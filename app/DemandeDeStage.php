<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DemandeDeStage extends Model
{
    protected $primaryKey= 'ID_DEMANDE';
    protected $table = 'demande_de_stages';

    protected $fillable = ['ORGANISME_DEMANDE','TYPE_DEMANDE','ETAT_DEMANDE', 'CIN_DEMANDE'];

}
