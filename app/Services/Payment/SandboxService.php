<?php


namespace App\Services\Payment;


use Illuminate\Support\Facades\Config;

class SandboxService
{


    public function payment($amount, $order, $onlinePayment){

        $merchantID = Config::get('payment.zarinpal_api_key');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://sandbox.zarinpal.com/pg/v4/payment/request.json',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
              "merchant_id": '. $merchantID .',
              "amount": '. $amount .',
              "callback_url": '. route('payment.callback', [$order, $onlinePayment]) .',
              "description": "Transaction description.",
              "metadata": {
                "mobile": "09106869409",
                "email": "info.test@gmail.com"
              }
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        echo  $response;


    }


    public function verifyPayment($amount, $onlinePayment)
    {

    }

}
