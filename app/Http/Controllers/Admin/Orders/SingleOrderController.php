<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Events\NewMessageEvent;
use App\Events\OrderCancelledEvent;
use App\Events\OrderCompletedEvent;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SingleOrderController extends Controller
{
    function __invoke($order){
        $order->loadCount('messages');
        $order->load('messages');

        return $this->view('admin.orders.single', [
            'order' => $order
        ]);
    }

    function sendMessage(Request $request, $order){
        try{
            $validator = validator([
                'message' => 'nullable',
                'attachments' => 'nullable|array',
                'attachments.*' => 'file'
            ]);

            if($validator->fails()){
                return redirect()->back()
                    ->withInput()
                    ->withErrors([
                        'status' => 'Please fix the highlighted errors and try again'
                    ])
                    ->withErrors($validator->errors());
            }

            // Ensure there is at least one attachment or a message
            if(!$request->hasFile('attachments') && !$request->message){
                return redirect()->back()
                    ->withInput()
                    ->withErrors([
                        'status' => 'Please enter a message or attach a file'
                    ]);
            }

            // Save message
            DB::beginTransaction();

            $message = $order->messages()->create([
                'sender_id' => auth('admin')->id(),
                'sender_type' => Admin::MODEL_NAME,
                'message' => $request->message,
                'is_answer' => $request->boolean('complete')
            ]);

            if(!$message->id ?? null){
                DB::rollBack();

                return redirect()->back()
                    ->withInput()
                    ->withErrors([
                        'status' => 'An error occurred while sending the message. Please try again later.'
                    ]);
            }

            // Save attachments
            if($request->hasFile('attachments')){
                foreach($request->file('attachments') as $file){
                    $attachment = $message->attachments()->create([
                        'name' => $file->getClientOriginalName(),
                        'path' => $file->store('attachments/messages'),
                        'type' => $file->getMimeType(),
                    ]);

                    if(!$attachment->id ?? null){
                        DB::rollBack();

                        return redirect()->back()
                            ->withInput()
                            ->withErrors([
                                'status' => 'An error occurred while sending the message. Please try again later.'
                            ]);
                    }
                }
            }

            $orderWasAlreadyCompleted = $order->isCompleted();

            // If order was marked complete
            if($request->boolean('complete')){
                $order->update([
                    'status' => Order::STATUS_COMPLETED,
                    'completed_at' => now()
                ]);

                if(!$orderWasAlreadyCompleted){
                    OrderCompletedEvent::dispatch($order);
                }
            }else{
                NewMessageEvent::dispatch($message);
            }

            DB::commit();

            return back();

        }catch(\Exception $e){
            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors([
                    'status' => 'An error occurred while sending the message. Please try again later.'
                ]);
        }
    }

    function cancel(Request $request, $order){
        // Order should be active to be cancelled
        if(!$order->isActive()){
            return back()
                ->withInput()
                ->withErrors([
                    'status' => 'The order cannot be cancelled at this stage. Only active orders can be cancelled'
                ]);
        }

        // Reason should be provided
        if(!$request->reason){
            return back()
                ->withInput()
                ->withErrors([
                    'status' => 'Please provide a reason for cancelling the order'
                ]);
        }

        try{
            $order->update([
                'status' => Order::STATUS_CANCELLED,
                'cancelled_at' => now(),
                'cancellation_reason' => $request->reason
            ]);

            OrderCancelledEvent::dispatch($order);

            return back()->with([
                'status' => 'The order has bee cancelled'
            ]);
        }catch(\Exception $e){
            return back()
                ->withInput()
                ->withErrors([
                    'status' => 'An error occurred while cancelling the order. Please try again later.'
                ]);
        }
    }
}
