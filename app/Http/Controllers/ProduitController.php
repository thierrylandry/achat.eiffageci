<?php
/**
 * Created by PhpStorm.
 * User: ckodia
 * Date: 25/10/2018
 * Time: 17:16
 */

namespace App\Http\Controllers;



use App\Materiel;
use Dompdf\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class ProduitController
{

    public function produits()
    {
        $produits=  Materiel::all();
        $domaines=  DB::table('domaines')->get();
        $analytiques=  DB::table('analytique')->distinct()->get(['codeRubrique','libelle']);
        return view('produits/gestion_produit',compact('produits','domaines','analytiques'));
    }
    public function Validproduits( Request $request)
    {
        $parameters = $request->except(['_token']);

        // Fournisseur::create($parameters);
        $image = $request->file('image');

        $imageName =  $_FILES['image']['name'];
        $date = new \DateTime(null);
        $produit = new Materiel();
        $produit->libelleMateriel = $parameters['libelleMateriel'];
        $produit->type = $parameters['type'];
        $produit->image = $imageName;
        $produit->code_analytique = $parameters['code_analytique'];
        $produit->slug = Str::slug($parameters['libelleMateriel'] . $date->format('dmYhis'));
        $produit->save();



if(isset($_FILES['image']['name'])){
    $image->move(public_path('uploads'),$imageName);
}



        return redirect()->route('gestion_produit')->with('success', "le produit à été ajouté");
    }
    public function voir_produit($slug)
    {
        $domaines=  DB::table('domaines')->get();
        $produits = Materiel::all();
        $produit = Materiel::where('slug', '=', $slug)->first();
        $analytiques=  DB::table('analytique')->distinct()->get(['codeRubrique','libelle']);
      return  view('produits/gestion_produit',compact('produits','domaines','analytiques','produit'));
    }
    public function supprimer_produit($slug)
    {
        $produit = Materiel::where('slug', '=', $slug)->first();
        unlink('uploads/'.$produit->image);

        $produit->delete();
        return redirect()->route('gestion_produit')->with('success', "le produit a été supprimé");
    }
    public function modifier_produit( Request $request)
    {
        $parameters=$request->except(['_token']);



        $produit=  Materiel::where('slug','=',$parameters['slug'])->first();

        // Fournisseur::create($parameters);
        $date= new \DateTime(null);
        $imageName =  $_FILES['image']['name'];
        if($imageName!=""){

            chmod('uploads',777);
            try{
                unlink('uploads/'.$produit->image);
            }catch (Exception $Ex){

            }

            $produit->image=$imageName;
        }
        $produit->libelleMateriel = $parameters['libelleMateriel'];
        $produit->type = $parameters['type'];
        $produit->code_analytique = $parameters['code_analytique'];
        $produit->slug = Str::slug($parameters['libelleMateriel'] . $date->format('dmYhis'));
        $image = $request->file('image');



        $produit->save();

        if(isset($_FILES['image']['name']) && $_FILES['image']['name']!=''){
            $image->move(public_path('uploads'),$imageName);
        }
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