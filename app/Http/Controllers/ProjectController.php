<?php

namespace App\Http\Controllers;

use App\Projet;
use App\StdClass;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    //

    public function gestion_projets($locale){

        $projets  = Projet::all();
        return view('projets/projet',compact('projets'));
    }
}
