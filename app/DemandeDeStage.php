<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DemandeDeStage extends Model
{
    protected $primaryKey= 'ID_DEMANDE';
    protected $table = 'demande_de_stages';

    protected $fillable = ['ORGANISME_DEMANDE','TYPE_DEMANDE','ETAT_DEMANDE', 'CIN_DEMANDE'];


    public function etudiant()
    {
        return $this->belongsTo('App\Etudiant' , 'ETUDIANT_DEMANDE', 'CIN_PASSEPORT');
    }

    public function stage()
    {
        return $this->hasOne('App\Stage',  'ID_DEMANDE_AFF' , 'ID_DEMANDE');
    }

}
