<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Analytique extends Model
{
    //
    protected  $table="analytique";
    //
    protected $fillable= ['id_analytique','codeRubrique','libelle'];
}
