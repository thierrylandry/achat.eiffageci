<?php
/**
 * Created by PhpStorm.
 * User: ckodia
 * Date: 25/10/2018
 * Time: 12:23
 */

namespace App\Http\Controllers;


use App\Analytique;
use App\Boncommande;
use App\fournisseur;
use App\ligne_bc;
use App\Reponse_fournisseur;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use League\Flysystem\Exception;

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

    public function bon_commande_file($slug){
     // $bc=  Boncommande::where('slug','=',$slug)->first();
        $bc= DB::table('boncommande')
            ->join('fournisseur', 'boncommande.id_fournisseur', '=', 'fournisseur.id')
            ->where('boncommande.slug','=',$slug)
            ->select('fournisseur.libelle','boncommande.id','numBonCommande','date')->first();

        $ligne_bcs=DB::table('ligne_bc')
            ->join('reponse_fournisseur', 'reponse_fournisseur.id', '=', 'ligne_bc.id_reponse_fournisseur')
            ->join('analytique', 'analytique.id_analytique', '=', 'ligne_bc.codeRubrique')
            ->where('id_bonCommande','=',$bc->id)
            ->select('titre_ext','quantite_ligne_bc','unite_ligne_bc','prix_unitaire_ligne_bc','remise_ligne_bc','prix_tot','ligne_bc.slug','analytique.codeRubrique')->get();
return view('BC/bon_commande_file',compact('bc','ligne_bcs'));
    }
    public function bon_commande_file1($slug){
        // $bc=  Boncommande::where('slug','=',$slug)->first();
        $bc= DB::table('boncommande')
            ->join('fournisseur', 'boncommande.id_fournisseur', '=', 'fournisseur.id')
            ->where('boncommande.slug','=',$slug)
            ->select('fournisseur.libelle','boncommande.id','numBonCommande','date')->first();

        $ligne_bcs=DB::table('ligne_bc')
            ->join('reponse_fournisseur', 'reponse_fournisseur.id', '=', 'ligne_bc.id_reponse_fournisseur')
            ->join('analytique', 'analytique.id_analytique', '=', 'ligne_bc.codeRubrique')
            ->where('id_bonCommande','=',$bc->id)
            ->select('titre_ext','quantite_ligne_bc','unite_ligne_bc','prix_unitaire_ligne_bc','remise_ligne_bc','prix_tot','ligne_bc.slug','analytique.codeRubrique')->get();
        return view('BC/bon_commande_file',compact('bc','ligne_bcs'));
    }

    public function gestion_bc()
    {
        $bcs=  Boncommande::all();
        $utilisateurs=  User::all();
        $fournisseurs= DB::table('fournisseur')
            ->join('reponse_fournisseur', 'fournisseur.id', '=', 'reponse_fournisseur.id_fournisseur')
            ->join('lignebesoin', 'reponse_fournisseur.id', '=', 'lignebesoin.id_reponse_fournisseur')
            ->where('lignebesoin.etat', '=', 2)
            ->select('fournisseur.libelle','fournisseur.id')->distinct()->get();

        $reponse_fournisseurs= DB::table('reponse_fournisseur')
            ->join('lignebesoin', 'reponse_fournisseur.id', '=', 'lignebesoin.id_reponse_fournisseur')
            ->join('materiel', 'materiel.id', '=', 'lignebesoin.id_materiel')
            ->where('lignebesoin.etat', '=', 2)
            ->select('materiel.libelleMateriel','titre_ext','reponse_fournisseur.id')->distinct()->get();
$analytiques= Analytique::all();
        return view('BC/gestion_bc',compact('bcs','fournisseurs','utilisateurs','reponse_fournisseurs','analytiques'));
    }
    public function ajouter_ligne_bc($slugbc)
    {
        $bcs=  Boncommande::all();
        $utilisateurs=  User::all();
        $fournisseurs= DB::table('fournisseur')
            ->join('reponse_fournisseur', 'fournisseur.id', '=', 'reponse_fournisseur.id_fournisseur')
            ->join('lignebesoin', 'reponse_fournisseur.id', '=', 'lignebesoin.id_reponse_fournisseur')
            ->where('lignebesoin.etat', '=', 2)
            ->select('fournisseur.libelle','fournisseur.id')->distinct()->get();
        $reponse_fournisseurs= DB::table('reponse_fournisseur')
            ->join('lignebesoin', 'reponse_fournisseur.id', '=', 'lignebesoin.id_reponse_fournisseur')
            ->join('materiel', 'materiel.id', '=', 'lignebesoin.id_materiel')
            ->where('lignebesoin.etat', '=', 2)
            ->select('materiel.libelleMateriel','titre_ext','reponse_fournisseur.id')->distinct()->get();
        $ajouterbc='';
        $analytiques= Analytique::all();
        return view('BC/gestion_bc',compact('bcs','fournisseurs','utilisateurs','ajouterbc','reponse_fournisseurs','slugbc','analytiques'));
    }
    public function modifier_ligne_bc($slug)
    {
        $bcs=  Boncommande::all();
        $utilisateurs=  User::all();
        $fournisseurs= DB::table('fournisseur')
            ->join('reponse_fournisseur', 'fournisseur.id', '=', 'reponse_fournisseur.id_fournisseur')
            ->join('lignebesoin', 'reponse_fournisseur.id', '=', 'lignebesoin.id_reponse_fournisseur')
            ->where('lignebesoin.etat', '=', 2)
            ->select('fournisseur.libelle','fournisseur.id')->distinct()->get();
        $reponse_fournisseurs= DB::table('reponse_fournisseur')
            ->join('lignebesoin', 'reponse_fournisseur.id', '=', 'lignebesoin.id_reponse_fournisseur')
            ->join('materiel', 'materiel.id', '=', 'lignebesoin.id_materiel')
            ->where('lignebesoin.etat', '=', 2)
            ->select('materiel.libelleMateriel','titre_ext','reponse_fournisseur.id')->distinct()->get();
        $modifierlignebc='';
        $analytiques= Analytique::all();
        $ligne_bc=Ligne_bc::where('slug','=',$slug)->first();
        return view('BC/gestion_bc',compact('bcs','fournisseurs','utilisateurs','modifierlignebc','reponse_fournisseurs','$slug','analytiques','ligne_bc'));
    }
    public function save_ligne_bc(Request $request)
    {
        $parameters=$request->except(['_token']);

        $date= new \DateTime(null);
        $ligne_bc= new ligne_bc();
        $boncommande= Boncommande::where('slug','=',$parameters['slugbc'])->first();

        $ligne_bc->id_bonCommande=$boncommande->id;
        $ligne_bc->codeRubrique=$parameters['codeRubrique'];
        $ligne_bc->remise_ligne_bc=$parameters['remise'];
        $ligne_bc->quantite_ligne_bc=$parameters['quantite'];
        $ligne_bc->unite_ligne_bc=$parameters['Unite'];
        $ligne_bc->prix_unitaire_ligne_bc=$parameters['Prix_unitaire'];
        $ligne_bc->prix_tot=$parameters['Prix'];
        $ligne_bc->id_reponse_fournisseur=$parameters['id_reponse_fournisseur'];

        $ligne_bc->slug=Str::slug($ligne_bc->id_bonCommand.$ligne_bc->codeRubrique.$ligne_bc->quantite_ligne_b.$ligne_bc->prix_unitaire_ligne_bc.$date->format('dmYhis'));
        $ligne_bc->save();
        return redirect()->route('gestion_bc')->with('success',"la commande a été ajouté avec success");
    }
    public function update_ligne_bc(Request $request)
    {
        $parameters=$request->except(['_token']);

        $date= new \DateTime(null);
        $ligne_bc= ligne_bc::where('slug','=',$parameters['slugligne'])->first();

        $ligne_bc->codeRubrique=$parameters['codeRubrique'];
        $ligne_bc->remise_ligne_bc=$parameters['remise'];
        $ligne_bc->quantite_ligne_bc=$parameters['quantite'];
        $ligne_bc->unite_ligne_bc=$parameters['Unite'];
        $ligne_bc->prix_unitaire_ligne_bc=$parameters['Prix_unitaire'];
        $ligne_bc->prix_tot=$parameters['Prix'];
        $ligne_bc->id_reponse_fournisseur=$parameters['id_reponse_fournisseur'];

        $ligne_bc->slug=Str::slug($ligne_bc->id_bonCommand.$ligne_bc->codeRubrique.$ligne_bc->quantite_ligne_b.$ligne_bc->prix_unitaire_ligne_bc.$date->format('dmYhis'));
        $ligne_bc->save();
        return redirect()->route('gestion_bc')->with('success',"la ligne  a été mise à jour avec succes");
    }
    public function valider_commande($slug)
    {
        $date= new \DateTime(null);
        $Boncommande= Boncommande::where('slug', '=', $slug)->first();
        $Boncommande->etat=2;
        $Boncommande->save();
        return redirect()->route('gestion_bc')->with('success',"le bon de commande à été valider avec succès");
    }
    public function annuler_commande($slug)
    {
        $date= new \DateTime(null);
        $Boncommande= Boncommande::where('slug', '=', $slug)->first();
        $Boncommande->etat=1;
        $Boncommande->save();
        return redirect()->route('gestion_bc')->with('success',"le bon de commande à été annuler avec succès");
    }
    public function lister_commande($id)
    {
        $bcs=  Boncommande::all();
        $utilisateurs=  User::all();
        $fournisseurs= DB::table('fournisseur')
            ->join('reponse_fournisseur', 'fournisseur.id', '=', 'reponse_fournisseur.id_fournisseur')
            ->join('lignebesoin', 'reponse_fournisseur.id', '=', 'lignebesoin.id_reponse_fournisseur')
            ->where('lignebesoin.etat', '=', 2)
            ->select('fournisseur.libelle','fournisseur.id')->distinct()->get();
        $reponse_fournisseurs= DB::table('reponse_fournisseur')
            ->join('lignebesoin', 'reponse_fournisseur.id', '=', 'lignebesoin.id_reponse_fournisseur')
            ->join('materiel', 'materiel.id', '=', 'lignebesoin.id_materiel')
            ->where('lignebesoin.etat', '=', 2)
            ->select('materiel.libelleMateriel','titre_ext','reponse_fournisseur.id')->distinct()->get();
        $ligne_bcs=DB::table('ligne_bc')
            ->join('reponse_fournisseur', 'reponse_fournisseur.id', '=', 'ligne_bc.id_reponse_fournisseur')
            ->join('analytique', 'analytique.id_analytique', '=', 'ligne_bc.codeRubrique')
            ->where('id_bonCommande','=',$id)
            ->select('titre_ext','quantite_ligne_bc','unite_ligne_bc','prix_unitaire_ligne_bc','remise_ligne_bc','prix_tot','ligne_bc.slug','analytique.codeRubrique')->get();
        $listerbc='';
        $analytiques= Analytique::all();
        return view('BC/gestion_bc',compact('bcs','fournisseurs','utilisateurs','listerbc','reponse_fournisseurs','slugbc','analytiques','ligne_bcs'));
    }
    public function gestion_bc_ajouter()
    {
        $bcs=  Boncommande::all();
        $utilisateurs=  User::all();
        $fournisseurs= DB::table('fournisseur')
            ->join('reponse_fournisseur', 'fournisseur.id', '=', 'reponse_fournisseur.id_fournisseur')
            ->join('lignebesoin', 'reponse_fournisseur.id', '=', 'lignebesoin.id_reponse_fournisseur')
            ->where('lignebesoin.etat', '=', 2)
            ->select('fournisseur.libelle','fournisseur.id')->distinct()->get();
        $reponse_fournisseurs= DB::table('reponse_fournisseur')
            ->join('lignebesoin', 'reponse_fournisseur.id', '=', 'lignebesoin.id_reponse_fournisseur')
            ->join('materiel', 'materiel.id', '=', 'lignebesoin.id_materiel')
            ->where('lignebesoin.etat', '=', 2)
            ->select('materiel.libelleMateriel','titre_ext','reponse_fournisseur.id')->distinct()->get();
        $ajouter='vrai';
        $analytiques= Analytique::all();
        return view('BC/gestion_bc',compact('bcs','fournisseurs','utilisateurs','ajouter','reponse_fournisseurs','analytiques'));
    }
    public function detail_rep_fournisseur($id){

        $reponse_fournisseur = Reponse_fournisseur::where('id','=',$id)->first();

        return response()->json($reponse_fournisseur);
    }
    public function save_bc( Request $request)
    {
        $parameters=$request->except(['_token']);

        $date= new \DateTime(null);
        $Boncommande= new Boncommande();
        $Boncommande->numBonCommande=$parameters['numbc'];
        $Boncommande->date=$parameters['date'];
        $Boncommande->id_fournisseur=$parameters['id_fournisseur'];
        $Boncommande->id_user=\Illuminate\Support\Facades\Auth::user()->id;

        $Boncommande->slug=Str::slug($parameters['numbc'].$date->format('dmYhis'));
       // $Boncommande->save();
        try{$Boncommande->save();
        }catch (\Illuminate\Database\QueryException $ex){
            return redirect()->route('gestion_bc')->with('error',"le numero du bon de commande est déjà utilisé");
        }

        return redirect()->route('gestion_bc')->with('success',"le bon de commande a été ajouté, Veuillez ajouter la listes des produits ou des services");
    }
    public function modifier_bc( Request $request)
    {
        $parameters=$request->except(['_token']);
        $slug=$parameters['slug'];
        $date= new \DateTime(null);
        $Boncommande= Boncommande::where('slug', '=', $slug)->first();
       // $Boncommande->numBonCommande=$parameters['numbc'];
        $Boncommande->date=$parameters['date'];
        $Boncommande->id_fournisseur=$parameters['id_fournisseur'];
        $Boncommande->id_user=\Illuminate\Support\Facades\Auth::user()->id;

       // $Boncommande->slug=Str::slug($parameters['numbc'].$date->format('dmYhis'));
        $Boncommande->save();


        return redirect()->route('gestion_bc')->with('success',"le bon de commande a été Modifier");
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
        $reponse_fournisseurs= DB::table('reponse_fournisseur')
            ->join('lignebesoin', 'reponse_fournisseur.id', '=', 'lignebesoin.id_reponse_fournisseur')
            ->join('materiel', 'materiel.id', '=', 'lignebesoin.id_materiel')
            ->where('lignebesoin.etat', '=', 2)
            ->select('materiel.libelleMateriel','titre_ext','reponse_fournisseur.id')->distinct()->get();
        $analytiques= Analytique::all();
        return view('BC/gestion_bc',compact('fournisseur','bcs','utilisateurs','fournisseurs','bc','reponse_fournisseurs','analytiques'));
    }
    public function supprimer_bc($slug)
    {
        $fournisseur = Boncommande::where('slug', '=', $slug)->first();
        $fournisseur->delete();
        return redirect()->route('gestion_bc')->with('success', "le Bon de commande a été supprimé   NB: la suppression d'un bon de commande, entraine la suppression en cascade des lignes de cet bon de commande ");
    }
    public function supprimer_ligne_bc($slug)
    {
        $fournisseur = ligne_bc::where('slug', '=', $slug)->first();
        $fournisseur->delete();


        return redirect()->route('gestion_bc')->with('success', "La ligne du bon de commande a été supprimée avec succes ");
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