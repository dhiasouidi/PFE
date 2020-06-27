<?php

namespace App\Http\Controllers;

use App\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Validator;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Etudiant::get(),200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function show(Etudiant $id)
    {
        $etudiant = Etudiant::find($id);
        if(is_null($etudiant))
        {
            return response()->json(["message" => 'Record not found'],404);
        }
        return response()->json(Etudiant::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function edit(Etudiant $etudiant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Etudiant $etudiant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Etudiant $etudiant)
    {
        //
    }

    public function binome()
    {
        $authenticated_user = Auth::user();
        $user = User::find($authenticated_user->login);
        $etudiant = Etudiant::find($user->login);
        return response($etudiant->binome);
    }

    public function currentetudiant()
    {
        $authenticated_user = Auth::user();
        $user = User::find($authenticated_user->login);
        $etudiant = Etudiant::find($user->login);
        return $etudiant;
    }


    public function addbinome(Request $binome )
    {
        $etudiant = $this->currentetudiant();

        $rules= [
            'binome_id' =>'required|string|min:2'
        ];

        $validator = Validator::make($binome->all(),$rules);

        if($validator->fails())
        {
            return response()->json($validator->errors(),400);
        }

        if($etudiant->statut_binome != '1' &&
        $etudiant->binome_id == null &&
        $binome->binome_id != $etudiant->CIN_PASSEPORT  )
        //&&  $etudiant->SUJET_ID != null
        {
            $etudiant->fill( $binome->all() )->save();
            return response()->json($etudiant,200);
        }
        return response()->json(['message'=>'You can\'t send request'],401 );
    }

    //ADMIN ONLY
    public function deletebinome()
    {
        $etudiant = $this->currentetudiant();

        if($etudiant->statut_binome != '1' && $etudiant->binome_id !=null)
        {
            $etudiant->binome_id=null;
            $etudiant->statut_binome='0';
            $etudiant->save();

            return response()->json(null,204);
        }
        return response()->json(['message'=>'You can\'t delete your partner'],401 );

    }

    public function acceptbinome(Request $binome )
    {
        $etudiant = $this->currentetudiant();

        $binome_objet = Etudiant::find($binome->CIN_PASSEPORT);

        if($binome_objet->binome_id == $etudiant->CIN_PASSEPORT
            && $etudiant->statut_binome !='1')
        {
            $binome_objet->statut_binome='1';
            $etudiant->binome_id  = $binome->CIN_PASSEPORT;
            $etudiant->statut_binome='1';
            $etudiant->save();
            $binome_objet->save();
            return response()->json([$etudiant,$binome_objet],200);
        }
        return response()->json(['message'=>'You can\'t accept request'],401 );

    }

    public function refusebinome(Request $binome )
    {
        $etudiant = Etudiant::find($binome->CIN_PASSEPORT);

        $etudiant->statut_binome='2';

        $etudiant->fill( $binome->all() )->save();
        return response()->json($etudiant,200);
    }

    public function demandesbinome()
    {
        $etudiant = $this->currentetudiant();
        $demandes= Etudiant::find();
    }
    public function stage()
    {
        $etudiant = $this->currentetudiant();
        if(is_null($etudiant->stage))
        {
            return response()->json(["message" => 'Stage not found'],404);
        }
        return $etudiant->stage;
    }
}
