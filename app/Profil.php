<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    //
    protected  $table="profil";
    protected $fillable= ['libelleProfil','descriptionProfil'];
}
