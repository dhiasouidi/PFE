<?php

namespace App\Http\Controllers;

use App\Soutenance;
use Illuminate\Http\Request;

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
    public function update(Request $request, Soutenance $soutenance)
    {
        //
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
