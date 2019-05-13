<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class domaines extends Model
{
    //
    protected  $table="domaines";
    protected $fillable=['id','libelleDomainne'];
}
