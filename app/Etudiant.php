<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Etudiant extends Model
{

    protected $primaryKey= 'CIN_PASSEPORT';
    public $incrementing = false;

    protected $guarded=[];

    public function user()
    {
        return $this->morphOne('App\User', 'userable');
    }

    public function demandes()
    {
        return $this->hasMany('App\DemandeDeStage' ,'ETUDIANT_DEMANDE', 'CIN_PASSEPORT');
    }

    public function binome()
    {
        $authenticated_user = Auth::user();
        $user = User::find($authenticated_user->login);
        $etudiant = Etudiant::find($user->login);

        return $this->belongsTo('App\Etudiant', 'binome_id', 'CIN_PASSEPORT')
                    ->where('binome_id',$etudiant->CIN_PASSEPORT)
                    ->where('statut_binome','1');
    }

    public function stage()
    {
        return $this->belongsTo('App\Stage', 'CIN_PASSEPORT' , 'ETUDIANT_ID');
    }

}
