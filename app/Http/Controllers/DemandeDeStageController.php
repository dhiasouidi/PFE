<?php

namespace App\Http\Controllers;

use App\DemandeDeStage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DemandeDeStageController extends Controller
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
        $infos->validate
        ([
        'ORGANISME_DEMANDE' => 'required|string|max:255'
        ]);

        $demande= new DemandeDeStage;

        $demande->ORGANISME_DEMANDE=request('ORGANISME_DEMANDE');

        $demande->CIN_DEMANDE=Auth::user()->userable->CIN_PASSEPORT;

        $type_etudiant= Auth::user()->userable->etudiantable_type;

        switch ($type_etudiant) {
            case "etudiantpfe":
                $demande->TYPE_DEMANDE="pfe";
              break;
              case "etudiantregulier":
                $demande->TYPE_DEMANDE="ete";
            break;
            case "etudiantmp2":
                $demande->TYPE_DEMANDE="mpro";
            break;
        }
            $demande_stage=DemandeDeStage::create($demande);

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
    public function show(DemandeDeStage $demandeDeStage)
    {
        //
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
