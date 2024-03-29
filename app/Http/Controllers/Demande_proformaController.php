<?php
/**
 * Created by PhpStorm.
 * User: ckodia
 * Date: 25/10/2018
 * Time: 17:16
 */

namespace App\Http\Controllers;



use App\DA;
use App\Designation;
use App\Devis;
use App\Devise;
use App\Domaines;
use App\Gestion;
use App\Jobs\EnvoieMailFournisseurPerso;
use App\Jobs\EnvoiMailFournisseur;
use App\Jobs\EnvoiRappelFournisseur;
use App\Lignebesoin;
use App\Mail\Demande_proforma_mail;
use App\mailclass;
use App\Materiel;
use App\Fournisseur;
use App\Nature;
use App\Reponse_fournisseur;
use App\Tracemail;
use App\Unites;
use App\User;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use phpDocumentor\Reflection\Types\Array_;

class Demande_proformaController extends Controller
{

    public function demande_proformas()
    {
        $projet_choisi= ProjectController::check_projet_access();
        $types = DB::table('designation')
            ->join('lignebesoin', 'designation.id', '=', 'lignebesoin.id_materiel')
            ->join('famille', 'famille.id', '=', 'designation.id_famille')
            ->join('domaines', 'domaines.id', '=', 'famille.id_domaine')
            ->whereIn('lignebesoin.etat',[2,3])
            ->where('lignebesoin.id_projet','=',$projet_choisi->id)
            ->select('domaines.libelleDomainne','domaines.id','lignebesoin.etat')->distinct()->get();

        $fournisseurs=Fournisseur::where('id_projet','=',$projet_choisi->id)->get();
        $das=  DA::where('id_projet','=',$projet_choisi->id)->get();
        $natures= Nature::all();
        $users= User::where('id_projet','=',$projet_choisi->id)->get();
        $trace_mails= DB::table('trace_mail')->where('id_projet','=',$projet_choisi->id)
            ->select('trace_mail.id','das','trace_mail.created_at','rappel','trace_mail.email','id_fournisseur','msg_contenu','objet')->orderBy('trace_mail.created_at', 'DESC')->get();


        return view('demande_proformas/gestion_demande_proforma',compact('das','fournisseurs','natures','users','types','trace_mails'));


    }
    public function demande_ou_rappel($locale,$tab_slug,$list_da){
        // a terminer
dd($list_da);
    }
    public function enregistrer_devis(Request $request)
    {
        $parameters = $request->except(['_token']);

       // dd($parameters);
        $res=$parameters['res'];
        $lesId=$parameters['lesId'];
        $lesIdmat=$parameters['lesIdmat'];
        $lesId=explode(',',$lesId);
        $lesIdmat=explode(',',$lesIdmat);
        parse_str($res,$tab);
        $i=0;
        foreach($lesId as $id){
            if($id!=="undefined" && $tab["row_n_".$id."_titre_ext"]!="" && $tab["row_n_".$id."_fournisseur"]!="" && $tab["row_n_".$id."_prix_unitaire"]!="" && $tab["row_n_".$id."_codeGestion"]!="" ){
                $devis = new Devis();
                $devis->titre_ext=$tab["row_n_".$id."_titre_ext"];
                $devis->id_materiel=$lesIdmat[$i];
                $devis->id_fournisseur=$tab["row_n_".$id."_fournisseur"];
                $devis->codeGestion=$tab["row_n_".$id."_codeGestion"];
                $devis->quantite=$tab["row_n_".$id."_quantite"];
                $devis->id_projet=session('id_projet');
                //ajout de la réference fournisseur
                $devis->referenceFournisseur=$tab["row_n_".$id."_ref"];
                if(isset($tab["row_n_".$id."_tva"]) && $tab["row_n_".$id."_tva"]!=""){
                    $devis->hastva=$tab["row_n_".$id."_tva"];
                }else{
                    $devis->hastva=0;
                }

                $devis->id_da=$id;
                if(isset($tab["row_n_".$id."_remise"]) && $tab["row_n_".$id."_remise"]!=""){
                    $devis->remise=$tab["row_n_".$id."_remise"];
                }else{
                    $devis->remise=0;
                }

                $devis->unite=$tab["row_n_".$id."_unite"];

                if($tab["row_n_".$id."_devise"]=="XOF"){
                    $devis->prix_unitaire=$tab["row_n_".$id."_prix_unitaire"];
                    $devis->prix_unitaire_euro=RapportController::convertir_dans_une_devise($tab["row_n_".$id."_prix_unitaire"],date("Y-m-d"),$tab["row_n_".$id."_devise"].'_EUR');
                    $devis->prix_unitaire_usd=RapportController::convertir_dans_une_devise($tab["row_n_".$id."_prix_unitaire"],date("Y-m-d"),$tab["row_n_".$id."_devise"].'_USD');
                }elseif($tab["row_n_".$id."_devise"]=="USD"){
                    $devis->prix_unitaire_usd=$tab["row_n_".$id."_prix_unitaire"];
                    $devis->prix_unitaire_euro=RapportController::convertir_dans_une_devise($tab["row_n_".$id."_prix_unitaire"],date("Y-m-d"),$tab["row_n_".$id."_devise"].'_EUR');
                    $devis->prix_unitaire=RapportController::convertir_dans_une_devise($tab["row_n_".$id."_prix_unitaire"],date("Y-m-d"),$tab["row_n_".$id."_devise"].'_XOF');
                }else{
                    $devis->prix_unitaire_euro=$tab["row_n_".$id."_prix_unitaire"];
                    $devis->prix_unitaire_usd=RapportController::convertir_dans_une_devise($tab["row_n_".$id."_prix_unitaire"],date("Y-m-d"),$tab["row_n_".$id."_devise"].'_USD');
                    $devis->prix_unitaire=RapportController::convertir_dans_une_devise($tab["row_n_".$id."_prix_unitaire"],date("Y-m-d"),$tab["row_n_".$id."_devise"].'_XOF');
                }
                $devis->etat=1;
                $devis->devise=$tab["row_n_".$id."_devise"];


                $lignebesoin= Lignebesoin::find($id);
                if(isset($lignebesoin->designation->code_analytique)){
                    $devis->codeRubrique=$lignebesoin->designation->code_analytique;
                }
                if(isset($lignebesoin)){
                    $lignebesoin->etat=3;
                    $lignebesoin->save();
                }

                 $devis->save();
            }
            $i++;
        }







return 1;

    }
    public function modifier_devis(Request $request)
    {
        $parameters = $request->except(['_token']);

        $res=$parameters['res'];
        $lesId=$parameters['lesId'];
        $lesId=explode(',',$lesId);

        parse_str($res,$tab);
        $i=0;
        foreach($lesId as $id){
            if($id!=="undefined" && $tab["row_n_".$id."_titre_ext"]!="" && $tab["row_n_".$id."_fournisseur"]!="" && $tab["row_n_".$id."_prix_unitaire"]!="" && $tab["row_n_".$id."_quantite"]){

                $devis =  Devis::find($id);
                if( $devis->etat==1){

                    $devis->titre_ext=$tab["row_n_".$id."_titre_ext"];
                    $devis->id_fournisseur=$tab["row_n_".$id."_fournisseur"];
                    if($tab["row_n_".$id."_codeGestion"]!=""){
                        $devis->codeGestion=$tab["row_n_".$id."_codeGestion"];
                    }


                    $devis->quantite=$tab["row_n_".$id."_quantite"];
                    $devis->referenceFournisseur=$tab["row_n_".$id."_ref"];
                   // $devis->id_da=$id;
                    if(isset($tab["row_n_".$id."_tva"]) && $tab["row_n_".$id."_tva"]!=""){
                        $devis->hastva=$tab["row_n_".$id."_tva"];
                    }else{
                        $devis->hastva=0;
                    }
                    //$devis->remise=$tab["row_n_".$id."_remise"];
                    $devis->unite=$tab["row_n_".$id."_unite"];
                    if(isset($tab["row_n_".$id."_remise"]) && $tab["row_n_".$id."_remise"]!=""){
                        $devis->remise=$tab["row_n_".$id."_remise"];
                    }else{
                        $devis->remise=0;
                    }
                    if($tab["row_n_".$id."_devise"]=="XOF"){
                        $devis->prix_unitaire=$tab["row_n_".$id."_prix_unitaire"];
                        $devis->prix_unitaire_euro=RapportController::convertir_dans_une_devise($tab["row_n_".$id."_prix_unitaire"],date("Y-m-d"),$tab["row_n_".$id."_devise"].'_EUR');
                        $devis->prix_unitaire_usd=RapportController::convertir_dans_une_devise($tab["row_n_".$id."_prix_unitaire"],date("Y-m-d"),$tab["row_n_".$id."_devise"].'_USD');
                    }elseif($tab["row_n_".$id."_devise"]=="USD"){
                        $devis->prix_unitaire_usd=$tab["row_n_".$id."_prix_unitaire"];
                        $devis->prix_unitaire_euro=RapportController::convertir_dans_une_devise($tab["row_n_".$id."_prix_unitaire"],date("Y-m-d"),$tab["row_n_".$id."_devise"].'_EUR');
                        $devis->prix_unitaire=RapportController::convertir_dans_une_devise($tab["row_n_".$id."_prix_unitaire"],date("Y-m-d"),$tab["row_n_".$id."_devise"].'_XOF');
                    }else{
                        $devis->prix_unitaire_euro=$tab["row_n_".$id."_prix_unitaire"];
                        $devis->prix_unitaire_usd=RapportController::convertir_dans_une_devise($tab["row_n_".$id."_prix_unitaire"],date("Y-m-d"),$tab["row_n_".$id."_devise"].'_USD');
                        $devis->prix_unitaire=RapportController::convertir_dans_une_devise($tab["row_n_".$id."_prix_unitaire"],date("Y-m-d"),$tab["row_n_".$id."_devise"].'_XOF');
                    }
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
        $projet_choisi= ProjectController::check_projet_access();
        $reponse_fournisseurs = DB::table('reponse_fournisseur')
            ->join('fournisseur', 'fournisseur.id', '=', 'reponse_fournisseur.id_fournisseur')
            ->join('lignebesoin', 'lignebesoin.id', '=', 'reponse_fournisseur.id_lignebesoin')
            ->where('reponse_fournisseur.id_lignebesoin', '=', $id_lignebesoin)
            ->where('lignebesoin.id_projet','=',$projet_choisi->id)
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
        return redirect()->route('ajouter_fournisseur')->with('success',"success");
    }
    public function send_it_personnalisé_ddd(Request $request){
        $parameters=$request->except(['_token']);
        $msg_contenu=$parameters['compose-textarea'];
        $objet=$parameters['objet'];
        $daas=explode(',',$parameters['daas']);


        $contact=explode(',',$parameters['To']);
        $i=0;
        foreach ($daas as $da):
            $lignebesoins[]=Lignebesoin::find($da);
            endforeach;


        foreach($lignebesoins as $das):
            if(isset($das->id)){
                $materiel=DB::table('designation')
                    ->where('id', '=', $das->id_materiel)
                    ->select('libelle','image')->distinct()->get();


                if($materiel[0]->image!==""){
                    $images[$i]=$materiel[0]->image;
                }else{
                    $images[$i]="vide";
                }
                if($das->commentaire!=""){
                    $precisions[$i]=$das->commentaire;
                }else{
                    $precisions[$i]="";

                }

               $corps[$i] =" - ".$das->quantite." ".$das->unite." de ".$materiel[0]->libelle;
            }
            $i++;

        endforeach;

        $this->dispatch(new EnvoieMailFournisseurPerso($contact,$images,$objet,$msg_contenu) );

        $tab_fournisseur= Array();
        foreach ($contact as $email):

            $frn=Fournisseur::where('contact','LIKE', '%'.$email.'%')->first();
            $tab_fournisseur[]=$frn->id;

        endforeach;

        $Trace_mail= new Tracemail();
        $Trace_mail->id_fournisseur=implode(",", array_unique($tab_fournisseur));
        $Trace_mail->email=implode(',',$contact);
        $Trace_mail->objet=$objet;
        $Trace_mail->msg_contenu=$msg_contenu;
        $Trace_mail->das=implode(',',$daas);
        $Trace_mail->save();

        return redirect()->back()->with('success', "success");

    }
    public function recup_infos_pour_envois_mail_perso($locale,$listeDA){

        $listeDA = explode(',',$listeDA);
        $i=0;
        $images=Array();

        $precisions=Array();
        foreach($listeDA as $laDA):
            $das=  DA::find($laDA);

            if(isset($das->id) && $das->id!=""){
                $materiel=DB::table('materiel')
                    ->where('id', '=', $das->id_materiel)
                    ->select('libelleMateriel','image')->distinct()->get();


                if($materiel[0]->image!==""){
                    $images[$i]=$materiel[0]->image;
                }else{
                    $images[$i]="vide";
                }
                if($das->commentaire!=""){
                    $precisions[$i]=$das->commentaire;
                }else{
                    $precisions[$i]="";

                }
                if($images[$i]=="vide"){
                    $corps[$i] =" - ".$das->quantite." ".$das->unite." ".__('neutrale.de').$materiel[0]->libelleMateriel;
                }else{
                    $corps[$i] =" - ".$das->quantite." ".$das->unite." ".__('neutrale.de').$materiel[0]->libelleMateriel." voir pièce jointe : ".$images[$i];
                }

                $i++;
            }




        endforeach;

        $tab['precision']=$precisions;
        $tab['corps']=$corps;

        return $tab;
    }


public function nouveau_rappel($locale,$id_trace_mail){

    $trace_mail= Tracemail::find($id_trace_mail);
    $id_das=explode(',',$trace_mail->das);


$i=0;
    foreach ($id_das as $da):
        if(isset($da)){
            $lignebesoins[]=Lignebesoin::find($da);
        }

    endforeach;
    foreach($lignebesoins as $das):
        if(isset($das->id)){
            $materiel=DB::table('designation')
                ->where('id', '=', $das->id_materiel)
                ->select('libelle','image')->distinct()->get();


            if($materiel[0]->image!==""){
                $images[$i]=$materiel[0]->image;
            }else{
                $images[$i]="vide";
            }
            if($das->commentaire!=""){
                $precisions[$i]=$das->commentaire;
            }else{
                $precisions[$i]="";

            }

            $corps[$i] =" - ".$das->quantite." ".$das->unite." de ".$materiel[0]->libelle;
        }
        $i++;

    endforeach;
    $this->dispatch(new EnvoieMailFournisseurPerso(explode(',',$trace_mail->email),$images,$trace_mail->objet,"POUR RAPPEL : \r\n".$trace_mail->msg_conten) );

    return redirect()->back()->with('success', "success");

}
    public function envoies(Request $request)
    {

         $parameters = $request->except(['_token']);

       // $fourn= $parameters['fourn'];
        $fournisseurs= explode(',',$parameters['fournisseur']);
        foreach($fournisseurs as $fournisseur):
            if($fournisseur!="" && strstr($fournisseur,'@')){
                $recup_email[]=$fournisseur;
            }elseif($fournisseur!="" && !strstr($fournisseur,'@')){
                $recup_slug[]=$fournisseur;
            }



            endforeach;
     //   dd($recup_email);
        $listeDA = $parameters['listeDA'];
        $domaine = $parameters['domaine'];
        $lang = $parameters['lang'];
        $domaine =  Domaines::find($domaine)->libelleDomainne;
       // dd($listeDA);
        $tab_listeSA = explode(",", $listeDA);

        if(isset($parameters['rappel'])){
            $rappel = $parameters['rappel'];
        }else{
            $rappel="";
        }

        $corps= Array();

        $images= Array();
        $precisions= Array();
$i=0;

        foreach($tab_listeSA as $laDA):
            $das=  DA::find($laDA);

            if(isset($das->id) && $das->id!=""){
                $materiel=DB::table('designation')
                    ->where('id', '=', $das->id_materiel)
                    ->select('libelle','image')->distinct()->get();


                if($materiel[0]->image!==""){
                    $images[$i]=$materiel[0]->image;
                }else{
                    $images[$i]="vide";
                }
                if($das->commentaire!=""){
                    $precisions[$i]=$das->commentaire;
                }else{
                    $precisions[$i]="";

                }
                $corps[$i] =" - ".$das->quantite." ".$das->unite." ".__('neutrale.de').$materiel[0]->libelle." \r\n ";
                $i++;
            }




        endforeach;
        $email='';
       // dd($recup_email);
        if($rappel!="on"){
            $date= new \DateTime(null);
            $date= $date->format("d/m/Y");

            $this->dispatch(new EnvoiMailFournisseur($corps, $precisions, $images, $recup_email,$domaine, $date,$lang) );
        }else{
            $date= new \DateTime(null);
            $date= $date->format("d/m/Y");
            $this->dispatch(new EnvoiRappelFournisseur($corps,$recup_email,$domaine,$date) );
        }
        $tab_fournisseur= Array();
foreach ($recup_email as $email):

    $frn=Fournisseur::where('contact','LIKE', '%'.$email.'%')->first();
    $tab_fournisseur[]=$frn->id;

    endforeach;

//mettre le contenue de la vu dans une variablme
        $debut_contenu="  Bonjour,\r\nVeuillez svp nous adresser votre meilleure offre pour :\r\n";

        $fin_contenu="\r\n Dans l’attente, et en vous remerciant par avance,\r\n\r\n";
        //fin contenue
        $date= new \DateTime(null);
        $date= $date->format("d/m/Y");
        $objet='EGCCI-PHB/Demande de devis - '.$domaine.' - '.$date;
        $Trace_mail= new Tracemail();
        $Trace_mail->id_fournisseur=implode(",", array_unique($tab_fournisseur));
        $Trace_mail->rappel=$rappel;
        $Trace_mail->email=implode(',',$recup_email);
        $Trace_mail->das=implode(',',$tab_listeSA);
        $Trace_mail->objet=$objet;
        $Trace_mail->msg_contenu=$debut_contenu.implode(' ',$corps).$fin_contenu;
        $Trace_mail->id_projet=session('id_projet');
        $Trace_mail->save();


       // return view('mail.mail')->with('corps',$corps);
            return redirect()->back()->with('success', "success");
    }

    /**
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function supprimer_def_devis2($locale,$id)
    {
        $devi= Devis::find($id);
        if(!empty($devi)){
            $da= Lignebesoin::find($devi->id_da);
            $da->delete();
            $devi->delete();
        }




        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.';Suppression du Devis et de la D.A N°'.$da->id, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return 'ok';
    }
    public function supprimer_def_devis2_collectif(Request $request)
    {
        $parameters = $request->except(['_token']);
        $lesid=$parameters['lesId'];
        $tab_id = explode(",", $lesid);

        foreach($tab_id as $id):

            if($id!=""){
        $devi= Devis::find($id);
        if(!empty($devi)){
            $da= Lignebesoin::find($devi->id_da);
            $da->delete();
            $devi->delete();
        }




        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.';Suppression du Devis et de la D.A N°'.$da->id, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
            }
        endforeach;
                return 'ok';
    }
    public function supprimer_def_devis($id)
    {
        $da= Lignebesoin::find($id);
        $da->delete();

        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.';Suppression  de la D.A N°'.$da->id, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return 'ok';
    }
    public function supprimer_def_devis_collectif(Request $request)
    {

             $parameters = $request->except(['_token']);
        $lesid=$parameters['lesId'];
        $tab_id = explode(",", $lesid);
        foreach($tab_id as $id):

            if($id!=""){



        $da= Lignebesoin::find($id);
        $da->delete();

        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.';Suppression  de la D.A N°'.$da->id, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
            }
        endforeach;
        return 'ok';


    }
    public function les_das_funct($locale,$domaine)
    {
        $projet_choisi= ProjectController::check_projet_access();
        $types = DB::table('designation')
            ->where('famille.id_domaine', '=', $domaine)
            ->where('lignebesoin.id_projet','=',$projet_choisi->id)
            ->join('famille', 'famille.id', '=', 'designation.id_famille')
            ->join('lignebesoin', 'designation.id', '=', 'lignebesoin.id_materiel')
            ->join('nature', 'nature.id', '=', 'lignebesoin.id_nature')
            ->leftJoin('users', 'users.id', '=', 'lignebesoin.id_valideur')
            ->whereIn('lignebesoin.etat', [2,3])
            ->select('lignebesoin.id','lignebesoin.id_materiel','unite','DateBesoin','quantite','demandeur','users.nom','users.prenoms','designation.libelle','libelleNature','lignebesoin.slug','lignebesoin.created_at','lignebesoin.etat')
            ->orderBy('lignebesoin.id', 'desc')
            ->distinct()->get();
        $variable="";
        $status="<i class='fa fa-circle' style='color: mediumspringgreen'></i>";

        return response()->json($types);
        //    return response()->json($variable);

    }


    public function contact_fonction_du_fournisseur($slug)
    {


        return response()->json($types);
        //    return response()->json($variable);

    }

    public function les_das_fournisseurs_funct($locale,$domaine)
    {



        $types = DB::table('fournisseur')
                    ->distinct()->get();
        $tableau = Array();

        foreach($types as $type):
            $tab = explode(',',$type->domaine);

            if(in_array($domaine,$tab)){
                $tableau[]=$type;
            }
        endforeach;
        return response()->json($tableau);

    }

    public function les_das_fournisseurs_funct_da($locale,$id_fournisseur){

        $fournisseur= Fournisseur::find($id_fournisseur);
       // dd($fournisseur);

        $contact=$fournisseur->contact;



        return response()->json($contact);
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
        $projet_choisi= ProjectController::check_projet_access();
        $gestions = Gestion::all();
        $fournisseurs=DB::table('fournisseur')
            ->join('domaines', 'domaines.id', '=', 'fournisseur.domaine')
            ->where('fournisseur.id_projet','=',$projet_choisi->id)
            ->select('libelle','libelleDomainne','fournisseur.id','fournisseur.domaine')->distinct()->get();
       // $materiels=Materiel::all();
        /*
        $das= DB::table('designation')
            ->join('lignebesoin', 'designation.id', '=', 'lignebesoin.id_materiel')
            ->where('etat', '=', 2)
            ->where('lignebesoin.created_at', '>', '2020-12-21 00:00:00')
            ->select('libelle','lignebesoin.id', 'lignebesoin.unite', 'lignebesoin.quantite', 'DateBesoin','id_user', 'id_reponse_fournisseur','id_nature', 'lignebesoin.id_materiel', 'id_bonCommande','demandeur','lignebesoin.slug','lignebesoin.etat','id_valideur','motif','code_analytique','type','lignebesoin.id_codeGestion')->distinct()->paginate(30);
*/
        $das= Lignebesoin::where('etat','=',2)->where('id_projet','=',$projet_choisi->id)->distinct()->paginate(30);
        $tab_proposition= Array();
        foreach ($das as $d):
            $dev = Devis::where('id_materiel','=',$d->id_materiel)->where('id_projet','=',$projet_choisi->id)->orderByRaw('devis.id DESC')->get()->first();
            if($dev!=null){
                $tab_proposition[$d->id]=$dev;
            }
        endforeach;
        $natures= Nature::all();
        $users= User::all();
        $domaines=  DB::table('domaines')->get();
        $devis = DB::table('devis')
            ->join('designation', 'designation.id', '=', 'devis.id_materiel')
            ->join('famille', 'famille.id', '=', 'designation.id_famille')
            ->where('devis.id_projet','=',$projet_choisi->id)
            ->select('designation.libelle','devis.id','devis.id_da','titre_ext','famille.id_domaine','devise', 'devis.unite', 'devis.quantite','id_fournisseur','prix_unitaire','prix_unitaire_usd','prix_unitaire_euro','remise','devis.codeRubrique','hastva','referenceFournisseur','codeGestion')

        ->where('etat','=',1)->get();

        $devises = Devise::all();

        $analytiques=  DB::table('analytique')->distinct()->get(['codeRubrique','libelle']);
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
        return view('reponse_fournisseur/gestion_reponse_fournisseur',compact('devises','analytiques','das','fournisseurs','natures','users','domaines','devis','tab_proposition','tab_unite','gestions','projet_choisi'));


    }

}
