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
use App\Devis;
use App\Fournisseur;
use App\Jobs\EnvoiBcFournisseur;
use App\Jobs\EnvoiBcFournisseurPersonnalise;
use App\ligne_bc;
use App\Lignebesoin;
use App\Materiel;
use App\Reponse_fournisseur;
use App\Services;
use App\Unites;
use App\User;
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

    public function bon_commande_file($slug){
     // $bc=  Boncommande::where('slug','=',$slug)->first();
        $bc= DB::table('boncommande')
            ->join('fournisseur', 'boncommande.id_fournisseur', '=', 'fournisseur.id')
            ->leftJoin('services', 'services.id', '=', 'boncommande.service_demandeur')
            ->where('boncommande.slug','=',$slug)
            ->select('fournisseur.libelle','boncommande.id','numBonCommande','date','boncommande.created_at','services.libelle as libelle_service','commentaire_general','fournisseur.conditionPaiement','boncommande.id_fournisseur','remise_excep')->first();

        $devis=DB::table('devis')
            ->join('lignebesoin', 'devis.id_da', '=', 'lignebesoin.id')
            ->where('id_bc','=',$bc->id)
            ->select('titre_ext','devis.quantite','devis.unite','devis.prix_unitaire','devis.remise','devis.prix_tot','devis.codeRubrique','devis.devise','commentaire','hastva','referenceFournisseur','codeGestion')->get();

        $taille=sizeof($devis);

        if($bc->commentaire_general==''){
            $taille_minim=6;
            $taille_maxim=38;
        }else{
            $taille_minim=5;
            $taille_maxim=37;
        }
        $tothtax = 0;
        //return view('BC.bon-commande', compact('bc','ligne_bcs','tothtax'));
        $pdf = PDF::loadView('BC.bon-commande', compact('bc','devis','tothtax','taille','taille_minim','taille_maxim'));

        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.'; téléchargement du B.C N°'.$bc->numBonCommande.'  Adressé au fournisseur '.$bc->id_fournisseur, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return $pdf->download('bon_de_commande_n°'.$bc->numBonCommande.'.pdf');

    }
    public function afficher_le_mail($bc_slug){

        $bc= DB::table('boncommande')
            ->join('fournisseur', 'boncommande.id_fournisseur', '=', 'fournisseur.id')
            ->join('services', 'services.id', '=', 'boncommande.service_demandeur')
            ->where('boncommande.id','=',$bc_slug)
            ->select('fournisseur.libelle','boncommande.id','numBonCommande','date','boncommande.created_at','libelle_service','contact')->get()->first();





        //$lignebesoins=Lignebesoin::where('id_bonCommande','=',$bc->id)->first();
        $lignebesoins=DB::table('lignebesoin')->where('id_bonCommande','=',$bc_slug)->get();
        //  $email=$bc->email;

$corps= Array();

        $images= Array();
        $precisions= Array();
        $i=0;
        foreach($lignebesoins as $das):
            if(isset($das->id)){
                $materiel=DB::table('materiel')
                    ->where('id', '=', $das->id_materiel)
                    ->select('libelleMateriel','image')->distinct()->get();


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
                $corps[$i] =" - ".$das->quantite." ".$das->unite." de ".$materiel[0]->libelleMateriel;
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
            ->where('boncommande.id','=',$bc_slug)
            ->select('fournisseur.libelle','boncommande.id','numBonCommande','date','boncommande.created_at','services.libelle as libelle_service','contact','commentaire_general','fournisseur.conditionPaiement','boncommande.id_fournisseur')->first();

        $devis=DB::table('devis')
            ->join('lignebesoin', 'devis.id_da', '=', 'lignebesoin.id')
            ->where('id_bc','=',$bc->id)
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
                $materiel=DB::table('materiel')
                    ->where('id', '=', $das->id_materiel)
                    ->select('libelleMateriel','image')->distinct()->get();


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
                $corps[$i] =" - ".$das->quantite." ".$das->unite." de ".$materiel[0]->libelleMateriel;
            }
            $i++;

        endforeach;

        $text="";
      //  $contact,$pdf,$bc,$images,$msg_contenu
        $pdf->save(storage_path('bon_commande').'\bon_de_commande_n°'.$bc->numBonCommande.'.pdf');
       // $pdf=$pdf->download('bon_de_commande_n°'.$bc->numBonCommande.'.pdf');
        $this->dispatch(new EnvoiBcFournisseurPersonnalise($contact,storage_path('bon_commande').'\bon_de_commande_n°'.$bc->numBonCommande.'.pdf',$bc,$images,$msg_contenu,$objet,$pj,$copi) );
        //  return redirect()->route('gestion_bc')->with('success', "Envoie d'email reussi");

        $boncom=Boncommande::where('id','=',$bc->id)->first();
        $boncom->etat=3;
        $boncom->save();
        $lignebesoin=Lignebesoin::where('id_bonCommande','=',$bc->id)->first();
        $lignebesoin->etat=3;
        $lignebesoin->save();
        // Finally, you can download the file using download function
        //$pdf->download('bon_de_commande_n°'.$bc->numBonCommande.'.pdf');
        $tothtax = 0;
        return redirect()->route('gestion_bc')->with('success', "Envoie d'email reussi");

    }
    public function send_it(Request $request){

        $parameters=$request->except(['_token']);

        $bc_slug=$parameters['bc_slug'];
        $contact=explode(',',$parameters['contact']);

       // $les_id_devis=explode(',',$parameters['les_id_devis']);
        $bc= DB::table('boncommande')
            ->join('fournisseur', 'boncommande.id_fournisseur', '=', 'fournisseur.id')
            ->join('services', 'services.id', '=', 'boncommande.service_demandeur')
            ->where('boncommande.id','=',$bc_slug)
            ->select('fournisseur.libelle','boncommande.id','numBonCommande','date','boncommande.created_at','services.libelle as libelle_service','contact','commentaire_general','fournisseur.conditionPaiement','boncommande.id_fournisseur','remise_excep')->first();


        $devis=DB::table('devis')
            ->join('lignebesoin', 'devis.id_da', '=', 'lignebesoin.id')
            ->where('id_bc','=',$bc->id)
            ->select('titre_ext','devis.quantite','devis.unite','devis.prix_unitaire','devis.remise','devis.prix_tot','devis.codeRubrique','devis.devise','commentaire','referenceFournisseur')->get();


        $tothtax = 0;
        $taille=sizeof($devis);
        if($bc->commentaire_general==''){
            $taille_minim=6;
            $taille_maxim=0;
        }else{
            $taille_minim=5;
            $taille_maxim=0;
        }
        // Send data to the view using loadView function of PDF facade
        $pdf = PDF::loadView('BC.bon-commande', compact('bc','devis','tothtax','taille','taille_minim','taille_maxim'));

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
                $materiel=DB::table('materiel')
                    ->where('id', '=', $das->id_materiel)
                    ->select('libelleMateriel','image')->distinct()->get();


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
                $corps[$i] =" - ".$das->quantite." ".$das->unite." de ".$materiel[0]->libelleMateriel;
            }
            $i++;

        endforeach;
        $pdf->save(storage_path('bon_commande').'\bon_de_commande_n°'.$bc->numBonCommande.'.pdf');
        $this->dispatch(new EnvoiBcFournisseur($contact,storage_path('bon_commande').'\bon_de_commande_n°'.$bc->numBonCommande.'.pdf',$tab,$corps,$contactDemandeur,$bc,$precisions,$images) );
      //  return redirect()->route('gestion_bc')->with('success', "Envoie d'email reussi");

        $boncom=Boncommande::where('id','=',$bc->id)->first();
        $boncom->etat=3;
        $boncom->save();
        $lignebesoin=Lignebesoin::where('id_bonCommande','=',$bc->id)->first();
        $lignebesoin->etat=3;
        $lignebesoin->save();
        // Finally, you can download the file using download function
          $pdf->download('bon_de_commande_n°'.$bc->numBonCommande.'.pdf');


        return redirect()->route('gestion_bc')->with('success', "Envoie d'email reussi");
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
        $bcs=  Boncommande::where('etat','!=',1)->orderBy('created_at', 'DESC')->paginate(100);
        $bcs_en_attentes=  Boncommande::where('etat','=',1)->orderBy('created_at', 'DESC')->get();
        $utilisateurs=  User::all();

        $fournisseurs= DB::table('fournisseur')
            ->join('devis', 'fournisseur.id', '=', 'devis.id_fournisseur')
            ->where('devis.etat', '=', 1)
            ->select('fournisseur.libelle','fournisseur.id')->distinct()->get();
        $fournisseurss= DB::table('fournisseur')

            ->select('fournisseur.libelle','fournisseur.id')->distinct()->get();
        $users= User::all();

