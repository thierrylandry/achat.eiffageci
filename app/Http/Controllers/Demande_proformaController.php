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
use App\domaines;
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
        $trace_mails= DB::table('trace_mail')
            ->select('trace_mail.id','das','trace_mail.created_at','rappel','trace_mail.email','id_fournisseur')->orderBy('trace_mail.created_at', 'DESC')->get();


        return view('demande_proformas/gestion_demande_proforma',compact('das','fournisseurs','materiels','natures','users','types','trace_mails'));


    }
    public function demande_ou_rappel($tab_slug,$list_da){
        // a terminer
dd($list_da);
    }
    public function enregistrer_devis(Request $request)
    {
        $parameters = $request->except(['_token']);

        $res=$parameters['res'];
        $lesId=$parameters['lesId'];
        $lesIdmat=$parameters['lesIdmat'];
        $lesId=explode(',',$lesId);
        $lesIdmat=explode(',',$lesIdmat);
        parse_str($res,$tab);
        $i=0;
        foreach($lesId as $id){
            if($id!=="undefined" && $tab["row_n_".$id."_titre_ext"]!="" && $tab["row_n_".$id."_fournisseur"]!="" && $tab["row_n_".$id."_prix_unitaire"]!=""){
                $devis = new Devis();
                $devis->titre_ext=$tab["row_n_".$id."_titre_ext"];
                $devis->id_materiel=$lesIdmat[$i];
                $devis->id_fournisseur=$tab["row_n_".$id."_fournisseur"];
                $devis->quantite=$tab["row_n_".$id."_quantite"];
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
                    $devis->quantite=$tab["row_n_".$id."_quantite"];
                   // $devis->id_da=$id;
                    if(isset($tab["row_n_".$id."_tva"]) && $tab["row_n_".$id."_tva"]!=""){
                        $devis->hastva=$tab["row_n_".$id."_tva"];
                    }else{
                        $devis->hastva=0;
                    }
                    //$devis->remise=$tab["row_n_".$id."_remise"];
                    $devis->unite=$tab["row_n_".$id."_unite"];

                    if( $tab["row_n_".$id."_codeRubrique"]!=""){
                        $devis->codeRubrique=$tab["row_n_".$id."_codeRubrique"];
                    }
                    if(isset($tab["row_n_".$id."_remise"]) && $tab["row_n_".$id."_remise"]!=""){
                        $devis->remise=$tab["row_n_".$id."_remise"];
                    }else{
                        $devis->remise=0;
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
        return redirect()->route('ajouter_fournisseur')->with('success',"Le fournisseur à été mis à jour");
    }
    public function send_it_personnalisé_ddd(Request $request){
        $parameters=$request->except(['_token']);

        $msg_contenu=$parameters['compose-textarea'];
        $bc_slug=$parameters['bcc'];
        $contact=explode(',',$parameters['To']);
        $bc= DB::table('boncommande')
            ->join('fournisseur', 'boncommande.id_fournisseur', '=', 'fournisseur.id')
            ->join('services', 'services.id', '=', 'boncommande.service_demandeur')
            ->where('boncommande.id','=',$bc_slug)
            ->select('fournisseur.libelle','boncommande.id','numBonCommande','date','boncommande.created_at','services.libelle as libelle_service','contact','commentaire_general','fournisseur.conditionPaiement')->first();

        $devis=DB::table('devis')
            ->join('lignebesoin', 'devis.id_da', '=', 'lignebesoin.id')
            ->where('id_bc','=',$bc->id)
            ->select('titre_ext','devis.quantite','devis.unite','devis.prix_unitaire','devis.remise','devis.prix_tot','devis.codeRubrique','devis.devise','commentaire')->get();
        $taille=sizeof($devis);
        $tothtax = 0;
        if($bc->commentaire_general==''){
            $taille_minim=6;
            $taille_maxim=38;
        }else{
            $taille_minim=5;
            $taille_maxim=37;
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
        $this->dispatch(new EnvoiBcFournisseurPersonnalise($contact,storage_path('bon_commande').'\bon_de_commande_n°'.$bc->numBonCommande.'.pdf',$bc,$images,$msg_contenu) );
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
                $corps[$i] =" - ".$das->quantite." ".$das->unite." de ".$materiel[0]->libelleMateriel;
                $i++;
            }




        endforeach;
        $email='';
       // dd($recup_email);
        if($rappel!="on"){
            $date= new \DateTime(null);
            $date= $date->format("d/m/Y");

            $this->dispatch(new EnvoiMailFournisseur($corps, $precisions, $images, $recup_email,$domaine, $date) );
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

        $Trace_mail= new Tracemail();
        $Trace_mail->id_fournisseur=implode(",", array_unique($tab_fournisseur));
        $Trace_mail->rappel=$rappel;
        $Trace_mail->email=implode(',',$recup_email);
        $Trace_mail->das=implode(',',$corps);
        $Trace_mail->save();

       // return view('mail.mail')->with('corps',$corps);
            return redirect()->route('gestion_demande_proformas')->with('success', "Envoie d'email reussi");
    }

    /**
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function supprimer_def_devis2($id)
    {
        $devi= Devis::find($id);
        if(!empty($devi)){
            $da= Lignebesoin::find($devi->id_da);
            $da->delete();
            $devi->delete();
        }





        return 'ok';
    }
    public function supprimer_def_devis($id)
    {
        $da= Lignebesoin::find($id);
        $da->delete();


        return 'ok';
    }
    public function les_das_funct($domaine)
    {
        $types = DB::table('materiel')
            ->where('type', '=', $domaine)
            ->join('lignebesoin', 'materiel.id', '=', 'lignebesoin.id_materiel')
            ->join('nature', 'nature.id', '=', 'lignebesoin.id_nature')
            ->leftJoin('users', 'users.id', '=', 'lignebesoin.id_valideur')
            ->where('lignebesoin.etat', '=', 2)
            ->select('lignebesoin.id','lignebesoin.id_materiel','unite','DateBesoin','quantite','demandeur','users.nom','users.prenoms','libelleMateriel','libelleNature','lignebesoin.slug','lignebesoin.created_at')
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

    public function les_das_fournisseurs_funct($domaine)
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

    public function les_das_fournisseurs_funct_da($id_fournisseur){

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
        $fournisseurs=DB::table('fournisseur')
            ->join('domaines', 'domaines.id', '=', 'fournisseur.domaine')
            ->select('libelle','libelleDomainne','fournisseur.id','fournisseur.domaine')->distinct()->get();
        $materiels=Materiel::all();
        $das= DB::table('materiel')
            ->join('lignebesoin', 'materiel.id', '=', 'lignebesoin.id_materiel')
            ->where('etat', '=', 2)
            ->select('lignebesoin.id', 'lignebesoin.unite', 'lignebesoin.quantite', 'DateBesoin','id_user', 'id_reponse_fournisseur','id_nature', 'lignebesoin.id_materiel', 'id_bonCommande','demandeur','lignebesoin.slug','lignebesoin.etat','id_valideur','motif','code_analytique','type')->distinct()->get();

        $tab_proposition= Array();
        foreach ($das as $d):
            $dev = Devis::where('id_materiel','=',$d->id_materiel)->orderByRaw('devis.id DESC')->get()->first();
            if($dev!=null){
                $tab_proposition[$d->id]=$dev;
            }

        endforeach;
        $natures= Nature::all();
        $users= User::all();
        $domaines=  DB::table('domaines')->get();
        $devis = Devis::where('etat','=',1)->get();
        $analytiques=  DB::table('analytique')->distinct()->get(['codeRubrique','libelle']);
        $unites=Unites::all();
        foreach($unites as $unite):
            if($unite->id==1){
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
        return view('reponse_fournisseur/gestion_reponse_fournisseur',compact('analytiques','das','fournisseurs','materiels','natures','users','domaines','devis','tab_proposition','tab_unite'));


    }

}