<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use App\Http\Controllers\Controller;

class PayPalController extends Controller
{
    //

    // Helper to get PayPal HTTP client
    private function paypalClient()
    {
        $clientId = config('services.paypal.client_id');
        $clientSecret = config('services.paypal.secret');
        $environment = new SandboxEnvironment($clientId, $clientSecret);
        return new PayPalHttpClient($environment);
    }

    // Create PayPal order
    public function createOrder(Request $request)
    {
        // Initialize PayPal client
        $client = $this->paypalClient();

        // Create order request
        $orderRequest = new OrdersCreateRequest();
        $orderRequest->prefer('return=representation');

        $orderRequest->body = [
            'intent' => 'CAPTURE',
            'purchase_units' => [[
                'amount' => [
                    'currency_code' => 'USD',
                    'value' => $request->input('amount', '10.00') // default to 10.00 if not provided
                ]
            ]],
            'application_context' => [
                'return_url' => route('paypal.capture'), // define this route in web.php
                'cancel_url' => route('paypal.cancel'),
            ]
        ];

        // Execute the request
        try {
            $response = $client->execute($orderRequest);
            $approveLink = collect($response->result->links)->firstWhere('rel', 'approve')->href;

            return response()->json([
                'orderID' => $response->result->id,
                'approve_url' => $approveLink
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    //  public function captureOrder(Request $request)
    // {
    //     $orderId = $request->query('token'); // PayPal sends token param on redirect

    //     if (!$orderId) {
    //         return response('Order ID missing', 400);
    //     }

    //     $client = $this->paypalClient();
    //     $captureRequest = new OrdersCaptureRequest($orderId);
    //     $captureRequest->prefer('return=representation');

    //     try {
    //         $response = $client->execute($captureRequest);

    //         // You can save order/payment details to DB here if you want

    //         // Redirect or return JSON as per your app
    //         return redirect('/thankyou');  // Or a React route you want
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }

    // public function cancel()
    // {
    //     return 'Payment cancelled by user.';
    // }

    public function captureOrder(Request $request)
    {
        $orderId = $request->query('token'); // PayPal sends token as "token"

        if (!$orderId) {
            return response('Order ID missing', 400);
        }

        $client = $this->paypalClient();
        $captureRequest = new OrdersCaptureRequest($orderId);
        $captureRequest->prefer('return=representation');

        try {
            $response = $client->execute($captureRequest);

            // Extract desired details
            $paypalOrderId = $response->result->id ?? '';
            $status = $response->result->status ?? '';
            $payerEmail = $response->result->payer->email_address ?? '';

            // Redirect to React with success and key data
            return redirect()->to(config('app.frontend_url') . '/checkout?' . http_build_query([
                'paypal_status' => 'success',
                'paypal_order_id' => $paypalOrderId,
                'status' => $status,
                'payer_email' => $payerEmail,
            ]));
        } catch (\Exception $e) {
            // Log error if needed
            return redirect()->to(config('app.frontend_url') . '/checkout?paypal_status=fail');
        }
    }


    public function cancel(Request $request)
    {
        $orderId = session('paypal_order_id');

        // Optional: Remove session value
        session()->forget('paypal_order_id');

        return redirect()->to(config('app.frontend_url') . '/checkout?' . http_build_query([
            'paypal_status' => 'cancelled',
            'paypal_order_id' => $orderId,
        ]));
    }

}
