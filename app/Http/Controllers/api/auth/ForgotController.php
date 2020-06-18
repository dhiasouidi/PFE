<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotRequest;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;


class ForgotController extends Controller
{

    public function forgot(ForgotRequest $request){

        $email = $request->input('login');

        if(User::where('login',$email)->doesntExist())
        {
            return response([
                'message'=>'User not found'
            ],404);
        }

        $token = Str::random(10);

        try{

            return response([
                'message'=>'Check your email ! '
            ]);


        }catch(\Exception $e){
            return response([
                'message'=>$e->getMessage()
            ]);

        }
    }
}
