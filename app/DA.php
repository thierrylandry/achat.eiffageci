<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DA extends Model
{
    //
    protected  $table="lignebesoin";
    //
    protected $fillable= ['unite','quantite','DateBesoin','id_user','id_fournisseur_select','id_nature','id_materiel','id_boncommande','demandeur','id_valideur','motif','dateConfirmation','date_livraison_eff'];
}
