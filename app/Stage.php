<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    protected $primaryKey= 'ID_STAGE';

    protected $fillable = ['DEMANDE_ID'];


    public function etudiants()
    {
        return $this->hasMany('App\Etudiant' , 'CIN_PASSEPORT' , 'ETUDIANT_ID');
    }


    // public function demande()
    // {
    //     return $this->hasOne('App\DemandeDeStage', 'DEMANDE_ID', 'ID_DEMANDE');
    // }
}
