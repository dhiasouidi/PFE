<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EtudiantMR2 extends Model
{
    public function etudiant()
    {
        return $this->morphOne('App\Etudiant', 'etudiantable');
    }
}
