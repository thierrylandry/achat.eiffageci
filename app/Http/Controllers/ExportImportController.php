<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExportImportController extends Controller
{
    //
    public function gestion_importation($locale,$id){

        $id_projet = $id;
        return view('importations.menu_importation',compact('id_projet'));
    }
    public function importation_code_tache($locale,$id_projet){

        return view('importations.importation_code_tache');
    }
}
