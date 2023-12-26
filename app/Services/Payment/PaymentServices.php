<?php


namespace App\Services\Payment;


use App\Models\OnlinePayment;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Config;
use Zarinpal\Clients\GuzzleClient;
use Zarinpal\Zarinpal;

class PaymentServices
{


    // lv.1
    public function zarinpal($amount,$order,$onlinePayment)
    {

        $merchantID = Config::get('payment.zarinpal_api_key');
        $sandbox = false;
        $zarinpalGate = false;
        $client = new GuzzleClient($sandbox);
        $zarinpalGatePSP = '';
        $lang = 'fa';
        $zarinpal = new Zarinpal($merchantID, $client, $lang, $sandbox, $zarinpalGate, $zarinpalGatePSP);

        $payment = [
            'amount' => (int)$amount * 10,
            'callback_url' => route('payment.callback',[$order,$onlinePayment]),
            'description' => 'some description',
        ];

        try {

            $response = $zarinpal->request($payment);
            $code = $response['data']['code'];
            $message = $zarinpal->getCodeMessage($code);
            if ($code === 100) {
                $onlinePayment->update(['bank_first_response' => $response]);
                $authority = $response['data']['authority'];
                return $zarinpal->redirect($authority);
            }

        } catch (RequestException $ex) {
            return false;
        }
    }



    // lv.3
    public function zarinpalVerify($amount, $onlinePayment)
    {
        $authority = $_GET['Authority'];
        $data = ['merchantID' => Config::get('payment.zarinpal_api_key'), 'authority' => $authority, 'amount' => (int)$amount];
        $jsonData = json_encode($data);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.zarinpal.com/pg/v4/payment/verify.json',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $jsonData,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json'
            ),
        ));

        $result = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($result, true);
        // save verify result in online payment
        $onlinePayment->update(['bank_second_response' => $result]);
        if (count($result['errors']) === 0) {
            if ($result['data']['code'] == 100) {
                return ['success' => true];
            } else {
                return ['success' => false];
            }
        } else {
            return ['success' => false];
        }


    }



}
