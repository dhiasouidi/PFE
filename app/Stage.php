<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    protected $primaryKey= 'ID_STAGE';

    protected $fillable = ['TYPE_STAGE','ORGANISME_STAGE','TEL_STAGE','FAX_STAGE','EMAIL_STAGE','ENCADRANT_STAGE','DATE_DEBUT','DATE_FIN','ETUDIANT_ID'];


    public function etudiant()
    {
        return $this->belongsTo('App\Etudiant' , 'ETUDIANT_ID', 'CIN_PASSEPORT' );
    }

}
