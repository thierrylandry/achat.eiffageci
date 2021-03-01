<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Devis extends Model
{
    //
    protected  $table="devis";
    protected $fillable=['id','id_materiel','id_fournisseur','quantite','prix_unitaire','titre_ext','devise','id_da','referenceFournisseur','codeGestion','id_bc'];
    public function designation(){

        return $this->belongsTo('App\Designation','id_materiel');
    }
}
