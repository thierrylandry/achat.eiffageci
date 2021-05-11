<?php

namespace App\Http\Controllers;

use App\Etat_da_pas_transforme;
use App\Ligne_bonlivraison;
use App\Moyenne_jour_livraison_par_fournisseur;
use App\Projet;
use App\Rapports;
use App\Stock;
use App\Taux_change;
use Barryvdh\DomPDF\Facade as PDF;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Shared\Date;

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

        $projet_choisi= ProjectController::check_projet_access();
        $rapport = Rapports::find($id);
        if($id==1){
            $tableaux =Moyenne_jour_livraison_par_fournisseur::where('id_projet','=',$projet_choisi->id)->get();
        }elseif($id==2){

         //  $res= RapportController::convertir_dans_une_devise(1,'2021-05-9','EUR_XOF');


            $tableaux_chiffre_affaires = DB::table('chiffre_ffaire')->where('id_projet','=',$projet_choisi->id )->select('id','libelle','chfirreaffaire','devise_bc')->get();

            $tableaux = array();
            $tableaux1 = array();
            foreach($tableaux_chiffre_affaires as $tableaux_chiffre_affaire):
                if(isset($tableaux1[$tableaux_chiffre_affaire->id])){

                        $tableaux1[$tableaux_chiffre_affaire->id]+=RapportController::convertir_dans_une_devise($tableaux_chiffre_affaire->chfirreaffaire,date("Y-m-d"),$tableaux_chiffre_affaire->devise_bc.'_'.$projet_choisi->defaultDevise);



                }else{
                    $tableaux1[$tableaux_chiffre_affaire->id]=RapportController::convertir_dans_une_devise($tableaux_chiffre_affaire->chfirreaffaire,date("Y-m-d"),$tableaux_chiffre_affaire->devise_bc.'_'.$projet_choisi->defaultDevise);

                }
            endforeach;


          //  dd($tableaux1);
            foreach($tableaux_chiffre_affaires as $tableaux_chiffre_affaire):

                $tableaux_chiffre_affaire->chfirreaffaire= number_format($tableaux1[$tableaux_chiffre_affaire->id],2,'.','');
                $tableaux[$tableaux_chiffre_affaire->id]=$tableaux_chiffre_affaire;

             endforeach;


        }elseif($id==3){
            $command_receptions = DB::select('SELECT `fournisseur`.`id` AS `id`,`fournisseur`.`libelle` AS `libelle`,`boncommande`.`numBonCommande` AS `numBonCommande`,sum(quantite) as quantite_commande_tot FROM fournisseur join boncommande on fournisseur.id=boncommande.id_fournisseur join devis on devis.id_bc=boncommande.id WHERE boncommande.id_projet='.$projet_choisi->id.' group by fournisseur.id,libelle,numBonCommande;');
            $tableaux_intermediaire=array();


           // dd($command_receptions);
        }elseif($id==4){
                //$ca_par_fournisseur_et_domaine
             $dependance_vu_produits = DB::select("SELECT `fournisseur`.`id` AS `id`, `fournisseur`.`libelle` AS `libelle`,domaines.libelleDomainne as libelleDomainne, sum(devis.prix_tot) as prix_total,sum(devis.valeur_tva) as valeur_tva_tot,devise_bc  FROM fournisseur  join boncommande on fournisseur.id=boncommande.id_fournisseur join devis on devis.id_bc=boncommande.id join designation on designation.id=devis.id_materiel join famille on famille.id=designation.id_famille join domaines on domaines.id=famille.id_domaine where boncommande.etat=3 and boncommande.id_projet=".$projet_choisi->id." group by devise_bc,fournisseur.id,fournisseur.libelle,libelleDomainne");

          //  dd($this->convertisseur_devise('EUR','XOF',1));

          $tableaux = array();
          $tableaux1 = array();
          foreach($dependance_vu_produits as $dependance_vu_produit):
              if(isset($tableaux1[$dependance_vu_produit->id]['prix_total'])){

                      $tableaux1[$dependance_vu_produit->id.$dependance_vu_produit->libelleDomainne]['prix_total']+=RapportController::convertir_dans_une_devise($dependance_vu_produit->prix_total,date("Y-m-d"),$dependance_vu_produit->devise_bc.'_'.$projet_choisi->defaultDevise);
                      $tableaux1[$dependance_vu_produit->id.$dependance_vu_produit->libelleDomainne]['valeur_tva_tot']+=RapportController::convertir_dans_une_devise($dependance_vu_produit->valeur_tva_tot,date("Y-m-d"),$dependance_vu_produit->devise_bc.'_'.$projet_choisi->defaultDevise);



              }else{
                  $tableaux1[$dependance_vu_produit->id.$dependance_vu_produit->libelleDomainne]['prix_total']=RapportController::convertir_dans_une_devise($dependance_vu_produit->prix_total,date("Y-m-d"),$dependance_vu_produit->devise_bc.'_'.$projet_choisi->defaultDevise);
                  $tableaux1[$dependance_vu_produit->id.$dependance_vu_produit->libelleDomainne]['valeur_tva_tot']=RapportController::convertir_dans_une_devise($dependance_vu_produit->valeur_tva_tot,date("Y-m-d"),$dependance_vu_produit->devise_bc.'_'.$projet_choisi->defaultDevise);

              }
          endforeach;


        //  dd($tableaux1);
          foreach($dependance_vu_produits as $dependance_vu_produit):

              $dependance_vu_produit->prix_total= number_format($tableaux1[$dependance_vu_produit->id.$dependance_vu_produit->libelleDomainne]['prix_total'],2,'.','');
              $dependance_vu_produit->valeur_tva_tot= number_format($tableaux1[$dependance_vu_produit->id.$dependance_vu_produit->libelleDomainne]['valeur_tva_tot'],2,'.','');
              $tableaux[$dependance_vu_produit->id.$dependance_vu_produit->libelleDomainne]=$dependance_vu_produit;

           endforeach;

            $dependance_tableaux=$tableaux;
           // dd($dependance_tableaux);
            $total = array();

           return view('rapport/rapport',compact('rapport','dependance_tableaux','dependance_vu_produits'));
           // dd($tableaux);
        }elseif($id==5){
                //$ca_par_fournisseur_et_domaine
             $retour_non_conformes = DB::table('retours_non_conforme')->where('id_projet','=',$projet_choisi->id)->get();

           return view('rapport/rapport',compact('rapport','retour_non_conformes'));
           // dd($tableaux);
        }elseif($id==6){
                //$ca_par_fournisseur_et_domaine
                $chronologie_livraisons = DB::table('chronologi_livraison')->where('id_projet','=',$projet_choisi->id)->get();

                $chronologie_sorties = DB::table('chronologie_sortie')->where('id_projet','=',$projet_choisi->id)->get();


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

            $tableaux = DB::select('SELECT domaine,famille,libelle,quantite,prix_unitaire, sum(quantite*prix_unitaire) as prix_ht_materiel,devise FROM achat_eiffage.consommation_prix_u WHERE id_projet='.$projet_choisi->id.' group by id_projet,id_materiel;');

        }elseif($id==8){
            //$ca_par_fournisseur_et_domaine

            $tableaux = DB::select('SELECT * FROM achat_eiffage.stock where  quantite<=stock_min and id_projet='.$projet_choisi->id );

            // dd($tableaux);
        }elseif($id==9){
            //$ca_par_fournisseur_et_domaine

            $tableaux =DB::table('moyenne_jour_livraison_produit')->where('id_projet','=',$projet_choisi->id)->get();

            // dd($tableaux);
        }elseif($id==10){
            //$ca_par_fournisseur_et_domaine

            $tableaux =Etat_da_pas_transforme::where('id_projet','=',$projet_choisi->id)->get();

        }elseif($id==11){
            //$ca_par_fournisseur_et_domaine

            $tableaux =DB::select('select boncommande.id_projet,fournisseur.libelle as fournisseur,boncommande.date, boncommande.id,numBonCommande,id_user,users.nom,users.prenoms,boncommande.created_at,boncommande.etat,boncommande.id_fournisseur,devis.id_materiel,devis.quantite as quantite_commande, sum(ligne_bonlivraison.quantite) as quantite_livree from boncommande
left join devis on devis.id_bc=boncommande.id
left join ligne_bonlivraison on ligne_bonlivraison.id_devis=devis.id
left join fournisseur on boncommande.id_fournisseur=fournisseur.id
left join users on boncommande.id_user=users.id
where boncommande.etat>=3, id_projet='.$projet_choisi->id.'
group by boncommande.id_projet,boncommande.id
having quantite_livree is null

');

        }else{

        }


        return view('rapport/rapport',compact('rapport','tableaux'));

    }
    public function fifo($_id_materiel,$libelle){
        $projet_choisi= ProjectController::check_projet_access();
        $chronologie_livraisons= DB::table('chronologi_livraison')->where('id_projet','=',$projet_choisi->id)->where('id','=',$_id_materiel)->orWhere('reference','=',$libelle)->where('id_projet','=',$projet_choisi->id)->get();

      //  dd($chronologie_livraisons);
        $point_consomation = DB::table("point_consomation")->where('id_projet','=',$projet_choisi->id)->where('id_materiel','=',$_id_materiel)->first();
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
        $projet_choisi= ProjectController::check_projet_access();
    $premiere_livraisons =DB::select("SELECT * FROM achat_eiffage.command_reception  where id_projet=".$projet_choisi->id." and id_materiel=$id_materiel and id=$id_fourisseur and numBonCommande='$numBonCommande' order by date_reception ASC limit 1;");


        dd($premiere_livraisons);
}
    public static function convertisseur_devise($de,$a,$valeur){
        $de="EUR";
        $a="XOF";
        $ch = curl_init('https://free.currconv.com/api/v7/convert?q='.$de.'_'.$a.'&compact=ultra&apiKey=70d29bc945007a293ffd');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// get the (still encoded) JSON data:
        $json = curl_exec($ch);
        curl_close($ch);
// Decode JSON response:
        $conversionResult = json_decode($json, true);
        $resultat= Array();
        foreach($conversionResult as $conversionResult1):
            $resultat=$conversionResult1;
        endforeach;
// access the conversion result
        return $resultat*$valeur;
    }
    public function fouille_et_trouve_montant(){


    }
    public static function convertir_dans_une_devise($montant,$date_montant,$sens_conversion){


        $taux_change = Taux_change::where('date','<=',$date_montant)->orderBy('date','DESC')->first();
      //  dd($montant);

        $montant_onverti=0;
        if($taux_change!==null){

            switch($sens_conversion) {
                case 'EUR_XOF':
                    $montant_onverti = $taux_change->EUR_XOF*$montant;
                  break;
                case 'EUR_USD':
                    $montant_onverti = $taux_change->EUR_USD*$montant;
                  break;
                case 'USD_XOF':
                    $montant_onverti = $taux_change->USD_XOF*$montant;
                  break;

                case 'XOF_EUR':
                    $montant_onverti =(1/$taux_change->EUR_XOF)*$montant;
                      break;
                case 'USD_EUR':
                    $montant_onverti = (1/$taux_change->EUR_USD)*$montant;
                      break;
                case 'XOF_USD':
                    $montant_onverti = (1/$taux_change->XOF_USD)*$montant;
                      break;

                default:
                $montant_onverti = $montant;

          }

        }else{

            $montant_onverti = $montant;
        }
        //dd($montant.'*'.$taux_change->EUR_XOF.'='.$montant_onverti);
       // return number_format($montant_onverti,2,'.','');
        return $montant_onverti;

    }
}
