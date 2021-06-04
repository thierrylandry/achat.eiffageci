<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Validation_flow extends Model
{
    //
    protected  $table="validation_flow";
    protected $fillable = ['*'];
    public function valideur(){

        return $this->belongsTo('App\User','id_valideur');
    }
    public function projet()
    {
        return $this->belongsTo('App\Projet','id_projet');
    }
}
