<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeanceEncadrement extends Model
{
    public function taches()
    {
        return $this->hasMany('App\Tache');
    }
}
