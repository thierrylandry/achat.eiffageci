<?php
/**
 * Created by PhpStorm.
 * User: ckodia
 * Date: 25/10/2018
 * Time: 17:16
 */

namespace App\Http\Controllers;



use App\DA;
use App\Materiel;
use App\Fournisseur;
use App\Nature;
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
        $das=  DA::orderBy('created_at', 'DESC')->get();
        $natures= Nature::all();
        $users= User::all();
        $domaines=  DB::table('domaines')->get();
        return view('DA/lister_da',compact('das','fournisseurs','materiels','natures','users','domaines'));


    }
    public function creer_da()
    {
        //ici
        $fournisseurs=Fournisseur::all();
        $materiels=Materiel::all();
        $das=  DA::where('id_user','=',\Illuminate\Support\Facades\Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        $natures= Nature::all();
        $users= User::all();
        $domaines=  DB::table('domaines')->get();

        return view('DA/creer_da',compact('das','fournisseurs','materiels','natures','users','domaines'));


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


        return redirect()->route('creer_da')->with('success', "la demande d'approvisionnement a été ajouté");



    }
    public function voir_da($slug)
    {
        $das=  DA::where('id_user','=',\Illuminate\Support\Facades\Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        $da = DA::where('slug', '=', $slug)->first();
        $domaines=  DB::table('domaines')->get();
        $fournisseurs=Fournisseur::all();
        $materiels=Materiel::all();
        $users= User::all();
        $natures= Nature::all();
        return view('DA/gestion_da',compact('das','fournisseurs','materiels','natures','da','users','domaines'));
    }
    public function afficher_image($id)
    {

       $materiel=Materiel::where('id','=',$id)->first();

        return $materiel->image;
    }

    public function supprimer_da($slug)
    {
        $da = DA::where('slug', '=', $slug)->first();
        $da->delete();
        return redirect()->route('gestion_da')->with('success', "la demande d'approvisionnement a bien été supprimé");
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



        $da->motif="";
        $da->save();

        return redirect()->route('gestion_da')->with('success', "la demande d'approvisionnement a bien été confirmé");

    }
    public function refuser_da(Request $request)
    {
        $parameters = $request->except(['_token']);

        $daa = DB::table('lignebesoin')
            ->join('materiel','materiel.id','=','lignebesoin.id_materiel')
            ->select('libelleMateriel','id_user')->get()->first();
        $da = DA::where('id', '=', $parameters['id'])->first();
     $user=User::where('id','=',$daa->id_user)->first();
        if (isset(Auth::user()->id)) {
            $da->id_valideur= Auth::user()->id ;

        }
        $da->etat=0;
        $da->motif=$parameters['motif'];
        $da->save();
        Mail::send('mail/mail_action_da',array('da' =>$da,'etat' =>$da->etat,'libelleMateriel'=>$daa->libelleMateriel),function($message)use ($user){
            $message->from(\Illuminate\Support\Facades\Auth::user()->email ,\Illuminate\Support\Facades\Auth::user()->nom )
                ->to($user->email)
                ->subject("Refus de la demande d'achat");

        });
        return redirect()->route('gestion_da')->with('succes', "la demande d'approvisionnement a bien été refusé");

    }

    public function suspendre_da($slug)
    {
        $da = DA::where('slug', '=', $slug)->first();

        if (isset(Auth::user()->name)) {
            $da->id_valideur= Auth::user()->name ;

        }
        $da->etat=1;
        $da->id_valideur="";
        $da->save();
        return redirect()->route('gestion_da')->with('success', "la demande d'approvisionnement a bien été suspendu");

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
        $da->slug = Str::slug($parameters['id_materiel'] . $date->format('dmYhis'));
        $da->save();

        return redirect()->route('creer_da')->with('success',"la demande d'approvisionnement a été mis à jour");
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