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
use App\DA;
use App\Designation;
use App\Devis;
use App\Fournisseur;
use App\Gestion;
use App\Jobs\EnvoiBcFournisseur;
use App\Jobs\EnvoiBcFournisseurPersonnalise;
use App\ligne_bc;
use App\Ligne_bonlivraison;
use App\Lignebesoin;
use App\Materiel;
use App\Projet;
use App\Reponse_fournisseur;
use App\Services;
use App\Unites;
use App\User;
use danielme85\CConverter\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use League\Flysystem\Exception;
use Barryvdh\DomPDF\Facade as PDF;
use Spipu\Html2Pdf\Html2Pdf;
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

    public function bon_commande_file($locale,$slug){
     // $bc=  Boncommande::where('slug','=',$slug)->first();
     $projet_choisi= ProjectController::check_projet_access();
       /* $bc= DB::table('boncommande')
            ->join('fournisseur', 'boncommande.id_fournisseur', '=', 'fournisseur.id')
             ->leftJoin('services', 'services.id', '=', 'boncommande.service_demandeur')
            ->leftJoin('projet', 'projet.id', '=', 'boncommande.id_projet')
            ->where('boncommande.slug','=',$slug)
            ->where('boncommande.id_projet','=',$projet_choisi->id)
            ->select('fournisseur.libelle','boncommande.id','numBonCommande','date','boncommande.created_at','services.libelle as libelle_service','commentaire_general','fournisseur.conditionPaiement','boncommande.id_fournisseur','remise_excep','n_rccm','n_cc',)->first();
       */
      $bc=Boncommande::where('slug','=',$slug)->first();

      /*$devis=DB::table('devis')
            ->leftjoin('lignebesoin', 'devis.id_da', '=', 'lignebesoin.id')
            ->where('id_bc','=',$bc->id)
            ->where('lignebesoin.id_projet','=',$projet_choisi->id)
            ->select('titre_ext','devis.quantite','devis.unite','devis.prix_unitaire','devis.remise','devis.prix_tot','devis.codeRubrique','devis.devise','commentaire','hastva','referenceFournisseur','codeGestion')->get();
        */
        $taille=sizeof($bc->ligne_bcs()->get());

        if($bc->commentaire_general==''){
            $taille_minim=6;
            $taille_maxim=38;
        }else{
            $taille_minim=5;
            $taille_maxim=37;
        }
        $tothtax = 0;
        //return view('BC.bon-commande', compact('bc','ligne_bcs','tothtax'));
        $pdf = PDF::loadView('BC.bon-commande', compact('bc','tothtax','taille','taille_minim','taille_maxim'));
       return  $pdf->stream();


        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.'; téléchargement du B.C N°'.$bc->numBonCommande.'  Adressé au fournisseur '.$bc->id_fournisseur, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
       // return $pdf->download('bon_de_commande_n°'.$bc->numBonCommande.'.pdf');

    }
    public function afficher_le_mail($locale,$bc_slug){
        $projet_choisi= ProjectController::check_projet_access();
        $bc= DB::table('boncommande')
            ->join('fournisseur', 'boncommande.id_fournisseur', '=', 'fournisseur.id')
            ->join('services', 'services.id', '=', 'boncommande.service_demandeur')
            ->where('boncommande.id','=',$bc_slug)
            ->where('boncommande.id_projet','=',$projet_choisi->id)
            ->select('fournisseur.libelle','boncommande.id','numBonCommande','date','boncommande.created_at','libelle_service','contact')->get()->first();





        //$lignebesoins=Lignebesoin::where('id_bonCommande','=',$bc->id)->first();
        $lignebesoins=DB::table('lignebesoin')->where('lignebesoin.id_projet','=',$projet_choisi->id)->where('id_bonCommande','=',$bc_slug)->get();
        //  $email=$bc->email;

$corps= Array();

        $images= Array();
        $precisions= Array();
        $i=0;
        foreach($lignebesoins as $das):
            if(isset($das->id)){
                $materiel=DB::table('designation')
                    ->where('id', '=', $das->id_materiel)
                    ->select('libelle','image')->distinct()->get();


                if($materiel[0]->image!==""){
                    $images[$i]=$materiel[0]->image;
                }else{
                    $images[$i]="";
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

        $numBonCommande=$bc->numBonCommande;
        $tab=Array();
        foreach($lignebesoins as $lignebesoin){
            $tab[]=$lignebesoin->id_nature;
        }

        $view = view('mail.mail_bc',compact('tab','numBonCommande','corps','precisions','images'))->render();

return $view;
    }
    public function send_it_personnalisé(Request $request){
        $projet_choisi= ProjectController::check_projet_access();
        $parameters=$request->except(['_token']);
        $objet=$parameters['objet'];
        $msg_contenu=$parameters['compose-textarea'];
        $bc_slug=$parameters['bcc'];
        $contact=explode(',',$parameters['To']);
        if(isset($parameters['cc'])){
            $copi=explode(',',$parameters['cc']);
        }else{
            $copi= Array();
        }

        $bc= DB::table('boncommande')
            ->join('fournisseur', 'boncommande.id_fournisseur', '=', 'fournisseur.id')
            ->join('services', 'services.id', '=', 'boncommande.service_demandeur')
            ->where('boncommande.id_projet','=',$projet_choisi->id)
            ->where('boncommande.id','=',$bc_slug)
            ->select('fournisseur.libelle','boncommande.id','numBonCommande','date','boncommande.created_at','services.libelle as libelle_service','contact','commentaire_general','fournisseur.conditionPaiement','boncommande.id_fournisseur')->first();

        $devis=DB::table('devis')
            ->join('lignebesoin', 'devis.id_da', '=', 'lignebesoin.id')
            ->where('id_bc','=',$bc->id)
            ->where('lignebesoin.id_projet','=',$projet_choisi->id)
            ->select('titre_ext','devis.quantite','devis.unite','devis.prix_unitaire','devis.remise','devis.prix_tot','devis.codeRubrique','devis.devise','commentaire','hastva')->get();
        $taille=sizeof($devis);
        $tothtax = 0;
        if($bc->commentaire_general==''){
            $taille_minim=6;
            $taille_maxim=38;
        }else{
            $taille_minim=5;
            $taille_maxim=37;
        }
        $pj="";
        if($request->file('pj')){
            //dd($request->file('pj'));
            $pj=$request->file('pj')->getClientOriginalName();

            $path = Storage::putFileAs(
               'pj' , $request->file('pj'),$request->file('pj')->getClientOriginalName()
            );
        }
        // Send data to the view using loadView function of PDF facade
        $pdf = PDF::loadView('BC.bon-commande', compact('bc','devis','tothtax','taille','taille_minim','taille_maxim'));

        //$lignebesoins=Lignebesoin::where('id_bonCommande','=',$bc->id)->first();
        $lignebesoins=DB::table('lignebesoin')->where('id_bonCommande','=',$bc->id)->get();
        //  $email=$bc->email;

        /*
        $contact=\GuzzleHttp\json_decode($bc->contact);
        if(isset($contact[0])){
            $interlocuteur=$contact[0]->valeur_c;

        }
*/
        $numBonCommande=$bc->numBonCommande;
        $tab=Array();
        foreach($lignebesoins as $lignebesoin){
            $tab[]=$lignebesoin->id_nature;
        }

        //constituer le mail

        $corps= Array();

        $images= Array();
        $precisions= Array();
        $i=0;
        foreach($lignebesoins as $das):
            if(isset($das->id)){
                $materiel=DB::table('designation')
                    ->where('id', '=', $das->id_materiel)
                    ->select('libelle','image')->distinct()->get();


                if($materiel[0]->image!==""){
                    $images[$i]=$materiel[0]->image;
                }else{
                    $images[$i]="";
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

        $text="";
      //  $contact,$pdf,$bc,$images,$msg_contenu
        $pdf->save(storage_path('bon_commande').'\ '.__('neutrale.numero_bc_sans_abreviation').$bc->numBonCommande.'.pdf');
       // $pdf=$pdf->download('bon_de_commande_n°'.$bc->numBonCommande.'.pdf');
        $this->dispatch(new EnvoiBcFournisseurPersonnalise($contact,storage_path('bon_commande').'\ '.__('neutrale.numero_bc_sans_abreviation').$bc->numBonCommande.'.pdf',$bc,$images,$msg_contenu,$objet,$pj,$copi) );
        //  return redirect()->route('gestion_bc')->with('success', "Envoie d'email reussi");

        $boncom=Boncommande::where('id','=',$bc->id)->first();
        $boncom->etat=3;
        $boncom->save();
        $lignebesoin=Lignebesoin::where('lignebesoin.id_projet','=',$projet_choisi->id)->where('id_bonCommande','=',$bc->id)->first();
        $lignebesoin->etat=3;
        $lignebesoin->save();
        // Finally, you can download the file using download function
        //$pdf->download('bon_de_commande_n°'.$bc->numBonCommande.'.pdf');
        $tothtax = 0;
        return redirect()->route('gestion_bc')->with('success', "success");

    }
    public function send_it(Request $request){
        $projet_choisi= ProjectController::check_projet_access();
        $parameters=$request->except(['_token']);

        $bc_slug=$parameters['bc_slug'];
        $contact=explode(',',$parameters['contact']);

       // $les_id_devis=explode(',',$parameters['les_id_devis']);
       $bc=Boncommande::where('slug','=',$bc_slug)->first();

        $tothtax = 0;
        $taille=sizeof($bc->ligne_bcs()->get());
        if($bc->commentaire_general==''){
            $taille_minim=6;
            $taille_maxim=0;
        }else{
            $taille_minim=5;
            $taille_maxim=0;
        }
        // Send data to the view using loadView function of PDF facade
        $pdf = PDF::loadView('BC.bon-commande', compact('bc','tothtax','taille','taille_minim','taille_maxim'));

        //$lignebesoins=Lignebesoin::where('id_bonCommande','=',$bc->id)->first();
        $lignebesoins=DB::table('lignebesoin')
                ->join('users', 'lignebesoin.id_user', '=', 'users.id')
            ->where('id_bonCommande','=',$bc->id)->get();
      //  $email=$bc->email;

        /*
        $contact=\GuzzleHttp\json_decode($bc->contact);
        if(isset($contact[0])){
            $interlocuteur=$contact[0]->valeur_c;

        }
*/
        $numBonCommande=$bc->numBonCommande;
        $tab=Array();
        foreach($lignebesoins as $lignebesoin){
            $tab[]=$lignebesoin->id_nature;
        }

        //constituer le mail

        $corps= Array();
        $contactDemandeur= Array();

        $images= Array();
        $precisions= Array();
        $i=0;
        foreach($lignebesoins as $das):
            if(isset($das->id)){


                $contactDemandeur[]=$das->email;
                $materiel=DB::table('designation')
                    ->where('id', '=', $das->id_materiel)
                    ->select('libelle','image')->distinct()->get();


                if($materiel[0]->image!==""){
                    $images[$i]=$materiel[0]->image;
                }else{
                    $images[$i]="";
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
        $pdf->save(storage_path('bon_commande').'\ '.__('neutrale.numero_bc_sans_abreviation').$bc->numBonCommande.'.pdf');
        $this->dispatch(new EnvoiBcFournisseur($contact,storage_path('bon_commande').'\ '.__('neutrale.numero_bc_sans_abreviation').$bc->numBonCommande.'.pdf',$tab,$corps,$contactDemandeur,$bc,$precisions,$images) );
      //  return redirect()->route('gestion_bc')->with('success', "Envoie d'email reussi");

        $boncom=Boncommande::where('id','=',$bc->id)->first();
        $boncom->etat=3;
        $boncom->save();
        $lignebesoin=Lignebesoin::where('id_bonCommande','=',$bc->id)->first();
        $lignebesoin->etat=3;
        $lignebesoin->save();
        // Finally, you can download the file using download function
          $pdf->download('bon_de_commande_n°'.$bc->numBonCommande.'.pdf');


        return redirect()->route('gestion_bc')->with('success', "success");
    }
    public function bon_commande_file1($slug){
        // $bc=  Boncommande::where('slug','=',$slug)->first();
        $bc= DB::table('boncommande')
            ->join('fournisseur', 'boncommande.id_fournisseur', '=', 'fournisseur.id')
            ->where('boncommande.slug','=',$slug)
            ->select('fournisseur.libelle','boncommande.id','numBonCommande','date','remise_excep')->first();

        $ligne_bcs=DB::table('ligne_bc')
            ->join('reponse_fournisseur', 'reponse_fournisseur.id', '=', 'ligne_bc.id_reponse_fournisseur')
            ->join('analytique', 'analytique.id_analytique', '=', 'ligne_bc.codeRubrique')
            ->where('id_bonCommande','=',$bc->id)
            ->select('titre_ext','quantite_ligne_bc','unite_ligne_bc','prix_unitaire_ligne_bc','remise_ligne_bc','prix_tot','ligne_bc.slug','analytique.codeRubrique','referenceFournisseur')->get();
        $tothtax = 0;
        return view('BC.bon-commande',compact('bc','ligne_bcs','tothtax'));
    }

    public function gestion_bc()
    {
        $projet_choisi= ProjectController::check_projet_access();
        $bcs=  Boncommande::where('etat','!=',1)->where('id_projet','=',$projet_choisi->id)->orderBy('created_at', 'DESC')->paginate(100);
        $bcs_en_attentes=  Boncommande::where('etat','=',1)->where('id_projet','=',$projet_choisi->id)->orderBy('created_at', 'DESC')->get();
        $utilisateurs=  User::all();

        $fournisseurs= DB::table('fournisseur')
            ->join('devis', 'fournisseur.id', '=', 'devis.id_fournisseur')
            ->where('devis.etat', '=', 1)
            ->where('devis.id_projet','=',$projet_choisi->id)
            ->select('fournisseur.libelle','fournisseur.id','devise')
            ->groupBy('devis.devise','fournisseur.id')
            ->get();
        $fournisseurss= DB::table('fournisseur')
             ->where('fournisseur.id_projet','=',$projet_choisi->id)
            ->select('fournisseur.libelle','fournisseur.id')->distinct()->get();
        $users= User::all();

        $analytiques= Analytique::all();
        $projets= Projet::all();
        $expediteurs= array();
        foreach($users as $user):
            if($user->hasRole('Gestionnaire_Pro_Forma')){
                $expediteurs[]=$user;
            }
            endforeach;
        return view('BC/gestion_bc',compact('bcs','bcs_en_attentes','fournisseurs','utilisateurs','analytiques','fournisseurss','users','projets','expediteurs'));
    }
    public function regularisation(){
        $projet_choisi= ProjectController::check_projet_access();
        $receptions = DB::table('ligne_bonlivraison')
            ->join('fournisseur', 'fournisseur.id', '=', 'ligne_bonlivraison.id_fournisseur')
            ->where('ligne_bonlivraison.etat', '=', 0)
            ->where('ligne_bonlivraison.id_projet','=',$projet_choisi->id)
            ->select('fournisseur.libelle','fournisseur.id','devise')->distinct()->get();

        return view('BC/regularisation',compact('receptions'));
    }

    public function detail_regularisation($locale,$id_fournisseur,$devise){
        $projet_choisi= ProjectController::check_projet_access();
        $fournisseur =Fournisseur::find($id_fournisseur);
        $ligne_bonlivraisons = Ligne_bonlivraison::where('ligne_bonlivraison.id_projet','=',$projet_choisi->id)->where('ligne_bonlivraison.devise','=',$devise)->where('id_fournisseur','=',$id_fournisseur)->where('etat','=',0)->get();
        $future_devis="";
        $numero_bc=$this->generer_numero_bc();
        $date_propose= Array();
        foreach($ligne_bonlivraisons as $devi):
            $future_devis=$future_devis.$devi->id.",";
            if(!in_array($devi->date_reception, $date_propose)){
                $date_propose[]=$devi->date_reception;
            }
            endforeach;
            $date_propose= Array();
            $service_id= Array();
            $service_libelle= Array();
        $gestions =Gestion::all();
        return view('BC/bc_regularisation',compact('ligne_bonlivraisons','fournisseur','gestions','devise','projet_choisi','future_devis','numero_bc','date_propose'));
    }
    public function generer_numero_bc(){
        $projet_choisi= ProjectController::check_projet_access();
        $bcs =Boncommande::where('id_projet','=',$projet_choisi->id)->get();
        $project = $projet_choisi;
        $tableau_numb= array();

        foreach($bcs as $bc):
            $tableau_numb[]= str_replace($project->libelle.'-',"",$bc->numBonCommande);

            rsort($tableau_numb);
            endforeach;
        $val=0;
        if(isset($tableau_numb[0])){
            $val =intval($tableau_numb[0])+1;
        }else{
            $val=1;
        }

        return $val;

    }
    public function regulariser($id_fournisseur){


    }
    public function action_regularisation(){

        $date= new \DateTime(null);

        $bc=  new Boncommande();

        $bc->numBonCommande=$this->generer_numero_bc();
        $bc->id_fournisseur=$id_fournisseur;
        $bc->id_user=Auth::user()->id;
        $bc->id_projet=1;
        $bc->id_expediteur=Auth::user()->id;

        $bc->slug=Str::slug($bc->numBonCommande.$date->format('dmYhis'));

        $users= User::all();

        $analytiques= Analytique::all();
        $projets= Projet::all();
        $expediteurs= array();
        foreach($users as $user):
            if($user->hasRole('Gestionnaire_Pro_Forma')){
                $expediteurs[]=$user;
            }
        endforeach;
    }
    public function validation_bc()
    {

        $projet_choisi= ProjectController::check_projet_access();
        $bcs=  Boncommande::where('id_projet','=',$projet_choisi->id)->where('etat','!=',1)->orderBy('created_at', 'DESC')->get();
        //je vérifie si on valide selon le paramettre valideur different

        $bcs_en_attentes = BCController::liste_bc_en_attente_fonction_mode_validation($projet_choisi);
         $utilisateurs=  User::where('id_projet','=',$projet_choisi->id)->get();

        $fournisseurs= DB::table('fournisseur')
            ->join('devis', 'fournisseur.id', '=', 'devis.id_fournisseur')
            ->where('devis.etat', '=', 1)
            ->where('devis.id_projet','=',$projet_choisi->id)
            ->select('fournisseur.libelle','fournisseur.id')->distinct()->get();
        $fournisseurss= DB::table('fournisseur')
            ->where('id_projet','=',$projet_choisi->id)
            ->select('fournisseur.libelle','fournisseur.id')->distinct()->get();

        $analytiques= Analytique::where('id_projet','=',$projet_choisi->id)->get();
        return view('BC/validation_bc',compact('bcs','bcs_en_attentes','fournisseurs','utilisateurs','analytiques','fournisseurss'));
    }
    public function validation_bc_collective($locale,$id)
    {
        // dd($listeDA);
        $tab_bc = explode(",", $id);

     //   $ligne_besoin= Lignebesoin::where('id_bonCommande', '=', $Boncommande->id)->first();

    foreach($tab_bc as $bc):
        if($bc!=''){
            $Boncommande= Boncommande::find($bc);

//dd($Boncommande);

            //utilisation de la fonction send_it

           // $parameters=$request->except(['_token']);

            $fournisseur = Fournisseur::find($Boncommande->id_fournisseur);
            $contacts= json_decode($fournisseur->contact);
            $contact = Array();
            foreach ($contacts as $cont):

                if($cont->type_c=="EMABC" || $cont->type_c=="EMA"){
                    $contact[]=$cont->valeur_c;
                }
                endforeach;

            // $les_id_devis=explode(',',$parameters['les_id_devis']);
            $tothtax = 0;
            $taille=sizeof($Boncommande->ligne_bcs()->get());
            if($Boncommande->commentaire_general==''){
                $taille_minim=6;
                $taille_maxim=0;
            }else{
                $taille_minim=5;
                $taille_maxim=0;
            }
            // Send data to the view using loadView function of PDF facade
          //  $bc=$Boncommande;
            $bc=$Boncommande;
             $pdf = PDF::loadView('BC.bon-commande', compact('bc','tothtax','taille','taille_minim','taille_maxim'));

            //$lignebesoins=Lignebesoin::where('id_bonCommande','=',$bc->id)->first();
            $lignebesoins=DB::table('lignebesoin')
                ->join('users', 'lignebesoin.id_user', '=', 'users.id')
                ->where('id_bonCommande','=',$Boncommande->id)->get();
            //  $email=$bc->email;

            /*
            $contact=\GuzzleHttp\json_decode($bc->contact);
            if(isset($contact[0])){
                $interlocuteur=$contact[0]->valeur_c;

            }
    */
            $numBonCommande=$Boncommande->numBonCommande;
            $tab=Array();
            foreach($lignebesoins as $lignebesoin){
                $tab[]=$lignebesoin->id_nature;
            }

            //constituer le mail

            $corps= Array();
            $contactDemandeur= Array();

            $images= Array();
            $precisions= Array();
            $i=0;
            foreach($lignebesoins as $das):
                if(isset($das->id)){
                    $contactDemandeur[]=$das->email;
                    $materiel=DB::table('designation')
                        ->where('id', '=', $das->id_materiel)
                        ->select('libelle','image')->distinct()->get();


                    if($materiel[0]->image!==""){
                        $images[$i]=$materiel[0]->image;
                    }else{
                        $images[$i]="";
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
            $pdf->save(storage_path('bon_commande').'\ '.__('neutrale.numero_bc_sans_abreviation').$Boncommande->numBonCommande.'.pdf');
            $this->dispatch(new EnvoiBcFournisseur($contact,storage_path('bon_commande').'\ '.__('neutrale.numero_bc_sans_abreviation').$Boncommande->numBonCommande.'.pdf',$tab,$corps,$contactDemandeur,$Boncommande,$precisions,$images) );
            //  return redirect()->route('gestion_bc')->with('success', "Envoie d'email reussi");

            $Boncommande->etat=3;
            $Boncommande->date_validation=date("Y-m-d H:i:s");
            $Boncommande->save();
            $lignebesoin=Lignebesoin::where('id_bonCommande','=',$Boncommande->id)->first();
            if(isset($lignebesoin)){
                $lignebesoin->etat=3;
                $lignebesoin->save();
            }
            // Finally, you can download the file using download function
            $pdf->download('bon_de_commande_n°'.$bc->numBonCommande.'.pdf');


            //fin de l'utilisation de la fonction send_it

        }

    endforeach;


        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.'; Validation et transmission collective des  B.Cs '.$id, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);

        // return redirect()->route('gestion_bc')->with('success', "Bon(s) de commande(s) validé(s) & Transmission aux fournisseurs");
    return 'success';
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
            ->join('designation', 'designation.id', '=', 'lignebesoin.id_materiel')
            ->where('lignebesoin.etat', '=', 2)
            ->select('designation.libelle','titre_ext','reponse_fournisseur.id')->distinct()->get();
        $modifierlignebc='';
        $analytiques= Analytique::all();
        $ligne_bc=Ligne_bc::where('slug','=',$slug)->first();
        return view('BC/gestion_bc',compact('bcs','fournisseurs','utilisateurs','modifierlignebc','reponse_fournisseurs','$slug','analytiques','ligne_bc'));
    }
    public function save_ligne_bc(Request $request){
        $parameters=$request->except(['_token']);
        $les_id_devis=explode(',',$parameters['les_id_devis']);
        $commentaire=$parameters['commentaire'];

        $date= new \DateTime(null);
        $boncommande= Boncommande::find($parameters['id_bc']);

        $boncommande->date=$parameters['date_livraison'];
        $boncommande->service_demandeur=$parameters['id_service'];
        $boncommande->remise_excep=$parameters['remise_exc'];
        $boncommande->commentaire_general=$commentaire;

      //  $sumligne=ligne_bc::where('id_bonCommande','=',$boncommande->id)->sum('prix_tot');

        $tot_ttc=$parameters['ttc_serv'];

        if($boncommande->devise_bc=="XOF"){
            $boncommande->total_ttc=$tot_ttc;
            $boncommande->total_ttc_euro=RapportController::convertir_dans_une_devise($tot_ttc,date("Y-m-d"),$boncommande->devise_bc.'_EUR');
            $boncommande->total_ttc_usd=RapportController::convertir_dans_une_devise($tot_ttc,date("Y-m-d"),$boncommande->devise_bc.'_USD');
        }elseif($boncommande->devise=="USD"){
            $boncommande->total_ttc_usd=$tot_ttc;
            $boncommande->total_ttc_euro=RapportController::convertir_dans_une_devise($tot_ttc,date("Y-m-d"),$boncommande->devise_bc.'_EUR');
            $boncommande->total_ttc=RapportController::convertir_dans_une_devise($tot_ttc,date("Y-m-d"),$boncommande->devise_bc.'_XOF');
        }else{

            $boncommande->total_ttc_euro=$tot_ttc;
            $boncommande->total_ttc_usd=RapportController::convertir_dans_une_devise($tot_ttc,date("Y-m-d"),$boncommande->devise_bc.'_USD');
            $boncommande->total_ttc=RapportController::convertir_dans_une_devise($tot_ttc,date("Y-m-d"),$boncommande->devise_bc.'_XOF');
        }



        $boncommande->save();
        foreach ($les_id_devis as $id):
            if($id!=""){


                $Devis= Devis::find($id);


                $Devis->id_bc=$parameters['id_bc'];
                $Devis->codeGestion=$parameters['row_n_'.$id.'_codeGestion'];
                $gestion =Gestion::where('codeGestion','=', $Devis->codeGestion)->first();

                if(isset($parameters['row_n_'.$id.'_tva']) && $parameters['row_n_'.$id.'_tva']=='on' ){
                    $Devis->hastva=1;
                }else{
                    $Devis->hastva=0;

                }

                if($Devis->devise=="XOF"){
                    $Devis->prix_tot=$Devis->prix_unitaire*$Devis->quantite-($Devis->remise*($Devis->prix_unitaire*$Devis->quantite))/100;
                    $Devis->prix_tot_euro=RapportController::convertir_dans_une_devise($Devis->prix_tot,date("Y-m-d"),$Devis->devise.'_EUR');
                    $Devis->prix_tot_usd=RapportController::convertir_dans_une_devise($Devis->prix_tot,date("Y-m-d"),$Devis->devise.'_USD');
                }elseif($Devis->devise=="USD"){
                    $Devis->prix_tot_usd=$Devis->prix_unitaire_usd*$Devis->quantite-($Devis->remise*($Devis->prix_unitaire_usd*$Devis->quantite))/100;
                    $Devis->prix_tot_euro=RapportController::convertir_dans_une_devise($Devis->prix_tot_usd,date("Y-m-d"),$Devis->devise.'_EUR');
                    $Devis->prix_tot=RapportController::convertir_dans_une_devise($Devis->prix_tot_usd,date("Y-m-d"),$Devis->devise.'_XOF');
                }else{
                    $Devis->prix_tot_euro=$Devis->prix_unitaire_euro*$Devis->quantite-($Devis->remise*($Devis->prix_unitaire_euro*$Devis->quantite))/100;
                    $Devis->prix_tot_usd=RapportController::convertir_dans_une_devise($Devis->prix_tot_euro,date("Y-m-d"),$Devis->devise.'_USD');
                    $Devis->prix_tot=RapportController::convertir_dans_une_devise($Devis->prix_tot_euro,date("Y-m-d"),$Devis->devise.'_XOF');
                }



                if($Devis->devise=="XOF"){

                    if(1==$Devis->hastva && $boncommande->projet->use_tva!="" or $boncommande->projet->use_tva!=0 ){
                        $Devis->valeur_tva=($Devis->prix_tot*$boncommande->projet->use_tva)/100;
                    }else{
                        $Devis->valeur_tva=0;
                    }
                    $Devis->valeur_tva_euro=RapportController::convertir_dans_une_devise($Devis->valeur_tva,date("Y-m-d"),$Devis->devise.'_EUR');
                    $Devis->valeur_tva_usd=RapportController::convertir_dans_une_devise($Devis->valeur_tva,date("Y-m-d"),$Devis->devise.'_USD');
                }elseif($Devis->devise=="USD"){
                    if(1==$Devis->hastva && $boncommande->projet->use_tva!="" or $boncommande->projet->use_tva!=0 ){
                        $Devis->valeur_tva_usd=($Devis->prix_tot_usd*$boncommande->projet->use_tva)/100;
                    }else{
                        $Devis->valeur_tva_usd=0;
                    }
                    $Devis->valeur_tva_euro=RapportController::convertir_dans_une_devise($Devis->valeur_tva_usd,date("Y-m-d"),$Devis->devise.'_EUR');
                    $Devis->valeur_tva=RapportController::convertir_dans_une_devise($Devis->valeur_tva_usd,date("Y-m-d"),$Devis->devise.'_XOF');
                }else{
                    if(1==$Devis->hastva && $boncommande->projet->use_tva!="" or $boncommande->projet->use_tva!=0 ){
                        $Devis->valeur_tva_euro=($Devis->prix_tot_euro*$boncommande->projet->use_tva)/100;
                    }else{
                        $Devis->valeur_tva_euro=0;
                    }
                    $Devis->valeur_tva_usd=RapportController::convertir_dans_une_devise($Devis->valeur_tva_euro,date("Y-m-d"),$Devis->devise.'_USD');
                    $Devis->valeur_tva=RapportController::convertir_dans_une_devise($Devis->valeur_tva_euro,date("Y-m-d"),$Devis->devise.'_XOF');
                }

                $Devis->save();
                $lignebesoin=Lignebesoin::find($Devis->id_da);
                $lignebesoin->id_bonCommande=$parameters['id_bc'];
                $lignebesoin->id_codeGestion=$gestion->id;

                $lignebesoin->save();
            }

            endforeach;





        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.'; Création du bon de commande Numero '.$boncommande->numBonCommande, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);

        //dd(App()->getLocale());
        return redirect()->route('gestion_bc',$parameters['locale'])->with('success',"success");
    }
    public function save_ligne_bc_regularisation(Request $request){

        $parameters=$request->except(['_token']);
        $les_id_futur_devis=explode(',',$parameters['les_id_futur_devis']);
        $commentaire=$parameters['commentaire'];
        $projet_choisi= ProjectController::check_projet_access();
        //je crée le bons de commandes
        $date= new \DateTime(null);
        $boncommande= new Boncommande();

        $boncommande->date=$parameters['date_livraison'];
        $boncommande->service_demandeur=$parameters['id_service'];
        $boncommande->remise_excep=$parameters['remise_exc'];
        $boncommande->commentaire_general=$commentaire;
        $boncommande->devise_bc=$parameters['devise'];
        $boncommande->numBonCommande=$projet_choisi->libelle.'-'.$parameters['numero_bc'];
        $boncommande->id_fournisseur= $parameters['id_fournisseur'];
        $boncommande->id_user= Auth()->user()->id;
        $boncommande->slug=Str::slug($parameters['numero_bc'].$date->format('dmYhis'));
      //  $sumligne=ligne_bc::where('id_bonCommande','=',$boncommande->id)->sum('prix_tot');

        $tot_ttc=$parameters['ttc_serv'];
        //dd($tot_ttc);
        if($boncommande->devise_bc=="XOF"){
            $boncommande->total_ttc=$tot_ttc;
            $boncommande->total_ttc_euro=RapportController::convertir_dans_une_devise($tot_ttc,date("Y-m-d"),$boncommande->devise_bc.'_EUR');
            $boncommande->total_ttc_usd=RapportController::convertir_dans_une_devise($tot_ttc,date("Y-m-d"),$boncommande->devise_bc.'_USD');
        }elseif($boncommande->devise=="USD"){
            $boncommande->total_ttc_usd=$tot_ttc;
            $boncommande->total_ttc_euro=RapportController::convertir_dans_une_devise($tot_ttc,date("Y-m-d"),$boncommande->devise_bc.'_EUR');
            $boncommande->total_ttc=RapportController::convertir_dans_une_devise($tot_ttc,date("Y-m-d"),$boncommande->devise_bc.'_XOF');
        }else{

            $boncommande->total_ttc_euro=$tot_ttc;
            $boncommande->total_ttc_usd=RapportController::convertir_dans_une_devise($tot_ttc,date("Y-m-d"),$boncommande->devise_bc.'_USD');
            $boncommande->total_ttc=RapportController::convertir_dans_une_devise($tot_ttc,date("Y-m-d"),$boncommande->devise_bc.'_XOF');
        }



        $boncommande->save();
$boncommande=Boncommande::find($boncommande->id);
        foreach ($les_id_futur_devis as $id):
            if($id!=""){

                $ligne_bonlivraison = Ligne_bonlivraison::find($id);
                //je crée un devis pour chaque ligne
                $Devis= new Devis();
                $Devis->id_bc=$boncommande->id;
                $Devis->codeGestion=$parameters['row_n_'.$id.'_codeGestion'];
                $gestion =Gestion::where('codeGestion','=', $Devis->codeGestion)->first();

                //je complête les informations du devis

                $Devis->titre_ext= $ligne_bonlivraison->reference;
                $designation = Designation::where('libelle','=',$ligne_bonlivraison->reference)->first();
                $Devis->id_materiel= $designation->id;
                $Devis->quantite= $ligne_bonlivraison->quantite;
                $Devis->unite= $ligne_bonlivraison->unite;
                $Devis->remise= $ligne_bonlivraison->remise;
                $Devis->codeRubrique= $designation->code_analytique;
                $Devis->devise= $ligne_bonlivraison->devise;
                $Devis->id_fournisseur= $ligne_bonlivraison->id_fournisseur;
                $Devis->id_projet= $ligne_bonlivraison->id_projet;
                $Devis->prix_unitaire=$ligne_bonlivraison->prix_unitaire;
                $Devis->prix_unitaire_euro=$ligne_bonlivraison->prix_unitaire_euro;
                $Devis->prix_unitaire_usd=$ligne_bonlivraison->prix_unitaire_usd;
                $Devis->etat=1;

               $ligne_bonlivraison->id_devis=$Devis->id;
               $ligne_bonlivraison->etat=1;
               $ligne_bonlivraison->save();
                if(isset($parameters['row_n_'.$id.'_tva']) && $parameters['row_n_'.$id.'_tva']=='on' ){
                    $Devis->hastva=1;
                }else{
                    $Devis->hastva=0;

                }
                if($Devis->devise=="XOF"){
                    $Devis->prix_tot=$Devis->prix_unitaire*$Devis->quantite-($Devis->remise*($Devis->prix_unitaire*$Devis->quantite))/100;
                    $Devis->prix_tot_euro=RapportController::convertir_dans_une_devise($Devis->prix_tot,date("Y-m-d"),$Devis->devise.'_EUR');
                    $Devis->prix_tot_usd=RapportController::convertir_dans_une_devise($Devis->prix_tot,date("Y-m-d"),$Devis->devise.'_USD');
                    if(1==$Devis->hastva && $boncommande->projet->use_tva!="" or $boncommande->projet->use_tva!=0 ){
                        $Devis->valeur_tva=($Devis->prix_tot*$boncommande->projet->use_tva)/100;
                    }else{
                        $Devis->valeur_tva=0;
                    }
                    $Devis->valeur_tva_euro=RapportController::convertir_dans_une_devise($Devis->valeur_tva,date("Y-m-d"),$Devis->devise.'_EUR');
                    $Devis->valeur_tva_usd=RapportController::convertir_dans_une_devise($Devis->valeur_tva,date("Y-m-d"),$Devis->devise.'_USD');

                }elseif($Devis->devise=="USD"){
                    $Devis->prix_tot_usd=$Devis->prix_unitaire_usd*$Devis->quantite-($Devis->remise*($Devis->prix_unitaire_usd*$Devis->quantite))/100;
                    $Devis->prix_tot_euro=RapportController::convertir_dans_une_devise($Devis->prix_tot_usd,date("Y-m-d"),$Devis->devise.'_EUR');
                    $Devis->prix_tot=RapportController::convertir_dans_une_devise($Devis->prix_tot_usd,date("Y-m-d"),$Devis->devise.'_XOF');
                    if(1==$Devis->hastva && $boncommande->projet->use_tva!="" or $boncommande->projet->use_tva!=0 ){
                        $Devis->valeur_tva_usd=($Devis->prix_tot_usd*$boncommande->projet->use_tva)/100;
                    }else{
                        $Devis->valeur_tva_usd=0;
                    }
                    $Devis->valeur_tva_euro=RapportController::convertir_dans_une_devise($Devis->valeur_tva_usd,date("Y-m-d"),$Devis->devise.'_EUR');
                    $Devis->valeur_tva=RapportController::convertir_dans_une_devise($Devis->valeur_tva_usd,date("Y-m-d"),$Devis->devise.'_XOF');
                }else{
                    $Devis->prix_tot_euro=$Devis->prix_unitaire_euro*$Devis->quantite-($Devis->remise*($Devis->prix_unitaire_euro*$Devis->quantite))/100;
                    $Devis->prix_tot_usd=RapportController::convertir_dans_une_devise($Devis->prix_tot_euro,date("Y-m-d"),$Devis->devise.'_USD');
                    $Devis->prix_tot=RapportController::convertir_dans_une_devise($Devis->prix_tot_euro,date("Y-m-d"),$Devis->devise.'_XOF');
                    if(1==$Devis->hastva && $boncommande->projet->use_tva!="" or $boncommande->projet->use_tva!=0 ){
                        $Devis->valeur_tva_euro=($Devis->prix_tot_euro*$boncommande->projet->use_tva)/100;
                    }else{
                        $Devis->valeur_tva_euro=0;
                    }
                    $Devis->valeur_tva_usd=RapportController::convertir_dans_une_devise($Devis->valeur_tva_euro,date("Y-m-d"),$Devis->devise.'_USD');
                    $Devis->valeur_tva=RapportController::convertir_dans_une_devise($Devis->valeur_tva_euro,date("Y-m-d"),$Devis->devise.'_XOF');
                }


            }

            //régularisation de la demande d'achat
             // Fournisseur::create($parameters);
        $date = new \DateTime(null);
        $da = new DA();
        $da->unite = $Devis->unite;
        $da->quantite = $Devis->quantite;
        $da->DateBesoin = $ligne_bonlivraison->date_reception;
        $da->id_user = Auth()->user()->id;
        $da->id_codeGestion = $gestion->id;
        $da->id_nature = 1;
        $da->id_materiel = $Devis->id_materiel;
        $da->etat=2;
        $da->usage = $boncommande->commentaire_general;
        $da->demandeur = Auth()->user()->nom;
        $da->slug = Str::slug($da->id_materiel. $date->format('dmYhis'));
        $da->id_projet=session('id_projet');
        $da->save();
        $Devis->id_da=$da->id;
       // dd($Devis);
        $Devis->save();
            //régularisation

            endforeach;





        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.'; Régularisation de bon de commande Numero '.$boncommande->numBonCommande, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);

        //dd(App()->getLocale());
        return redirect()->route('regularisation',$parameters['locale'])->with('success',"success");
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
        $ligne_bc->prix_tot=str_replace(" ","",$parameters['Prix']);
        $ligne_bc->id_reponse_fournisseur=$parameters['id_reponse_fournisseur'];


        $ligne_bc->slug=Str::slug($ligne_bc->id_bonCommand.$ligne_bc->codeRubrique.$ligne_bc->quantite_ligne_b.$ligne_bc->prix_unitaire_ligne_bc.$date->format('dmYhis'));
        $ligne_bc->save();

        $boncommande= Boncommande::where('id','=',$ligne_bc->id_bonCommande)->first();
        $sumligne=ligne_bc::where('id_bonCommande','=',$boncommande->id)->sum('prix_tot');
        $tot_ttc=$parameters['tot_serv'];
        $boncommande->total_ttc=$tot_ttc;
        $boncommande->save();

        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.'; Modification du bon de commande Numero '.$boncommande->numBonCommande, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);

        return redirect()->route('gestion_bc')->with('success',"success");
    }
    public function valider_commande($locale,$slug)
    {
        $date= new \DateTime(null);
        $bc= Boncommande::where('slug', '=', $slug)->first();
        $ligne_besoin= Lignebesoin::where('id_bonCommande', '=', $bc->id)->first();
        if($bc->date==null && $ligne_besoin==null){
            return redirect()->route('gestion_bc')->with('error',"Le bon de commande n'est pas rempli donc ne peut être validé");

        }else{
                //utilisation de la fonction send_it

                // $parameters=$request->except(['_token']);

                $fournisseur = Fournisseur::find($bc->id_fournisseur);
                $contacts= json_decode($fournisseur->contact);
                $contact = Array();
                foreach ($contacts as $cont):

                    if($cont->type_c=="EMABC" || $cont->type_c=="EMA"){
                        $contact[]=$cont->valeur_c;
                    }
                endforeach;

  // $les_id_devis=explode(',',$parameters['les_id_devis']);
 /* $devis=DB::table('devis')
  ->leftjoin('lignebesoin', 'devis.id_da', '=', 'lignebesoin.id')
  ->where('id_bc','=',$bc->id)
  ->select('titre_ext','devis.quantite','devis.unite','devis.prix_unitaire','devis.remise','devis.prix_tot','devis.codeRubrique','devis.codeGestion','devis.devise','commentaire','hastva','referenceFournisseur')->get();
*/
                $tothtax = 0;
                $taille=sizeof($bc->ligne_bcs()->get());
                if($bc->commentaire_general==''){
                    $taille_minim=6;
                    $taille_maxim=0;
                }else{
                    $taille_minim=5;
                    $taille_maxim=0;
                }
                // Send data to the view using loadView function of PDF facade
             //   $bc=$Boncommande;
            $pdf = PDF::loadView('BC.bon-commande', compact('bc','tothtax','taille','taille_minim','taille_maxim'));


                //$lignebesoins=Lignebesoin::where('id_bonCommande','=',$bc->id)->first();
                $lignebesoins=DB::table('lignebesoin')
                                  ->join('users', 'lignebesoin.id_user', '=', 'users.id')->where('id_bonCommande','=',$bc->id)->get();
                //  $email=$bc->email;

                /*
                $contact=\GuzzleHttp\json_decode($bc->contact);
                if(isset($contact[0])){
                    $interlocuteur=$contact[0]->valeur_c;

                }
        */
                $numBonCommande=$bc->numBonCommande;
                $tab=Array();
                foreach($lignebesoins as $lignebesoin){
                    $tab[]=$lignebesoin->id_nature;
                }

                //constituer le mail

                $corps= Array();
            $contactDemandeur= Array();

                $images= Array();
                $precisions= Array();
                $i=0;
                foreach($lignebesoins as $das):
                    if(isset($das->id)){
                        $contactDemandeur[]=$das->email;
                        $materiel=DB::table('designation')
                            ->where('id', '=', $das->id_materiel)
                            ->select('libelle','image')->distinct()->get();


                        if($materiel[0]->image!==""){
                            $images[$i]=$materiel[0]->image;
                        }else{
                            $images[$i]="";
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
                $pdf->save(storage_path('bon_commande').'\ '.__('neutrale.numero_bc_sans_abreviation').$bc->numBonCommande.'.pdf');
          //  dd($contactDemandeur);
                $this->dispatch(new EnvoiBcFournisseur($contact,storage_path('bon_commande').'\ '.__('neutrale.numero_bc_sans_abreviation').$bc->numBonCommande.'.pdf',$tab,$corps,$contactDemandeur,$bc,$precisions,$images) );
                //  return redirect()->route('gestion_bc')->with('success', "Envoie d'email reussi");

                $bc->etat=3;
                 $bc->date_validation=date("Y-m-d H:i:s");
                $bc->save();
                $lignebesoin=Lignebesoin::where('id_bonCommande','=',$bc->id)->first();
            if(isset($lignebesoin)){
                $lignebesoin->etat=3;
                $lignebesoin->save();
            }

                // Finally, you can download the file using download function
                $pdf->download('bon_de_commande_n°'.$bc->numBonCommande.'.pdf');


            /*debut du traçages*/
            $ip			= $_SERVER['REMOTE_ADDR'];
            if (isset($_SERVER['REMOTE_HOST'])){
                $nommachine = $_SERVER['REMOTE_HOST'];
            }else{
                $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
            }
            Log::info('ip :'.$ip.'; Machine: '.$nommachine.'; Bon de commande validé et transmit N° '.$bc->numBonCommande, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
                //fin de l'utilisation de la fonction send_it
        }
        return redirect()->back()->with('success',"success");
    }
    public function add_new_da_to_bc($locale,$id,$id_bc)
    {
        $devi= Devis::find($id);



            $devi->id_bc=$id_bc;
            //pour dire que ce la sont lie a un bon de commande
            $devi->etat=2;
            $devi->save();


        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.';Ajout du  Devis N° '.$devi->id.' du bon de commande id°'.$id_bc, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return "super";
    }
    public function detail_list_devis($id_bc)
    {
        $devis= DB::table('devis')
            ->leftjoin('lignebesoin', 'lignebesoin.id','=','devis.id_da')
            ->where('id_bc','=',$id_bc)
            ->select('devis.id','devis.quantite','devis.titre_ext','date_livraison_eff')->get();
        return \GuzzleHttp\json_encode($devis);
    }
    public function preciser_les_date_de_livraison(Request $request)
    {
        $parameters=$request->except(['_token']);

        $lesidd=explode(',',$parameters['lesidd']);
        $nb=0;
        $count=0;
        foreach($lesidd as $id):
        if ($id!=""){
            $devis= Devis::find($id);
            $lignebesoin = Lignebesoin::find($devis->id_da);

            if(isset($parameters[$id.'date_livr_def'])){
                if($parameters[$id.'date_livr_def']!=""){
                    $count++;
                    $lignebesoin->etat=4;
                }
                $dates[]=$parameters[$id.'date_livr_def'];
                $lignebesoin->date_livraison_eff=$parameters[$id.'date_livr_def'];

                $lignebesoin->save();
            }

            $nb++;
        }
            endforeach;
        $devis= Devis::find($lesidd[1]);
        $bondecommande= Boncommande::find($devis->id_bc);
        if($count==$nb){
            $mostRecent= 0;
            foreach($dates as $date){
                $curDate = strtotime($date);
                if ($curDate > $mostRecent) {
                    $mostRecent = date("Y-m-d",$curDate);
                }
            }

            $bondecommande->date_livraison=$mostRecent;
            $bondecommande->etat=4;
            $bondecommande->save();
        }else{
            if($bondecommande->etat==4){
                $bondecommande->etat=3;
                $bondecommande->save();
            }
        }
        return redirect()->route('gestion_bc')->with('success',"success");

    }

    public function chercher_codeRubrique($id)
    {
        $materiel= Materiel::find($id);
        return \GuzzleHttp\json_encode($materiel);
    }

    public function retirer_da_to_bc($locale,$id,$id_bc)
    {
        $devi= Devis::find($id);

       $bc= $devi->id_bc;
            $devi->id_bc=null;
            //pour dire que ce la sont lie a un bon de commande
            $devi->etat=1;
            $devi->save();


        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.';Rétirer le Devis N° '.$devi->id.' du bon de commande id°'.$bc, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);

        return \GuzzleHttp\json_encode($devi);
    }
    public function supprimer_def_da_to_bc($locale,$id,$id_bc)
    {
        $devi= Devis::find($id);
        $bc=$devi->id_bc;
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
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.';Suppression définitive de la D.A et du devis le Devis N° '.$devi->id.' du bon de commande id°'.$bc, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);


        return \GuzzleHttp\json_encode($devi);
    }

    public function traite_finalise($locale,$slug)
    {
        $date= new \DateTime(null);
        $today = $date->format("Y-m-d");
        $Boncommande= Boncommande::where('slug', '=', $slug)->first();
        $Boncommande->etat=4;
        $Boncommande->date_livraison=$today;
        $Boncommande->save();
        $lignebesoins=Lignebesoin::where('id_bonCommande','=',$Boncommande->id)->get();
        foreach( $lignebesoins as $lignebesoin):
            $lignebesoin->etat=4;
            $lignebesoin->date_livraison_eff=$today;
            $lignebesoin->save();
            endforeach;



        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.';Bon de commande traité et finalisé N° '.$Boncommande->numBonCommande, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return redirect()->route('gestion_bc')->with('success',"success");
    }
    public function traite_retourne($locale,$slug)
    {
        $date= new \DateTime(null);
        $Boncommande= Boncommande::where('slug', '=', $slug)->first();
        $Boncommande->etat=11;
        $Boncommande->save();

        $lignebesoins=Lignebesoin::where('id_bonCommande','=',$Boncommande->id)->get();
        foreach( $lignebesoins as $lignebesoin):
            $lignebesoin->etat=11;
            $lignebesoin->save();
        endforeach;
        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.';Bon de commande traité et retourné N° '.$Boncommande->numBonCommande, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return redirect()->route('gestion_bc')->with('success',"success");
    }
    public function refuser_commande($locale,$slug)
    {
        $date= new \DateTime(null);
        $Boncommande= Boncommande::where('slug', '=', $slug)->first();
        $Boncommande->etat=0;
        $Boncommande->save();
        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.';Bon de commande tréfusé N° '.$Boncommande->numBonCommande, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return redirect(url()->previous())->with('success',"success");
    }

    public function annuler_commande($locale,$slug)
    {
        $date= new \DateTime(null);
        $Boncommande= Boncommande::where('slug', '=', $slug)->first();
        $Boncommande->etat=1;
        $Boncommande->save();

        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.';Annulation du Bon de commande N° '.$Boncommande->numBonCommande, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return redirect(url()->previous())->with('success',"success");
    }
    public function lister_commande($locale,$id){
        $bc=  Boncommande::find($id);
        $utilisateurs=  User::all();
        $fournisseur= Fournisseur::find($bc->id_fournisseur);



        $services=Services::all();
        $projet_choisi= ProjectController::check_projet_access();
        $new_devis=DB::table('devis')
            ->leftJoin('lignebesoin', 'lignebesoin.id', '=', 'devis.id_da')
            ->leftJoin('users', 'lignebesoin.id_user', '=', 'users.id')
            ->where('devis.etat', '=', 1)
            ->where('devis.id_bc', '=', null)
            ->where('devis.devise', '=', $bc->ligne_bcs()->first()->devise)
            ->where('devis.id_fournisseur', '=', $bc->id_fournisseur)
            ->where('devis.id_projet','=',$projet_choisi->id)
            ->select('devis.id','devis.titre_ext','id_bc','devis.codeRubrique','devis.quantite','devis.unite','devis.prix_unitaire','devis.prix_unitaire_usd','devis.prix_unitaire_euro','devis.remise','devis.devise','devis.hastva','DateBesoin','users.service','lignebesoin.commentaire','referenceFournisseur')->distinct()->get();

        $date_propose= Array();
        $service_id= Array();
        $service_libelle= Array();

        foreach($bc->ligne_bcs()->get() as $dev){

            if(!in_array($dev->DateBesoin, $date_propose)){
                $date_propose[]=$dev->ligne_besoin->DateBesoin;
            }

            if(!in_array($dev->ligne_besoin->user->service,$service_id)){


                $service_unique= Services::find($dev->ligne_besoin->user->service);
                if(isset($service_unique)){
                    $service_id[]=$service_unique->id;
                    $service_libelle[]=$service_unique->libelle;
                }

            }
        }

        $devise=$bc->devise_bc;


        $id_devi="";

        foreach($bc->ligne_bcs()->get() as $devi):
            $id_devi=$id_devi.$devi->id.",";
            endforeach;


        $listerbc='';
        $gestions= Gestion::all();
        return view('BC/list_ligne_bc',compact('bc','fournisseur','utilisateurs','listerbc','gestions','devise','id_devi','date_propose','service_id','service_libelle','new_devis','services'));
    }
    public function bc_express($locale,$nb){
        $analytiques =  Analytique::all();
        $materiels =  Materiel::all();
        $fournisseurs =  Fournisseur::all();
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
        return view('BC/bcexpress',compact('analytiques','materiels','fournisseurs','tab_unite','nb'));

    }
    public function gestion_bc_ajouter()
    {
        $projet_choisi= ProjectController::check_projet_access();
        $bcs=  Boncommande::where('boncommande.id_projet','=',$projet_choisi->id)->orderBy('created_at', 'DESC')->paginate(100);
        $bcs_en_attentes=  Boncommande::where('boncommande.id_projet','=',$projet_choisi->id)->where('etat','=',1)->orderBy('created_at', 'DESC')->get();
        $utilisateurs=  User::where('id_projet','=',$projet_choisi->id)->get();
        $fournisseurs= DB::table('fournisseur')
            ->join('devis', 'fournisseur.id', '=', 'devis.id_fournisseur')
            ->where('devis.etat', '=', 1)
            ->where('devis.id_projet','=',$projet_choisi->id)
            ->select('fournisseur.libelle','fournisseur.id','devise')
            ->groupBy('devis.devise','fournisseur.id')
            ->get();
        $fournisseurss= DB::table('fournisseur')
            ->where('id_projet','=',$projet_choisi->id)
            ->select('fournisseur.libelle','fournisseur.id')->distinct()->get();
        $ajouter='vrai';
        $analytiques= Analytique::where('id_projet','=',$projet_choisi->id)->get();
        $projets= Projet::where('id','=',$projet_choisi->id)->get();
        $expediteurs= array();
        $suggestion = $this->generer_numero_bc();
        foreach($utilisateurs as $user):
            if($user->hasRole('Gestionnaire_Pro_Forma')){
                $expediteurs[]=$user;
            }
        endforeach;
        return view('BC/gestion_bc',compact('bcs','bcs_en_attentes','fournisseurs','utilisateurs','ajouter','analytiques','fournisseurss','projets','expediteurs','suggestion'));
    }
    public function detail_rep_fournisseur($locale,$id){

        $reponse_fournisseur = Reponse_fournisseur::where('id','=',$id)->first();

        return response()->json($reponse_fournisseur);
    }
    public function save_bc( Request $request)
    {
        $projet_choisi= ProjectController::check_projet_access();
        $parameters=$request->except(['_token']);

        $date= new \DateTime(null);
        $projet= Projet::find($parameters['id_projet']);
        $Boncommande= new Boncommande();
        $Boncommande->numBonCommande=$projet->libelle."-".$parameters['numbc'];
       // $Boncommande->date=$parameters['date'];
       // dd($parameters['id_fournisseur']);
        $id_fournisseur = explode('-',$parameters['id_fournisseur'])[0];
        $devise = explode('-',$parameters['id_fournisseur'])[1];

        $Boncommande->id_fournisseur=$id_fournisseur;
        $Boncommande->id_user=Auth::user()->id;
        $Boncommande->id_projet=$projet->id;
        $Boncommande->devise_bc=$devise;
        $Boncommande->id_projet=session('id_projet');
        $Boncommande->id_expediteur=$parameters['id_expediteur'];

        $Boncommande->slug=Str::slug($parameters['numbc'].$date->format('dmYhis'));
       // $Boncommande->save();
        try{$Boncommande->save();
        }catch (\Illuminate\Database\QueryException $ex){


            return redirect()->back()->with('error',__('neutrale.numero_bc_utilise'));
        }
        $lesdevis= Devis::where('id_fournisseur','=',$Boncommande->id_fournisseur)
                        ->where('Devis.id_projet','=',$projet_choisi->id)
                        ->where('etat','=',1)->where('devise','=',$devise)->get();
                       // dd($lesdevis);

        foreach($lesdevis as $devi):
            $devi->id_bc=$Boncommande->id;
            //pour dire que ce la sont lie a un bon de commande
            $devi->etat=2;
            $devi->save();
        endforeach;

        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.';Création du Bon de commande N° '.$Boncommande->numBonCommande, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return redirect()->back()->with('success',"success");
    }
    public function modifier_bc( Request $request)
    {
        $parameters=$request->except(['_token']);
        $slug=$parameters['slug'];
        $date= new \DateTime(null);
        $Boncommande= Boncommande::where('slug', '=', $slug)->first();
        $Boncommande->id_user=\Illuminate\Support\Facades\Auth::user()->id;

        $Boncommande->save();

        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.';Modification du Bon de commande N° '.$Boncommande->numBonCommande, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return redirect()->route('gestion_bc')->with('success',"success");
    }

    public function supprimer_bc($locale,$slug)
    {
        $bon_de_commande = Boncommande::where('slug', '=', $slug)->first();

        $devis = Devis::where('id_bc','=',$bon_de_commande->id)->get();
       foreach ($devis as $devi):
        $devi->etat=1;
        $devi->id_bc=null;
        $devi->save();
        endforeach;

        $bon_de_commande->delete();

        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.';Suppression du Bon de commande N° '.$bon_de_commande->numBonCommande, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return redirect()->route('gestion_bc')->with('success', "Le Bon de commande a été supprimé   NB: la suppression d'un bon de commande, entraine la suppression en cascade des lignes de cet bon de commande ");
    }
    public function supprimer_ligne_bc($locale,$slug)
    {
        $ligne_bc = ligne_bc::where('slug', '=', $slug)->first();
       $id=$ligne_bc->id_bonCommande;
        $ligne_bc->delete();

        $sumligne=ligne_bc::where('id_bonCommande','=',$id)->sum('prix_tot');
        $tot_ttc=$sumligne*1.18;
        $boncommande=Boncommande::where('id','=',$id)->first();
        $boncommande->total_ttc=$tot_ttc;
        $boncommande->save();

        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.';Suppression de la ligne du bon de commande  du Bon de commande N° '.$boncommande->numBonCommande, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return redirect()->route('gestion_bc')->with('success', "success");
    }

    public function list_contact($locale,$id)
    {
$bc= Boncommande::find($id);
 $fournisseur=       Fournisseur::find($bc->id_fournisseur);


        return response()->json($fournisseur->contact);

    }
public function gestion_offre(){
    return view('BC/choix_offres');
}

    ////
    public function add_date_livraison(Request $request){
        $parameters=$request->except(['_token']);
        $id= $parameters['bc_slug'];
        $date_livraison= $parameters['date_livraison'];

        $boncommande=Boncommande::find($id);
        $boncommande->date_livraison=$date_livraison;
        $boncommande->save();

        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.';Date de livraison effective affecté sur le Bon de commande N° '.$boncommande->numBonCommande, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return redirect()->route('gestion_bc')->with('success', "success");

    }
    public function list_materiel_produit(){
        $codes= Analytique::all();
        $materiels = Designation::all();
$optcode="";$optmateriel="";$optunite="";
        foreach ($codes as $code):
$optcode.=" <option value='".$code->codeRubrique."' data-subtext='".$code->libelle."'>".$code->codeRubrique."</option>";
            endforeach;
        foreach ($materiels as $materiel):
            $optmateriel.="<option value='".$materiel->id."'>".$materiel->libelle."</option>";
        endforeach;

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
        foreach($tab_unite['nothing'] as $unite):
            $optunite.="<option value='".$unite."'>".$unite."</option>";
        endforeach;
        $optunite.="<optgroup label='La longeur'>";
        foreach($tab_unite['La longueur'] as $unite):
            $optunite.="<option value=".$unite.">".$unite."</option>";
        endforeach;
                   $optunite.="</optgroup>";

        $optunite.=" <optgroup label='La masse'>";
            foreach($tab_unite['La masse'] as $unite):
                $optunite.="<option value='".$unite."'>".$unite."</option>";
        endforeach;
        $optunite.="</optgroup>";



        $optunite.="<optgroup label='Le volume'>";
            foreach($tab_unite['Le volume'] as $unite):
                $optunite.="<option value=".$unite.">".$unite."</option>";
        endforeach;
        $optunite.="</optgroup>";

        $optunite.="<optgroup label='La surface'>";
            foreach($tab_unite['La surface'] as $unite):
                $optunite.="<option value=".$unite.">".$unite."</option>";
        endforeach;
        $optunite.="</optgroup>";

        $tab['optcode']=$optcode;
        $tab['optmateriel']=$optmateriel;
        $tab['optunite']=$optunite;

        return $tab;

    }




    public static function liste_bc_en_attente_fonction_mode_validation($projet_choisi){

        if( $projet_choisi->typeValidation==2){

            //si personne connecté egale à valideur
            if(Auth::user()->id==$projet_choisi->valideur1){
                    if($projet_choisi->defaultDevise=="XOF"){
                        $bcs_en_attentes=  Boncommande::where('id_projet','=',$projet_choisi->id)->where([['etat', '=', 1],['date', '<>', null],['service_demandeur', '<>', null],['total_ttc','<=',$projet_choisi->montant1]])->orderBy('created_at', 'DESC')->get();

                     }elseif($projet_choisi->defaultDevis=="USD"){
                        $bcs_en_attentes=  Boncommande::where('id_projet','=',$projet_choisi->id)->where([['etat', '=', 1],['date', '<>', null],['service_demandeur', '<>', null],['total_ttc_usd','<=',$projet_choisi->montant1]])->orderBy('created_at', 'DESC')->get();
                      }else{

                        $bcs_en_attentes=  Boncommande::where('id_projet','=',$projet_choisi->id)->where([['etat', '=', 1],['date', '<>', null],['service_demandeur', '<>', null],['total_ttc_euro','<=',$projet_choisi->montant1]])->orderBy('created_at', 'DESC')->get();
                    }


            }elseif(Auth::user()->id==$projet_choisi->valideur2){

            //si la personne connecté est le valideur 2

            //enfonction de la devise par defaut
                if($projet_choisi->defaultDevise=="XOF"){
                    $bcs_en_attentes=  Boncommande::where('id_projet','=',$projet_choisi->id)->where([['etat', '=', 1],['date', '<>', null],['service_demandeur', '<>', null],['total_ttc','>',$projet_choisi->montant2]])->orderBy('created_at', 'DESC')->get();

                 }elseif($projet_choisi->defaultDevis=="USD"){
                    $bcs_en_attentes=  Boncommande::where('id_projet','=',$projet_choisi->id)->where([['etat', '=', 1],['date', '<>', null],['service_demandeur', '<>', null],['total_ttc_usd','>',$projet_choisi->montant2]])->orderBy('created_at', 'DESC')->get();

                  }else{

                    $bcs_en_attentes=  Boncommande::where('id_projet','=',$projet_choisi->id)->where([['etat', '=', 1],['date', '<>', null],['service_demandeur', '<>', null],['total_ttc_euro','>',$projet_choisi->montant2]])->orderBy('created_at', 'DESC')->get();

                }
            }else{
                //dd("ici");
                if($projet_choisi->defaultDevise=="XOF"){
                    $bcs_en_attentes=  Boncommande::where('id_projet','=',$projet_choisi->id)->where([['etat', '=', 1],['date', '<>', null],['service_demandeur', '<>', null],['total_ttc','<=',$projet_choisi->montant1]])->orderBy('created_at', 'DESC')->get();

                 }elseif($projet_choisi->defaultDevis=="USD"){
                    $bcs_en_attentes=  Boncommande::where('id_projet','=',$projet_choisi->id)->where([['etat', '=', 1],['date', '<>', null],['service_demandeur', '<>', null],['total_ttc_usd','<=',$projet_choisi->montant1]])->orderBy('created_at', 'DESC')->get();
                  }else{

                    $bcs_en_attentes=  Boncommande::where('id_projet','=',$projet_choisi->id)->where([['etat', '=', 1],['date', '<>', null],['service_demandeur', '<>', null],['total_ttc_euro','<=',$projet_choisi->montant1]])->orderBy('created_at', 'DESC')->get();
                }

            }


        }else{
            $bcs_en_attentes=  Boncommande::where('id_projet','=',$projet_choisi->id)->where([['etat', '=', 1],['date', '<>', null],['service_demandeur', '<>', null]])->orderBy('created_at', 'DESC')->get();

        }
        return $bcs_en_attentes;
    }

    public static function signature_bc($projet_choisi){

        $res='';
        if( $projet_choisi->typeValidation==2){

            //si personne connecté egale à valideur
            if(Auth::user()->id==$projet_choisi->valideur1){

                $res=$projet_choisi->signature1;

            }elseif(Auth::user()->id==$projet_choisi->valideur2){

                $res=$projet_choisi->signature2;
            }else{
                $res=$projet_choisi->signature1;
            }


        }else{
            $res=$projet_choisi->signature1;

        }

        return $res;
    }

    public static function signataire_bc($projet_choisi){

        $res='';
        if( $projet_choisi->typeValidation==2){

            //si personne connecté egale à valideur
            if(Auth::user()->id==$projet_choisi->valideur1){

                $res=$projet_choisi->signataire_principale->nom.' '.$projet_choisi->signataire_principale->prenoms;

            }elseif(Auth::user()->id==$projet_choisi->valideur2){

                $res=$projet_choisi->signataire_secondaire->nom.' '.$projet_choisi->signataire_secondaire->prenoms;

            }else{
                $res=$projet_choisi->signataire_principale->nom.' '.$projet_choisi->signataire_principale->prenoms;
            }


        }else{
            $res=$projet_choisi->signataire_principale->nom.' '.$projet_choisi->signataire_principale->prenoms;

        }

        return $res;
    }

}
