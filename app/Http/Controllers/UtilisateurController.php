<?php
/**
 * Created by PhpStorm.
 * User: ckodia
 * Date: 25/10/2018
 * Time: 17:16
 */

namespace App\Http\Controllers;



use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UtilisateurController
{

    public function utilisateurs()
    {
        $utilisateurs=  User::all();
        $roles=  Role::all();
        return view('utilisateurs/gestion_utilisateur',compact('utilisateurs','roles'));
    }
    public function Validutilisateurs( Request $request)
    {
        $parameters = $request->except(['_token']);

        // Fournisseur::create($parameters);
        $date = new \DateTime(null);
        $utilisateur = new User();
        $utilisateur->name = $parameters['name'];
        $utilisateur->abréviation = $parameters['abréviation'];
        $utilisateur->function = $parameters['function'];
        $utilisateur->email = $parameters['email'];
        $utilisateur->password = Hash::make( $parameters['password']);
        $utilisateur->slug = Str::slug($parameters['email'] . $date->format('dmYhis'));
        $utilisateur->save();
        $roles=$parameters['roles'];
        foreach ($roles as $role):
            $utilisateur->roles()->attach(Role::where('name',$role)->first());
            endforeach;


        return redirect()->route('gestion_utilisateur')->with('success', "l'utilisateur à été ajouté");
    }
    public function voir_utilisateur($slug)
    {
        $utilisateurs = User::all();
        $utilisateur = User::where('slug', '=', $slug)->first();
        $roles=  Role::all();

        return view('utilisateurs/gestion_utilisateur',compact('utilisateurs','utilisateur','roles'));
    }
    public function supprimer_utilisateur($slug)
    {
        $utilisateur = User::where('slug', '=', $slug)->first();
        $utilisateur->roles()->detach();
        $utilisateur->delete();
        return redirect()->route('gestion_utilisateur')->with('success', "l'utilisateur a été supprimé");
    }
    public function modifier_utilisateur( Request $request)
    {
        $parameters=$request->except(['_token']);



        $utilisateur=  User::where('slug','=',$parameters['slug'])->first();

        // Fournisseur::create($parameters);
        $date= new \DateTime(null);


        $utilisateur->name = $parameters['name'];
        $utilisateur->abréviation = $parameters['abréviation'];
        $utilisateur->function = $parameters['function'];
        $utilisateur->email = $parameters['email'];
        $utilisateur->password =Hash::make( $parameters['password']);
        $utilisateur->slug = Str::slug($parameters['email'] . $date->format('dmYhis'));
        $utilisateur->save();

        $utilisateur->roles()->detach();
        $roles=$parameters['roles'];
        foreach ($roles as $role):
            $utilisateur->roles()->attach(Role::where('name',$role)->first());
        endforeach;

        return redirect()->route('gestion_utilisateur')->with('success',"l'utilisateur à été mis à jour");
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