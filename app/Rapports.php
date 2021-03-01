<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rapports extends Model
{
    //
    protected  $table="rapports";
    //
    protected $fillable= ['*'];
    public function type_rapport(){

        return $this->belongsTo(Type_rapports::class,'id_fournisseur');
    }

}
