<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginController extends Controller
{
    public function login (Request $request)
    {
        try{
            if(Auth::attempt($request->only('login','password'))){


                $authenticated_user = Auth::user();
                $user = User::find($authenticated_user->login);
                $accesstoken = $user->createToken('access_token')->accessToken;
                return response(['message'=>'success','user'=>$authenticated_user , 'access_token'=>$accesstoken]);
            }
        }catch(\Exception $exception){
            return response([
                'message'=>$exception->getMessage()
                ],400);
        }
        return response(['message'=>'Invalid Login/Password'],401);
    }
}
