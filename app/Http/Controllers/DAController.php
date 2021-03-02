<?php
/**
 * Created by PhpStorm.
 * User: ckodia
 * Date: 25/10/2018
 * Time: 17:16
 */

namespace App\Http\Controllers;



use App\Boncommande;
use App\CodeTache;
use App\DA;
use App\Designation;
use App\Devis;
use App\Domaines;
use App\Famille;
use App\Gestion;
use App\ligne_bc;
use App\Lignebesoin;
use App\Materiel;
use App\Fournisseur;
use App\Nature;
use App\Panier_demande;
use App\Tracemail;
use App\Unites;
use App\User;
use Carbon\Carbon;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Array_;

class DAController
{

    public function das()
    {
        $fournisseurs=Fournisseur::all();
        $materiels=Materiel::all();
      //  $das=  DA::orderBy('created_at', 'DESC')->paginate(100);
       // $das=  DA::orderBy('created_at', 'DESC')->paginate(20);
        $das=  DB::table('lignebesoin')
            ->Join('users','users.id','=','lignebesoin.id_user')
            ->leftJoin('materiel','materiel.id','=','lignebesoin.id_materiel')
            ->leftJoin('devis','devis.id_da','=','lignebesoin.id')
            ->leftJoin('fournisseur','fournisseur.id','=','devis.id_fournisseur')
            ->leftJoin('boncommande','boncommande.id','=','lignebesoin.id_bonCommande')
            ->leftJoin('gestion','gestion.id','=','lignebesoin.id_codeGestion')
            //->where('users.service','=',\Illuminate\Support\Facades\Auth::user()->service)->orderBy('lignebesoin.created_at', 'DESC')
            ->select('lignebesoin.id','lignebesoin.unite','lignebesoin.quantite','DateBesoin','lignebesoin.id_user','id_nature','lignebesoin.id_materiel','lignebesoin.created_at','demandeur','lignebesoin.slug','lignebesoin.etat','id_valideur','motif','usage','lignebesoin.commentaire','dateConfirmation','date_livraison_eff','code_analytique','codeRubrique',DB::raw('fournisseur.libelle as libelle_fournisseur'),'numBonCommande','boncommande.date','gestion.codeGestion')->paginate(300);
        $natures= Nature::all();
          //  dd($das[0]->bondecommande);
        $service_users=DB::table('users')
            ->leftJoin('services', 'services.id', '=', 'users.service')
            ->select('users.id','nom','prenoms','services.libelle','users.service')->get();
        $domaines=  DB::table('domaines')->get();
        $tracemails= DB::table('trace_mail')->get();


//dd($das);
        //trace
        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }

        Log::info('ip :'.$ip.'; Machine: '.$nommachine.'; Lister les D.A par user.', ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return view('DA/lister_da',compact('das','fournisseurs','materiels','natures','service_users','domaines','tracemails'));


    }
    public function lister_da_recherche()
    {
        $fournisseurs=Fournisseur::all();
        $materiels=Materiel::all();
      //  $das=  DA::orderBy('created_at', 'DESC')->paginate(100);
       // $das=  DA::orderBy('created_at', 'DESC')->paginate(20);
        $das= "";
        $natures= Nature::all();
          //  dd($das[0]->bondecommande);
        $service_users=DB::table('users')
            ->leftJoin('services', 'services.id', '=', 'users.service')
            ->select('users.id','nom','prenoms','services.libelle','users.service')->get();
        $domaines=  DB::table('domaines')->get();
        $tracemails= DB::table('trace_mail')->get();

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
//dd($das);
        //trace
        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }

        Log::info('ip :'.$ip.'; Machine: '.$nommachine.'; Lister les D.A par user.', ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return view('DA/lister_da_recherche',compact('das','fournisseurs','materiels','natures','service_users','domaines','tracemails','tab_unite'));


    }

