<?php

namespace App\Helpers;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;

class Paypal
{
    /* 
    انشاء order يتم بمرحلتين
    1-بنشا طلبةفي بيبال
    برجعلك رقم لي انشئه
    2-توجه مستخدم الي عملية الدفع
    3-تنفيذ الدفع
    */

    public  function paypal($total, $id)
    {
        $config = config('services.paypal');

        $environment = new SandboxEnvironment($config['client_id'], $config['client_secret']);

        $client = new PayPalHttpClient($environment);
        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = [
            "intent" => "CAPTURE",
            "purchase_units" => [[
                "reference_id" => $id,
                "amount" => [
                    "value" => $total,
                    "currency_code" => "USD"
                ]
            ]],
            "application_context" => [
                "cancel_url" => url(route('paypal.cancle')),
                "return_url" => url(route('paypal.return'))
            ]
        ];

        try {

            // Call API with your client and get a response for your call
            $response = $client->execute($request);

            if ($response->statusCode == 201 && isset($response->result)) {

                foreach ($response->result->links as $link) {
                    session()->put('paypal_order_id', $response->result->id);
                    session()->put('wasfa_id', $id);

                    if ($link->rel == 'approve') {

                        return redirect()->to($link->href)->send();
                    }
                }
                dd('yes');
            }
        } catch (Throwable $ex) {
            return $ex->getMessage();
        }
        return 'error';
    }


    public function paypalclient()
    {
        $config = config('services.paypal');

        $environment = new SandboxEnvironment($config['client_id'], $config['client_secret']);

        $client = new PayPalHttpClient($environment);

        return $client;
    }
    public  function paypalReturn()
    {


        $paypal_order_id = session()->get('paypal_order_id');
        $request = new OrdersCaptureRequest($paypal_order_id);
        $request->prefer('return=representation');
        try {
            $response =    $this->paypalclient()->execute($request);

            if ($response->statusCode == 201) {
                if (strtoupper($response->result->status == 'COMPLETED')) {
                    return ['id' => session()->get('wasfa_id'), 'message' => 'تم عملية الدفع بنجاح'];
                }
            }
        } catch (Throwable $ex) {
            return $ex->getMessage();
        }
    }
}
