<?php
/**
 * Created by PhpStorm.
 * User: ckodia
 * Date: 25/10/2018
 * Time: 17:16
 */

namespace App\Http\Controllers;



use App\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class ProfilController
{

    public function profils()
    {
        $profils=  Profil::all();
        return view('profiles/gestion_profil')->with('profils',$profils);
    }
    public function Validprofils( Request $request)
    {
        $parameters = $request->except(['_token']);

        // Fournisseur::create($parameters);
        $date = new \DateTime(null);
        $profil = new Profil();
        $profil->libelleProfil = $parameters['libelleProfil'];
        $profil->descriptionProfil = $parameters['description'];
        $profil->slug = Str::slug($parameters['libelleProfil'] . $date->format('dmYhis'));
        $profil->save();


        return redirect()->route('gestion_profil')->with('success', "le profil à été ajouté");
    }
    public function voir_profil($slug)
    {
        $profils = Profil::all();
        $profil = Profil::where('slug', '=', $slug)->first();
        return view('profiles/gestion_profil')->with('profil', $profil)->with('profils', $profils);
    }
    public function supprimer_profil($slug)
    {
        $profil = Profil::where('slug', '=', $slug)->first();
        $profil->delete();
        return redirect()->route('gestion_profil')->with('success', "le profil a été supprimé");
    }
    public function modifier_profil( Request $request)
    {
        $parameters=$request->except(['_token']);



        $profil=  Profil::where('slug','=',$parameters['slug'])->first();

        // Fournisseur::create($parameters);
        $date= new \DateTime(null);


        $profil->libelleProfil = $parameters['libelleProfil'];
        $profil->descriptionProfil = $parameters['description'];
        $profil->slug = Str::slug($parameters['libelleProfil'] . $date->format('dmYhis'));
        $profil->save();

        return redirect()->route('gestion_profil')->with('success',"le profil à été mis à jour");
    }
    public function alljson(){
        $collections = [];
        return response()->json($collections);
    }
    public function Listefournisseur()
    {
        $fournisseurs=  Profil::all();
        var_dump($fournisseurs);
        return redirect()->back();
    }
}