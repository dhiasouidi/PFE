<?php

namespace App\Http\Controllers;


use App\DemandeDeStage;
use App\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Validator;


class DemandeDeStageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(DemandeDeStage::get(),200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $infos)
    {
        $rules= [
            'ORGANISME_DEMANDE' =>'required|string|min:2'
        ];

        $validator = Validator::make($infos->all(),$rules);

        if($validator->fails())
        {
            return response()->json($validator->errors(),400);
        }

        $authenticated_user = Auth::user();

        $user = User::find($authenticated_user->login);

        $etudiant = Etudiant::find($user->login);

        $type_etudiant= $etudiant->etudiant_type;

        switch ($type_etudiant) {
            case "etudiantpfe":
                $TYPE_DEMANDE="pfe";
              break;
              case "etudiantregulier":
                $TYPE_DEMANDE="ete";
            break;
            case "etudiantmp2":
                $TYPE_DEMANDE="mpro";
            break;
        }

            $demande_stage=DemandeDeStage::create([
                'ETUDIANT_DEMANDE' => $etudiant->CIN_PASSEPORT,
                'ORGANISME_DEMANDE' => request('ORGANISME_DEMANDE'),
                'TYPE_DEMANDE' =>  $TYPE_DEMANDE,
            ]);

            return response()->json($demande_stage,201);
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
     * @param  \App\DemandeDeStage  $demandeDeStage
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $demande = DemandeDeStage::find($id);
        if(is_null($demande))
        {
            return response()->json(["message" => 'Record not found'],404);
        }
        return response()->json(DemandeDeStage::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DemandeDeStage  $demandeDeStage
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DemandeDeStage  $demandeDeStage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $demande = DemandeDeStage::find($id);
        if(is_null($demande))
        {
            return response()->json(["message" => 'Record not found'],404);
        }
        $id->update($request->all());
        return response()->json($id,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DemandeDeStage  $demandeDeStage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request , $id)
    {
        $demande = DemandeDeStage::find($id);
        if(is_null($demande))
        {
            return response()->json(["message" => 'Record not found'],404);
        }

        $id->delete();

        return response()->json(null,204);
    }
}
