<?php

namespace App;
use App\Designation;
use Illuminate\Database\Eloquent\Model;

class Famille extends Model
{
    //
    protected  $table="famille";
    //
    protected $fillable= ['*'];
    public function domaine(){

        return $this->belongsTo('App\Domaines','id_domaine');
    }
       public function designations(){

                return $this->hasmany('App\Designation','id_famille');
            }
}
