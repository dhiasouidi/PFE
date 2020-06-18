<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EtudiantMP2 extends Model
{
    public function etudiant()
    {
        return $this->morphOne('App\Etudiant', 'etudiantable');
    }
}
