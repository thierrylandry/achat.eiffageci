<?php

namespace App\Http\Controllers;

use App\Boncommande;
use App\Designation;
use App\Devise;
use App\Domaines;
use App\Famille;
use App\Fournisseur;
use App\Ligne_bonlivraison;
use App\Materiel;
use App\Mouvement;
use App\Unites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ReceptionController extends Controller
{
    //
    public function reception_commande(){
        $projet_choisi= ProjectController::check_projet_access();
        $bcs = Boncommande::where('etat','=','3')->where('id_projet','=',$projet_choisi->id)->get();
        return view('reception_commande/reception_avec_bc',compact('bcs'));
    }
    public function reception_commande_sans_bc(){
        $projet_choisi= ProjectController::check_projet_access();
        $fournisseurs = Fournisseur::where('id_projet','=',$projet_choisi->id)->get();
        $produits = Designation::orderby('libelle','ASC')->get();
        $domaines =Domaines::orderby('libelleDomainne','ASC')->get();
        $familles = Famille::orderby('libelle','ASC')->get();
        $devises = Devise::all();

        $ligne_bonlivraisons= Ligne_bonlivraison::where('etat','=',0)->where('id_projet','=',$projet_choisi->id)->get();
        $unites=Unites::all();
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
        return view('reception_commande/reception_sans_bc',compact('fournisseurs','produits','ligne_bonlivraisons','tab_unite','domaines','familles','devises'));
    }
    public function historique_bl(){
        $projet_choisi= ProjectController::check_projet_access();
        $ligne_bonlivraisons= Ligne_bonlivraison::where('id_projet','=',$projet_choisi->id)->get();
        return view('reception_commande/historique_bl',compact('ligne_bonlivraisons'));
    }
    public function reception_commande_sans_bc_edit($locale,$id){
        $projet_choisi= ProjectController::check_projet_access();
        $ligne_bonlivraison = Ligne_bonlivraison::find($id);

         $produits = Designation::orderby('libelle','ASC')->get();

                $familles = Famille::orderby('libelle','ASC')->get();
                 $domaines =Domaines::orderby('libelleDomainne','ASC')->get();
        $fournisseurs = Fournisseur::all();

        $ligne_bonlivraisons= Ligne_bonlivraison::where('etat','=',0)->where('id_projet','=',$projet_choisi->id)->get();
         $unites=Unites::all();
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
                $devises = Devise::all();
        return view('reception_commande/reception_sans_bc',compact('fournisseurs','produits','ligne_bonlivraisons','ligne_bonlivraison','produits','domaines','familles','tab_unite','devises'));
    }
    public function donne_moi_les_famille($locale,$domaine){
       $res="<option value=''>SELECTIONNER UNE FAMILLE</option>";
            if($domaine!='tout'){
              $domaine = Domaines::find($domaine);
             // dd($domaine);
                       $familles =$domaine->familles()->get();

            }else{
            $familles = Famille::all();
            }

            foreach($familles as $famille):
                 $res =$res."<option value='".$famille->id."'>".$famille->libelle."</option>";
            endforeach;

        return $res;
    }
     public function donne_moi_les_designation($locale,$famille){
       $res="<option value=''>SELECTIONNER UNE FAMILLE</option>";
            if($famille!='tout'){
              $famille = Famille::find($famille);
                       $designations =$famille->designations()->get();

            }else{
            $designations = Designation::all();
            }

            foreach($designations as $designation):
                 $res =$res."<option value='".$designation->id."'>".$designation->libelle."</option>";
            endforeach;

        return $res;
    }
       public function donne_moi_toute_la_refference($locale,$refference){

      $produit = Designation::find($refference);
//dd($produit);
        $res['id_famille']=$produit->id_famille;
        $res['id_domaine']=$produit->famille->id_domaine;
        return $res;
    }
    public function supprimer_livraison($locale,$id){

        $ligne_bonlivraison = Ligne_bonlivraison::find($id);
        $id_bc =$ligne_bonlivraison->ligne_bc->id_bc;
        $ligne_bonlivraison->delete();
        $mouvement = Mouvement::where('id_ligne_bonlivraison','=',$ligne_bonlivraison->id)->first();
        $mouvement->delete();
        return redirect()->route('reception_commande_numero',['locale'=>app()->getLocale(),'id_bc'=>$id_bc,'_token'=>csrf_token()])->with('success',"success");
    }
    public function supprimer_livraison_sans_bc($locale,$id){

        $ligne_bonlivraison = Ligne_bonlivraison::find($id);
        $ligne_bonlivraison->delete();

          $mouvement = Mouvement::where('id_ligne_bonlivraison','=',$ligne_bonlivraison->id)->first();
                $mouvement->delete();
        return redirect()->back()->with('success',"success");
    }
    public function reception_commande_numero(Request $request){
        $projet_choisi= ProjectController::check_projet_access();
        $parameters=$request->except(['_token']);

        if(sizeof($parameters)==0){
            return redirect()->route('reception_commande',app()->getLocale());
        }
        $id_bc=$parameters['id_bc'];
        $bc_chosisi = Boncommande::find($id_bc);
        $bcs = Boncommande::where('etat','=','3')->where('id_projet','=',$projet_choisi->id)->get();
        $bls=$this->donne_moi_bc_je_te_donne_bl($id_bc);
        //dd($bls);
        return view('reception_commande/reception_avec_bc',compact('bc_chosisi','bcs','bls'));
    }
    public function receptionner_commande_sans_bc(Request $request){
        $parameters=$request->except(['_token']);
       // dd($parameters);
        $numero_bl=$parameters['numero_bl'];
        $id_fournisseur=$parameters['id_fournisseur'];
        $refference=$parameters['refference'];
        $prix_unitaire=$parameters['prix_unitaire'];
        $quantite=$parameters['quantite'];
        $date_livraison=$parameters['date_livraison'];
        $unite=$parameters['unite'];
        $devise=$parameters['devise'];
        $designation =Designation::find($parameters['refference']);
        //dd($bc_chosisi->ligne_bcs()->get());


            $ligne_livraison = new Ligne_bonlivraison();

            $ligne_livraison->quantite	=$quantite;
            $ligne_livraison->date_reception=$date_livraison;
            $ligne_livraison->numero_bl	=$numero_bl;
            $ligne_livraison->prix_unitaire	=$prix_unitaire;
            $ligne_livraison->reference	=$designation->libelle;
            $ligne_livraison->devise=$devise;
            $ligne_livraison->unite=$unite;
            $ligne_livraison->etat=0;
            $ligne_livraison->id_fournisseur	=$id_fournisseur;
            $ligne_livraison->id_projet=session('id_projet');
            $ligne_livraison->save();


       // $designation = Designation::where('libelle','=',$refference)->first();
       // dd($refference);
        $this->faire_un_mouvement_stock($designation->id,$quantite,$unite,$ligne_livraison->id,1);
        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.'; Reception de commande sans bon de commande', ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return redirect()->back()->with('success',"success");
    }
    public function receptionner_commande_sans_bc_update(Request $request){
        $parameters=$request->except(['_token']);
       // dd($parameters);
        $id=$parameters['id'];
        $numero_bl=$parameters['numero_bl'];
        $id_fournisseur=$parameters['id_fournisseur'];
        $refference=$parameters['refference'];
        $designation =Designation::find($refference);
        $prix_unitaire=$parameters['prix_unitaire'];
        $quantite=$parameters['quantite'];
        $date_livraison=$parameters['date_livraison'];
        $unite=$parameters['unite'];
        $devise=$parameters['devise'];

        //dd($bc_chosisi->ligne_bcs()->get());


            $ligne_livraison =  Ligne_bonlivraison::find($id);

            $ligne_livraison->quantite	=$quantite;
            $ligne_livraison->date_reception=$date_livraison;
            $ligne_livraison->numero_bl	=$numero_bl;


            if($devise=="XOF"){
                $ligne_livraison->prix_unitaire	=$prix_unitaire;
                $ligne_livraison->prix_unitaire_euro=RapportController::convertir_dans_une_devise($prix_unitaire,date("Y-m-d"),$devise.'_EUR');
                $ligne_livraison->prix_unitaire_usd=RapportController::convertir_dans_une_devise($prix_unitaire,date("Y-m-d"),$devise.'_USD');
            }elseif($devise=="USD"){
                $ligne_livraison->prix_unitaire_usd	=$prix_unitaire;
                $ligne_livraison->prix_unitaire_euro=RapportController::convertir_dans_une_devise($prix_unitaire,date("Y-m-d"),$devise.'_EUR');
                $ligne_livraison->prix_unitaire=RapportController::convertir_dans_une_devise($prix_unitaire,date("Y-m-d"),$devise.'_XOF');
            }else{

                $ligne_livraison->prix_unitaire_euro=$prix_unitaire;
                $ligne_livraison->prix_unitaire_usd=RapportController::convertir_dans_une_devise($prix_unitaire,date("Y-m-d"),$devise.'_USD');
                $ligne_livraison->prix_unitaire=RapportController::convertir_dans_une_devise($prix_unitaire,date("Y-m-d"),$devise.'_XOF');
            }


            $ligne_livraison->reference	=$designation;
            $ligne_livraison->devise=$devise;
            $ligne_livraison->unite=$unite;
            $ligne_livraison->etat=0;
           // $ligne_livraison->id_projet=session('id_projet');
            $ligne_livraison->id_fournisseur	=$id_fournisseur;
            $ligne_livraison->save();

        //$designation = Designation::where('libelle','=',$refference)->first();
        $this->faire_un_mouvement_stock($designation->id,$quantite,$unite,$ligne_livraison->id,1);
        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.'; Modification de la réception de commande sans bon de commande', ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return redirect()->back()->with('success',"success");
    }
    public function receptionner_commande(Request $request){
        $parameters=$request->except(['_token']);
       // dd($parameters);
        $id_bc=$parameters['id_bc'];
        $bc_chosisi = Boncommande::find($id_bc);

        //dd($bc_chosisi->ligne_bcs()->get());
        foreach($bc_chosisi->ligne_bcs()->get() as $ligne_bc):
            $_qte_livraison =$parameters['row_n_'.$ligne_bc->id.'_qte_livraison'];
            $_date_livraison =$parameters['row_n_'.$ligne_bc->id.'_date_livraison'];
            $_numerobl_livraison =$parameters['row_n_'.$ligne_bc->id.'_numerobl_livraison'];
        if($_qte_livraison!="" && $_date_livraison!="" && $_numerobl_livraison!=""){

            $ligne_livraison = new Ligne_bonlivraison();
            $ligne_livraison->id_devis	=$ligne_bc->id;
            $ligne_livraison->quantite	=$_qte_livraison;
            $ligne_livraison->qte_initial	=$_qte_livraison;
            $ligne_livraison->date_reception	=$_date_livraison;
            $ligne_livraison->numero_bl	=$_numerobl_livraison;
            $ligne_livraison->prix_unitaire	=$ligne_bc->prix_unitaire;
            $ligne_livraison->prix_unitaire_usd	=$ligne_bc->prix_unitaire_usd;
            $ligne_livraison->prix_unitaire_euro	=$ligne_bc->prix_unitaire_euro;
            $ligne_livraison->reference	=$ligne_bc->titre_ext;
            $ligne_livraison->etat=1;
            $ligne_livraison->id_projet=session('id_projet');
            $ligne_livraison->unite=$ligne_bc->unite;
            $ligne_livraison->devise=$ligne_bc->devise;
            $ligne_livraison->id_fournisseur	=$bc_chosisi->id_fournisseur;
            $ligne_livraison->save();

            $this->faire_un_mouvement_stock($ligne_bc->id_materiel,$_qte_livraison,$ligne_bc->unite,$ligne_livraison->id,1);

        }

        endforeach;
        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.'; Reception de commande pour le  du bon de commande Numero '.$bc_chosisi->numBonCommande, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return redirect()->route('reception_commande_numero',['locale'=>app()->getLocale(),'id_bc'=>$id_bc,'_token'=>csrf_token()])->with('success',"success");
    }
    public function faire_un_mouvement_stock($id_materiel,$quantite,$unite,$id_ligne_bonlivraison,$type_mouvement){


        $mouvement= Mouvement::where('id_ligne_bonlivraison','=',$id_ligne_bonlivraison)->where('id_materiel','=',$id_materiel)->first();

        if($mouvement!=''){

            $mouvement->quantite=$quantite;
            $mouvement->unite=$unite;
            $mouvement->save();
        }else{
            $mouvement = new Mouvement();
            $mouvement->quantite=$type_mouvement*$quantite;
            $mouvement->id_ligne_bonlivraison=$id_ligne_bonlivraison;
            $mouvement->id_materiel=$id_materiel;
            $mouvement->id_type_mouvement=1;
            $mouvement->unite=$unite;
            $mouvement->id_projet=session('id_projet');
            $mouvement->save();
        }


    }
    public function donne_moi_bc_je_te_donne_bl($id_bc){
         $projet_choisi= ProjectController::check_projet_access();
        $bc_chosisi = Boncommande::find($id_bc);
        $arrayidlignebcs= Array();
        foreach ($bc_chosisi->ligne_bcs()->get() as $lige_bc):
            $arrayidlignebcs[]=$lige_bc->id;
        endforeach;

        $ligne_bon_livraisons = Ligne_bonlivraison::whereIn('id_devis',$arrayidlignebcs)->where('id_projet','=',$projet_choisi->id)->get();
        $nb_bls = Ligne_bonlivraison::whereIn('id_devis',$arrayidlignebcs)->where('id_projet','=',$projet_choisi->id)->get()->unique('numero_bl')->count();
        foreach($ligne_bon_livraisons as $lignebl):
        $res['ligne'.$lignebl->id_devis][]=$lignebl;
        $res['tot_bl'][]=$lignebl;
            endforeach;
        $res['nb']=$nb_bls;
        return $res;

    }
}
