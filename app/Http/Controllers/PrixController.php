<?php
/**
 * Created by PhpStorm.
 * User: ckodia
 * Date: 25/10/2018
 * Time: 17:16
 */

namespace App\Http\Controllers;



use App\Materiel;
use App\Tbprix;
use App\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class PrixController
{

    public function prixs()
    {
        $prixs=  Tbprix::all();
        $fournisseurs=Fournisseur::all();
        $materiels=Materiel::all();
        return view('prix/gestion_prix',compact('prixs','fournisseurs','materiels'));
    }
    public function Validprixs( Request $request)
    {
        $parameters = $request->except(['_token']);

        // Fournisseur::create($parameters);
        $date = new \DateTime(null);
        $prix = new Tbprix();
        $prix->prix = $parameters['prix'];
        $prix->unite = $parameters['unite'];
        $prix->date = $parameters['date'];
        $prix->id_fournisseur = $parameters['id_fournisseur'];
        $prix->id_materiel = $parameters['id_materiel'];
        $prix->slug = Str::slug($parameters['prix'] . $date->format('dmYhis'));
        $prix->save();


        return redirect()->route('gestion_prix')->with('success', "success");
    }
    public function voir_prix($slug)
    {
        $prixs = Tbprix::all();
        $prix = Tbprix::where('slug', '=', $slug)->first();
        $fournisseurs=Fournisseur::all();
        $materiels=Materiel::all();
        return view('prix/gestion_prix',compact('prixs','fournisseurs','materiels','prix'));
    }
    public function supprimer_prix($slug)
    {
        $prix = Tbprix::where('slug', '=', $slug)->first();
        $prix->delete();
        return redirect()->route('gestion_prix')->with('success', "success");
    }
    public function modifier_prix( Request $request)
    {

        try{
            $parameters=$request->except(['_token']);



            $prix=  Tbprix::where('slug','=',$parameters['slug'])->first();

            // Fournisseur::create($parameters);
            $date= new \DateTime(null);

            $prix->prix = $parameters['prix'];
            $prix->unite = $parameters['unite'];
            $prix->date = $parameters['date'];
            $prix->id_fournisseur = $parameters['id_fournisseur'];
            $prix->id_materiel = $parameters['id_materiel'];
            $prix->slug = Str::slug($parameters['prix'] . $date->format('dmYhis'));
            $prix->save();
            return redirect()->route('gestion_prix')->with('success',"success");
        }
        catch(\Exception $e){
            // do task when error
            return redirect()->route('gestion_prix')->with('error',"echec de la mise à jours");
        }


    }
    public function alljson(){
        $collections = [];
        return response()->json($collections);
    }
    public function Listefournisseur()
    {
        $fournisseurs=  Tbprix::all();
        var_dump($fournisseurs);
        return redirect()->back();
    }
}