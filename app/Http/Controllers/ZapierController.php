<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ZapierController extends Controller
{
    public function getCompanyDetails(Request $request)
    {
        try {
            $zap_array = $request->all();

            // stuff it into a query
            $zap_array = http_build_query($zap_array);

            // get my zap URL
            $ZAPIER_HOOK_URL = "https://hooks.zapier.com/hooks/catch/16472073/3rlfays/";

            // curl my data into the zap
            $ch = curl_init($ZAPIER_HOOK_URL);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $zap_array);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $response = curl_exec($ch);
            return response()->json(['success'=>true, 'message'=>"Request Successfull"]);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }

    public function getAttendeesDetails(Request $request)
    {
        return response()->json('Api request');
    }
}
