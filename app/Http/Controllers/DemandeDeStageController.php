<?php

namespace App\Http\Controllers;

use App\DemandeDeStage;
use App\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;



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
        $infos->validate
        ([
        'ORGANISME_DEMANDE' => 'required|string|max:255'
        ]);

        $authenticated_user = Auth::user();

        $user = User::find($authenticated_user->login);

        $etudiant = Etudiant::find($user->login);

        $type_etudiant= $etudiant->etudiantable_type;

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
                'CIN_DEMANDE' => $etudiant->CIN_PASSEPORT,
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
        return response()->json(DemandeDeStage::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DemandeDeStage  $demandeDeStage
     * @return \Illuminate\Http\Response
     */
    public function edit(DemandeDeStage $demandeDeStage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DemandeDeStage  $demandeDeStage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DemandeDeStage $demandeDeStage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DemandeDeStage  $demandeDeStage
     * @return \Illuminate\Http\Response
     */
    public function destroy(DemandeDeStage $demandeDeStage)
    {
        //
    }
}
