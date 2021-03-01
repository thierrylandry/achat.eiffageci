<?php

namespace App;
use App\Famille;
use Illuminate\Database\Eloquent\Model;

class Domaines extends Model
{
    //
    protected  $table="domaines";
    protected $fillable=['id','libelleDomainne'];

     public function familles(){

            return $this->hasmany('App\Famille','id_domaine');
        }
}
