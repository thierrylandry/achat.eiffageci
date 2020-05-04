<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Boncommande extends Model
{
    //
    protected  $table="boncommande";
    //
    protected $fillable= ['numBonCommande','id_user','service_demandeur','commentaire_general','created_at','date_livraison','remise_excep'];

    public function fournisseur()
    {
        return $this->belongsTo('App\Fournisseur','id_fournisseur');
    }
}
