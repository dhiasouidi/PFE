<?php

namespace App\Http\Controllers;

use App\Enseignant;
use App\Etudiant;
use App\Sujet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\User;

class SujetController extends Controller
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
    public function create(Request $sujet)
    {
        $rules= [
            'TYPE_DEPOT' =>'required|string|min:2|max:255',
            'SESSION_ECRIT' =>'required|string|min:2|max:255',
            'SESSION_DEPOT' =>'required|string|min:2|max:255',
            'TITRE_SUJET' =>'required|string|min:2|max:255',
            'ABSTRACT' =>'required|string|min:2|max:255',
        ];

        $validator = Validator::make($sujet->all(),$rules);

        if($validator->fails())
        {
            return response()->json($validator->errors(),400);
        }

        $sujet=Sujet::create([
            'TYPE_DEPOT' => request('TYPE_DEPOT'),
            'SESSION_ECRIT' => request('SESSION_ECRIT'),
            'SESSION_DEPOT' => request('SESSION_DEPOT'),
            'TITRE_SUJET' => request('TITRE_SUJET'),
            'ABSTRACT' => request('ABSTRACT'),
        ]);

        $authenticated_user = Auth::user();
        $user = User::find($authenticated_user->login);
        $etudiant = Etudiant::find($user->login);
        $etudiant->SUJET_ID = $sujet->ID_SUJET;
        $etudiant->save();

        return response()->json($sujet,201);


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
     * @param  \App\Sujet  $sujet
     * @return \Illuminate\Http\Response
     */
    public function show(Sujet $sujet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sujet  $sujet
     * @return \Illuminate\Http\Response
     */
    public function edit(Sujet $sujet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sujet  $sujet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sujet = Sujet::find($id);
        if(is_null($sujet))
        {
            return response()->json(["message" => 'Record not found'],404);
        }
        $sujet->update($request->all());
        return response()->json($sujet,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sujet  $sujet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sujet $sujet)
    {
        //
    }

    public  function addencadrant(Request $encadrant)
    {
        $authenticated_user = Auth::user();
        $user = User::find($authenticated_user->login);
        $etudiant = Etudiant::find($user->login);

        $sujet= Sujet::find($etudiant->SUJET_ID);

        $rules= [
            'ENCADRANT' =>'required|string|min:2|max:255'
        ];

        $validator = Validator::make($encadrant->all(),$rules);

        if($validator->fails())
        {
            return response()->json($validator->errors(),400);
        }

        if($sujet->STATUT_ENCADRANT != '1')
        {
            $sujet->ENCADRANT = $encadrant->ENCADRANT;
            $sujet->save();
            return response()->json($sujet,200);
        }

        return response()->json(['message'=>'You can\'t send request'],401 );
    }

    public function deleteencadrant()
    {
        $authenticated_user = Auth::user();
        $user = User::find($authenticated_user->login);
        $etudiant = Etudiant::find($user->login);

        $sujet= Sujet::find($etudiant->SUJET_ID);

        if($sujet->STATUT_ENCADRANT != '1' && $sujet->ENCADRANT !=null)
        {
            $sujet->ENCADRANT=null;
            $sujet->STATUT_ENCADRANT='0';
            $sujet->save();
            return response()->json(null,204);
        }
        return response()->json(['message'=>'You can\'t delete your supervisor'],401 );

    }

    public function acceptencadrement($id)
    {
        $authenticated_user = Auth::user();
        $user = User::find($authenticated_user->login);
        $encadrant = Enseignant::find($user->login);

        $sujet= Sujet::find($id);

        if($sujet->ENCADRANT == $encadrant->ID_ENSEIGNANT && $sujet->STATUT_ENCADRANT !='1' )
        {
            $sujet->STATUT_ENCADRANT='1';
            $sujet->save();
            return response()->json([$sujet],200);
        }
        return response()->json(['message'=>'You can\'t accept request'],401 );

    }

    public function refuserencadrement($id)
    {
        $authenticated_user = Auth::user();
        $user = User::find($authenticated_user->login);
        $encadrant = Enseignant::find($user->login);

        $sujet= Sujet::find($id);

        if($sujet->STATUT_ENCADRANT !='1')
        {
            $sujet->STATUT_ENCADRANT='2';
            $sujet->save();
            return response()->json([$sujet],200);
        }
        return response()->json(['message'=>'You can\'t refuse request'],401 );

    }
}
