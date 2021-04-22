<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    //
    protected  $table="designation";
    //
    protected $fillable= ['*'];
    public function famille(){

        return $this->belongsTo('App\Famille','id_famille');
    }

    public function lecode_analytique(){

        return $this->belongsTo('App\Analytique','code_analytique','codeRubrique');
    }
    public function lecode_comptable(){

        return $this->belongsTo('App\Code_comptable','code_comptable','code');
    }


}
