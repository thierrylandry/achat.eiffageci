<?php
/**
 * Created by PhpStorm.
 * User: ckodia
 * Date: 25/10/2018
 * Time: 17:16
 */

namespace App\Http\Controllers;



use App\Materiel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class ProduitController
{

    public function produits()
    {
        $produits=  Materiel::all();
        $domaines=  DB::table('domaines')->get();
        return view('produits/gestion_produit')->with('produits',$produits)->with('domaines', $domaines);
    }
    public function Validproduits( Request $request)
    {
        $parameters = $request->except(['_token']);

        // Fournisseur::create($parameters);
        $date = new \DateTime(null);
        $produit = new Materiel();
        $produit->libelleMateriel = $parameters['libelleMateriel'];
        $produit->type = $parameters['type'];
        $produit->slug = Str::slug($parameters['libelleMateriel'] . $date->format('dmYhis'));
        $produit->save();


        return redirect()->route('gestion_produit')->with('success', "le produit à été ajouté");
    }
    public function voir_produit($slug)
    {
        $domaines=  DB::table('domaines')->get();
        $produits = Materiel::all();
        $produit = Materiel::where('slug', '=', $slug)->first();
        return view('produits/gestion_produit')->with('produit', $produit)->with('produits', $produits)->with('domaines', $domaines);
    }
    public function supprimer_produit($slug)
    {
        $produit = Materiel::where('slug', '=', $slug)->first();
        $produit->delete();
        return redirect()->route('gestion_produit')->with('success', "le produit a été supprimé");
    }
    public function modifier_produit( Request $request)
    {
        $parameters=$request->except(['_token']);



        $produit=  Materiel::where('slug','=',$parameters['slug'])->first();

        // Fournisseur::create($parameters);
        $date= new \DateTime(null);


        $produit->libelleMateriel = $parameters['libelleMateriel'];
        $produit->type = $parameters['type'];
        $produit->slug = Str::slug($parameters['libelleMateriel'] . $date->format('dmYhis'));
        $produit->save();

        return redirect()->route('gestion_produit')->with('success',"le produit à été mis à jour");
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