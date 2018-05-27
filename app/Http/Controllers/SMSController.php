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
                'Authorization: BearerToken '.$this->oauth(),
                'Content-Type: application/json',
                'Content-Length: ' . strlen($rawData)
            ]
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        return collect(json_decode($response,true));
    }

    public function oauth()
    {
        $url = "https://api-prd.kpn.com/oauth/client_credential/accesstoken?grant_type=client_credentials";
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => http_build_query([
                'client_id' => env('KPN_SMS_ID'),
                'client_secret' => env('KPN_SMS_KEY')
            ]),
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/x-www-form-urlencoded',
            ]
        ]);

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response,1)['access_token'];

    }
}
