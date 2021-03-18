<?php

namespace App\Http\Controllers;

use App\Etat_da_pas_transforme;
use App\Ligne_bonlivraison;
use App\Moyenne_jour_livraison_par_fournisseur;
use App\Rapports;
use App\Stock;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RapportController extends Controller
{
    //
    public function rapport_demande_achat(){

        $rapports = Rapports::where('id_type_rapport','=',3)->get();


        return view('rapport/rapport_demande',compact('rapports'));
    }
    public function performance_fournisseur(){

        $rapports = Rapports::where('id_type_rapport','=',1)->get();


        return view('rapport/liste_rapport_fournisseur',compact('rapports'));
    }
    public function rapport_stock(){

        $rapports = Rapports::where('id_type_rapport','=',2)->get();


        return view('rapport/rapport_stock',compact('rapports'));
    }
    public function rapport($locale,$id){

        $rapport = Rapports::find($id);
        if($id==1){
            $tableaux =Moyenne_jour_livraison_par_fournisseur::all();
        }elseif($id==2){
            $tableaux = DB::table('chiffre_ffaire')->select('libelle','chfirreaffaire','devise_bc')->get();
        }elseif($id==3){
            $command_receptions = DB::select('SELECT `fournisseur`.`id` AS `id`,`fournisseur`.`libelle` AS `libelle`,`boncommande`.`numBonCommande` AS `numBonCommande`,sum(quantite) as quantite_commande_tot FROM fournisseur join boncommande on fournisseur.id=boncommande.id_fournisseur join devis on devis.id_bc=boncommande.id group by fournisseur.id,libelle,numBonCommande;');
            $tableaux_intermediaire=array();


           // dd($command_receptions);
        }elseif($id==4){
                //$ca_par_fournisseur_et_domaine
             $dependance_vu_produits = DB::select("SELECT `fournisseur`.`id` AS `id`, `fournisseur`.`libelle` AS `libelle`,domaines.libelleDomainne as libelleDomainne, sum(devis.prix_tot) as prix_total,sum(devis.valeur_tva) as valeur_tva_tot,devise_bc  FROM fournisseur  join boncommande on fournisseur.id=boncommande.id_fournisseur join devis on devis.id_bc=boncommande.id join designation on designation.id=devis.id_materiel join famille on famille.id=designation.id_famille join domaines on domaines.id=famille.id_domaine where boncommande.etat=3 group by devise_bc,fournisseur.id,fournisseur.libelle,libelleDomainne");
            $dependance_tableaux=$dependance_vu_produits;
            $total = array();

           return view('rapport/rapport',compact('rapport','dependance_tableaux','dependance_vu_produits'));
           // dd($tableaux);
        }elseif($id==5){
                //$ca_par_fournisseur_et_domaine
             $retour_non_conformes = DB::table('retours_non_conforme')->get();

           return view('rapport/rapport',compact('rapport','retour_non_conformes'));
           // dd($tableaux);
        }elseif($id==6){
                //$ca_par_fournisseur_et_domaine
                $chronologie_livraisons = DB::table('chronologi_livraison')->get();

                $chronologie_sorties = DB::table('chronologie_sortie')->get();


            $stocks = Stock::all();
            $tableaux = array();
//dd($stocks);
            foreach ($stocks as $stock):
                if($this->fifo($stock->id,$stock->libelle)!=0 && $stock->quantite!="0") {
                    $tableaux[$stock->id][$stock->libelle] = $this->fifo($stock->id,$stock->libelle);
                }
                endforeach;
           // dd($tableaux);
            return view('rapport/rapport',compact('rapport','tableaux','stocks'));

        }elseif($id==7){
            //$ca_par_fournisseur_et_domaine

            $tableaux = DB::select('SELECT domaine,famille,libelle,quantite,prix_unitaire, sum(quantite*prix_unitaire) as prix_ht_materiel,devise FROM achat_eiffage.consommation_prix_u
group by id_materiel;');

        }elseif($id==8){
            //$ca_par_fournisseur_et_domaine

            $tableaux = DB::select('SELECT * FROM achat_eiffage.stock where quantite<=stock_min');

            // dd($tableaux);
        }elseif($id==9){
            //$ca_par_fournisseur_et_domaine

            $tableaux =DB::table('moyenne_jour_livraison_produit')->get();

            // dd($tableaux);
        }elseif($id==10){
            //$ca_par_fournisseur_et_domaine

            $tableaux =Etat_da_pas_transforme::all();

        }elseif($id==11){
            //$ca_par_fournisseur_et_domaine

            $tableaux =DB::select('select fournisseur.libelle as fournisseur,boncommande.date, boncommande.id,numBonCommande,id_user,users.nom,users.prenoms,boncommande.created_at,boncommande.etat,boncommande.id_fournisseur,devis.id_materiel,devis.quantite as quantite_commande, sum(ligne_bonlivraison.quantite) as quantite_livree from boncommande
left join devis on devis.id_bc=boncommande.id
left join ligne_bonlivraison on ligne_bonlivraison.id_devis=devis.id
left join fournisseur on boncommande.id_fournisseur=fournisseur.id
left join users on boncommande.id_user=users.id
where boncommande.etat>=3 
group by boncommande.id
having quantite_livree is null

');

        }else{

        }


        return view('rapport/rapport',compact('rapport','tableaux'));

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
    public function donne_moi_la_les_elements_de_la_première_livraison($numBonCommande,$id_fourisseur,$id_materiel){

    $premiere_livraisons =DB::select("SELECT * FROM achat_eiffage.command_reception  where  id_materiel=$id_materiel and id=$id_fourisseur and numBonCommande='$numBonCommande' order by date_reception ASC limit 1;");


        dd($premiere_livraisons);
}
}
