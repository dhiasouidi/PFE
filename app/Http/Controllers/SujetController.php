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
        return response()->json(Sujet::get(),200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $sujet)
    {
        $authenticated_user = Auth::user();
        $user = User::find($authenticated_user->login);
        $etudiant = Etudiant::find($user->login);
        if($etudiant->AFFECTATION == 'NA')
        {
            return response()->json(["message" => 'Pas affecté à un stage'],400);
        }

        if(!is_null($etudiant->SUJET_ID))
        {
            return response()->json(["message" => 'Sujet déjà crée'],400);
        }

        $rules= [
            'SESSION_ECRIT' =>'string|min:2|max:255',
            'SESSION_DEPOT' =>'string|min:2|max:255',
            'TITRE_SUJET' =>'required|string|min:2|max:255',
            'ABSTRACT' =>'string|min:2|max:255',
        ];

        $validator = Validator::make($sujet->all(),$rules);

        if($validator->fails())
        {
            return response()->json($validator->errors(),400);
        }
        if($etudiant->etudiant_type == 'etudiantpfe')
        {
            $ecrit = '0';
            $depot = '0';
            $abstract = '0';
        }else
        {
            $ecrit = request('SESSION_ECRIT');
            $depot = request('SESSION_DEPOT');
            $abstract = request('ABSTRACT');
        }

        $sujet=Sujet::create([
            'TYPE_DEPOT' => $etudiant->etudiant_type ,
            'SESSION_ECRIT' => $ecrit ,
            'SESSION_DEPOT' => $depot ,
            'TITRE_SUJET' => request('TITRE_SUJET'),
            'ABSTRACT' => $abstract,
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Sujet  $sujet
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sujet = Sujet::find($id);
        if(is_null($sujet))
        {
            return response()->json(["message" => 'Record not found'],404);
        }
        return response()->json(Sujet::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sujet  $sujet
     * @return \Illuminate\Http\Response
     */


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

        $infosencadrant = Enseignant::find($encadrant->ENCADRANT);

        if(is_null($infosencadrant))
        {
            return response()->json(["message"=>'Enseignant Introuvabale'],404);
        }

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
        if(is_null($sujet))
        {
            return response()->json(['message'=>'Vous avez pas un sujet '],401 );
        }

        if($sujet->STATUT_ENCADRANT == '1')
        {
            return response()->json(['message'=>'Vous pouvez pas supprimer votre encadrant'],401 );
        }

        if($sujet->ENCADRANT == null)
        {
            return response()->json(['message'=>'Aucun encadrant trouvé'],401 );
        }

            $sujet->ENCADRANT=null;
            $sujet->STATUT_ENCADRANT='0';
            $sujet->save();
            return response()->json(null,204);

    }


    public function acceptencadrement($id)
    {
        $authenticated_user = Auth::user();
        $user = User::find($authenticated_user->login);
        $encadrant = Enseignant::find($user->login);

        $sujet= Sujet::find($id);
        if(is_null($sujet))
        {
            return response()->json(['message'=>'Sujet introuvable'],401 );
        }

        if($sujet->STATUT_ENCADRANT =='1')
        {
            return response()->json(['message'=>'Sujet a déjà un encadrant'],401 );
        }

        if($sujet->ENCADRANT == $encadrant->ID_ENSEIGNANT)
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

        if($sujet->STATUT_ENCADRANT !='1' || $sujet->ENCADRANT != $encadrant->ID_ENSEIGNANT)
        {
            return response()->json(['message'=>'You can\'t refuse request'],401 );
        }

        $sujet->STATUT_ENCADRANT='2';
        $sujet->save();
        return response()->json([$sujet],200);

    }
}
