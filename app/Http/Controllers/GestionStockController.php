<?php

namespace App\Http\Controllers;

use App\CodeTache;
use App\Designation;
use App\Designation_stock;
use App\Fournisseur;
use App\Gestion;
use App\Ligne_bonlivraison;
use App\mailclass;
use App\Materiel;
use App\Mouvement;
use App\Nature;
use App\Stock;
use App\Stock_user;
use App\Unites;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GestionStockController extends Controller
{
    //
    public function gestion_stock()  {

        return view('gestion_stock/gestion');
    }
    public function donne_moi_les_sortie_de_ce_mouvement($id_mouvement){

        $mouvements =Mouvement::where('id_mouvement','=',$id_mouvement)->get();

        $solde =0;
        foreach ($mouvements as $mouvement):
        $solde=$solde + $mouvement->quantite;
        endforeach;

        return $solde;

    }
    public function sortie_stock()  {

        //ici
        $codetaches= CodeTache::all();


        $mouvement_materiels_totals=Stock_user::orderby('libelle','asc')->get();
        $mouvement_materiels = array();
        $domaines= array();
        $familles= array();
            foreach( $mouvement_materiels_totals as $mouvement_materiel):
                $domaines[$mouvement_materiel->id_domaine]=$mouvement_materiel;
                $familles[$mouvement_materiel->id_famille]=$mouvement_materiel;
                $mouvement_materiel->quantite = $mouvement_materiel->quantite +$this->donne_moi_les_sortie_de_ce_mouvement($mouvement_materiel->id);
            if($mouvement_materiel->quantite!=0){
                $mouvement_materiels[]=$mouvement_materiel;
            }

            endforeach;
        //dd($familles);
        // $das=  DA::where('id_user','=',\Illuminate\Support\Facades\Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(50);
        $unites=Unites::all();
        $demandeurs = User::all();
        $mouvements = Mouvement::where('id_type_mouvement','=',0)->orderBy('id','desc')->get();
        foreach($unites as $unite):
            if($unite->id==1 || $unite->id>=41 && $unite->id<50 ){
                $tab_unite['nothing'][]=$unite->libelle;
            }elseif($unite->id>1 && $unite->id<=10 ){
                $tab_unite['La longueur'][]= $unite->libelle;
            }elseif ($unite->id>10 && $unite->id<=20){
                $tab_unite['La masse'][]=$unite->libelle;
            }elseif ($unite->id>20 && $unite->id<=30){
                $tab_unite['Le volume'][]=$unite->libelle;
            }elseif ($unite->id>30 && $unite->id<=40){
                $tab_unite['La surface'][]=$unite->libelle;
            }
        endforeach;
        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }

        Log::info('ip :'.$ip.'; Machine: '.$nommachine.'; affichage de la fenetre de création de D.A.', ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);




        return view('gestion_stock/sortie_stock',compact('domaines','familles','mouvement_materiels','tab_unite','codetaches','demandeurs','mouvements'));
    }
    public function donne_moi_les_famille_disponible($domaine){



        $res="<option value=''>SELECTIONNER UNE FAMILLE</option>";
        if($domaine!='tout'){

            $familles =Stock_user::orderby('libelle','asc')->where('id_domaine','=',$domaine)->get();

        }else{
            $familles = Stock_user::orderby('libelle','asc')->get();
        }

        foreach($familles as $famille):
            $res =$res."<option value='".$famille->id_famille."'>".$famille->libelle_famille."</option>";
        endforeach;

        return $res;
    }
    public function stock_min(){
        $designation_stock_mins =Designation_stock::all();

        $designations =Designation::all();

        foreach($designations as $designation):

            foreach($designation_stock_mins as $stockmin):

                if($designation->libelle==$stockmin->libelle){

                    $designation->stock_min =$stockmin->stock_min;
                    $designation->save();
                }
                endforeach;

            endforeach;
    }

    public function donne_moi_les_designation_disponible($famille){



        $res="<option value=''>SELECTIONNER UN PRODUIT </option>";
        if($famille!='tout'){

            $produits =Stock_user::orderby('libelle','asc')->where('id_famille','=',$famille)->get();

        }else{
            $produits = Stock_user::orderby('libelle','asc')->get();
        }

        foreach($produits as $produit):
            $stock_max=$produit->quantite+$produit->quantite*(-1);
            $res =$res." <optgroup label='code tache: $produit->codetache'><option value='".$produit->id."'>".$produit->libelle."  Stock: $produit->quantite $produit->unite</option> </optgroup>";
        endforeach;

        return $res;
    }
    public function edit_mouvement($locale,$id)  {

        //ici
        $codetaches= CodeTache::all();


        $mouvement_materiels_totals=Stock_user::orderby('libelle','asc')->get();
        $domaines= array();
        $familles= array();
        foreach( $mouvement_materiels_totals as $mouvement_materiel):
            $domaines[$mouvement_materiel->id_domaine]=$mouvement_materiel;
            $familles[$mouvement_materiel->id_famille]=$mouvement_materiel;
            $mouvement_materiel->quantite = $mouvement_materiel->quantite +$this->donne_moi_les_sortie_de_ce_mouvement($mouvement_materiel->id);
            if($mouvement_materiel->quantite!=0){
                $mouvement_materiels[]=$mouvement_materiel;
            }

        endforeach;
        $codetaches= CodeTache::all();
        $mouvement_materiels=Stock_user::orderby('libelle','asc')->get();
        foreach( $mouvement_materiels as $mouvement_materiel):

            $mouvement_materiel->quantite = $mouvement_materiel->quantite +$this->donne_moi_les_sortie_de_ce_mouvement($mouvement_materiel->id);

        endforeach;
        // $das=  DA::where('id_user','=',\Illuminate\Support\Facades\Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(50);
        $unites=Unites::all();
        $demandeurs = User::all();
        $mouvement = Mouvement::find($id);
        $mouvements = Mouvement::where('id_type_mouvement','=',0)->orderBy('id','desc')->get();
        foreach($unites as $unite):
            if($unite->id==1 || $unite->id>=41 && $unite->id<50 ){
                $tab_unite['nothing'][]=$unite->libelle;
            }elseif($unite->id>1 && $unite->id<=10 ){
                $tab_unite['La longueur'][]= $unite->libelle;
            }elseif ($unite->id>10 && $unite->id<=20){
                $tab_unite['La masse'][]=$unite->libelle;
            }elseif ($unite->id>20 && $unite->id<=30){
                $tab_unite['Le volume'][]=$unite->libelle;
            }elseif ($unite->id>30 && $unite->id<=40){
                $tab_unite['La surface'][]=$unite->libelle;
            }
        endforeach;
        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }

        Log::info('ip :'.$ip.'; Machine: '.$nommachine.'; affichage de la fenetre de création de D.A.', ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);




        return view('gestion_stock/sortie_stock',compact('mouvement_materiels','tab_unite','codetaches','demandeurs','mouvements','mouvement','domaines','familles'));
    }
    public function reste_en_stock($valeur){

        $stock=Stock_user::find($valeur);

        return $stock;
    }
    public function enregistrer_mouvement(Request $request){
        $parameters=$request->except(['_token']);
        $id_mouvement=$parameters['id_mouvement'];
        $id_imputation=$parameters['id_imputation'];
        $id_demandeur=$parameters['id_demandeur'];
        $quantite=$parameters['quantite'];
        $unite=$parameters['unite'];

        $mouvement = new Mouvement();

        $mouvement_traite= Mouvement::find($id_mouvement);
        $mouvement->id_materiel=$mouvement_traite->id_materiel;
        $mouvement->id_imputation=$id_imputation;
        $mouvement->id_demandeur=$id_demandeur;
        $mouvement->id_user=Auth::user()->id;
        $mouvement->quantite=-$quantite;
        $mouvement->unite=$unite;
        $mouvement->id_type_mouvement=0;
        $mouvement->id_mouvement=$mouvement_traite->id;
        $mouvement->save();
        if($id_imputation=="1003"){
            $ligne_bonlivraison = Ligne_bonlivraison::find($mouvement_traite->id_ligne_bonlivraison);
            $ligne_bonlivraison->quantite=$ligne_bonlivraison->qte_initial-$quantite;
            $ligne_bonlivraison->save();
        }
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.'; sorite du materiel '.$mouvement->libelle, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return redirect()->back()->with('success',"La sorite  a été prise en compte avec succes");
    }
    public function modifier_mouvement(Request $request){
        $parameters=$request->except(['_token']);
        $id_mouvement=$parameters['id_mouvement'];
        $id_imputation=$parameters['id_imputation'];
        $id_demandeur=$parameters['id_demandeur'];
        $quantite=$parameters['quantite'];
        $unite=$parameters['unite'];
        $id=$parameters['id'];

        $mouvement =  Mouvement::find($id);
        $mouvement_traite= Mouvement::find($id_mouvement);
        $mouvement->id_materiel=$mouvement_traite->id_materiel;
        $mouvement->id_imputation=$id_imputation;
        $mouvement->id_demandeur=$id_demandeur;
        $mouvement->id_user=Auth::user()->id;
        $mouvement->quantite=-$quantite;
        $mouvement->unite=$unite;
        $mouvement->id_type_mouvement=0;
        $mouvement->id_mouvement=$mouvement_traite->id;
        $mouvement->save();
        if($id_imputation=="1003"){
            $ligne_bonlivraison = Ligne_bonlivraison::find($mouvement_traite->id_ligne_bonlivraison);
            $ligne_bonlivraison->quantite=$ligne_bonlivraison->qte_initial-$quantite;
            $ligne_bonlivraison->save();
        }

        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.'; sorite du materiel '.$mouvement->libelle, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return redirect()->back()->with('success',"La sorite  a été modifiée  avec succes");
    }
    public function delete_mouvement($locale,$id){
        $mouvement = Mouvement::find($id);
        $mouvement->delete();

        return redirect()->back()->with('success',"La sorite  a été supprimée  avec succes");

    }
    public function stock(){

        $stocks =Stock::orderBy('libelle','ASC')->get();

        $tableaux = array();
        foreach ($stocks as $stock):
            if($this->fifo($stock->id,$stock->libelle)!=0 && $stock->quantite!="0"){
                $tableaux[$stock->id][$stock->libelle]=$this->fifo($stock->id,$stock->libelle);
            }



        endforeach;

        return view('gestion_stock/stock',compact('stocks','tableaux'));
    }
    public function fifo($_id_materiel,$libelle){

        $chronologie_livraisons= DB::table('chronologi_livraison')->where('id','=',$_id_materiel)->orWhere('reference','=',$libelle)->get();

        //  dd($chronologie_livraisons);
        $point_consomation = DB::table("point_consomation")->where('id_materiel','=',$_id_materiel)->first();
        //   dd($point_consomation);
        $resultats = array();
        $consommer=0;
        if(isset($point_consomation->quantite)){
            $consommer =$point_consomation->quantite;

        }
        foreach($chronologie_livraisons as $chronologie_livraison):

            $res= $chronologie_livraison->quantite+$consommer;


            if($res<0){

                $chronologie_livraison->quantite=0;
                $consommer=$res;

            }elseif($res>0){
                $chronologie_livraison->quantite=$res;
                $consommer=0;

            }elseif($res==0){
                $chronologie_livraison->quantite=0;
                $consommer=$res;
            }
            // $point_consomation->quantite=$res;

            $resultats[]=$chronologie_livraison;

        endforeach;

        $valeur_stock=0;

        foreach($resultats as $result):

            if(!is_null($result->prix_tot)){
                $valeur_stock+=$result->quantite*($result->prix_tot+$result->valeur_tva);
            }else{
                $valeur_stock+=$result->quantite*($result->prix_unitaire+$result->valeur_tva);
            }

        endforeach;

        return $valeur_stock;
    }
}
