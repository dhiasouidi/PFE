<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EtudiantPFE extends Model
{
    protected $table = 'etudiants_pfe';

    public function etudiant()
    {
        return $this->morphOne('App\Etudiant', 'etudiantable');
    }
}
