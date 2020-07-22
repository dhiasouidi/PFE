<?php

namespace App\Http\Controllers;

use App\Soutenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SoutenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Soutenance::get(),200);
    }

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Soutenance  $soutenance
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $soutenance = Soutenance::find($id);
        if(is_null($soutenance))
        {
            return response()->json(["message" => 'Record not found'],404);
        }
        return response()->json(Soutenance::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Soutenance  $soutenance
     * @return \Illuminate\Http\Response
     */
    public function edit(Soutenance $soutenance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Soutenance  $soutenance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

        $rules= [
            'DATE_SOUTENANCE' => 'date|min:2|max:255',
            'TAUX_PLAGIAT' => 'string|min:2|max:255',
            'FORME' => 'string|min:2|max:255',
            'ORIGINALITE' => 'string|min:2|max:255',
            'METHODOLOGIE' => 'string|min:2|max:255',
            'ORALE' => 'string|min:2|max:255',
            'APPRECIATION' => 'string|min:2|max:255',
            'OBSERVATIONS' => 'string|min:2|max:255',
            'DECISION' => 'string|min:2|max:255',
            'MENTION' => 'string|min:2|max:255',
            'SALLE' => 'string|min:2|max:255',
            'NOTE' => 'string|min:2|max:255',
            'ID_PJ' => 'string|min:2|max:255',
            'ID_RAP' => 'string|min:2|max:255',
            'ID_MJ1' => 'string|min:2|max:255',
            'ID_MJ2' => 'string|min:2|max:255',

                            ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails())
        {
            return response()->json($validator->errors(),400);
        }
        $soutenance=Soutenance::find($id);

        $soutenance->update($request->all());
        return response()->json($soutenance,200);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Soutenance  $soutenance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Soutenance $soutenance)
    {
        //
    }
}
