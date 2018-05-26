<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class AddressesController extends Controller
{
    private $endpoint = "https://api.postcodeapi.nu/";
    private $apiVersion = "v2";


    public function checkZipcode(string $zipcode, string $number)
    {
        $data = $this->call('addresses', [
            'postcode' => $zipcode,
            'number' => $number
        ]);

        if($data->has('_embedded')){
            $embed = collect($data['_embedded']);
            if($embed->has('addresses')){
                $address = $embed->get('addresses')[0];
                $geo = $address['geo']['center']['wgs84']['coordinates'];
                $long = $geo['0'];
                $lat = $geo['1'];
                return [
                    'lat' => $lat,
                    'long' => $long
                ];
            }
        }

        return false;
    }

    /**
     * Make a call to the API using curl
     *
     * @param string $url to call from the API
     * @param array $arguments Arguments for the API
     * @return Collection JSON decoded object from the API.
     */
    private function call(string $url, array $arguments){
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $this->endpoint . $this->apiVersion . '/' . $url . '/?' . http_build_query($arguments),
            CURLOPT_HTTPHEADER => ['x-api-key: '.env('POSTCODE_KEY')]
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        return collect(json_decode($response,true));
    }
}
