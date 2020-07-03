<?php

namespace App\Http\Controllers;

use App\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $infos)
    {
        $rules= [
            'CIN_PASSEPORT' =>'bail|unique:App\Etudiant,CIN_PASSEPORT|required|string|size:8',
            'NOM' =>'bail|required|string|min:2',
            'PRENOM' =>'bail|required|string|min:2',
            'DATE_NAISSAINCE' =>'bail|required|date',
            'SEXE' =>'bail|required|string|min:5',
            'NATIONALITE' =>'bail|required|string|min:2',
            'TELEPHONE' =>'bail|string|size:8',
            'SKYPE' =>'bail|string|min:2',
            'LINKEDIN' =>'bail|string|min:2',
            'EMAIL' =>'bail|email',
            'DIPLOME' =>'bail|required|string|min:2',
            'SPECIALITE' =>'bail|required|string|min:2',
            'CYCLE' =>'bail|required|string|max:2',
            'NIVEAU' =>'bail|required|string|max:2',
        ];

        $validator = Validator::make($infos->all(),$rules);

        if($validator->fails())
        {
            return response()->json($validator->errors(),400);
        }

            $etudiant=Etudiant::create([
                'CIN_PASSEPORT' => request('CIN_PASSEPORT'),
                'NOM' => request('NOM'),
                'PRENOM' => request('PRENOM'),
                'DATE_NAISSAINCE' => request('DATE_NAISSAINCE'),
                'SEXE' => request('SEXE'),
                'NATIONALITE' => request('NATIONALITE'),
                'TELEPHONE' => request('TELEPHONE'),
                'SKYPE' => request('SKYPE'),
                'LINKEDIN' => request('LINKEDIN'),
                'DIPLOME' => request('DIPLOME'),
                'SPECIALITE' => request('SPECIALITE'),
                'CYCLE' => request('CYCLE'),
                'NIVEAU' => request('NIVEAU'),
            ]);

            if(request('CYCLE') == '1')
            {
                if(request('NIVEAU') == '3')
                {
                    $type = 'etudiantpfe';
                }
                else
                {
                    $type = 'etudiantregulier';
                }
            }else
            {
                if(request('NIVEAU') == '1' && substr(request('DIPLOME'),0,3) == 'M.P')
                {
                    $type = 'etudiantregulier';
                }
                else
                {
                    if(substr(request('DIPLOME'),0,3) == 'M.P')
                    {
                        $type = 'etudiantmp2';
                    }
                    else
                    {
                        $type = 'etudiantmr2';
                    }
                }
            }

            $user = User::create([
                'login' => request('CIN_PASSEPORT'),
                'password' => Hash::make(request('CIN_PASSEPORT')),
                'email' => request('EMAIL'),
                'userable_id' => request('CIN_PASSEPORT'),
                'userable_type' => $type,
            ]);

            return response()->json([$etudiant,$user],201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Etudiant::get(),200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function show(Etudiant $id)
    {
        $etudiant = Etudiant::find($id);
        if(is_null($etudiant))
        {
            return response()->json(["message" => 'Record not found'],404);
        }
        return response()->json(Etudiant::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $etudiant = $this->currentetudiant();

        $rules= [
            'NOM' => 'string|min:2|max:255',
            'PRENOM' => 'string|min:2|max:255',
            'DATE_NAISSAINCE' => 'date',
            'TELEPHONE' => 'string|min:2|max:255',
            'SKYPE' => 'string|min:2|max:255',
            'LINKEDIN' => 'string|min:2|max:255',
                ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails())
        {
            return response()->json($validator->errors(),400);
        }

        $etudiant->update($request->all());
        return response()->json($etudiant,200);


        return response()->json($etudiant,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Etudiant $etudiant)
    {
        //
    }

    public function binome()
    {
        $authenticated_user = Auth::user();
        $user = User::find($authenticated_user->login);
        $etudiant = Etudiant::find($user->login);
        if($etudiant->statut_binome != '1')
        {
            return response()->json(["message" => 'Vous n\'avez pas un binome'],400);
        }

        return response()->json($etudiant->binome,201);

    }

    public function currentetudiant()
    {
        $authenticated_user = Auth::user();
        $user = User::find($authenticated_user->login);
        $etudiant = Etudiant::find($user->login);
        return $etudiant;
    }


    public function addbinome(Request $binome )
    {
        $etudiant = $this->currentetudiant();

        $rules= [
            'binome_id' =>'required|string|min:2'
        ];

        $validator = Validator::make($binome->all(),$rules);

        if($validator->fails())
        {
            return response()->json($validator->errors(),400);
        }

        $bin = Etudiant::find($binome->binome_id);

        if(is_null($bin))
        {
            return response()->json(['message'=>'Binome not found'],401 );
        }
        if($etudiant->SUJET_ID == null)
        {
            return response()->json(['message'=>'Vous devez d\'abord créer un sujet'],401 );
        }

        if($etudiant->statut_binome == '1')
        {
            return response()->json(['message'=>'Vous avez déjà un binome'],401 );
        }

        if($bin->statut_binome == '1')
        {
            return response()->json(['message'=>'Etudiant posséde déja un binome'],401 );
        }
        if($bin->AFFECTATION == 'NA')
        {
            return response()->json(['message'=>'Etudiant n\'est pas affecté à aucun stage'],401 );
        }


        if($binome->binome_id == $etudiant->CIN_PASSEPORT)
        {
            return response()->json(['message'=>'Vous pouvez pas etre binome avec toi meme'],401 );
        }

        $etudiant->fill( $binome->all() )->save();
        return response()->json($etudiant,200);
    }

    //ADMIN ONLY
    public function deletebinome()
    {
        $etudiant = $this->currentetudiant();

        if($etudiant->statut_binome == '1' || $etudiant->binome_id ==null)
        {
            return response()->json(['message'=>'You can\'t delete your partner'],401 );
        }

            $etudiant->binome_id=null;
            $etudiant->statut_binome='0';
            $etudiant->save();

            return response()->json(null,204);

    }

    public function acceptbinome(Request $binome )
    {
        $etudiant = $this->currentetudiant();

        $binome_objet = Etudiant::find($binome->CIN_PASSEPORT);

        if($etudiant->statut_binome == '1')
        {
            return response()->json(['message'=>'Vous avez deja un binome'],401 );
        }

        if($binome_objet->binome_id == $etudiant->CIN_PASSEPORT)
        {
            $binome_objet->statut_binome='1';
            $etudiant->binome_id  = $binome->CIN_PASSEPORT;
            $etudiant->statut_binome='1';
            $etudiant->SUJET_ID= $binome_objet->SUJET_ID;
            $etudiant->save();
            $binome_objet->save();
            return response()->json([$etudiant,$binome_objet],200);
        }
        return response()->json(['message'=>'You can\'t accept request'],401 );

    }

    public function refusebinome(Request $binome )
    {
        $etudiant = Etudiant::find($binome->CIN_PASSEPORT);

        if($etudiant->statut_binome == '1')
        {
            return response()->json(['message'=>'Vous avez deja un binome'],401 );
        }

        $etudiant->statut_binome='2';

        $etudiant->fill( $binome->all() )->save();
        return response()->json($etudiant,200);
    }

    public function demandesbinome()
    {
        $etudiant = $this->currentetudiant();
        $demandes= Etudiant::where('binome_id',$etudiant->CIN_PASSEPORT)
                            ->where('statut_binome','0')
                            ->get();
        return response()->json($demandes,200);

    }

    public function stage()
    {
        $etudiant = $this->currentetudiant();
        if(is_null($etudiant->stage))
        {
            return response()->json(["message" => 'Stage not found'],404);
        }
        return $etudiant->stage;
    }

    public function getbinomes()
    {
        $etudiant = Etudiant::where('statut_binome','1')
                            ->whereNotNull('binome_id')
                            ->get();

        return response()->json($etudiant,200);

    }

    public function sujet()
    {
        $etudiant = $this->currentetudiant();
        if(is_null($etudiant->sujet))
        {
            return response()->json(["message" => 'Sujet not found'],404);
        }
        return $etudiant->sujet;
    }
}
