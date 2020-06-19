<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EtudiantRegulier extends Model
{
    protected $table = 'etudiants_reguliers';

    public function etudiant()
    {
        return $this->morphOne('App\Etudiant', 'etudiantable');
    }
}
