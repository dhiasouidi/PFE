<?php

namespace App\Http\Controllers;

use App\Admin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;




class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $infos)
    {
        $rules= [
            'PSEUDO' =>'bail|unique:App\Admin,PSEUDO|required|string|min:5',
            'NOM' =>'bail|required|string|min:2',
            'PRENOM' =>'bail|required|string|min:2',
            'FONCTION' =>'bail|required|string|min:2',
        ];

        $validator = Validator::make($infos->all(),$rules);

        if($validator->fails())
        {
            return response()->json($validator->errors(),400);
        }

            $admin=Admin::create([
                'PSEUDO' => request('PSEUDO'),
                'NOM' => request('NOM'),
                'PRENOM' => request('PRENOM'),
                'FONCTION' => request('PRENOM'),

            ]);

            $user = User::create([
                'login' => request('PSEUDO'),
                'password' => Hash::make('admin'),
                'email' => request('EMAIL'),
                'userable_id' => request('PSEUDO'),
                'userable_type' => 'admin',
            ]);

            return response()->json([$admin,$user],201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */

    public function currentadmin()
    {
        $authenticated_user = Auth::user();
        $user = User::find($authenticated_user->login);
        $admin = Admin::find($user->login);
        return $admin;
    }
    public function update(Request $request)
    {

        $admin = $this->currentadmin();

        $rules= [
            'NOM' => 'string|min:2|max:255',
            'PRENOM' => 'string|min:2|max:255',
                            ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails())
        {
            return response()->json($validator->errors(),400);
        }

        $admin->update($request->all());
        return response()->json($admin,200);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
