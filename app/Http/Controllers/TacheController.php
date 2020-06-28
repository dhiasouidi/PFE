<?php

namespace App\Http\Controllers;

use App\Sujet;
use App\Tache;
use Illuminate\Http\Request;

class TacheController extends Controller
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
     * @param  \App\Tache  $tache
     * @return \Illuminate\Http\Response
     */
    public function show(Tache $tache)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tache  $tache
     * @return \Illuminate\Http\Response
     */
    public function edit(Tache $tache)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tache  $tache
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tache $tache)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tache  $tache
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tache $tache)
    {
        //
    }

    public function assigntask($id ,Request $task)
    {
        $sujet = Sujet::find($id);
        if(is_null($sujet))
        {
            return response()->json(["message" => 'Record not found'],404);
        }

        $task = Tache::create([
            'TITRE_TACHE' =>  $task->TITRE_TACHE,
            'DESCRIPTION' =>  $task->DESCRIPTION,
            'DEADLINE' =>  $task->DEADLINE,
            'TITRE_TACHE' =>  $task->TITRE_TACHE,
            'TITRE_TACHE' =>  $task->TITRE_TACHE,

        ]);

    }
}
