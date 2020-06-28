<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{

    public function seance()
    {
        return $this->belongsTo('App\SeanceEncadrement' , 'ID_SEANCE');
    }

}
