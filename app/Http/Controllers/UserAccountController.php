<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientLoginRequest;
use App\Http\Requests\ClientRegisterationRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserAccountController extends Controller
{
    
    public function register(ClientRegisterationRequest $request){
        DB::beginTransaction();
        try{
             User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'name' => $request->name
            ]);

            DB::commit();
            return $this->api_response(null,'success', 'ok', 201);
        }catch(Exception $error){
            DB::rollBack();
            return $this->api_error_response([
                'error_type' => 'internal',
                'action' => 'contact support',
                'email' => 'wanderatimothy2@gmail.com',
                'extra' => $error->getMessage()
            ],'internal server error', 'nil' , 400);
        }
            
    }


    public function login(ClientLoginRequest $request){
            try{
            $auth = match($request->type)
            {
                "email" => User::where('email', $request->input)->first(),
                "phone" => User::where('phone', $request->input)->first(),
                default =>  throw new Exception('Failed to authenticate account'),
            };

            if(!($auth && Hash::check($auth->password ,$request->password))) return $this->api_error_response([
                'error_type' => 'client',
                'extra'  => 'Invalid Credentials',
                'action'
            ],'Invalid Credentials','nil', 403);

            $access_token = $auth->createToken($auth->name)->plainTextToken;

            return $this->api_response([
                'access_token' => $access_token,
                'expiry' => now()->copy()->add('minutes',30)
            ]);


            
            }catch(Exception $error){
                DB::rollBack();
                return $this->api_error_response([
                    'error_type' => 'internal',
                    'action' => 'contact support',
                    'email' => 'wanderatimothy2@gmail.com',
                    'extra' => $error->getMessage()
                ],'internal server error', 'nil' , 400);
            }
        
    }



    public function logout(Request $request){

        $user =  $request->user();

        $user->tokens()->delete();

        return $this->api_response(null,'See you soon','ok',200);
    }


    public function me(Request $request){

        return $this->api_response($request->user()->only([
            'email',
            'name',
            'phone',
            'postal_code',
            'photo'
        ]),'success','ok',200);
    }
}
