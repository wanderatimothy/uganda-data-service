<?php

namespace App\Http\Controllers;

use App\Http\Resources\CountryResource;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data =  Cache::remember("countries_data",140,function(){
            return Country::all();
        });
        return $this->api_response(CountryResource::collection($data));
    }



    /**
     * Display the specified resource.
     */
    public function getCountryName(Request $request)
    {
        $validation = validator()->make($request->all(),[
            'code' => 'required|max:3|min:2|exists:countries,code'
        ],[
            'exists' => 'The code provide is not associated with any country in our database',
            'required' => 'Please provide a country code'
        ]);

        if($validation->fails()) return $this->api_error_response($validation->errors(),'request was not completed');

        $country = Country::where("code",$request->code)->first();

        return $this->api_response(CountryResource::make($country));
    }





}
