<?php

namespace App\Http\Controllers;

abstract class Controller
{
    

    public function api_response($data , $message ='' , $status = 'ok' , $httpCode = 200){

        return response()->json([
            "data" => $data,
            "status" =>  $status,
            "message" => $message
        ],$httpCode);
    }

    public function api_error_response($errors , $message , $status = 'nil' , $httpCode = 400){

        return response()->json([
            'errors' => $errors,
            'message' => $message,
            "status" => $status
        ], $httpCode);
    }
}
