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
        $login = $request->validate([
            'login'=>'required|string',
            'password'=>'required|string'
        ]);

        if(!Auth::attempt($login))
        {
            return response(['message'=>'Invalid Login Credentials']);
        }

        $auth_user = Auth::user();
        $user = User::find($auth_user->id);
        $accesstoken = $user->createToken('access_token')->accessToken;
        return response(['user'=>Auth::user()->userable->NOM , 'access_token'=>$accesstoken]);
    }
}
