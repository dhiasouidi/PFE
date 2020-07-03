<?php

namespace App\Http\Controllers;

use App\Stage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Etudiant;

class StageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Stage::get(),200);
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stage = Stage::find($id);
        if(is_null($stage))
        {
            return response()->json(["message" => 'Record not found'],404);
        }
        return response()->json(Stage::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stage  $stage
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    //OK
    public function update(Request $request)
    {
        $authenticated_user = Auth::user();
        $user = User::find($authenticated_user->login);
        $etudiant = Etudiant::find($user->login);

        $stage = Stage::find($etudiant->STAGE_ID);
        if(is_null($stage))
        {
            return response()->json(["message" => 'Record not found'],404);
        }
        $stage->update($request->all());
        return response()->json($stage,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stage $stage)
    {
        //
    }

    public function etudiant($id)
    {
        $stage = Stage::find($id);
        if(is_null($stage))
        {
            return response()->json(["message" => 'Record not found'],404);
        }
        return $stage->etudiant;
    }
}
