<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pays extends Model
{
    //
    protected  $table="pays";
    protected $fillable=['*'];

     public function projets(){

            return $this->hasmany('App\Pays','id_pays');
        }
}
