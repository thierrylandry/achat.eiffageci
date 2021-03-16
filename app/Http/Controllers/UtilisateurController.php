<?php
/**
 * Created by PhpStorm.
 * User: ckodia
 * Date: 25/10/2018
 * Time: 17:16
 */

namespace App\Http\Controllers;



use App\Role;
use App\Services;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UtilisateurController
{

    public function utilisateurs()
    {
        $utilisateurs=  User::all();
        $services= Services::all();
        $roles=  Role::all();
        return view('utilisateurs/gestion_utilisateur',compact('utilisateurs','roles','services'));
    }
    public function Validutilisateurs( Request $request)
    {
        $parameters = $request->except(['_token']);

        // Fournisseur::create($parameters);
        $date = new \DateTime(null);
        $utilisateur = new User();
        $utilisateur->nom = $parameters['nom'];
        $utilisateur->prenoms = $parameters['prenoms'];
        $utilisateur->abréviation = $parameters['abréviation'];
        $utilisateur->function = $parameters['function'];
        $utilisateur->email = $parameters['email'];
        $utilisateur->password = Hash::make( $parameters['password']);
        $utilisateur->contact =$parameters['contact'];
        $utilisateur->service = $parameters['id_service'];
        $utilisateur->slug = Str::slug($parameters['email'] . $date->format('dmYhis'));
        $utilisateur->save();
        $roles=$parameters['roles'];
        foreach ($roles as $role):
            $utilisateur->roles()->attach(Role::where('name',$role)->first());
            endforeach;


        return redirect()->back()->with('success', "success");
    }
    public function voir_utilisateur($locale,$slug)
    {
        $utilisateurs = User::all();
        $utilisateur = User::where('slug', '=', $slug)->first();
        $roles=  Role::all();
        $services= Services::all();
        return view('utilisateurs/gestion_utilisateur',compact('utilisateurs','utilisateur','roles','services'));
    }

    public function monprofile($locale,$slug)
    {
        $utilisateur = User::where('slug', '=', $slug)->first();
        $roles=  Role::all();
        $services= Services::all();
        return view('utilisateurs/profile',compact('utilisateur','roles','services'));
    }
    public function supprimer_utilisateur($locale,$slug)
    {
        $utilisateur = User::where('slug', '=', $slug)->first();
        $utilisateur->roles()->detach();
        $utilisateur->delete();
        return redirect()->route('gestion_utilisateur')->with('success', "success");
    }
    public function modifier_utilisateur( Request $request)
    {
        $parameters=$request->except(['_token']);



        $utilisateur=  User::where('slug','=',$parameters['slug'])->first();

        // Fournisseur::create($parameters);
        $date= new \DateTime(null);


        $utilisateur->nom = $parameters['nom'];
        $utilisateur->prenoms = $parameters['prenoms'];
        $utilisateur->abréviation = $parameters['abréviation'];
        $utilisateur->function = $parameters['function'];
        $utilisateur->email = $parameters['email'];
        $utilisateur->contact =$parameters['contact'];
        $utilisateur->service = $parameters['id_service'];

        //Hash::needsRehash($parameters['password'])
        //dd("ancien ".$utilisateur->password." nouveau :".$parameters['password']." Qaund on hash sa donne ceci".Hash::check($parameters['password'],$parameters['password']));
          //  dd(Hash::needsRehash($parameters['password']));

        if(Hash::needsRehash($parameters['password'])){

            $utilisateur->password =Hash::make($parameters['password']);
        }

        $utilisateur->slug = Str::slug($parameters['email'] . $date->format('dmYhis'));
        $utilisateur->save();

        $utilisateur->roles()->detach();

        $roles=$parameters['roles'];
        foreach ($roles as $role):
            $utilisateur->roles()->attach(Role::where('name',$role)->first());
        endforeach;

        return redirect()->back()->with('success',"success");
    }
    public function modifier_profile( Request $request)
    {
        $parameters=$request->except(['_token']);

      //  dd($request);

        $utilisateur=  User::where('slug','=',$parameters['slug'])->first();

        // Fournisseur::create($parameters);
        $date= new \DateTime(null);


        $utilisateur->nom = $parameters['nom'];
        $utilisateur->prenoms = $parameters['prenoms'];
        $utilisateur->abréviation = $parameters['abréviation'];
        $utilisateur->function = $parameters['function'];
        $utilisateur->contact =$parameters['contact'];

        //Hash::needsRehash($parameters['password'])
        //dd("ancien ".$utilisateur->password." nouveau :".$parameters['password']." Qaund on hash sa donne ceci".Hash::check($parameters['password'],$parameters['password']));
          //  dd(Hash::needsRehash($parameters['password']));

        if(Hash::needsRehash($parameters['password'])){

            $utilisateur->password =Hash::make($parameters['password']);
        }

        $utilisateur->slug = Str::slug($parameters['email'] . $date->format('dmYhis'));
        $utilisateur->save();


        return redirect()->route('home',app()->getLocale())->with('success',"success");
    }
    public function alljson(){
        $collections = [];
        return response()->json($collections);
    }
    public function Listefournisseur()
    {
        $fournisseurs=  User::all();
        var_dump($fournisseurs);
        return redirect()->back();
    }
}