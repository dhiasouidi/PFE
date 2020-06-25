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
        return $this->hasMany('App\DemandeDeStage');
    }

    public function binome()
    {
        return $this->belongsTo('App\Binome', 'etudiant_id', 'binome_id')
                    ->wherePivot('accepted', '=', 1);
    }



}
