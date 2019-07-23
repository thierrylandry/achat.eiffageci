<?php
/**
 * Created by PhpStorm.
 * User: ckodia
 * Date: 25/10/2018
 * Time: 17:16
 */

namespace App\Http\Controllers;



use App\Boncommande;
use App\DA;
use App\Devis;
use App\Materiel;
use App\Fournisseur;
use App\Nature;
use App\Unites;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class DAController
{

    public function das()
    {
        $fournisseurs=Fournisseur::all();
        $materiels=Materiel::all();
        $das=  DA::orderBy('created_at', 'DESC')->paginate(100);
        $natures= Nature::all();
        //    dd($das->bondecommande);
        $service_users=DB::table('users')
            ->leftJoin('services', 'services.id', '=', 'users.service')
            ->select('users.id','nom','prenoms','services.libelle','users.service')->get();
        $domaines=  DB::table('domaines')->get();
        return view('DA/lister_da',compact('das','fournisseurs','materiels','natures','service_users','domaines'));


    }
    public function creer_da()
    {
        //ici
        $fournisseurs=Fournisseur::all();
        $materiels=Materiel::all();
       // $das=  DA::where('id_user','=',\Illuminate\Support\Facades\Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(50);
        $das=  DB::table('lignebesoin')
                ->Join('users','users.id','=','lignebesoin.id_user')
                ->where('users.service','=',\Illuminate\Support\Facades\Auth::user()->service)->orderBy('lignebesoin.created_at', 'DESC')
            ->select('lignebesoin.id','unite','quantite','DateBesoin','id_user','id_nature','id_materiel','lignebesoin.created_at','demandeur','lignebesoin.slug','etat','id_valideur','motif','usage','commentaire','dateConfirmation','date_livraison_eff')->paginate(50);
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
        return view('DA/creer_da',compact('das','fournisseurs','materiels','natures','service_users','domaines','tab_unite'));


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

        $da->id_nature = $parameters['id_nature'];
        $da->id_materiel = $parameters['id_materiel'];
        $da->commentaire = $parameters['commentaire'];
        $da->usage = $parameters['usage'];
        $da->demandeur = $parameters['demandeur'];
        $da->slug = Str::slug($parameters['id_materiel'] . $date->format('dmYhis'));
        $da->save();


        return redirect()->route('creer_da')->with('success', "La demande d'approvisionnement a été ajoutée");



    }
    public function voir_da($slug)
    {
        //$das=  DA::where('id_user','=',\Illuminate\Support\Facades\Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(50);
        $das=  DB::table('lignebesoin')
            ->Join('users','users.id','=','lignebesoin.id_user')
            ->where('users.service','=',\Illuminate\Support\Facades\Auth::user()->service)->orderBy('lignebesoin.created_at', 'DESC')
            ->select('lignebesoin.id','unite','quantite','DateBesoin','id_user','id_nature','id_materiel','lignebesoin.created_at','demandeur','lignebesoin.slug','etat','id_valideur','motif','usage','commentaire','dateConfirmation','date_livraison_eff')->paginate(50);

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
        return view('DA/gestion_da',compact('das','fournisseurs','materiels','natures','da','service_users','domaines','tab_unite'));
    }
    public function afficher_image($id)
    {

       $materiel=Materiel::where('id','=',$id)->first();

        return $materiel->image;
    }

    public function supprimer_da($slug)
    {
        $da = DA::where('slug', '=', $slug)->first();
     //   $devis=Devis::where('id_da',$da->id)->first();
        $da->delete();


        return redirect()->route('gestion_da')->with('success', "La demande d'approvisionnement a bien été supprimée");
    }

    /**
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function confirmer_da($slug)
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

        return redirect()->route('gestion_da')->with('success', "La demande d'approvisionnement a bien été confirmée");

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
        return redirect()->route('gestion_da')->with('success', "la demande d'approvisionnement a bien été suspendue");

    }
    public function modifier_da( Request $request)
    {
        $parameters=$request->except(['_token']);



        $da=  DA::where('slug','=',$parameters['slug'])->first();

        // Fournisseur::create($parameters);
        $date= new \DateTime(null);


        $da->unite = $parameters['unite'];
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