<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EtudiantRegulier extends Model
{
    public function etudiant()
    {
        return $this->morphOne('App\Etudiant', 'etudiantable');
    }
}
