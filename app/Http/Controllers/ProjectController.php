<?php

namespace App\Http\Controllers;

use App\Pays;
use App\Projet;
use App\StdClass;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    //

    public function gestion_projets($locale){

        $projets  = Projet::all();
        $payss =Pays::all();
        return view('projets/projet',compact('projets','payss'));
    }
    public function modifier_projets($locale,$id){

        $projet = Projet::find($id);
        $projets  = Projet::all();
        $payss =Pays::all();
        return view('projets/projet',compact('projets','payss','projet'));
    }
    public function ajouter_projet(Request $request){

        $parameters=$request->except(['_token']);
        $id_pays = $parameters['id_pays'];
        $libelle= $parameters['libelle'];
        $projet = new Projet();
        $projet->libelle=$libelle;
        $projet->id_pays=$id_pays;
        $projet->save();
        return redirect()->back()->with('success', "success");
    }
    public function update_projet(Request $request){

        $parameters=$request->except(['_token']);
        $id = $parameters['id'];
        $id_pays = $parameters['id_pays'];
        $libelle= $parameters['libelle'];
        $projet =  Projet::find($id);
        $projet->libelle=$libelle;
        $projet->id_pays=$id_pays;
        $projet->save();
        return redirect()->back()->with('success', "success");
    }
}
