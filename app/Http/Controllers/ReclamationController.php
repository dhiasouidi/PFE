<?php

namespace App\Http\Controllers;

use App\Reclamation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReclamationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Reclamation::get(),200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $infos)
    {
        $rules= [
            'OBJET' =>'bail|required|string|min:2',
            'CORPS' =>'bail|required|string|min:2',
        ];

        $validator = Validator::make($infos->all(),$rules);

        if($validator->fails())
        {
            return response()->json($validator->errors(),400);
        }

            $rec = Reclamation::create([
                'OBJET' => request('OBJET'),
                'CORPS' => request('CORPS'),
            ]);

            return response()->json([$rec],201);
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
     * @param  \App\Reclamation  $reclamation
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $rec = Reclamation::find($id);
        if(is_null($rec))
        {
            return response()->json(["message" => 'Record not found'],404);
        }
        return response()->json(Reclamation::find($id));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reclamation  $reclamation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reclamation $reclamation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reclamation  $reclamation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reclamation $reclamation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reclamation  $reclamation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reclamation $reclamation)
    {
        //
    }
}
