<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EtudiantPFE extends Model
{
    public function etudiant()
    {
        return $this->morphOne('App\Etudiant', 'etudiantable');
    }
}
