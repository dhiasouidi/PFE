<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EtudiantMP2 extends Model
{
    protected $table = 'etudiants_mp2';

    public function etudiant()
    {
        return $this->morphOne('App\Etudiant', 'etudiantable');
    }
}
