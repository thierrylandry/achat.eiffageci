<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tracemail extends Model
{
    //
    protected  $table="trace_mail";
   protected  $fillable=['id','id_fournisseur','das'];
}
