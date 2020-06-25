<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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


    function binomes_invited()
    {
        return $this->belongsTo('App\Binome', 'CIN_PASSEPORT', 'etudiant_id');    }

    function binomes_invited_by()
    {
        return $this->belongsTo('App\Binome', 'etudiant_id', 'CIN_PASSEPORT');    }

    public function binome()
    {
        return $this->belongsTo('App\Binome', 'CIN_PASSEPORT', 'etudiant_id')
                    ->where('accepted', '1');
        }


}
