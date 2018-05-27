<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SMSController extends Controller
{
    /**
     * Make a call to the API using curl
     *
     * @param string $url to call from the API
     * @param array $arguments Arguments for the API
     * @return Collection JSON decoded object from the API.
     */
    public function send($message, $number){

        $rawData = '{
                   "messages": [
                       {
                           "content": "'.$message.'",
                           "mobile_number": "'.$number.'"
                       }
                   ],
                  "sender": "SHB"
                }';

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POSTFIELDS => $rawData,
            CURLOPT_URL => "https://api-prd.kpn.com/messaging/sms-kpn/v1/send",
            CURLOPT_HTTPHEADER => [
                'Authorization: BearerToken '.env('KPN_SMS_KEY'),
                'Content-Type: application/json',
                'Content-Length: ' . strlen($rawData)
            ]
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        dd($response);

        return collect(json_decode($response,true));
    }
}
