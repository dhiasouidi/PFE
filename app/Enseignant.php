<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
    protected $primaryKey= 'ID_ENSEIGNANT';
    public $incrementing = false;

    protected $fillable = [
        'ID_ENSEIGNANT',
        'EMAIL',
        'NOM',
        'PRENOM',
        'SPECIALITE',
        'ETABLISSEMENT',
        'UNIVERSITE',
        'GRADE',
        'TELEPHONE'];


    protected $guarded=[];

    public function user()
    {
        return $this->morphOne('App\User', 'userable');
    }
}
