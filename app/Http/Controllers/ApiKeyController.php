<?php

namespace App\Http\Controllers;

use App\Models\ApiKey;
use Illuminate\Http\Request;
use Spatie\Crypto\Rsa\KeyPair;

class ApiKeyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = validator()->make($request->all(),[
            'name' => 'required|max:255|min:2',
            'expiry' => 'required'
        ]);

        if($validation->fails()){
            return $this->api_error_response($validation->errors(),"invalid data");
        }

        $secret = $request->user()->secret;

        [$passwordProtectedPrivateKey, $publicKey] = (new KeyPair())->password($secret)->generate();

        $apiKey = new ApiKey();
        
        $apiKey->user_id =  $request->user()->id;




    }

    /**
     * Display the specified resource.
     */
    public function show(ApiKey $apiKey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ApiKey $apiKey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ApiKey $apiKey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ApiKey $apiKey)
    {
        //
    }
}
