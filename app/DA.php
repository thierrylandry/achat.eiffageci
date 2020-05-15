<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DA extends Model
{
    //
    protected  $table="lignebesoin";
    //
    protected $fillable= ['unite','quantite','DateBesoin','id_user','id_fournisseur_select','id_nature','id_materiel','id_boncommande','demandeur','id_valideur','motif','dateConfirmation','date_livraison_eff','id_codeGestion'];

    public function bondecommande(){

        return $this->belongsTo('App\Boncommande','id_bonCommande');
    }
    public function codeGestion(){

        return $this->belongsTo('App\Gestion','id_codeGestion');
    }

    public function materiel(){

        return $this->belongsTo('App\Materiel','id_materiel');
    }
    public function nature(){

        return $this->belongsTo('App\Nature','id_nature');
    }
    public function fournisseurSelectionne(){

        return $this->belongsTo('App\Fournisseur','id_fournisseur_select');
    }
    public function user(){

        return $this->belongsTo('App\User','id_user');
    }
    public function devis()
    {
        return $this->belongsTo('App\Devis','id_da');
    }
}
