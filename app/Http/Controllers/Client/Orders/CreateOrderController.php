<?php

namespace App\Http\Controllers\Client\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class CreateOrderController extends Controller
{
    function start(Request $request, $order = null){
        if($request->isMethod('GET')){
            return $this->view(
                'client.orders.create',
                array_merge(
                    $this->data(),
                    [
                        'order' => $order,
                        'step' => 'start',
                    ]
                )
            );
        }

        // Save draft and go to step 2
        $validator = validator($request->post(), [
            'paper_type' => 'required|exists:paper_types,id',
            'academic_level' => 'required|exists:academic_levels,id',
            'subject' => 'required|exists:subjects,id',
        ]);

        if($validator->fails()){
            return back()->withInput()
                ->with([
                    'status' => 'Please fix the highlighted errors and try again'
                ])
                ->withErrors($validator);
        }

        // Create an order if null, otherwise update
        if($order == null){
            $order = $request->user()->orders()->create([
                'paper_type_id' => $request->post('paper_type'),
                'academic_level_id' => $request->post('academic_level'),
                'subject_id' => $request->post('subject'),
                'status' => Order::STATUS_DRAFT
            ]);
        }else{
            $order->update([
                'paper_type_id' => $request->post('paper_type'),
                'academic_level_id' => $request->post('academic_level'),
                'subject_id' => $request->post('subject'),
            ]);
        }

        // Go to step 2
        return redirect()->route('client.orders.create.requirements', $order);
    }

    function requirements(Request $request, $order){
        if($request->isMethod('GET')){
            return $this->view(
                'client.orders.create',
                array_merge(
                    $this->data(),
                    [
                        'order' => $order,
                        'step' => 'requirements',
                    ]
                )
            );
        }

        // Save requirements to draft and go to step 3
        // Validate
        $validator = validator($request->post(), [
            'title' => 'required',
            'instructions' => 'required',
            'urgency' => 'required|numeric|min:1',
            'urgency_type' => 'required|in:days,hours',
            'pages' => 'required|numeric|min:1',
            'formatting' => 'required|in:'.implode(',', Order::FORMATTING_OPTIONS),
            'attachments' => 'array',
            'attachments.*' => 'file|max:8192|mimes:doc,docx,pdf,txt,jpg,jpeg,png'
        ]);

        if($validator->fails()){
            return back()->withInput()
                ->withErrors([
                    'status' => 'Please fix the highlighted errors and try again'
                ])
                ->withErrors($validator);
        }

        // Convert urgency to hours
        $urgency = $request->post('urgency');
        if($request->post('urgency_type') == 'days'){
            $urgency = $urgency * 24;
        }

        // Save order
        $order->update([
            'title' => $request->post('title'),
            'instructions' => $request->post('instructions'),
            'urgency' => $urgency,
            'pages' => $request->post('pages'),
            'formatting' => $request->post('formatting'),
        ]);

        // Save attachments
        if($request->hasFile('attachments')){
            foreach($request->file('attachments') as $file){
                $order->attachments()->create([
                    'name' => $file->getClientOriginalName(),
                    'path' => $file->store('attachments'),
                    'type' => $file->getMimeType(),
                ]);
            }
        }

        // Go to step 3
        return redirect()->route('client.orders.create.review', $order);
    }

    function review(Request $request, $order){
        // Calculate the order price
        $order->calculatePrice();

        if($request->isMethod('GET')){
            return $this->view(
                'client.orders.create',
                array_merge(
                    $this->data(),
                    [
                        'order' => $order,
                        'step' => 'review'
                    ]
                )
            );
        }

        // User confirmed order
        // Update order status
        $order->update([
            'status' => Order::STATUS_PENDING_PAYMENT
        ]);

        // Redirect to get paypal payment
        return redirect()->route('client.orders.payments.attempt', $order);

    }

    function data(){
        return [
            'paper_types' => \App\Models\PaperType::all(),
            'academic_levels' => \App\Models\AcademicLevel::all(),
            'subjects' => \App\Models\Subject::all(),
            'formatting' => Order::FORMATTING_OPTIONS,
        ];
    }
}
