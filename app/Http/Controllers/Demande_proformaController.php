<?php
/**
 * Created by PhpStorm.
 * User: ckodia
 * Date: 25/10/2018
 * Time: 17:16
 */

namespace App\Http\Controllers;



use App\DA;
use App\Mail\Demande_proforma_mail;
use App\mailclass;
use App\Materiel;
use App\Fournisseur;
use App\Nature;
use App\Reponse_fournisseur;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class Demande_proformaController
{

    public function demande_proformas()
    {

        $types = DB::table('materiel')
            ->join('lignebesoin', 'materiel.id', '=', 'lignebesoin.id_materiel')
            ->join('domaines', 'domaines.id', '=', 'materiel.type')
            ->where('etat', '=', 2)
            ->select('domaines.libelleDomainne','domaines.id')->distinct()->get();
$fournisseurs=Fournisseur::all();
        $materiels=Materiel::all();
        $das=  DA::all();
        $natures= Nature::all();
        $users= User::all();
        return view('demande_proformas/gestion_demande_proforma',compact('das','fournisseurs','materiels','natures','users','types'));


    }
    public function lister_les_reponse($id_lignebesoin)
    {

        $reponse_fournisseurs = DB::table('reponse_fournisseur')
            ->join('fournisseur', 'fournisseur.id', '=', 'reponse_fournisseur.id_fournisseur')
            ->where('reponse_fournisseur.id_lignebesoin', '=', $id_lignebesoin)
            ->select('titre_ext','quantite','unite','prix','libelle','reponse_fournisseur.slug')->distinct()->get();
        return response()->json($reponse_fournisseurs);

    }
    public function modifier_reponse_fournisseur($slug, Request $request){
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
    public function envoies( Request $request)
    {

        $parameters = $request->except(['_token']);

        $fourn = $parameters['fourn'];
        $listeDA = $parameters['listeDA'];
        $tab_listeSA = explode(",", $listeDA);
        $corps='';
        $enteetab='<table><th>produits et service</th><th>Quantite</th><th>prix</th>';
        foreach($tab_listeSA as $laDA):
            $das=  DA::find($laDA);

            if(isset($das->id)){
                $materiel=DB::table('materiel')
                    ->where('id', '=', $das->id_materiel)
                    ->select('libelleMateriel')->distinct()->get();
                $corps =$corps." ".$das->quantite." ".$das->unite." de ".$materiel[0]->libelleMateriel." ;";
        }


/*Mail::send('mail.mail',array('corps' =>$corps),function($message){
$message->from('no-reply@procachat.com','procachat')
    ->to('cyriaquekodia@gmail.com','cyriaquekodia')
    ->subject('Demande de proforma');
});*/

        endforeach;

        return view('mail.mail')->with('corps',$corps);

    }

    /**
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */

    public function les_das_funct($domaine)
    {
        $types = DB::table('materiel')
            ->where('type', '=', $domaine)
            ->join('lignebesoin', 'materiel.id', '=', 'lignebesoin.id_materiel')
            ->join('nature', 'nature.id', '=', 'lignebesoin.id_nature')
            ->select('lignebesoin.id','lignebesoin.id_materiel','unite','DateBesoin','quantite','demandeur','id_valideur','libelleMateriel','libelleNature','lignebesoin.slug')
            ->distinct()->get();
        $variable="";
        $status="<i class='fa fa-circle' style='color: mediumspringgreen'></i>";

        return response()->json($types);
        //    return response()->json($variable);

    }

    public function ajouter_reponse(Request $request){

        $parameters = $request->except(['_token']);

        $id_lignebesoin = $parameters['id_lignebesoin'];
        $id_fournisseur = $parameters['id_fournisseur'];
        $titre_ext = $parameters['titre_ext'];
        $quantite_reponse=$parameters['quantite_reponse'];
        $Unite=$parameters['unite_reponse'];
        $prix_reponse=$parameters['prix_reponse'];

$rep_fourn = new Reponse_fournisseur();
        $date = new \DateTime(null);
        $rep_fourn->id_lignebesoin=$id_lignebesoin;
        $rep_fourn->id_fournisseur=$id_fournisseur;
        $rep_fourn->titre_ext=$titre_ext;
        $rep_fourn->quantite=$quantite_reponse;
        $rep_fourn->Unite=$Unite;
        $rep_fourn->prix=$prix_reponse;
        $rep_fourn->prix=$prix_reponse;
        $rep_fourn->slug = Str::slug($parameters['titre_ext'].$Unite. $date->format('dmYhis'));
        $rep_fourn->save();
        return redirect()->route('gestion_demande_proformas')->with('success', "la pro forma à été ajouté");

    }

    public function les_das_fournisseurs_funct($domaine)
    {
        $valeur = array($domaine);
        $types = DB::table('fournisseur')
            ->whereIn('domaine', $valeur)
            ->distinct()->get();
        return response()->json($types);

    }

    public function les_das_fournisseurs_funct_da($id_lignebesoin){

        $sql = 'SELECT*FROM fournisseur,materiel,lignebesoin WHERE   fournisseur.domaine in (materiel.type) and lignebesoin.id_materiel=materiel.id  and lignebesoin.id='.$id_lignebesoin;


        $results = DB::select($sql);

        return response()->json($results);
    }

    public function alljson(){
        $collections = [];
        return response()->json($collections);
    }

    public function Listefournisseur()
    {
        $fournisseurs=  Materiels::all();
        var_dump($fournisseurs);
        return redirect()->back();
    }
    public function mailling(){

        return view('mail/mail')->with('txt',1);
    }



    //reponse fournisseur
    public function gestion_reponse_fournisseur(){
        $types = DB::table('materiel')
            ->join('lignebesoin', 'materiel.id', '=', 'lignebesoin.id_materiel')
            ->where('etat', '=', 2)
            ->select('materiel.libelleMateriel','lignebesoin.id','quantite','unite')->distinct()->get();
        $fournisseurs=Fournisseur::all();
        $materiels=Materiel::all();
        $das=  DA::all();
        $natures= Nature::all();
        $users= User::all();
        return view('reponse_fournisseur/gestion_reponse_fournisseur',compact('das','fournisseurs','materiels','natures','users','types'));


    }
}