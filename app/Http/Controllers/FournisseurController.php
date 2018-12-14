<?php
/**
 * Created by PhpStorm.
 * User: ckodia
 * Date: 25/10/2018
 * Time: 12:23
 */

namespace App\Http\Controllers;


use App\fournisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class FournisseurController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function fournisseurs()
    {
        $fournisseurs=  Fournisseur::all();
        return view('fournisseurs/fournisseurs')->with('fournisseurs',$fournisseurs);
    }
    public function voir_fournisseur($slug)
    {
        $domaines=  DB::table('domaines')->get();
        $fournisseurs = Fournisseur::all();
        $fournisseur = Fournisseur::where('slug', '=', $slug)->first();
        return view('fournisseurs/ajouter_fournisseur')->with('fournisseur', $fournisseur)->with('fournisseurs', $fournisseurs)->with('domaines',$domaines);
    }

    public function ajouter_fournisseur()
    {
        $domaines=  DB::table('domaines')->get();
        $fournisseurs=  Fournisseur::all();
        return view('fournisseurs/ajouter_fournisseur')->with('fournisseurs',$fournisseurs)->with('domaines',$domaines);
    }
    public function supprimer_fournisseur($slug)
    {
        $fournisseur = Fournisseur::where('slug', '=', $slug)->first();
        $fournisseur->delete();
        return redirect()->route('ajouter_fournisseur')->with('success', "le fournisseur a été supprimé");
    }
    public function modifier_fournisseur( Request $request)
    {
        $parameters=$request->except(['_token']);



        $fournisseur=  Fournisseur::where('slug','=',$parameters['slug'])->first();

        // Fournisseur::create($parameters);
        $date= new \DateTime(null);

        $fournisseur->libelle=$parameters['libelle'];
        $fournisseur->domaine=implode(',',$parameters['domaine']);
        $fournisseur->conditionPaiement=$parameters['conditionPaiement'];
        $fournisseur->commentaire=$parameters['commentaire'];
        $fournisseur->adresseGeographique=$parameters['adresseGeographique'];
        $fournisseur->responsable=$parameters['responsable'];
        $fournisseur->interlocuteur=$parameters['interlocuteur'];
        $fournisseur->email=$parameters['email'];
        $fournisseur->slug=Str::slug($parameters['libelle'].$date->format('dmYhis'));
        $fournisseur->save();
        return redirect()->route('ajouter_fournisseur')->with('success',"le fournisseur à été mis à jour");
    }
    public function Validfournisseur( Request $request)
    {
        $parameters=$request->except(['_token']);

       // Fournisseur::create($parameters);
        $date= new \DateTime(null);
        $fournisseur= new Fournisseur();
        $fournisseur->libelle=$parameters['libelle'];

        $fournisseur->domaine= implode(',',$parameters['domaine']);
        $fournisseur->conditionPaiement=$parameters['conditionPaiement'];
        $fournisseur->commentaire=$parameters['commentaire'];
        $fournisseur->adresseGeographique=$parameters['adresseGeographique'];
        $fournisseur->responsable=$parameters['responsable'];
        $fournisseur->interlocuteur=$parameters['interlocuteur'];
        $fournisseur->email=$parameters['email'];
        $fournisseur->slug=Str::slug($parameters['libelle'].$date->format('dmYhis'));
        $fournisseur->save();


        return redirect()->route('ajouter_fournisseur')->with('success',"le fournisseur à été ajouté");
    }
    public function alljson(){
        $collections = [];
        return response()->json($collections);
    }
    public function Listefournisseur()
    {
        $fournisseurs=  Fournisseur::all();
        var_dump($fournisseurs);
        return redirect()->back();
    }
}