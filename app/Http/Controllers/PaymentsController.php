<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPayment;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function mb(Request $request)
    {
        $curl = curl_init();

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => 'https://ifthenpay.com/api/multibanco/reference/sandbox',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                    "mbKey": "YBN-625144",
                    "orderId": ' . 1 . ',
                    "amount": ' . $request->amount . '
                }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                ),
            )
        );

        $response = curl_exec($curl);

        curl_close($curl);

        $mb = json_decode($response, true);

        return view('partials.mb')->with([
            'amount' => $mb['Amount'],
            'entity' => $mb['Entity'],
            'reference' => $mb['Reference']
        ]);

    }

    public function subscriptionPaymentGenerate(Request $request)
    {
        
        $subscriptionPayment = new SubscriptionPayment;
        $subscriptionPayment->subscription_id = $request->subscription_id;
        $subscriptionPayment->value = $request->value;
        $subscriptionPayment->method = $request->method;
        $subscriptionPayment->paid = $request->paid;
        $subscriptionPayment->save();
        
        return [];
    }
}