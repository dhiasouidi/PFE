<?php

namespace App\Http\Controllers;

use App\Enseignant;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class EnseignantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Enseignant::get(),200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $infos)
    {
        $rules= [
            'NOM' =>'bail|required|string|min:2',
            'PRENOM' =>'bail|required|string|min:2',
            'SPECIALITE' =>'bail|required|string|min:2',
            'ETABLISSEMENT' =>'bail|required|string|min:2',
            'UNIVERSITE' =>'bail|required|string|min:2',
            'GRADE' =>'bail|required|string|min:2',
            'TELEPHONE' =>'bail|required|string|min:8',
            'EMAIL' =>'bail|required|email|min:8',
        ];

        $validator = Validator::make($infos->all(),$rules);

        if($validator->fails())
        {
            return response()->json($validator->errors(),400);
        }

            $enseignant=Enseignant::create([
                'ID_ENSEIGNANT' => request('NOM').request('PRENOM').'ISGT',
                'NOM' => request('NOM'),
                'PRENOM' => request('PRENOM'),
                'SPECIALITE' => request('SPECIALITE'),
                'ETABLISSEMENT' => request('ETABLISSEMENT'),
                'UNIVERSITE' => request('UNIVERSITE'),
                'GRADE' => request('GRADE'),
                'TELEPHONE' => request('TELEPHONE'),
                'EMAIL' => request('EMAIL'),
            ]);

            $user = User::create([
                'login' => request('NOM').request('PRENOM').'ISGT',
                'password' => Hash::make('admin'),
                'email' => request('EMAIL'),
                'userable_id' => request('NOM').request('PRENOM').'ISGT',
                'userable_type' => 'enseignant',
            ]);

            return response()->json([$enseignant,$user],201);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  \App\Enseignant  $enseignant
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $enseignant = Enseignant::find($id);
        if(is_null($enseignant))
        {
            return response()->json(["message" => 'Record not found'],404);
        }
        return response()->json(Enseignant::find($id));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Enseignant  $enseignant
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Enseignant  $enseignant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $enseignant = Enseignant::find($id);
        if(is_null($enseignant))
        {
            return response()->json(["message" => 'Record not found'],404);
        }

        $enseignant->update($request->all());
        return response()->json($enseignant,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Enseignant  $enseignant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $enseignant = Enseignant::find($id);

        if(is_null($enseignant))
        {
            return response()->json(["message" => 'Record not found'],404);
        }
        $enseignant->delete();

        return response()->json(null,204);
    }

    public function sujets()
    {
        $authenticated_enseignat = Auth::user();

        if($authenticated_enseignat->userable_type != 'enseignant')
        {
            return response()->json(["message" => 'Record not found'],404);
        }

        $enseignant = Enseignant::find($authenticated_enseignat->userable_id);

        return $enseignant->sujets;
    }

    public function demandes()
    {
        $authenticated_enseignant = Auth::user();

        if($authenticated_enseignant->userable_type != 'enseignant')
        {
            return response()->json(["message" => 'Record not found'],404);
        }

        $encadrant = Enseignant::find($authenticated_enseignant->userable_id);
        return $encadrant->demandes;
    }
}
