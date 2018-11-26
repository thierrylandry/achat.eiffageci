<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Boncommande extends Model
{
    //
    protected  $table="Boncommande";
    //
    protected $fillable= ['numBonCommande','id_user'];
}
