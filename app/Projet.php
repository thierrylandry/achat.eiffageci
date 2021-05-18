<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    //
    protected  $table="projets";
    //
    protected $fillable= ['*'];

    public function boncommande()
    {
        return $this->belongsTo('App\Boncommande','id_projet');
    }
    public function pays()
    {
        return $this->belongsTo('App\Pays','id_pays');
    }
    public function signataire_principale()
    {
        return $this->belongsTo('App\User','valideur1');
    }
    public function signataire_secondaire()
    {
        return $this->belongsTo('App\User','valideur2');
    }
}
