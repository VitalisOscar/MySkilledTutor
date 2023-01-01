<?php

namespace App\Http\Controllers\Client;

use App\Events\OrderCreatedEvent;
use App\Events\OrderFailedEvent;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal;

class PaymentController extends Controller
{
    function process($order){
        // Check if there is a pending payment
        $pendingPayment = $order->payments()
            ->pending()
            ->first();

        if($pendingPayment != null){
            return redirect()->route('client.orders.create.review', $order)
                ->withErrors([
                    'status' => 'There is an ongoing payment for this order. You can try again only after it fails'
                ]);
        }

        $provider = new PayPal;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('client.orders.payments.completed', $order),
                "cancel_url" => route('client.orders.payments.cancelled', $order),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $order->price
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    // Create a payment record
                    $order->payments()->create([
                        'amount' => $order->price,
                        'currency' => 'USD',
                        'method' => 'PayPal',
                        'reference' => $response['id'],
                        'data' => [],
                        'status' => Payment::STATUS_PENDING,
                    ]);

                    return redirect()->away($links['href']);
                }
            }

            return redirect()
                ->route('client.orders.create.review', $order)
                ->withErrors('status', 'Failed to initiate a payment. Please try again.');

        } else {
            return redirect()
                ->route('client.orders.create.review', $order)
                ->withErrors('status', 'Failed to initiate a payment. Please try again.');
        }
    }

    function cancelled($order){
        $this->failOrder($order);

        return redirect()
            ->route('client.orders.create.review', $order)
            ->withErrors('status', 'Payment cancelled. You can still try again');
    }

    function completed(Request $request, $order){
        $provider = new PayPal;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $this->progressOrder($order);

            return redirect()
                ->route('client.orders.single', $order)
                ->with('status', 'Payment processed successfully');
        } else {
            $this->failOrder($order);

            return redirect()
                ->route('client.orders.create.review', $order)
                ->withErrors('status', 'Something went wrong. Please try again');
        }
    }

    function failOrder($order){
        // Mark order as cancelled
        $order->update([
            'status' => Order::STATUS_FAILED
        ]);

        // Mark the order's pending payment as failed
        $order->payments()
            ->pending()
            ->update([
                'status' => Payment::STATUS_FAILED
            ]);

        OrderFailedEvent::dispatch($order);
    }

    function progressOrder($order){
        // Mark order as in progress
        $order->update([
            'status' => Order::STATUS_ACTIVE,
            'paid_at' => now()
        ]);

        // Mark payment complete
        $order->payments()
            ->pending()
            ->update([
                'status' => Payment::STATUS_COMPLETED
            ]);

        OrderCreatedEvent::dispatch($order);
    }
}
