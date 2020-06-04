<?php
/**
 * Created by PhpStorm.
 * User: ckodia
 * Date: 25/10/2018
 * Time: 17:16
 */

namespace App\Http\Controllers;



use App\Gestion;
use App\Materiel;
use Dompdf\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class ProduitController
{

    public function produits()
    {
        $produits=  Materiel::all();
        $domaines=  DB::table('domaines')->get();
        $analytiques=  DB::table('analytique')->distinct()->get(['codeRubrique','libelle']);
        $gestions=  Gestion::all();
        return view('produits/gestion_produit',compact('produits','domaines','analytiques','gestions'));
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
      //  $produit->id_codeGestion = $parameters['id_codeGestion'];
        $produit->slug = Str::slug($parameters['libelleMateriel'] . $date->format('dmYhis'));
        $produit->save();



if(isset($_FILES['image']['name']) && $_FILES['image']['name']!="" ){
    $image->move(public_path('uploads'),$imageName);
}


        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.';Ajout du produit '.$produit->libelleMateriel , ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return redirect()->route('gestion_produit')->with('success', "Le produit a été ajouté");
    }
    public function voir_produit($slug)
    {
        $domaines=  DB::table('domaines')->get();
        $produits = Materiel::all();
        $produit = Materiel::where('slug', '=', $slug)->first();
        $analytiques=  DB::table('analytique')->distinct()->get(['codeRubrique','libelle']);
        $gestions=  Gestion::all();
      return  view('produits/gestion_produit',compact('produits','domaines','analytiques','produit','gestions'));
    }
    public function supprimer_produit($slug)
    {
        $produit = Materiel::where('slug', '=', $slug)->first();
        if(file_exists('uploads/'.$produit->image)){
         //   unlink('uploads/'.$produit->image);
        }else{

        }

        $produit->delete();

        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.';Le  produit '.$produit->libelleMateriel , ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);

        return redirect()->route('gestion_produit')->with('success', "Le produit a été supprimé");
    }
    public function modifier_produit( Request $request)
    {
        $parameters=$request->except(['_token']);



        $produit=  Materiel::where('slug','=',$parameters['slug'])->first();

        // Fournisseur::create($parameters);
        $date= new \DateTime(null);
        $imageName =  $_FILES['image']['name'];
        if($imageName!=""){

         //   chmod('uploads',777);
            try{
                if(file_exists('uploads/'.$produit->image)){
             //   unlink('uploads/'.$produit->image);
                }else{

                }
            }catch (Exception $Ex){

            }

            $produit->image=$imageName;
        }
        $produit->libelleMateriel = $parameters['libelleMateriel'];
        $produit->type = $parameters['type'];
        $produit->code_analytique = $parameters['code_analytique'];
       // $produit->id_codeGestion = $parameters['id_codeGestion'];
        $produit->slug = Str::slug($parameters['libelleMateriel'] . $date->format('dmYhis'));
        $image = $request->file('image');



        $produit->save();

        if(isset($_FILES['image']['name']) && $_FILES['image']['name']!=''){
            $image->move(public_path('uploads'),$imageName);
        }
        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.';le  produit a été modifié  id_produit:'.$produit->id.' '.$produit->libelleMateriel , ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return redirect()->route('gestion_produit')->with('success',"Le produit a été mis à jour");
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