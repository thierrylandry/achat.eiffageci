<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lignebesoin extends Model
{
    //
    protected  $table="lignebesoin";
    protected $fillable= ['id','unite','quantite','DateBesoin','id_user','id_nature','id_materiel','id_bonCommande','id_reponse_fournisseur','demandeur','etat','slug','id_valideur','usage','motif','dateConfirmation','date_livraison_eff','created_at','updated_at','id_codeGestion'];

    public function codeGestion(){

        return $this->belongsTo('App\Gestion','id_codeGestion');
    }
    public function materiel(){

        return $this->belongsTo('App\Materiel','id_materiel');
    }
}
