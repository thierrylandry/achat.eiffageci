<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ligne_bonlivraison extends Model
{
    //
    protected  $table="ligne_bonlivraison";
    protected $fillable= ['*'];
    public function ligne_bc()
    {

        return $this->belongsTo(Devis::class, "id_devis");
    }
    public function fournisseur()
    {

        return $this->belongsTo(Fournisseur::class, "id_fournisseur");
    }
    public function projet()
    {
        return $this->belongsTo('App\Projet','id_projet');
    }
}