    public function validation_da_collective($locale,$id)
    {
        // dd($listeDA);
        $tab_da = explode(",", $id);

        //   $ligne_besoin= Lignebesoin::where('id_bonCommande', '=', $Boncommande->id)->first();

        foreach($tab_da as $da):
            if($da!=''){
                $lada= DA::find($da);
                $lada->etat=2;
                $lada->id_valideur= Auth::user()->id ;
                $lada->save();
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
    public function donne_moi_le_nom_des_designations($locale,$id)
    {
        // dd($listeDA);
        $ids = explode(",", $id);

        //   $ligne_besoin= Lignebesoin::where('id_bonCommande', '=', $Boncommande->id)->first();

        $res='<ol>';

        foreach($ids as $id):
            if($id!=''){
               $designation = Designation::find($id);
                $res=$res.'<li>'.$designation->libelle.'</li>';
            }

        endforeach;
        $res=$res.'</ol>';
        // return redirect()->route('gestion_bc')->with('success', "Bon(s) de commande(s) validé(s) & Transmission aux fournisseurs");
        return $res;
    }
    public function creation_ajout_de_panier($locale,$id)
    {
        $res=1;

        $ids = explode(",", $id);
        $panier_demande=Panier_demande::where('etat','=',1)->where('id_user','=',Auth::user()->id)->first();

        if(!isset($panier_demande)){

            $panier_demande= new Panier_demande();

            $panier_demande->id_user = Auth::user()->id;
            $panier_demande->etat =1;
            $panier_demande->save();


        }
        $date= new \DateTime(null);
       // echo $date->format('Y-m-d');
    //    dd($ids);
        foreach($ids as $id):
            $lignaexiste = Lignebesoin::where('id_materiel','=',$id)->where('id_user','=',Auth::user()->id)->where('etat','=',1)->first();
//dd($lignaexiste);
          if(!isset($lignaexiste->id)){
              if($id!=''){
                  $lignebesoin = new DA();
                  $lignebesoin->id_materiel=$id;
                  $lignebesoin->quantite=1;
                  $lignebesoin->unite="u";
                  // $lignebesoin->nature=1;
                  $lignebesoin->DateBesoin=$date->format('Y-m-d');
                  $lignebesoin->demandeur=Auth::user()->nom;
                  $lignebesoin->id_user=Auth::user()->id;
                  $lignebesoin->id_panier_demande=$panier_demande->id;
                  $lignebesoin->slug= Str::slug($id . $date->format('Y-m-d h:m:s'));
                  $lignebesoin->save();

              }
          }else{
              $res=2;
          }

        endforeach;
        return $res;
    }
    public function mise_ajour_info_da(Request $request)
    {
        $parameters = $request->except(['_token']);

//         dd($parameters);
        $res=$parameters['res'];
        $lesId=$parameters['lesId'];
        $lesId=explode(',',$lesId);
        parse_str($res,$tab);
        $i=0;
        foreach($lesId as $id){
            if($id!=="undefined" ){
                $lignebesoin = Lignebesoin::find($id);
                if($tab["id_codeGestion".$id]!=''){
                    $lignebesoin->id_codeGestion=$tab["id_codeGestion".$id];
                }
                if($tab["id_codeTache".$id]!=''){
                    $lignebesoin->id_codeTache=$tab["id_codeTache".$id];
                }

                $lignebesoin->demandeur=$tab["demandeur".$id];
                $lignebesoin->usage=$tab["usage".$id];
                $lignebesoin->id_nature=$tab["id_nature".$id];
                $lignebesoin->quantite=$tab["quantite".$id];
                $lignebesoin->unite=$tab["unite".$id];
                $lignebesoin->DateBesoin=$tab["DateBesoin".$id];
                $lignebesoin->commentaire=$tab["commentaire".$id];
                $lignebesoin->save();
            }
            $i++;
        }







        return 1;

    }
    public function retirer_du_panier($locale,$id)
    {

        $ids = explode(",", $id);
        $panier_demande=Panier_demande::where('etat','=',1)->where('id_user','=',Auth::user()->id)->first();

        $date= new \DateTime(null);
       // echo $date->format('Y-m-d');
        foreach($panier_demande->lignebesoins()->get() as $lignebesoin):


            if($id!='' && in_array($lignebesoin->id,$ids)){
                $lignebesoin->delete();

            }

        endforeach;
        return 1;
    }
    public function afficher_contenue_panier()
    {
        $panier_demande = Panier_demande::where('id_user','=',Auth::user()->id)->where('etat','=',1)->first();

      //  dd($panier_demande);
        $lignebesoins = $panier_demande->lignebesoins()->where('etat','<',2)->where('etat','<>',0)->get();
       // dd($lignebesoins);
        $res = array();
        foreach($lignebesoins as $lignebesoin):
            $res[]=$lignebesoin->designation->libelle;
            endforeach;
        return $res;
    }

    public function refus_da_collective($locale,$id)
    {
        // dd($listeDA);
        $tab_da = explode(",", $id);

        //   $ligne_besoin= Lignebesoin::where('id_bonCommande', '=', $Boncommande->id)->first();

        foreach($tab_da as $da):
            if($da!=''){
                $lada= DA::find($da);
                $lada->etat=0;
                $date = new \DateTime(null);
                $lada->dateConfirmation=$date->format('Y-m-d h:m:s');
                $lada->motif="Aucun";
                $lada->id_valideur= Auth::user()->id ;
                $lada->save();
                $user=User::where('id','=',$lada->id_user)->first();
                try{
                    Mail::send('mail/mail_action_da',array('da' =>$lada,'etat' =>$da->etat,'libelleMateriel'=>$lada->libelleMateriel),function($message)use ($user){
                        $message->from(\Illuminate\Support\Facades\Auth::user()->email ,\Illuminate\Support\Facades\Auth::user()->nom )
                            ->to($user->email)
                            ->subject(strtoupper("Refus de la demande d'achat"));

                    });}catch (\Exception $e){

                }
            }

        endforeach;

        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.'; Refus  collective des  D.As '.$id, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);

        // return redirect()->route('gestion_bc')->with('success', "Bon(s) de commande(s) validé(s) & Transmission aux fournisseurs");
        return 'success';
    }
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function recherche_da(Request $request)
    {
        $parameters = $request->except(['_token']);

        $mot_cle = $parameters['mot_cle'];
       // $debut = $parameters['debut'];
        //$fin = $parameters['fin'];


       // dd($finn);
        $fournisseurs=Fournisseur::all();
        $materiels=Materiel::all();
      //  $das=  DA::orderBy('created_at', 'DESC')->paginate(100);
       // $das=  DA::orderBy('created_at', 'DESC')->paginate(20);
        $das=  DB::table('lignebesoin')
            ->Join('users','users.id','=','lignebesoin.id_user')
            ->leftJoin('materiel','materiel.id','=','lignebesoin.id_materiel')
            ->leftJoin('devis','devis.id_da','=','lignebesoin.id')
            ->leftJoin('fournisseur','fournisseur.id','=','devis.id_fournisseur')
            ->leftJoin('gestion','gestion.id','=','lignebesoin.id_codeGestion')

            ->leftJoin('boncommande','boncommande.id','=','lignebesoin.id_bonCommande')
            ->select('lignebesoin.id','lignebesoin.unite','lignebesoin.quantite','DateBesoin','lignebesoin.id_user','id_nature','lignebesoin.id_materiel','materiel.libelleMateriel','lignebesoin.created_at','demandeur','lignebesoin.slug','lignebesoin.etat','id_valideur','motif','usage','lignebesoin.commentaire','dateConfirmation','date_livraison_eff','code_analytique','codeRubrique',DB::raw('fournisseur.libelle as libelle_fournisseur'),'numBonCommande','boncommande.date','lignebesoin.created_at','gestion.codeGestion','devis.prix_unitaire')
         //   ->WhereBetween('lignebesoin.created_at', [$debut, $fin])
            ->orWhere('lignebesoin.demandeur', 'LIKE', "%{$mot_cle}%")
            //  ->WhereBetween('lignebesoin.created_at', [$debutt, $finn])
            ->orWhere('materiel.libelleMateriel', 'LIKE', "%{$mot_cle}%")
            ->orWhere('fournisseur.libelle', 'LIKE', "%{$mot_cle}%")
            ->orWhere('lignebesoin.demandeur', 'LIKE', "%{$mot_cle}%")
            ->orWhere('boncommande.numBonCommande', 'LIKE', "%{$mot_cle}%")
            ->orWhere('gestion.codeGestion', 'LIKE', "%{$mot_cle}%")
            ->orWhere('boncommande.date', 'LIKE', "%{$mot_cle}%")
          ->get(100);



/*
        $das=  DB::table('lignebesoin')
            ->Join('users','users.id','=','lignebesoin.id_user')
            ->leftJoin('materiel','materiel.id','=','lignebesoin.id_materiel')
            ->leftJoin('devis','devis.id_da','=','lignebesoin.id')
            ->leftJoin('fournisseur','fournisseur.id','=','devis.id_fournisseur')
            ->WhereBetween('lignebesoin.created_at', [$debutt, $finn])
            ->leftJoin('boncommande','boncommande.id','=','lignebesoin.id_bonCommande')
            ->select('lignebesoin.id','lignebesoin.unite','lignebesoin.quantite','DateBesoin','lignebesoin.id_user','id_nature','lignebesoin.id_materiel','materiel.libelleMateriel','lignebesoin.created_at','demandeur','lignebesoin.slug','lignebesoin.etat','id_valideur','motif','usage','lignebesoin.commentaire','dateConfirmation','date_livraison_eff','code_analytique','codeRubrique',DB::raw('fournisseur.libelle as libelle_fournisseur'),'numBonCommande','boncommande.date','lignebesoin.created_at')
 ->orWhere('lignebesoin.demandeur', 'LIKE', "%{$mot_cle}%")
            ->orWhere('materiel.libelleMateriel', 'LIKE', "%{$mot_cle}%")
            ->orWhere('fournisseur.libelle', 'LIKE', "%{$mot_cle}%")
            ->orWhere('lignebesoin.demandeur', 'LIKE', "%{$mot_cle}%")
            ->orWhere('boncommande.numBonCommande', 'LIKE', "%{$mot_cle}%")
            ->orWhere('boncommande.date', 'LIKE', "%{$mot_cle}%")
            ->orWhere('lignebesoin.usage', 'LIKE', "%{$mot_cle}%")
            ->paginate(50);
            ->orWhere([
                ['lignebesoin.demandeur', 'LIKE', "%{$mot_cle}%"],
                ['materiel.libelleMateriel', 'LIKE', "%{$mot_cle}%"],
                ['fournisseur.libelle', 'LIKE', "%{$mot_cle}%"],
                ['lignebesoin.demandeur', 'LIKE', "%{$mot_cle}%"],
                ['boncommande.numBonCommande', 'LIKE', "%{$mot_cle}%"],
                ['boncommande.date', 'LIKE', "%{$mot_cle}%"],
                ['lignebesoin.usage', 'LIKE', "%{$mot_cle}%"],
            ])
*/
     /*   $das=  DB::select("select `lignebesoin`.`id`, `lignebesoin`.`unite`, `lignebesoin`.`quantite`, `DateBesoin`, `lignebesoin`.`id_user`, `id_nature`, `lignebesoin`.`id_materiel`, `materiel`.`libelleMateriel`, `lignebesoin`.`created_at`, `demandeur`, `lignebesoin`.`slug`, `lignebesoin`.`etat`, `id_valideur`, `motif`, `usage`, `lignebesoin`.`commentaire`, `dateConfirmation`, `date_livraison_eff`, `code_analytique`, `codeRubrique`, fournisseur.libelle as libelle_fournisseur, `numBonCommande`, `boncommande`.`date`, `lignebesoin`.`created_at`
                           from `lignebesoin` inner join `users` on `users`.`id` = `lignebesoin`.`id_user` left join `materiel` on `materiel`.`id` = `lignebesoin`.`id_materiel` left join `devis` on `devis`.`id_da` = `lignebesoin`.`id` left join `fournisseur` on `fournisseur`.`id` = `devis`.`id_fournisseur` left join `boncommande` on `boncommande`.`id` = `lignebesoin`.`id_bonCommande`
                           where `lignebesoin`.`created_at` between ? and ? and (`lignebesoin`.`demandeur` LIKE ? or `materiel`.`libelleMateriel` LIKE ? or `fournisseur`.`libelle` LIKE ?  or `boncommande`.`numBonCommande` LIKE ? or `boncommande`.`date` LIKE ? or `lignebesoin`.`usage` LIKE ?)",[$debutt,$finn,'%'.$mot_cle.'%','%'.$mot_cle.'%','%'.$mot_cle.'%','%'.$mot_cle.'%','%'.$mot_cle.'%','%'.$mot_cle.'%',]);
       */
         // dd($das);
           /*
            ->orWhere('lignebesoin.demandeur', 'LIKE', "%{$mot_cle}%")
            ->orWhere('materiel.libelleMateriel', 'LIKE', "%{$mot_cle}%")
            ->orWhere('fournisseur.libelle', 'LIKE', "%{$mot_cle}%")
            ->orWhere('lignebesoin.demandeur', 'LIKE', "%{$mot_cle}%")
            ->orWhere('boncommande.numBonCommande', 'LIKE', "%{$mot_cle}%")
            ->orWhere('boncommande.date', 'LIKE', "%{$mot_cle}%")
            ->orWhere('lignebesoin.usage', 'LIKE', "%{$mot_cle}%")
            ->paginate(50);*/

        //dd($das);
        $natures= Nature::all();
          //  dd($das[0]->bondecommande);
        $service_users=DB::table('users')
            ->leftJoin('services', 'services.id', '=', 'users.service')
            ->select('users.id','nom','prenoms','services.libelle','users.service')->get();
        $domaines=  DB::table('domaines')->get();
        $tracemails= DB::table('trace_mail')->get();

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
//dd($das);
        //trace
        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }

        Log::info('ip :'.$ip.'; Machine: '.$nommachine.'; Lister les D.A par user.', ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return view('DA/lister_da_recherche',compact('das','fournisseurs','materiels','natures','service_users','domaines','tracemails','tab_unite','mot_cle'));


    }
    public function encours_validation()
    {
        $das = Lignebesoin::where('etat','=',1)->where('id_codeGestion','<>','')->where('usage','<>','')->paginate(100);
        $gestions= Gestion::all();
        $tracemails= DB::table('trace_mail')->get();
        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }

        Log::info('ip :'.$ip.'; Machine: '.$nommachine.'; Lister les D.A en cours de validation.', ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);


        return view('DA/da_a_valider',compact('das','tracemails','gestions'));


    }
    public function creer_da()
    {
        //ici
        $gestions= Gestion::all();
        $fournisseurs=Fournisseur::all();
        $materiels=Materiel::all();
       // $das=  DA::where('id_user','=',\Illuminate\Support\Facades\Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(50);
        $das=  DB::table('lignebesoin')
                ->Join('users','users.id','=','lignebesoin.id_user')
                ->leftJoin('materiel','materiel.id','=','lignebesoin.id_materiel')
                ->leftJoin('devis','devis.id_da','=','lignebesoin.id')
                ->leftJoin('fournisseur','fournisseur.id','=','devis.id_fournisseur')
                ->leftJoin('boncommande','boncommande.id','=','lignebesoin.id_bonCommande')
                ->leftJoin('gestion','gestion.id','=','lignebesoin.id_codeGestion')
                ->where('users.service','=',\Illuminate\Support\Facades\Auth::user()->service)->orderBy('lignebesoin.created_at', 'DESC')
            ->select('lignebesoin.id','lignebesoin.unite','lignebesoin.quantite','DateBesoin','lignebesoin.id_user','id_nature','lignebesoin.id_materiel','lignebesoin.created_at','demandeur','lignebesoin.slug','lignebesoin.etat','id_valideur','motif','usage','lignebesoin.commentaire','dateConfirmation','date_livraison_eff','code_analytique','codeRubrique',DB::raw('fournisseur.libelle as libelle_fournisseur'),'numBonCommande','boncommande.date','lignebesoin.id_codeGestion','gestion.codeGestion')->paginate(30);
         $mesdas=  DB::table('lignebesoin')
                ->Join('users','users.id','=','lignebesoin.id_user')
                ->leftJoin('materiel','materiel.id','=','lignebesoin.id_materiel')
                ->leftJoin('devis','devis.id_da','=','lignebesoin.id')
                ->leftJoin('fournisseur','fournisseur.id','=','devis.id_fournisseur')
                ->leftJoin('boncommande','boncommande.id','=','lignebesoin.id_bonCommande')
                ->leftJoin('gestion','gestion.id','=','lignebesoin.id_codeGestion')
                ->where('users.id','=',\Illuminate\Support\Facades\Auth::user()->id)->orderBy('lignebesoin.created_at', 'DESC')
            ->select('lignebesoin.id','lignebesoin.unite','lignebesoin.quantite','DateBesoin','lignebesoin.id_user','id_nature','lignebesoin.id_materiel','lignebesoin.created_at','demandeur','lignebesoin.slug','lignebesoin.etat','id_valideur','motif','usage','lignebesoin.commentaire','dateConfirmation','date_livraison_eff','code_analytique','codeRubrique',DB::raw('fournisseur.libelle as libelle_fournisseur'),'numBonCommande','boncommande.date','lignebesoin.id_codeGestion','gestion.codeGestion')->paginate(30);
        $natures= Nature::all();
        $service_users=DB::table('users')
            ->leftJoin('services', 'services.id', '=', 'users.service')
            ->select('users.id','nom','prenoms','services.libelle','users.service')->get();
        $domaines=  DB::table('domaines')->get();
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
        $tracemails= DB::table('trace_mail')->get();

        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }

