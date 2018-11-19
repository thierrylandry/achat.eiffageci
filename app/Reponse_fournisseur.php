<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reponse_fournisseur extends Model
{
    //
    protected  $table="reponse_fournisseur";

    protected $fillable= ['id_fournisseur','titre_ext','quantite','prix','id_lignebesoin'];
}
