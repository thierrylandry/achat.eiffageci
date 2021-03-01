<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Panier_demande extends Model
{
    //
    protected  $table="panier_demande";
    protected $fillable= ['*'];
    public function user(){

        return $this->belongsTo(User::class, "id_user");
    }
    public function lignebesoins()
    {
        return $this->hasMany(Lignebesoin::class,'id_panier_demande');
    }

}
