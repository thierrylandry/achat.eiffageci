<?php
/**
 * Created by PhpStorm.
 * User: ckodia
 * Date: 25/10/2018
 * Time: 12:23
 */

namespace App\Http\Controllers;


use App\fournisseur;
use App\Metier\Json\Contact;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class FournisseurController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function fournisseurs()
    {
        $domaines=  DB::table('domaines')->get();
        $fournisseurs=  Fournisseur::all();
        return view('fournisseurs/lister_fournisseur')->with('fournisseurs', $fournisseurs)->with('domaines',$domaines);
    }
    public function modifier_fournisseur($slug)
    {
        $domaines=  DB::table('domaines')->get();
       // $fournisseurs = Fournisseur::all();
        $fournisseur = Fournisseur::where('slug', '=', $slug)->first();
        $contacts= json_decode($fournisseur->contact);
      //  dd($contacts);
        return view('fournisseurs/modifer_fournisseur',compact('fournisseur','domaines','contacts'));
    }

    public function ajouter_fournisseur()
    {
        $domaines=  DB::table('domaines')->get();
        $fournisseurs=  Fournisseur::all();
        return view('fournisseurs/ajouter_fournisseur')->with('fournisseurs',$fournisseurs)->with('domaines',$domaines);
    }
    public function supprimer_fournisseur($slug)
    {
        $fournisseur = Fournisseur::where('slug', '=', $slug)->first();
        $fournisseur->delete();
        return redirect()->route('lister_fournisseurs')->with('success', "le fournisseur a été supprimé");
    }
    public function update_fournisseur( Request $request)
    {
        $parameters=$request->except(['_token']);
// pour enregistrer les contacts multiple
        $contacts = new Collection();



        for($i = 0; $i <= count($request->input("titre_c"))-1; $i++ )
        {
            $contact = new Contact();
            if( !empty($request->input("titre_c")[$i]) || !empty($request->input("valeur_c")[$i])  ){

                $contact->titre_c = $request->input("titre_c")[$i];
                $contact->type_c = $request->input("type_c")[$i];
                $contact->valeur_c = $request->input("valeur_c")[$i];
                $contacts->add($contact);
            }
        }

        $raw = $request->except("_token", "valeur_c", "type_c", "titre_c");
        $raw["contact"] = json_encode($contacts->toArray());




        $fournisseur=  Fournisseur::where('slug','=',$parameters['slug'])->first();

        // Fournisseur::create($parameters);
        $date= new \DateTime(null);

        $fournisseur->libelle=$parameters['libelle'];
        $fournisseur->domaine=implode(',',$parameters['domaine']);
        $fournisseur->conditionPaiement=$parameters['conditionPaiement'];
        $fournisseur->commentaire=$parameters['commentaire'];
        $fournisseur->adresseGeographique=$parameters['adresseGeographique'];
        $fournisseur->responsable=$parameters['responsable'];
        $fournisseur->email=$parameters['email'];
        $fournisseur->contact=$raw["contact"];
        $fournisseur->slug=Str::slug($parameters['libelle'].$date->format('dmYhis'));
        $fournisseur->save();

        $domaines=  DB::table('domaines')->get();
        // $fournisseurs = Fournisseur::all();

        $contacts= json_decode($fournisseur->contact);

        return redirect()->route('lister_fournisseurs')->with('success',"le fournisseur à été mis à jour");
    }
    public function Validfournisseur( Request $request)
    {
        $parameters=$request->except(['_token']);
// pour enregistrer les contacts multiple
        $contacts = new Collection();



        for($i = 0; $i <= count($request->input("titre_c"))-1; $i++ )
        {
            $contact = new Contact();

            if( !empty($request->input("titre_c")[$i]) || !empty($request->input("valeur_c")[$i])  ){

                $contact->titre_c = $request->input("titre_c")[$i];
                $contact->type_c = $request->input("type_c")[$i];
                $contact->valeur_c = $request->input("valeur_c")[$i];
                $contacts->add($contact);
            }

        }

        $raw = $request->except("_token", "valeur_c", "type_c", "titre_c");
        $raw["contact"] = json_encode($contacts->toArray());



// fin -- pour enregistrer les contact multiple
        // Fournisseur::create($parameters);
        $date= new \DateTime(null);
        $fournisseur= new Fournisseur();
        $fournisseur->libelle=$parameters['libelle'];

        $fournisseur->domaine= implode(',',$parameters['domaine']);
        $fournisseur->conditionPaiement=$parameters['conditionPaiement'];
        $fournisseur->commentaire=$parameters['commentaire'];
        $fournisseur->adresseGeographique=$parameters['adresseGeographique'];
        $fournisseur->responsable=$parameters['responsable'];
      //  $fournisseur->interlocuteur=$parameters['interlocuteur'];
        $fournisseur->email=$parameters['email'];
        $fournisseur->contact=$raw["contact"];
        $fournisseur->slug=Str::slug($parameters['libelle'].$date->format('dmYhis'));
        $fournisseur->save();


        return redirect()->route('ajouter_fournisseur')->with('success',"le fournisseur à été ajouté");
    }
    public function alljson(){
        $collections = [];
        return response()->json($collections);
    }
    public function Listefournisseur()
    {
        $fournisseurs=  Fournisseur::all();
        var_dump($fournisseurs);
        return redirect()->back();
    }
}