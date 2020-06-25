<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    public function demande()
    {
        return $this->belongsTo('App\DemandeDeStage', 'ID_DEMANDE_AFF', 'ID_DEMANDE');
    }
}
