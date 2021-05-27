<?php
/**
 * Created by PhpStorm.
 * User: ckodia
 * Date: 25/10/2018
 * Time: 17:16
 */

namespace App\Http\Controllers;

use App\Projet;
use App\Role;
use App\Services;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class UtilisateurController
{

    public function super_utilisateur()
    {
        $utilisateurs=  User::all();
        $services= Services::all();
        $roles=  Role::all();
        $projets =Projet::all();
        return view('superusers/gestion_utilisateur',compact('utilisateurs','roles','services','projets'));
    }

    public function utilisateurs()
    {
        $projet_choisi= ProjectController::check_projet_access();
        $utilisateurs=  User::where('id_projet','=',$projet_choisi->id)->where('id_type_users','=',1)->get();
        $services= Services::all();
        $roles= Role::where('name','<>','Configuration')->get();
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
        $utilisateur->id_projet=session('id_projet');
        $utilisateur->save();
        $roles=$parameters['roles'];
        foreach ($roles as $role):
            $utilisateur->roles()->attach(Role::where('name',$role)->first());
            endforeach;


        return redirect()->back()->with('success', "success");
    }
    public function voir_utilisateur($locale,$slug)
    {
        $projet_choisi= ProjectController::check_projet_access();
        $utilisateurs = User::where('id_projet','=',$projet_choisi->id)->get();
        $utilisateur = User::where('slug', '=', $slug)->first();
        $roles=  Role::where('name','<>','Configuration')->get();
        $services= Services::all();
        return view('utilisateurs/gestion_utilisateur',compact('utilisateurs','utilisateur','roles','services'));
    }
    public function voir_superutilisateur($locale,$slug)
    {
        $projet_choisi= ProjectController::check_projet_access();
        $utilisateurs = User::where('id_projet','=',$projet_choisi->id)->get();
        $utilisateur = User::where('slug', '=', $slug)->first();
        $roles=  Role::all();
        $services= Services::all();
        $projets =Projet::all();
        return view('superusers/gestion_utilisateur',compact('utilisateurs','utilisateur','roles','services','projets'));
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
        return redirect()->back()->with('success', "success");
    }

    public function Validsuperutilisateurs( Request $request)
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
        $utilisateur->id_type_users = $parameters['types_user'];
        $utilisateur->id_projet=$parameters['id_projet'];
        $utilisateur->save();
        $roles=$parameters['roles'];
        $projets=$parameters['projets'];
        foreach ($roles as $role):
            $utilisateur->roles()->attach(Role::where('name',$role)->first());
            endforeach;
        foreach ($projets as $projet):
                $utilisateur->projets()->attach(Projet::where('chantier',$projet)->first());
        endforeach;



        return redirect()->back()->with('success', "success");
    }
        public function modifier_superutilisateur( Request $request)
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
        $utilisateur->id_type_users = $parameters['types_user'];
        if(isset($parameters['id_projet'])){
            $utilisateur->id_projet=$parameters['id_projet'];
        }


        //Hash::needsRehash($parameters['password'])
        //dd("ancien ".$utilisateur->password." nouveau :".$parameters['password']." Qaund on hash sa donne ceci".Hash::check($parameters['password'],$parameters['password']));
          //  dd(Hash::needsRehash($parameters['password']));

        if(Hash::needsRehash($parameters['password'])){

            $utilisateur->password =Hash::make($parameters['password']);
        }

        $utilisateur->slug = Str::slug($parameters['email'] . $date->format('dmYhis'));
        $utilisateur->save();

        $utilisateur->roles()->detach();
        $utilisateur->projets()->detach();

        $roles=$parameters['roles'];
        $projets=$parameters['projets'];
        foreach ($roles as $role):
            $utilisateur->roles()->attach(Role::where('name',$role)->first());
        endforeach;
        foreach ($projets as $projet):
            $utilisateur->projets()->attach(Projet::where('libelle',$projet)->first());
        endforeach;
        return redirect()->back()->with('success',"success");
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
        $utilisateur->id_projet=$parameters['id_projet'];

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
        if($request->file('signature')){
                $utilisateur->signature=$utilisateur->id.'.'.$request->file('signature')->getClientOriginalExtension();
                $path = Storage::putFileAs(
                    'images/users', $request->file('signature'), $utilisateur->signature
                );

        }else{

        }

        //Hash::needsRehash($parameters['password'])
        //dd("ancien ".$utilisateur->password." nouveau :".$parameters['password']." Qaund on hash sa donne ceci".Hash::check($parameters['password'],$parameters['password']));
          //  dd(Hash::needsRehash($parameters['password']));

        if(Hash::needsRehash($parameters['password'])){

            $utilisateur->password =Hash::make($parameters['password']);
        }

        $utilisateur->slug = Str::slug($parameters['email'] . $date->format('dmYhis'));
        $utilisateur->save();


        return redirect()->route('home',$parameters['locale'])->with('success',"success");
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
