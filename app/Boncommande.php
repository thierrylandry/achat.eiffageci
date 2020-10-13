<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Boncommande extends Model
{
    //
    protected  $table="boncommande";
    //
    protected $fillable= ['numBonCommande','id_user','service_demandeur','commentaire_general','created_at','date_livraison','remise_excep','id_projet','id_expediteur'];

    public function fournisseur()
    {
        return $this->belongsTo('App\Fournisseur','id_fournisseur');
    }
    public function expediteur()
    {
        return $this->belongsTo('App\User','id_expediteur');
    }
}
