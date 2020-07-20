<?php

namespace App\Http\Controllers\api;

use App\Admin;
use App\Enseignant;
use App\Etudiant;
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

                switch($user->userable_type)
                {
                    case 'etudiant' :
                        $userinfo = Etudiant::find($user->login);
                        break;
                    case 'enseignant':
                        $userinfo = Enseignant::find($user->login);
                        break;
                    case 'admin':
                        $userinfo = Admin::find($user->login);
                        break;
                }
                $accesstoken = $user->createToken('access_token')->accessToken;
                return response(['user'=>$authenticated_user ,'userinfo'=>$userinfo, 'access_token'=>$accesstoken]);
            }
        }catch(\Exception $exception){
            return response([
                'message'=>$exception->getMessage()
                ],400);
        }
        return response(['message'=>'Invalid Login/Password'],401);
    }

}
