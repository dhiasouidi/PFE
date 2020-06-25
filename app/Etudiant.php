<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{

    protected $primaryKey= 'CIN_PASSEPORT';
    public $incrementing = false;

    protected $guarded=[];

    public function user()
    {
        return $this->morphOne('App\User', 'userable');
    }

    public function demandes()
    {
        return $this->hasMany('App\DemandeDeStage');
    }

    function binomes_invited()
    {
        return $this->belongsTo('App\Binome', 'etudiant_id', 'binome_id')
        ->withPivot('accepted'); // or to fetch accepted value
    }

    function binomes_invited_by()
    {
        return $this->belongsTo('App\Binome', 'binome_id', 'etudiant_id')
        ->withPivot('accepted'); // or to fetch accepted value
    }

    public function binome()
    {
        return $this->belongsTo('App\Binome', 'etudiant_id', 'binome_id')
                    ->wherePivot('accepted', '=', 1);
    }


}
