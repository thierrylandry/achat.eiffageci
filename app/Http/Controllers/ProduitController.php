<?php
/**
 * Created by PhpStorm.
 * User: ckodia
 * Date: 25/10/2018
 * Time: 17:16
 */

namespace App\Http\Controllers;



use App\Designation;
use App\Domaines;
use App\Famille;
use App\Gestion;
use App\Materiel;
use App\Type_designation;
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
    public function domaines(){

        $domaines =Domaines::orderBy('libelleDomainne', 'ASC')->get();
        return view('domaines/domaines',compact('domaines'));
    }
    public function modifier_domaine($locale,$id){

        $domaine =Domaines::find($id);
        $domaines =Domaines::orderBy('libelleDomainne', 'ASC')->get();
        return view('domaines/domaines',compact('domaines','domaine'));
    }
    public function supprimer_domaine($locale,$id){

        $domaine =Domaines::find($id);

        $domaine->delete();
        return redirect()->back()->with('success', "Le domaine a été supprimé avec succès");
    }
    public function familles(){
        $domaines =Domaines::orderBy('libelleDomainne','ASC')->get();

        $familles =Famille::orderBy('libelle', 'ASC')->get();
        return view('familles/familles',compact('familles','domaines'));
    }
    public function designations(){

        $familles =Famille::orderBy('libelle', 'ASC')->get();
        $designations =Designation::orderBy('libelle', 'ASC')->get();
        $type_designations =Type_designation::all();
        $analytiques=  DB::table('analytique')->distinct()->get(['codeRubrique','libelle']);
        return view('designations/designations',compact('familles','designations','type_designations','analytiques'));
    }
    public function modifier_famille($locale,$id){

        $famille =Famille::find($id);
        $familles =Famille::orderBy('libelle', 'ASC')->get();
        $domaines =Domaines::orderBy('libelleDomainne', 'ASC')->get();
        return view('familles/familles',compact('familles','famille','domaines'));
    }
    public function supprimer_famille($locale,$id){

        $famille =Famille::find($id);

        $famille->delete();
        return redirect()->back()->with('success', "La famille a été supprimé avec succès");
    }
    public function modifier_designation($locale,$id){

        $designation =Designation::find($id);
        $familles =Famille::orderBy('libelle', 'ASC')->get();
        $designations =Designation::orderBy('libelle', 'ASC')->get();
        $type_designations =Type_designation::all();
        $analytiques=  DB::table('analytique')->distinct()->get(['codeRubrique','libelle']);
        return view('designations/designations',compact('familles','designation','designations','type_designations','analytiques'));
    }
    public function supprimer_designation($locale,$id){

        $desingation =Designation::find($id);

        $desingation->delete();
        return redirect()->back()->with('success', "La designation a été supprimé avec succès");
    }
    public function menu_produit(){

        return view('produits/menu_produit');
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
    public function update_domaine( Request $request)
    {
        $parameters = $request->except(['_token']);

        $id = $parameters['id'];
        $libelle = $parameters['libelle'];
        $domaine = Domaines::find($id);
        $domaine->libelleDomainne=$libelle;
        $domaine->save();
        // Fournisseur::create($parameters);
        return redirect()->back()->with('success', "Le domaine a été modifié avec succès");
    }
    public function enregistrer_domaine( Request $request)
    {
        $parameters = $request->except(['_token']);
        $libelle = $parameters['libelle'];
        $domaine = new Domaines();
        $domaine->libelleDomainne=$libelle;
        $domaine->save();
        // Fournisseur::create($parameters);
        return redirect()->back()->with('success', "Le domaine a été ajouté");
    }
    public function update_famille( Request $request)
    {
        $parameters = $request->except(['_token']);

        $id = $parameters['id'];
        $libelle = $parameters['libelle'];
        $id_domaine = $parameters['id_domaine'];
        $famille=  Famille::find($id);
        $famille->libelle=$libelle;
        $famille->id_domaine=$id_domaine;
        $famille->save();
        // Fournisseur::create($parameters);
        return redirect()->back()->with('success', "La famille a été ajouté avec succès");
    }
    public function enregistrer_famille( Request $request)
    {
        $parameters = $request->except(['_token']);
        $libelle = $parameters['libelle'];
        $id_domaine = $parameters['id_domaine'];
        $famille= new Famille();
        $famille->libelle=$libelle;
        $famille->id_domaine=$id_domaine;
        $famille->save();
        // Fournisseur::create($parameters);
        return redirect()->back()->with('success', "Le famille a été ajoutée avec succès");
    }
    public function update_designation( Request $request)
    {
        $parameters = $request->except(['_token']);

        $id = $parameters['id'];
        $libelle = $parameters['libelle'];
        $id_famille = $parameters['id_famille'];
        $stockmin = $parameters['stock_min'];
        $type_designation = $parameters['type_designation'];
        $code_analytique = $parameters['code_analytique'];
        $designation=  Designation::find($id);
        $designation->libelle=$libelle;
        $designation->id_famille=$id_famille;
        $designation->stock_min=$stockmin;
        $designation->type_designation=$type_designation;
        $designation->code_analytique=$code_analytique;
        $designation->save();
        // Fournisseur::create($parameters);
        return redirect()->back()->with('success', "La designation a été ajouté avec succès");
    }
    public function enregistrer_designation( Request $request)
    {
        $parameters = $request->except(['_token']);

        $id = $parameters['id'];
        $libelle = $parameters['libelle'];
        $id_famille = $parameters['id_famille'];
        $stockmin = $parameters['stock_min'];
        $type_designation = $parameters['type_designation'];
        $code_analytique = $parameters['code_analytique'];
        $designation=  new Designation();
        $designation->libelle=$libelle;
        $designation->id_famille=$id_famille;
        $designation->stock_min=$stockmin;
        $designation->type_designation=$type_designation;
        $designation->code_analytique=$code_analytique;
        $designation->save();
        // Fournisseur::create($parameters);
        // Fournisseur::create($parameters);
        return redirect()->back()->with('success', "Le famille a été ajoutée avec succès");
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