        Log::info('ip :'.$ip.'; Machine: '.$nommachine.'; affichage de la fenetre de création de D.A.', ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);

        return view('DA/creer_da',compact('das','fournisseurs','materiels','natures','service_users','domaines','tab_unite','tracemails','gestions','mesdas'));


    }
    public function historique_achat()
    {
           $mesdas=  Lignebesoin::where('lignebesoin.created_at','<','2020-12-14 00:00:00')->where('lignebesoin.id_user','=',Auth::user()->id)->orderBy('lignebesoin.created_at', 'DESC')->get();
           $mesdas_news=  Lignebesoin::where('lignebesoin.created_at','>','2020-12-14 00:00:00')->where('lignebesoin.id_user','=',Auth::user()->id)->orderBy('lignebesoin.created_at', 'DESC')->get();
        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }

        Log::info('ip :'.$ip.'; Machine: '.$nommachine.'; affichage de la fenetre de création de D.A.', ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);

        return view('DA/historique_achat',compact('mesdas','mesdas_news'));


    }
    public function demande_achat()
    {

        $materiels=Designation::all();
        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }

        $panini ="panier";
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.'; affichage de la fenetre de création de D.A.', ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);

        return view('DA/demande_achat',compact('materiels','panini'));


    }
    public function mon_panier()
    {
        $panier_demande = Panier_demande::where('id_user','=',Auth::user()->id)->where('etat','=',1)->first();
        $gestions = Gestion::all();
        $natures = Nature::all();
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
        $codetaches =CodeTache::all();
        return view('DA/panier',compact('panier_demande','gestions','natures','tab_unite','codetaches'));


    }
    public function da_multiple()
    {
        //ici
        $gestions= Gestion::all();
        $fournisseurs=Fournisseur::all();
        $materiels=Materiel::all();
       // $das=  DA::where('id_user','=',\Illuminate\Support\Facades\Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(50);
       $natures= Nature::all();
        $service_users=DB::table('users')
            ->leftJoin('services', 'services.id', '=', 'users.service')
            ->select('users.id','nom','prenoms','services.libelle','users.service')->get();
        $domaines=  DB::table('domaines')->get();
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
        $tracemails= DB::table('trace_mail')->get();

        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }

        Log::info('ip :'.$ip.'; Machine: '.$nommachine.'; affichage de la fenetre de création de D.A.', ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);

        return view('DA/da_multiple',compact('fournisseurs','materiels','natures','service_users','domaines','tab_unite','tracemails','gestions'));


    }
    public function Validdas( Request $request)
    {

        $parameters = $request->except(['_token']);

        // Fournisseur::create($parameters);
        $date = new \DateTime(null);
        $da = new DA();
        $da->unite = $parameters['unite'];
        $da->quantite = $parameters['quantite'];
        $da->DateBesoin = $parameters['DateBesoin'];
        $da->id_user = $parameters['id_user'];
        $da->id_codeGestion = $parameters['id_codeGestion'];
        $da->id_nature = $parameters['id_nature'];
        $da->id_materiel = $parameters['id_materiel'];
        $da->commentaire = $parameters['commentaire'];
        $da->usage = $parameters['usage'];
        $da->demandeur = $parameters['demandeur'];
        $da->slug = Str::slug($parameters['id_materiel'] . $date->format('dmYhis'));
        $da->save();

        $materiel = Materiel::find( $da->id_materiel);
        if(isset($materiel) && $materiel->id_codeGestion==null){
            $materiel->id_codeGestion=$da->id_codeGestion;
            $materiel->save();
        }

        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }

        Log::info('ip :'.$ip.'; Machine: '.$nommachine.'; création  de la  D.A slug:'.$da->slug.' .', ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return redirect()->route('creer_da')->with('success', "La demande d'approvisionnement a été ajoutée");



    }
    public function changer_code_gestion( Request $request)
    {

        $parameters = $request->except(['_token']);

        // Fournisseur::create($parameters);
        $date = new \DateTime(null);
        $id=$parameters['id'];
        $da =  DA::find($id);
        $da->id_codeGestion = $parameters['id_codeGestion'];
        $da->save();

        $materiel = Materiel::find( $da->id_materiel);
        if(isset($materiel) && $materiel->id_codeGestion==null){
            $materiel->id_codeGestion=$da->id_codeGestion;
            $materiel->save();
        }

        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }

        Log::info('ip :'.$ip.'; Machine: '.$nommachine.'; Modification du code de gestion:'.$da->slug.' .', ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return redirect()->back()->with('success', "La modification du code de gestion de la D.A n°".$da->id." a été faite");



    }
    public function enregistrer_da_multiple(Request $request){

        $parameters = $request->except(['_token']);
        //dd($request->input("id_materiel"));
        $date = new \DateTime(null);
        for ($i=0;$i<sizeof($request->input("id_materiel"));$i++){
           $da = new DA();

            $da->id_materiel=$request->input("id_materiel")[$i];
            $da->id_nature=$request->input("id_nature")[$i];
            $da->DateBesoin =$request->input("DateBesoin")[$i];
            $da->id_codeGestion=$request->input("id_codeGestion")[$i];
            $da->id_codeGestion=$request->input("id_codeGestion")[$i];
            $da->quantite=$request->input("quantite")[$i];
            $da->demandeur=$request->input("demandeur")[$i];
            $da->usage=$request->input("usage")[$i];
            $da->unite=$request->input("unite")[$i];
            $da->commentaire=$request->input("commentaire")[$i];
            $da->id_user=$request->input("id_user")[$i];
            $da->slug = Str::slug($request->input("id_materiel")[$i] . $date->format('dmYhis'));
            $da->save();
        }
        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }

        Log::info('ip :'.$ip.'; Machine: '.$nommachine.'; création  de la  D.A multiple: .', ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return redirect()->back()->with('success', "vos demandes d'approvisionnement ont été ajoutées");


    }
    public function voir_da($locale,$slug)
    {
        //$das=  DA::where('id_user','=',\Illuminate\Support\Facades\Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(50);
        $gestions =Gestion::all();
        $das=  DB::table('lignebesoin')
            ->leftJoin('materiel','materiel.id','=','lignebesoin.id_materiel')
            ->leftJoin('devis','devis.id_da','=','lignebesoin.id')
            ->leftJoin('fournisseur','fournisseur.id','=','devis.id_fournisseur')
            ->leftJoin('boncommande','boncommande.id','=','lignebesoin.id_bonCommande')
            ->leftJoin('gestion','gestion.id','=','lignebesoin.id_codeGestion')
            ->Join('users','users.id','=','lignebesoin.id_user')
            ->where('users.service','=',\Illuminate\Support\Facades\Auth::user()->service)->orderBy('lignebesoin.created_at', 'DESC')
            ->select('lignebesoin.id','lignebesoin.unite','lignebesoin.quantite','DateBesoin','lignebesoin.id_user','id_nature','lignebesoin.id_materiel','lignebesoin.created_at','demandeur','lignebesoin.slug','lignebesoin.etat','id_valideur','motif','usage','lignebesoin.commentaire','dateConfirmation','date_livraison_eff','code_analytique','codeRubrique',DB::raw('fournisseur.libelle as libelle_fournisseur'),'numBonCommande','boncommande.date','lignebesoin.id_codeGestion','gestion.codeGestion')->paginate(30);
        $mesdas=  DB::table('lignebesoin')
            ->Join('users','users.id','=','lignebesoin.id_user')
            ->leftJoin('materiel','materiel.id','=','lignebesoin.id_materiel')
            ->leftJoin('devis','devis.id_da','=','lignebesoin.id')
            ->leftJoin('fournisseur','fournisseur.id','=','devis.id_fournisseur')
            ->leftJoin('boncommande','boncommande.id','=','lignebesoin.id_bonCommande')
            ->leftJoin('gestion','gestion.id','=','lignebesoin.id_codeGestion')
            ->where('users.id','=',\Illuminate\Support\Facades\Auth::user()->id)->orderBy('lignebesoin.created_at', 'DESC')
            ->select('lignebesoin.id','lignebesoin.unite','lignebesoin.quantite','DateBesoin','lignebesoin.id_user','id_nature','lignebesoin.id_materiel','lignebesoin.created_at','demandeur','lignebesoin.slug','lignebesoin.etat','id_valideur','motif','usage','lignebesoin.commentaire','dateConfirmation','date_livraison_eff','code_analytique','codeRubrique',DB::raw('fournisseur.libelle as libelle_fournisseur'),'numBonCommande','boncommande.date','lignebesoin.id_codeGestion','gestion.codeGestion')->paginate(30);

        $da = DA::where('slug', '=', $slug)->first();
        $domaines=  DB::table('domaines')->get();
        $fournisseurs=Fournisseur::all();
        $materiels=Materiel::all();
        $service_users=DB::table('users')
            ->leftJoin('services', 'services.id', '=', 'users.service')
            ->select('users.id','nom','prenoms','services.libelle','users.service')->get();
        $natures= Nature::all();
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
        $tracemails= DB::table('trace_mail')->get();

        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }

        Log::info('ip :'.$ip.'; Machine: '.$nommachine.'; Consultation de la D.A '.$da->id, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return view('DA/gestion_da',compact('das','fournisseurs','materiels','natures','da','service_users','domaines','tab_unite','tracemails','gestions','mesdas'));
    }
    public function afficher_image($id)
    {

       $materiel=Materiel::where('id','=',$id)->first();

        return $materiel->image;
    }
    public function code_gestion_produit($id)
    {

       $materiel=Materiel::where('id','=',$id)->first();

        return $materiel->id_codeGestion;
    }
    public function adapter()
    {
        /*
        $familles = Famille::all();
        $designations = Designation::all();


        foreach($designations as $design):
            $mafamille=Famille::where('libelle','=',$design->id_famille)->first();
            if(isset($mafamille)){

                $design->id_famille= $mafamille->id;
                $design->save();
            }

        endforeach;
        dd($designations);
        */
        $familles = Famille::all();

        foreach($familles as $famille):
            $mondomaine=Domaines::where('libelleDomainne','=',$famille->id_domaine)->first();
            if(isset($mondomaine)){

                $famille->id_domaine= $mondomaine->id;
                $famille->save();
            }

        endforeach;
        dd($familles);
    }

    public function supprimer_da($slug)
    {
        $da = DA::where('slug', '=', $slug)->first();
        $idda=$da->id;
     //   $devis=Devis::where('id_da',$da->id)->first();
        $da->delete();

        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }

        Log::info('ip :'.$ip.'; Machine: '.$nommachine.'; suppression de la D.A '.$idda, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return redirect()->route('gestion_da')->with('success', "La demande d'approvisionnement a bien été supprimée");
    }

    /**
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function confirmer_da($locale,$slug)
    {
        $da = DA::where('slug', '=', $slug)->first();

        if (isset(Auth::user()->id)) {
            $da->id_valideur= Auth::user()->id ;

        }
  /*
        $daa = DB::table('lignebesoin')
            ->join('materiel','materiel.id','=','lignebesoin.id_materiel')
            ->select('libelleMateriel','id_user')->get()->first();
        $user=User::where('id','=',$daa->id_user)->first();
        $da = DA::where('id', '=', $da->id)->first();
        if($da->etat==0){
            Mail::send('mail/mail_action_da',array('da' =>$da,'etat' =>2,'libelleMateriel'=>$daa->libelleMateriel),function($message)use ($user){
                $message->from(\Illuminate\Support\Facades\Auth::user()->email ,\Illuminate\Support\Facades\Auth::user()->name )
                    ->to($user->email)
                    ->subject("Confirmation de la demande d'achat préalablement refusée");

            });
        }
*/
        $da->etat=2;

        $date = new \DateTime(null);
        $da->motif="";
        $da->dateConfirmation=$date->format('Y-m-d H:i:s');
        $da->save();

        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.'; confirmaion de la D.A '.$da->id, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return redirect()->route('encours_validation')->with('success', "La demande d'approvisionnement a bien été confirmée");

    }

    public function confirmer_da_depuis_creermodifier_da($slug)
    {
        $da = DA::where('slug', '=', $slug)->first();

        if (isset(Auth::user()->id)) {
            $da->id_valideur= Auth::user()->id ;

        }
        /*
              $daa = DB::table('lignebesoin')
                  ->join('materiel','materiel.id','=','lignebesoin.id_materiel')
                  ->select('libelleMateriel','id_user')->get()->first();
              $user=User::where('id','=',$daa->id_user)->first();
              $da = DA::where('id', '=', $da->id)->first();
              if($da->etat==0){
                  Mail::send('mail/mail_action_da',array('da' =>$da,'etat' =>2,'libelleMateriel'=>$daa->libelleMateriel),function($message)use ($user){
                      $message->from(\Illuminate\Support\Facades\Auth::user()->email ,\Illuminate\Support\Facades\Auth::user()->name )
                          ->to($user->email)
                          ->subject("Confirmation de la demande d'achat préalablement refusée");

                  });
              }
      */
        $da->etat=2;

        $date = new \DateTime(null);
        $da->motif="";
        $da->dateConfirmation=$date->format('Y-m-d H:i:s');
        $da->save();

        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.'; confirmaion de la D.A '.$da->id, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return redirect()->route('creer_da')->with('success', "La demande d'approvisionnement a bien été confirmée");

    }

    public function refuser_da(Request $request)
    {
        $parameters = $request->except(['_token']);
        $da = DA::where('id', '=', $parameters['id'])->first();
        $daa = DB::table('lignebesoin')
            ->join('materiel','materiel.id','=','lignebesoin.id_materiel')
            ->where("lignebesoin.id",'=',$da->id)
            ->select('libelleMateriel','id_user')->get()->first();

     $user=User::where('id','=',$da->id_user)->first();
        if (isset(Auth::user()->id)) {
            $da->id_valideur= Auth::user()->id ;

        }
        $da->etat=0;
        $da->motif=$parameters['motif'];

        $date = new \DateTime(null);
        $da->dateConfirmation=$date->format('Y-m-d h:m:s');
        $da->save();
        try{
        Mail::send('mail/mail_action_da',array('da' =>$da,'etat' =>$da->etat,'libelleMateriel'=>$daa->libelleMateriel),function($message)use ($user){
            $message->from(\Illuminate\Support\Facades\Auth::user()->email ,\Illuminate\Support\Facades\Auth::user()->nom )
                ->to($user->email)
                ->subject(strtoupper("Refus de la demande d'achat"));

        });}catch (\Exception $e){

        }
        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.'; refus de la D.A '.$da->id, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);

        return redirect()->route('gestion_da')->with('succes', "La demande d'approvisionnement a bien été refusée");

    }

    public function suspendre_da($slug)
    {
        $da = DA::where('slug', '=', $slug)->first();

        if (isset(Auth::user()->name)) {
            $da->id_valideur= Auth::user()->name ;

        }
        $da->etat=1;



        $date = new \DateTime(null);
        $da->dateConfirmation=$date->format('Y-m-d h:m:s');


        $da->id_valideur="";
        $da->save();

        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.'; suspension de la D.A '.$da->id, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return redirect()->route('gestion_da')->with('success', "la demande d'approvisionnement a bien été suspendue");

    }
    public function modifier_da( Request $request)
    {
        $parameters=$request->except(['_token']);



        $da=  DA::where('slug','=',$parameters['slug'])->first();

        // Fournisseur::create($parameters);
        $date= new \DateTime(null);


        $da->unite = $parameters['unite'];
        $da->id_codeGestion = $parameters['id_codeGestion'];
        $da->quantite = $parameters['quantite'];
        $da->DateBesoin = $parameters['DateBesoin'];
        $da->id_user = $parameters['id_user'];

        $da->id_nature = $parameters['id_nature'];
        $da->id_materiel = $parameters['id_materiel'];
        $da->commentaire = $parameters['commentaire'];
        $da->usage = $parameters['usage'];
        $da->demandeur = $parameters['demandeur'];
        $da->slug = Str::slug($parameters['id_materiel'] . $date->format('Y-m-d h:m:s'));
        $da->save();

        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.'; Modification  de la D.A '.$da->id, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return redirect()->route('creer_da')->with('success',"La demande d'approvisionnement a été mise à jour");
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
}
