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
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class DAController
{

    public function das()
    {
        $fournisseurs=Fournisseur::all();
        $materiels=Materiel::all();
        $das=  DA::all();
        $natures= Nature::all();
        $users= User::all();
        $domaines=  DB::table('domaines')->get();
        return view('DA/gestion_da',compact('das','fournisseurs','materiels','natures','users','domaines'));


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
        //$da->id_bonommande = $parameters['id_bonommande'];
        $da->demandeur = $parameters['demandeur'];
        $da->slug = Str::slug($parameters['id_materiel'] . $date->format('dmYhis'));
        $da->save();


        return redirect()->route('gestion_da')->with('success', "la demande d'approvisionnement a été ajouté");



    }
    public function voir_da($slug)
    {
        $das = DA::all();
        $da = DA::where('slug', '=', $slug)->first();
        $domaines=  DB::table('domaines')->get();
        $fournisseurs=Fournisseur::all();
        $materiels=Materiel::all();
        $users= User::all();
        $natures= Nature::all();
        return view('DA/gestion_da',compact('das','fournisseurs','materiels','natures','da','users','domaines'));
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

        if (isset(Auth::user()->name)) {
            $da->id_valideur= Auth::user()->name ;

        }
        $da->etat=2;
        $da->save();
        return redirect()->route('gestion_da')->with('success', "la demande d'approvisionnement a bien été confirmé");

    }
    public function refuser_da($slug)
    {
        $da = DA::where('slug', '=', $slug)->first();

        if (isset(Auth::user()->name)) {
            $da->id_valideur= Auth::user()->name ;

        }
        $da->etat=0;
        $da->save();
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
        //$da->id_bonommande = $parameters['id_bonommande'];
        $da->demandeur = $parameters['demandeur'];
        $da->slug = Str::slug($parameters['id_materiel'] . $date->format('dmYhis'));
        $da->save();

        return redirect()->route('gestion_da')->with('success',"la demande d'approvisionnement a été mis à jour");
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