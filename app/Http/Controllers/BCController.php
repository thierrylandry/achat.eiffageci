<?php
/**
 * Created by PhpStorm.
 * User: ckodia
 * Date: 25/10/2018
 * Time: 12:23
 */

namespace App\Http\Controllers;


use App\Boncommande;
use App\fournisseur;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class BCController extends Controller
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

    public function bon_commande_file(){

    }

    public function gestion_bc()
    {
        $bcs=  Boncommande::all();
        $utilisateurs=  User::all();
        $fournisseurs= DB::table('materiel')
            ->join('lignebesoin', 'materiel.id', '=', 'lignebesoin.id_materiel')
            ->join('domaines', 'domaines.id', '=', 'materiel.type')
            ->join('fournisseur', 'fournisseur.domaine', '=', 'domaines.id')
            ->where('etat', '=', 2)
            ->select('fournisseur.libelle','fournisseur.id')->distinct()->get();
        return view('BC/gestion_bc',compact('bcs','fournisseurs','utilisateurs'));
    }
    public function save_bc( Request $request)
    {
        $parameters=$request->except(['_token']);

        $date= new \DateTime(null);
        $Boncommande= new Boncommande();
        $Boncommande->numBonCommande=$parameters['numbc'];
        $Boncommande->date=$parameters['date'];
        $Boncommande->id_user=\Illuminate\Support\Facades\Auth::user()->id;

        $Boncommande->slug=Str::slug($parameters['numbc'].$date->format('dmYhis'));
        $Boncommande->save();


        return redirect()->route('gestion_bc')->with('success',"le bon de commande a été ajouter, Veuillez ajouter la listes des produits ou des services");
    }

    public function voir_bc($slug)
    {
        $bc = Boncommande::where('slug', '=', $slug)->first();
        $bcs=  Boncommande::all();
        $utilisateurs=  User::all();
        $fournisseurs= DB::table('materiel')
            ->join('lignebesoin', 'materiel.id', '=', 'lignebesoin.id_materiel')
            ->join('domaines', 'domaines.id', '=', 'materiel.type')
            ->join('fournisseur', 'fournisseur.domaine', '=', 'domaines.id')
            ->where('etat', '=', 2)
            ->select('fournisseur.libelle','fournisseur.id')->distinct()->get();
        return view('BC/gestion_bc',compact('fournisseur','bcs','utilisateurs','fournisseurs','bc'));
    }
public function gestion_offre(){
    return view('BC/choix_offres');
}

    ////


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
        $fournisseur->domaine=$parameters['domaine'];
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