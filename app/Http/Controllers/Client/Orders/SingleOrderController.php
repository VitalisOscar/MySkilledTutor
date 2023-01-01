<?php

namespace App\Http\Controllers\Client\Orders;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                        'path' => $file->store('attachments/messages', 'public'),
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
}
