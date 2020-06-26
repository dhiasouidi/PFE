<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    protected $primaryKey= 'ID_STAGE';

    protected $fillable = ['TYPE_STAGE','ORGANISME_STAGE','TEL_STAGE','FAX_STAGE','EMAIL_STAGE','ENCADRANT_STAGE','DATE_DEBUT','DATE_FIN'];


    public function etudiants()
    {
        return $this->hasMany('App\Etudiant' , 'CIN_PASSEPORT' , 'ETUDIANT_ID');
    }


    // public function demande()
    // {
    //     return $this->hasOne('App\DemandeDeStage', 'DEMANDE_ID', 'ID_DEMANDE');
    // }
}
