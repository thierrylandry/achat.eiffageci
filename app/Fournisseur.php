<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    protected  $table="fournisseur";
    //
    protected $fillable= ['libelle','domaine','conditionPaiement','commentaire','adresseGeographique','responsable','interlocuteur','email'];
}
