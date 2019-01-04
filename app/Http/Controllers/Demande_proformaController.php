<?php
/**
 * Created by PhpStorm.
 * User: ckodia
 * Date: 25/10/2018
 * Time: 17:16
 */

namespace App\Http\Controllers;



use App\DA;
use App\Devis;
use App\Lignebesoin;
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
    public function enregistrer_devis($res,$lesId,$lesIdmat)
    {
        $lesId=explode(',',$lesId);
        $lesIdmat=explode(',',$lesIdmat);
        parse_str($res,$tab);
//dd($lesId);
        $i=0;
        foreach($lesId as $id){
            if($id!=="undefined" && $tab["row_n_".$id."_titre_ext"]!="" && $tab["row_n_".$id."_fournisseur"]!="" && $tab["row_n_".$id."_prix_unitaire"]!=""){

                $devis = new Devis();
                $devis->titre_ext=$tab["row_n_".$id."_titre_ext"];
                $devis->id_materiel=$lesIdmat[$i];
                $devis->id_fournisseur=$tab["row_n_".$id."_fournisseur"];
                $devis->quantite=$tab["row_n_".$id."_quantite"];
                $devis->id_da=$id;
                $devis->remise=$tab["row_n_".$id."_remise"];
                $devis->unite=$tab["row_n_".$id."_unite"];

               if( $tab["row_n_".$id."_codeRubrique"]!=""){
                   $devis->codeRubrique=$tab["row_n_".$id."_codeRubrique"];
               }

                $devis->prix_unitaire=$tab["row_n_".$id."_prix_unitaire"];
                $devis->devise=$tab["row_n_".$id."_devise"];
                $devis->etat=1;

                $devis->save();
                $lignebesoin= Lignebesoin::find($id);

                $lignebesoin->etat=3;
                $lignebesoin->save();
            }
            $i++;
        }







return 1;

    }
    public function modifier_devis($res,$lesId)
    {
        $lesId=explode(',',$lesId);
        parse_str($res,$tab);
//dd($lesId);
        $i=0;
        foreach($lesId as $id){
            if($id!=="undefined" && $tab["row_n_".$id."_titre_ext"]!="" && $tab["row_n_".$id."_fournisseur"]!="" && $tab["row_n_".$id."_prix_unitaire"]!="" && $tab["row_n_".$id."_quantite"]){

                $devis =  Devis::find($id);
                if( $devis->etat==1){

                    $devis->titre_ext=$tab["row_n_".$id."_titre_ext"];
                    $devis->id_fournisseur=$tab["row_n_".$id."_fournisseur"];
                    $devis->quantite=$tab["row_n_".$id."_quantite"];
                    $devis->id_da=$id;
                    //$devis->remise=$tab["row_n_".$id."_remise"];
                    $devis->unite=$tab["row_n_".$id."_unite"];

                    if( $tab["row_n_".$id."_codeRubrique"]!=""){
                        $devis->codeRubrique=$tab["row_n_".$id."_codeRubrique"];
                    }

                    $devis->prix_unitaire=$tab["row_n_".$id."_prix_unitaire"];
                    $devis->devise=$tab["row_n_".$id."_devise"];
                    $devis->etat=1;

                    $devis->save();
                }else{
                    return 2;
                }

            }
            $i++;
        }







        return 1;

    }
    public function lister_les_reponse($id_lignebesoin)
    {

        $reponse_fournisseurs = DB::table('reponse_fournisseur')
            ->join('fournisseur', 'fournisseur.id', '=', 'reponse_fournisseur.id_fournisseur')
            ->join('lignebesoin', 'lignebesoin.id', '=', 'reponse_fournisseur.id_lignebesoin')
            ->where('reponse_fournisseur.id_lignebesoin', '=', $id_lignebesoin)
            ->select('titre_ext','reponse_fournisseur.quantite','reponse_fournisseur.unite','reponse_fournisseur.prix','fournisseur.libelle','reponse_fournisseur.slug','id_fournisseur','lignebesoin.id_reponse_fournisseur','reponse_fournisseur.id','remise','date_precise')
            ->orderBy('prix', 'ASC')->get();
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
    public function envoies(Request $request)
    {

         $parameters = $request->except(['_token']);

        $fourn= $parameters['fourn'];
        $listeDA = $parameters['listeDA'];
        $tab_listeSA = explode(",", $listeDA);
        $corps='';
        $enteetab='<table><th>Produits et Service</th><th>Quantite</th><th>Prix</th>';
        foreach($tab_listeSA as $laDA):
            $das=  DA::find($laDA);

            if(isset($das->id)){
                $materiel=DB::table('materiel')
                    ->where('id', '=', $das->id_materiel)
                    ->select('libelleMateriel')->distinct()->get();
                $corps ="\n".$corps." ".$das->quantite." ".$das->unite." de ".$materiel[0]->libelleMateriel." ;";
        }


        endforeach;
        $email='';
        foreach($fourn as $slug):
            $fournisseur= Fournisseur::where('slug','=',$slug)->first();
            $email=$fournisseur->email;
            $interlocuteur=$fournisseur->interlocuteur;
            Mail::send('mail.mail',array('corps' =>$corps),function($message)use ($email,$interlocuteur ){


                $message->from(\Illuminate\Support\Facades\Auth::user()->email ,\Illuminate\Support\Facades\Auth::user()->name )
                    ->to($email ,$interlocuteur)
                    ->subject('Demande de proforma');

            });
        endforeach;


        return redirect()->route('gestion_demande_proformas')->with('success', "Envoie d'email reussi");
       // return view('mail.mail')->with('corps',$corps);

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
            ->where('lignebesoin.etat', '=', 2)
            ->select('lignebesoin.id','lignebesoin.id_materiel','unite','DateBesoin','quantite','demandeur','id_valideur','libelleMateriel','libelleNature','lignebesoin.slug')
            ->distinct()->get();
        $variable="";
        $status="<i class='fa fa-circle' style='color: mediumspringgreen'></i>";

        return response()->json($types);
        //    return response()->json($variable);

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

        $sql = 'SELECT fournisseur.id , libelle FROM fournisseur,materiel,lignebesoin WHERE fournisseur.domaine in (materiel.type) and lignebesoin.id_materiel=materiel.id  and lignebesoin.id='.$id_lignebesoin;


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



    //reponse fournisseur iportant
    public function gestion_reponse_fournisseur(){
        $types = DB::table('materiel')
            ->join('lignebesoin', 'materiel.id', '=', 'lignebesoin.id_materiel')
            ->where('etat', '=', 2)
            ->select('materiel.libelleMateriel','lignebesoin.id','quantite','unite')->distinct()->get();
        $fournisseurs=DB::table('fournisseur')
            ->join('domaines', 'domaines.id', '=', 'fournisseur.domaine')
            ->select('libelle','libelleDomainne','fournisseur.id','fournisseur.domaine')->distinct()->get();
        $materiels=Materiel::all();
        $das= DB::table('materiel')
            ->join('lignebesoin', 'materiel.id', '=', 'lignebesoin.id_materiel')
            ->where('etat', '=', 2)
            ->select('lignebesoin.id', 'unite', 'quantite', 'DateBesoin','id_user', 'id_reponse_fournisseur','id_nature', 'id_materiel', 'id_bonCommande','demandeur','lignebesoin.slug','etat','id_valideur','motif','type')->distinct()->get();
        $natures= Nature::all();
        $users= User::all();
        $domaines=  DB::table('domaines')->get();
        $devis = Devis::where('etat','=',1)->get();
        return view('reponse_fournisseur/gestion_reponse_fournisseur',compact('das','fournisseurs','materiels','natures','users','types','domaines','devis'));


    }

}