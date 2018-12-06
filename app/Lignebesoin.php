<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lignebesoin extends Model
{
    //
    protected  $table="lignebesoin";
    protected $fillable= ['id','unite','quantite','DateBesoin','id_user','id_nature','id_materiel','id_bonommande','id_reponse_fournisseur','demandeur','etat','slug','id_valideur'];

}
