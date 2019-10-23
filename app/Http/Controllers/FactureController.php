<?php

namespace App\Http\Controllers;

use App\DA;
use App\Devis;
use App\EtatFacture;
use App\Facture;
use App\Fournisseur;
use App\Lignebesoin;
use App\Materiel;
use App\Nature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FactureController extends Controller
{
    //
    public function Gestion_Facture(){
        $fournisseurs=Fournisseur::all();
        $materiels=Materiel::all();
        $etatFactures =EtatFacture::all();
        //  $das=  DA::orderBy('created_at', 'DESC')->paginate(100);
        $das=  DB::table('lignebesoin')->where('lignebesoin.etat','=',4)
                ->join('boncommande','boncommande.id','=','lignebesoin.id_bonCommande')
               ->select('lignebesoin.id','unite','DateBesoin','lignebesoin.id_user','id_materiel','id_bonCommande','demandeur','lignebesoin.etat','id_valideur','motif','usage','commentaire','date_livraison_eff','lignebesoin.created_at','quantite','dateConfirmation','numBonCommande')
               ->groupBy('id_bonCommande','lignebesoin.id')
               ->orderBy('created_at', 'DESC')
            ->paginate(300);
        //dd($das);
        $natures= Nature::all();
        //  dd($das[0]->bondecommande);
        $service_users=DB::table('users')
            ->leftJoin('services', 'services.id', '=', 'users.service')
            ->select('users.id','nom','prenoms','services.libelle','users.service')->get();
        $domaines=  DB::table('domaines')->get();
        $tracemails= DB::table('trace_mail')->get();



        //trace
        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }

        Log::info('ip :'.$ip.'; Machine: '.$nommachine.'; Page de gestion des factures par user.', ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return view('factures/gestionFacture',compact('das','fournisseurs','materiels','natures','service_users','domaines','tracemails','etatFactures'));


    }

    public function ajouterFacture( Request $request)
    {

        $parameters = $request->except(['_token']);

        $id_facture= $parameters['id_facture'];

//dd($parameters);
        // Fournisseur::create($parameters);
        $date = new \DateTime(null);

        if(is_null($id_facture)) {
            $fac = new Facture();
            $id_da= $parameters['id_da'];
            $da =  DA::find($id_da);
            $devis =Devis::where('id_da','=',$id_da)->first();
            $fac->id_devis = $devis->id;
            $fac->dateRecepFact = $parameters['dateRecepFact'];
            $fac->dateFacturation = $parameters['dateFacturation'];
            $fac->refFacture = $parameters['refFacture'];
            $fac->ctrlbcblFacture = $parameters['ctrlbcblFacture'];

            $fac->montantFacture = $parameters['montantFacture'];
            $fac->commentaires = $parameters['commentaires'];

            $fac->save();
        }else{
            $fac =  Facture::find($id_facture);
           // dd($fac);
            $fac->dateRecepFact = $parameters['dateRecepFact'];
            $fac->dateFacturation = $parameters['dateFacturation'];
            $fac->refFacture = $parameters['refFacture'];
          //  dd($parameters);
            $fac->ctrlbcblFacture = $parameters['ctrlbcblFacture'];

            $fac->montantFacture = $parameters['montantFacture'];
            $fac->commentaires = $parameters['commentaires'];

            $fac->save();
        }


        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        if(is_null($id_facture)) {
            Log::info('ip :' . $ip . '; Machine: ' . $nommachine . '; ajout dune facture: n°fac' . $fac->id . ' .', ['nom et prenom' => Auth::user()->nom . ' ' . Auth::user()->prenom]);
            return redirect()->back()->with('success', "La facture a été ajoutée");
        }else{
            Log::info('ip :' . $ip . '; Machine: ' . $nommachine . '; modifier dune facture: n°fac' . $fac->id . ' .', ['nom et prenom' => Auth::user()->nom . ' ' . Auth::user()->prenom]);
            return redirect()->back()->with('success', "La facture a été modifié");
        }



    }
    public function listfacture($id){

            $da= Lignebesoin::find($id);
        //dd($da);
        $devis =Devis::where('id_da','=',$da->id)->first();

        $factures =Facture::where('id_devis','=',$devis->id)->get();
        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }

        Log::info('ip :'.$ip.'; Machine: '.$nommachine.'; lister les factures de la ligne correspondant au devis N° :'.$devis->id.' par user.', ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);

        return $factures;
    }
    public function afficherfacture($id){
        $facture =Facture::find($id);
        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }

        Log::info('ip :'.$ip.'; Machine: '.$nommachine.'; Afficher la facture n°:'.$id.' par user.', ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);

        return $facture;
    }
    public function supprimerfacture($id){
        $facture=Facture::find($id);
        $facture->delete();
        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }

        Log::info('ip :'.$ip.'; Machine: '.$nommachine.'; Suppression de la facture n°:'.$id.' par user.', ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return redirect()->back()->with('success', "La facture a été Supprimé");

    }
}
