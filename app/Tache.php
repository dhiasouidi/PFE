<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    public function sujet()
    {
        return $this->belongsTo('App\Sujet', '', '');
    }
}
