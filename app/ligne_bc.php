<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ligne_bc extends Model
{
    //
    protected  $table="ligne_bc";
    //id	codeRubrique	remise_ligne_bc	quantite_ligne_bc	unite_ligne_bc	prix_unitaire_ligne_bc	id_reponse_fournisseur	id_bonCommande	created_at	updated_at	slug
    protected $fillable= ['codeRubrique','remise_ligne_bc','quantite_ligne_bc','unite_ligne_bc','prix_unitaire_ligne_bc','prix_tot','remise_ligne_bc','id_reponse_fournisseur','id_bonCommande'];
}
