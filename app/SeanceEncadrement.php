<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeanceEncadrement extends Model
{
    public function taches()
    {
        return $this->hasMany('App\Tache');
    }

    public function sujet()
    {
        return $this->belongsTo('App\Sujet','SUJET_ID','ID_SUJET');
    }
}
