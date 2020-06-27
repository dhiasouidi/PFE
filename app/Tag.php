<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function sujets()
    {
        return $this->belongsToMany(Sujet::class , 'sujet_tag' , 'SUJET_ID', 'tag_id' );
    }
}
