<?php

namespace App\Http\Controllers;

use App\Http\Resources\DistrictResource;
use App\Models\Country;
use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $code)
    {
        $validation = validator()->make(request()->all(),[
            'limit' => "nullable|numeric|min:1|max:100",
            "search" => "nullable|max:20|min:2"
        ]);

        if($validation->fails()){
            return $this->api_error_response($validation->errors(),"invalid data", "nil",422);
        }
        
        $country =  Country::where("code" , $code)->first();

        if(!$country){
            return $this->api_error_response([
                "code" => [
                    "Country Not found"
                ]
                ],"Not Found" , "nil" , 404);
        }

        $data =  $country->districts()
        ->when(request()->has("search"),function($q){
            $search = request()->search;
            $q->whereLike('districts_name', '%'.$search.'%', caseSensitive: false);
        })
        ->paginate($request->limit ?? 20)->through(fn($record) => new DistrictResource($record));

        return $this->api_response( data:$data,   message: "success");

        
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(District $district)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(District $district)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, District $district)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(District $district)
    {
        //
    }
}
