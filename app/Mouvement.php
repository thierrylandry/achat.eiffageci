<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mouvement extends Model
{
    //
    protected  $table="mouvement";
    protected $fillable= ['*'];

    public function designation(){

        return $this->belongsTo('App\Designation','id_materiel');
    }
    public function imputation(){

        return $this->belongsTo('App\CodeTAche','id_imputation');
    }
    public function demandeur(){

        return $this->belongsTo('App\User','id_demandeur');
    }
    public function auteur(){

        return $this->belongsTo('App\User','id_user');
    }
    public function mouvements(){

        return $this->belongsTo('App\Mouvement','id_mouvement');
    }
    public function ligne_bonlivraison(){

        return $this->belongsTo('App\ligne_bonlivraison','id_ligne_bonlivraison');
    }
}
