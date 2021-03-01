<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    //
    protected  $table="designation";
    //
    protected $fillable= ['*'];
    public function famille(){

        return $this->belongsTo('App\Famille','id_famille');
    }
}
