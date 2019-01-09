<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErreurController extends Controller
{
    //
    public function erreur(){

        return view('erreur');
    }
}
