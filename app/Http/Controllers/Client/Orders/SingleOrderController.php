<?php

namespace App\Http\Controllers\Client\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SingleOrderController extends Controller
{
    function __invoke($order){
        $order->loadCount('messages');
        $order->load('messages');

        return $this->view('client.orders.single', [
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
                'sender_id' => auth('web')->id(),
                'sender_type' => User::MODEL_NAME,
                'message' => $request->message,
                'is_answer' => false
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

    function retryPayment($order){
        if(!$order->didFail()){
            return back()->withErrors([
                'status' => 'Payment for this order cannot be retried'
            ]);
        }

        // Make draft
        $order->status = Order::STATUS_DRAFT;

        $order->save();

        return redirect()->route('client.orders.create.review', ['order' => $order]);
    }

    function getAttachment(Request $request, $order, $attachment, $message = null){
        if(!$request->hasValidSignature()){
            return back()
                ->withErrors([
                    'status' => 'Url is expired or invalid. Please click the attachment link again'
                ]);
        }

        // If image, return the url
        if($attachment->isImage()){
            return response()->file(storage_path('app/'.$attachment->path));
        }

        // Return file download response
        return response()->download(storage_path('app/'.$attachment->path), $attachment->name);
    }

    function deleteAttachment($order, $attachment){
        // Check auth
        if($order->user_id == auth()->id()){
            if($attachment->delete()){
                Storage::delete(storage_path('app/'.$attachment->path));
            }

            return back()->with([
                'status' => 'Attached file '.$attachment->name.' deleted'
            ]);
        }

        // Return file download response
        return back()->withErrors([
            'status' => 'ATtached file not found'
        ]);
    }
}
