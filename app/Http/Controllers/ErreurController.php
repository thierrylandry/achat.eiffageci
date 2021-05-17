<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErreurController extends Controller
{
    //
    public function erreur($locale){


        return view('erreur');
    }
}
