<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etat_da_pas_transforme extends Model
{
    //
    protected  $table="etat_da_pas_transforme";
    protected $fillable=['*'];

    public function codeTache(){

        return $this->belongsTo('App\CodeTache','id_codeTache');
    }
    public function codeGestion(){

        return $this->belongsTo('App\CodeTache','id_codeGestion');
    }
    public function designation(){

        return $this->belongsTo(Designation::class,'id_materiel');
    }
}
