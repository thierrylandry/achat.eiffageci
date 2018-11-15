<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbprix extends Model
{
    //
    protected  $table="tbprix";
    protected $fillable= ['prix','unite','date','id_materiel','id_fournisseur'];
}
