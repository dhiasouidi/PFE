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
            'login' => 'required|string',
            'password'=>'required|string'
        ]);

        if(!Auth::attempt($login)){
            return response(['message'=>'Invalid login credentials']);
        }

        $authenticated_user = Auth::user();
        $user = User::find($authenticated_user->login);
        $accesstoken = $user->createToken('access_token')->accessToken;
        return response(['user'=>$authenticated_user , 'access_token'=>$accesstoken]);
    }
}
