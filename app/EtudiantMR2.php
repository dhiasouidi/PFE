<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EtudiantMR2 extends Model
{
    protected $table = 'etudiants_mr2';

    public function etudiant()
    {
        return $this->morphOne('App\Etudiant', 'etudiantable');
    }
}
