<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domaines extends Model
{
    //
    protected  $table="domaines";
    protected $fillable=['id','libelleDomainne'];
}
