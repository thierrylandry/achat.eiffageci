<?php
/**
 * Created by PhpStorm.
 * User: ckodia
 * Date: 25/10/2018
 * Time: 17:16
 */

namespace App\Http\Controllers;



use App\DA;
use App\Mail\Demande_proforma_mail;
use App\mailclass;
use App\Materiel;
use App\Fournisseur;
use App\Nature;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class Demande_proformaController
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
        return view('demande_proformas/gestion_demande_proforma',compact('das','fournisseurs','materiels','natures','users','types'));


    }
    public function envoies( Request $request)
    {

        $parameters = $request->except(['_token']);

        $fourn = $parameters['fourn'];
        $listeDA = $parameters['listeDA'];
        $tab_listeSA = explode(",", $listeDA);
        $corps='';
        $enteetab='<table><th>produits et service</th><th>Quantite</th><th>prix</th>';
        foreach($tab_listeSA as $laDA):
            $das=  DA::find($laDA);

            if(isset($das->id)){
                $materiel=DB::table('materiel')
                    ->where('id', '=', $das->id_materiel)
                    ->select('libelleMateriel')->distinct()->get();
                $corps =$corps." ".$das->quantite." ".$das->unite." de ".$materiel[0]->libelleMateriel." ;";
        }


/*Mail::send('mail.mail',array('corps' =>$corps),function($message){
$message->from('no-reply@procachat.com','procachat')
    ->to('cyriaquekodia@gmail.com','cyriaquekodia')
    ->subject('Demande de proforma');
});*/

        endforeach;

        return view('mail.mail')->with('corps',$corps);

    }

    /**
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function les_das_funct($domaine)
    {
        $types = DB::table('materiel')
            ->where('type', '=', $domaine)
            ->join('lignebesoin', 'materiel.id', '=', 'lignebesoin.id_materiel')
            ->join('nature', 'nature.id', '=', 'lignebesoin.id_nature')
            ->select('lignebesoin.id','lignebesoin.id_materiel','unite','DateBesoin','quantite','demandeur','id_valideur','libelleMateriel','libelleNature','lignebesoin.slug')
            ->distinct()->get();
        $variable="";
        $status="<i class='fa fa-circle' style='color: mediumspringgreen'></i>";

        return response()->json($types);
    //    return response()->json($variable);

    }
    public function les_das_funct($domaine)
    {
        $types = DB::table('materiel')
            ->where('type', '=', $domaine)
            ->join('lignebesoin', 'materiel.id', '=', 'lignebesoin.id_materiel')
            ->join('nature', 'nature.id', '=', 'lignebesoin.id_nature')
            ->select('lignebesoin.id','lignebesoin.id_materiel','unite','DateBesoin','quantite','demandeur','id_valideur','libelleMateriel','libelleNature','lignebesoin.slug')
            ->distinct()->get();
        $variable="";
        $status="<i class='fa fa-circle' style='color: mediumspringgreen'></i>";

        return response()->json($types);
        //    return response()->json($variable);

    }
    public function les_das_fournisseurs_funct($domaine)
    {
        $types = DB::table('fournisseur')
            ->where('domaine', '=', $domaine)
            ->distinct()->get();
        return response()->json($types);

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
}