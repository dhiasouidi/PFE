<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sujet extends Model
{
    protected $primaryKey= 'ID_SUJET';

    protected $fillable = [
        'TYPE_DEPOT',
        'SESSION_ECRIT',
        'SESSION_DEPOT',
        'TITRE_SUJET',
        'ABSTRACT',
        'ENCADRANT',
        'STATUT_ENCADRANT',
        'STRUCTURE_RECHERCHE',
        'DATE_DEPOT',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'sujet_tag' , 'tag_id',  'SUJET_ID' );
    }

    public function seances()
    {
        return $this->hasMany('App\SeanceEncadrement' , 'SUJET_ID' ,'ID_SUJET');
    }
}
