<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materiel extends Model
{
    //
    protected  $table="materiel";
    //
    protected $fillable= ['libelleMateriel','type','image','id_codeGestion','code_analytique'];
    public function Domaine(){

        return $this->belongsTo('App\Domaines','type');
    }
}
