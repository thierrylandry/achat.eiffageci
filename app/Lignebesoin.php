<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lignebesoin extends Model
{
    //
    protected  $table="lignebesoin";
    protected $fillable= ['*'];

    public function codeGestion(){

        return $this->belongsTo('App\Gestion','id_codeGestion');
    }
    public function materiel(){

        return $this->belongsTo('App\Materiel','id_materiel');
    }
    public function designation(){

        return $this->belongsTo('App\Designation','id_materiel');
    }
    public function codetache(){

        return $this->belongsTo('App\CodeTache','id_codeTache');
    }
    public function nature(){

        return $this->belongsTo('App\Nature','id_nature');
    }
    public function gestion(){

        return $this->belongsTo('App\Gestion','id_codeGestion');
    }
    public function user(){

        return $this->belongsTo('App\User','id_user');
    }
    public function devis()
    {
        return $this->belongsTo('App\Devis','id_da');
    }
}