$analytiques= Analytique::all();
        return view('BC/gestion_bc',compact('bcs','bcs_en_attentes','fournisseurs','utilisateurs','analytiques','fournisseurss','users'));
    }
    public function validation_bc()
    {
        $bcs=  Boncommande::where('etat','!=',1)->orderBy('created_at', 'DESC')->get();
        $bcs_en_attentes=  Boncommande::where([['etat', '=', 1],['date', '<>', null],['service_demandeur', '<>', null]])->orderBy('created_at', 'DESC')->get();
        $utilisateurs=  User::all();

        $fournisseurs= DB::table('fournisseur')
            ->join('devis', 'fournisseur.id', '=', 'devis.id_fournisseur')
            ->where('devis.etat', '=', 1)
            ->select('fournisseur.libelle','fournisseur.id')->distinct()->get();
        $fournisseurss= DB::table('fournisseur')

            ->select('fournisseur.libelle','fournisseur.id')->distinct()->get();

        $analytiques= Analytique::all();
        return view('BC/validation_bc',compact('bcs','bcs_en_attentes','fournisseurs','utilisateurs','analytiques','fournisseurss'));
    }
    public function validation_bc_collective($id)
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
            $devis=DB::table('devis')
                ->join('lignebesoin', 'devis.id_da', '=', 'lignebesoin.id')
                ->where('id_bc','=',$Boncommande->id)
                ->select('titre_ext','devis.quantite','devis.unite','devis.prix_unitaire','devis.remise','devis.prix_tot','devis.codeRubrique','devis.devise','commentaire','hastva','referenceFournisseur')->get();


            $tothtax = 0;
            $taille=sizeof($devis);
            if($Boncommande->commentaire_general==''){
                $taille_minim=6;
                $taille_maxim=0;
            }else{
                $taille_minim=5;
                $taille_maxim=0;
            }
            // Send data to the view using loadView function of PDF facade
          //  $bc=$Boncommande;
            $bc=DB::table('boncommande')
                ->join('fournisseur', 'boncommande.id_fournisseur', '=', 'fournisseur.id')
                ->join('services', 'services.id', '=', 'boncommande.service_demandeur')
                ->where('boncommande.id','=',$Boncommande->id)
                ->select('fournisseur.libelle','boncommande.id','numBonCommande','date','boncommande.created_at','services.libelle as libelle_service','contact','commentaire_general','fournisseur.conditionPaiement','boncommande.id_fournisseur','remise_excep')->first();
            $pdf = PDF::loadView('BC.bon-commande', compact('bc','devis','tothtax','taille','taille_minim','taille_maxim'));

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
                    $materiel=DB::table('materiel')
                        ->where('id', '=', $das->id_materiel)
                        ->select('libelleMateriel','image')->distinct()->get();


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
                    $corps[$i] =" - ".$das->quantite." ".$das->unite." de ".$materiel[0]->libelleMateriel;
                }
                $i++;

            endforeach;
            $pdf->save(storage_path('bon_commande').'\bon_de_commande_n°'.$Boncommande->numBonCommande.'.pdf');
            $this->dispatch(new EnvoiBcFournisseur($contact,storage_path('bon_commande').'\bon_de_commande_n°'.$Boncommande->numBonCommande.'.pdf',$tab,$corps,$contactDemandeur,$Boncommande,$precisions,$images) );
            //  return redirect()->route('gestion_bc')->with('success', "Envoie d'email reussi");

            $Boncommande->etat=3;
            $Boncommande->save();
            $lignebesoin=Lignebesoin::where('id_bonCommande','=',$Boncommande->id)->first();
            $lignebesoin->etat=3;
            $lignebesoin->save();
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

        $les_id_devis=explode(',',$parameters['les_id_devis']);
        $commentaire=$parameters['commentaire'];

        $date= new \DateTime(null);

        foreach ($les_id_devis as $id):
            if($id!=""){


                $Devis= Devis::find($id);


                $Devis->id_bc=$parameters['id_bc'];
                $Devis->codeRubrique=$parameters['row_n_'.$id.'_codeRubrique'];

                if(isset($parameters['row_n_'.$id.'_tva']) && $parameters['row_n_'.$id.'_tva']=='on' ){
                    $Devis->hastva=1;
                }else{
                    $Devis->hastva=0;

                }
                $Devis->prix_tot=$Devis->prix_unitaire*$Devis->quantite-($Devis->remise*($Devis->prix_unitaire*$Devis->quantite))/100;
                $Devis->valeur_tva=$Devis->prix_tot*0.18;

                $Devis->save();
                $lignebesoin=Lignebesoin::find($Devis->id_da);
                $lignebesoin->id_bonCommande=$parameters['id_bc'];

                $lignebesoin->save();
            }

            endforeach;


        $boncommande= Boncommande::find($parameters['id_bc']);

        $boncommande->date=$parameters['date_livraison'];
        $boncommande->service_demandeur=$parameters['id_service'];
        $boncommande->remise_excep=$parameters['remise_exc'];
        $boncommande->commentaire_general=$commentaire;

      //  $sumligne=ligne_bc::where('id_bonCommande','=',$boncommande->id)->sum('prix_tot');

        $tot_ttc=$parameters['ttc_serv'];


        $boncommande->total_ttc=$tot_ttc;
        $boncommande->save();





        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.'; Création du bon de commande Numero '.$boncommande->numBonCommande, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return redirect()->route('gestion_bc')->with('success',"La commande a été ajoutée avec success");
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

        return redirect()->route('gestion_bc')->with('success',"La ligne  a été mise à jour avec succes");
    }
    public function valider_commande($slug)
    {
        $date= new \DateTime(null);
        $Boncommande= Boncommande::where('slug', '=', $slug)->first();
        $ligne_besoin= Lignebesoin::where('id_bonCommande', '=', $Boncommande->id)->first();
        if($Boncommande->date==null && $ligne_besoin==null){
            return redirect()->route('gestion_bc')->with('error',"Le bon de commande n'est pas rempli donc ne peut être validé");

        }else{
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
                $devis=DB::table('devis')
                    ->join('lignebesoin', 'devis.id_da', '=', 'lignebesoin.id')
                    ->where('id_bc','=',$Boncommande->id)
                    ->select('titre_ext','devis.quantite','devis.unite','devis.prix_unitaire','devis.remise','devis.prix_tot','devis.codeRubrique','devis.devise','commentaire','hastva','referenceFournisseur')->get();


                $tothtax = 0;
                $taille=sizeof($devis);
                if($Boncommande->commentaire_general==''){
                    $taille_minim=6;
                    $taille_maxim=0;
                }else{
                    $taille_minim=5;
                    $taille_maxim=0;
                }
                // Send data to the view using loadView function of PDF facade
             //   $bc=$Boncommande;
            $bc=DB::table('boncommande')
                ->join('fournisseur', 'boncommande.id_fournisseur', '=', 'fournisseur.id')
                ->join('services', 'services.id', '=', 'boncommande.service_demandeur')
                ->where('boncommande.id','=',$Boncommande->id)
                ->select('fournisseur.libelle','boncommande.id','numBonCommande','date','boncommande.created_at','services.libelle as libelle_service','contact','commentaire_general','fournisseur.conditionPaiement','boncommande.id_fournisseur')->first();
            $pdf = PDF::loadView('BC.bon-commande', compact('bc','devis','tothtax','taille','taille_minim','taille_maxim'));
                $pdf = PDF::loadView('BC.bon-commande', compact('bc','devis','tothtax','taille','taille_minim','taille_maxim'));

                //$lignebesoins=Lignebesoin::where('id_bonCommande','=',$bc->id)->first();
                $lignebesoins=DB::table('lignebesoin')
                                  ->join('users', 'lignebesoin.id_user', '=', 'users.id')->where('id_bonCommande','=',$Boncommande->id)->get();
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
                        $materiel=DB::table('materiel')
                            ->where('id', '=', $das->id_materiel)
                            ->select('libelleMateriel','image')->distinct()->get();


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
                        $corps[$i] =" - ".$das->quantite." ".$das->unite." de ".$materiel[0]->libelleMateriel;
                    }
                    $i++;

                endforeach;
                $pdf->save(storage_path('bon_commande').'\bon_de_commande_n°'.$Boncommande->numBonCommande.'.pdf');
          //  dd($contactDemandeur);
                $this->dispatch(new EnvoiBcFournisseur($contact,storage_path('bon_commande').'\bon_de_commande_n°'.$Boncommande->numBonCommande.'.pdf',$tab,$corps,$contactDemandeur,$Boncommande,$precisions,$images) );
                //  return redirect()->route('gestion_bc')->with('success', "Envoie d'email reussi");

                $Boncommande->etat=3;
                $Boncommande->save();
                $lignebesoin=Lignebesoin::where('id_bonCommande','=',$Boncommande->id)->first();
                $lignebesoin->etat=3;
                $lignebesoin->save();
                // Finally, you can download the file using download function
                $pdf->download('bon_de_commande_n°'.$bc->numBonCommande.'.pdf');


            /*debut du traçages*/
            $ip			= $_SERVER['REMOTE_ADDR'];
            if (isset($_SERVER['REMOTE_HOST'])){
                $nommachine = $_SERVER['REMOTE_HOST'];
            }else{
                $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
            }
            Log::info('ip :'.$ip.'; Machine: '.$nommachine.'; Bon de commande validé et transmit N° '.$Boncommande->numBonCommande, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
                //fin de l'utilisation de la fonction send_it
        }
        return redirect()->route('validation_bc')->with('success',"Bon de commande validé et transmit");
    }
    public function add_new_da_to_bc($id,$id_bc)
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
            ->join('lignebesoin', 'lignebesoin.id','=','devis.id_da')
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
        return redirect()->route('gestion_bc')->with('success',"a date de livraison a été précisé");

    }

    public function chercher_codeRubrique($id)
    {
        $materiel= Materiel::find($id);
        return \GuzzleHttp\json_encode($materiel);
    }

    public function retirer_da_to_bc($id,$id_bc)
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
    public function supprimer_def_da_to_bc($id,$id_bc)
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

    public function traite_finalise($slug)
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
        return redirect()->route('gestion_bc')->with('success',"le bon de commande à été traité et finalisé");
    }
    public function traite_retourne($slug)
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
        return redirect()->route('gestion_bc')->with('success',"le bon de commande à été traité et finalisé");
    }
    public function refuser_commande($slug)
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
        return redirect(url()->previous())->with('success',"Le bon de commande à été validé avec succès");
    }

    public function annuler_commande($slug)
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
        return redirect(url()->previous())->with('success',"le bon de commande à été annuler avec succès");
    }
    public function lister_commande($id)
    {
        $bc=  Boncommande::find($id);
        $utilisateurs=  User::all();
        $fournisseur= Fournisseur::find($bc->id_fournisseur);
        $devis= DB::table('devis')
            ->leftJoin('lignebesoin', 'lignebesoin.id', '=', 'devis.id_da')
            ->leftJoin('users', 'lignebesoin.id_user', '=', 'users.id')
            ->where('devis.etat', '=', 2)
            ->where('devis.id_bc', '=', $id)
            ->select('devis.id','devis.titre_ext','id_bc','devis.codeRubrique','devis.quantite','devis.unite','devis.prix_unitaire','devis.remise','devis.devise','devis.hastva','DateBesoin','users.service','lignebesoin.commentaire','referenceFournisseur')->distinct()->get();



    $services=Services::all();
        $new_devis=DB::table('devis')
            ->leftJoin('lignebesoin', 'lignebesoin.id', '=', 'devis.id_da')
            ->leftJoin('users', 'lignebesoin.id_user', '=', 'users.id')
            ->where('devis.etat', '=', 1)
            ->where('devis.id_bc', '=', null)
            ->where('devis.id_fournisseur', '=', $bc->id_fournisseur)
            ->select('devis.id','devis.titre_ext','id_bc','devis.codeRubrique','devis.quantite','devis.unite','devis.prix_unitaire','devis.remise','devis.devise','devis.hastva','DateBesoin','users.service','lignebesoin.commentaire','referenceFournisseur')->distinct()->get();

        $date_propose= Array();
        $service_id= Array();
        $service_libelle= Array();

        foreach($devis as $dev){

            if(!in_array($dev->DateBesoin, $date_propose)){
                $date_propose[]=$dev->DateBesoin;
            }
            if(!in_array($dev->service,$service_id)){


                $service_unique= Services::find($dev->service);
                if(isset($service_unique)){
                    $service_id[]=$service_unique->id;
                    $service_libelle[]=$service_unique->libelle;
                }

            }
        }
if(isset($devis->first()->devise)){
    $devise=$devis->first()->devise;
}else{
    $devise="";
}

        $id_devi="";
        foreach($devis as $devi):
            $id_devi=$id_devi.$devi->id.",";
            endforeach;


        $listerbc='';
        $analytiques= Analytique::all();
        return view('BC/list_ligne_bc',compact('bc','fournisseur','utilisateurs','listerbc','devis','analytiques','devise','id_devi','date_propose','service_id','service_libelle','new_devis','services'));
    }
    public function bc_express(){
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
        return view('BC/bcexpress',compact('analytiques','materiels','fournisseurs','tab_unite'));

    }
    public function gestion_bc_ajouter()
    {
        $bcs=  Boncommande::orderBy('created_at', 'DESC')->paginate(100);
        $bcs_en_attentes=  Boncommande::where('etat','=',1)->orderBy('created_at', 'DESC')->get();
        $utilisateurs=  User::all();
        $fournisseurs= DB::table('fournisseur')
            ->join('devis', 'fournisseur.id', '=', 'devis.id_fournisseur')
            ->where('devis.etat', '=', 1)
            ->select('fournisseur.libelle','fournisseur.id')->distinct()->get();
        $fournisseurss= DB::table('fournisseur')

            ->select('fournisseur.libelle','fournisseur.id')->distinct()->get();
        $ajouter='vrai';
        $analytiques= Analytique::all();
        return view('BC/gestion_bc',compact('bcs','bcs_en_attentes','fournisseurs','utilisateurs','ajouter','analytiques','fournisseurss'));
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
        $Boncommande->numBonCommande="PHB-815140-".$parameters['numbc'];
       // $Boncommande->date=$parameters['date'];
        $Boncommande->id_fournisseur=$parameters['id_fournisseur'];
        $Boncommande->id_user=Auth::user()->id;

        $Boncommande->slug=Str::slug($parameters['numbc'].$date->format('dmYhis'));
       // $Boncommande->save();
        try{$Boncommande->save();
        }catch (\Illuminate\Database\QueryException $ex){


            return redirect()->route('gestion_bc')->with('error',"Le numero du bon de commande est déjà utilisé");
        }
        $lesdevis= Devis::where('id_fournisseur','=',$Boncommande->id_fournisseur)

            ->where('etat','=',1)->get();


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
        return redirect()->route('gestion_bc')->with('success',"Le bon de commande a été ajouté, Veuillez ajouter la listes des produits ou des services");
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
        return redirect()->route('gestion_bc')->with('success',"Le bon de commande a été Modifié");
    }

    public function supprimer_bc($slug)
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
    public function supprimer_ligne_bc($slug)
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
        return redirect()->route('gestion_bc')->with('success', "La ligne du bon de commande a été supprimée avec succes ");
    }

    public function list_contact($id)
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
        return redirect()->route('gestion_bc')->with('success', "Date de livraison ajoutée avec succès ");

    }
    public function list_materiel_produit(){
        $codes= Analytique::all();
        $materiels = Materiel::all();
$optcode="";$optmateriel="";$optunite="";
        foreach ($codes as $code):
$optcode.=" <option value='".$code->codeRubrique."' data-subtext='".$code->libelle."'>".$code->codeRubrique."</option>";
            endforeach;
        foreach ($materiels as $materiel):
            $optmateriel.="<option value='".$materiel->id."'>".$materiel->libelleMateriel."</option>";
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

}