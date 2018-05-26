<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PolitieApiController extends Controller
{
    private $endpoint = 'https://api.acceptatie.politie.nl';
    private $apiVersion = 'v4';


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => ['data']
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Get the local officer near a certain latitude en longitude
     * @param $lat string Latitude of the area to search in
     * @param $long string Longitude of the area to search in.
     */
    public function localOfficer($lat,$long)
    {
        $arguments = [
            'lat' => $lat,
            'lon' => $long
        ];

        $data = $this->call('wijkagenten',$arguments);
        if($data->has('wijkagenten')){
            return response()->json([
                'status' => 'success',
                'data' => $data['wijkagenten'][0]
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'No results'
        ]);
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
            CURLOPT_URL => $this->endpoint . '/' . $this->apiVersion . '/' . $url . '?' . http_build_query($arguments),
            CURLOPT_HTTPHEADER => ['x-api-key: '.env('POLITIE_KEY')]
        ]);


        $response = curl_exec($curl);

        curl_close($curl);

        return collect(json_decode($response,true));
    }
}
