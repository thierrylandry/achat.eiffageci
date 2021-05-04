<?php

namespace App\Http\Controllers;

use App\Pays;
use App\Projet;
use App\Devise;
use App\Languages;
use App\TypeValidation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProjectController extends Controller
{
    //
     public static function check_projet_access(){
       $id_projet= Session::get('id_projet');

        $leprojet=Projet::find($id_projet);
        $liste_projet_objs=Auth::user()->projets()->get();
        $liste_projets=array();
        foreach($liste_projet_objs as $obj):
            $liste_projets[]=$obj->libelle;
        endforeach;

        if(isset($leprojet->libelle) && in_array($leprojet->libelle,$liste_projets,true)){
           //
            return $leprojet;
        }elseif(!isset($leprojet->libelle) && !empty($liste_projets)){

            $leprojet= Projet::where('libelle','=',$liste_projets[0])->first();
            session(['id_projet' => $leprojet->id]);
            return $leprojet;

        }else{
            return null;
        }

    }

    public function gestion_projets($locale){

        $projets  = Projet::all();
        $devises = Devise::all();
        $languages = Languages::all();
        $typesValidations = TypeValidation::all();
        $payss =Pays::all();
        $listeusers = User::all();
        $users = array();
        foreach($listeusers as $user):
            if($user->hasRole('Gestionnaire_Pro_Forma')){
                $users[]=$user;
            }
            endforeach;


        return view('projets/projet',compact('projets','payss','devises','languages','typesValidations','users'));
    }
    public function modifier_projets($locale,$id){

        $projet = Projet::find($id);
        $projets  = Projet::all();
        $devises = Devise::all();
        $languages = Languages::all();
        $typesValidations = TypeValidation::all();
        $payss =Pays::all();
        $listeusers = User::all();
        $users = array();
        foreach($listeusers as $user):
            if($user->hasRole('Gestionnaire_Pro_Forma')){
                $users[]=$user;
            }
            endforeach;

        return view('projets/projet',compact('projets','payss','projet','devises','languages','typesValidations','users'));
    }
    public function ajouter_projet(Request $request){



        $parameters=$request->except(['_token']);
        //dd($parameters);
        $id_pays = $parameters['id_pays'];
        $libelle= $parameters['libelle'];
        $chantier= $parameters['chantier'];
        $denomination_courte= $parameters['denomination_courte'];
        $denomination_longue= $parameters['denomination_longue'];
        $n_rccm= $parameters['n_rccm'];
        $n_cc= $parameters['n_cc'];
        $siege_social= $parameters['siege_social'];
        $portEPIObligatoire= $parameters['portEPIObligatoire'];
        $adresse_geographique= $parameters['adresse_geographique'];
        $adressePostale= $parameters['adressePostale'];
        $adresseReceptionFacture= $parameters['adresseReceptionFacture'];
        $adressePostaleReceptionFacture=$parameters['adressePostaleReceptionFacture'];
        $default_language= $parameters['default_language'];
        $devise= $parameters['devise'];
        $typeValidation= $parameters['typeValidation'];
        $conditionGeneralAchat= $parameters['conditionGeneralAchat'];
        $use_tva= $parameters['use_tva'];
        $valideur= $parameters['valideur'];
        $montant= $parameters['montant'];
        $site_installation= $parameters['site_installation'];
        $denomination = $parameters['denomination'];

        $projet = new Projet();
        $projet->libelle=$libelle;
        $projet->chantier=$chantier;
        $projet->id_pays=$id_pays;
        $projet->site_installation=$site_installation;

        $projet->denomination_courte=$denomination_courte;
        $projet->denomination_longue=$denomination_longue;
        $projet->n_rccm=$n_rccm;
        $projet->n_cc=$n_cc;
        $projet->siege_social=$siege_social;
        $projet->portEPIObligatoire=$portEPIObligatoire;
        $projet->adresseGeographique=$adresse_geographique;
        $projet->adressePostale=$adressePostale;
        $projet->adresseReceptionFacture=$adresseReceptionFacture;
        $projet->adressePostaleReceptionFacture=$adressePostaleReceptionFacture;
        $projet->	defaultLanguage=$default_language;
        $projet->defaultDevise=$devise;
        $projet->typeValidation=$typeValidation;

        $projet->conditionGeneralAchat=$conditionGeneralAchat;
        $projet->use_tva=$use_tva;
        $projet->valideur1=$valideur[0];
        $projet->montant1=$montant[0];
        $projet->valideur2=$valideur[1];
        $projet->montant2=$montant[1];
        $projet->denomination=$denomination;


        $projet->save();
        return redirect()->back()->with('success', "success");
    }
    public function switch_projet(Request $request){
        $parameters=$request->except(['_token']);
        $id_projet = $parameters['id_projet'];

        session(['id_projet' => $id_projet]);
        return redirect()->back()->with('success', "success");
    }
    public function update_projet(Request $request){

        $parameters=$request->except(['_token']);
        //dd($parameters);
        $id = $parameters['id'];
        $id_pays = $parameters['id_pays'];
        $libelle= $parameters['libelle'];
        $chantier= $parameters['chantier'];

        $denomination_courte= $parameters['denomination_courte'];
        $denomination_longue= $parameters['denomination_longue'];
        $n_rccm= $parameters['n_rccm'];
        $n_cc= $parameters['n_cc'];
        $siege_social= $parameters['siege_social'];
        $portEPIObligatoire= $parameters['portEPIObligatoire'];
        $adresse_geographique= $parameters['adresse_geographique'];
        $adressePostale= $parameters['adressePostale'];
        $adresseReceptionFacture= $parameters['adresseReceptionFacture'];
        $adressePostaleReceptionFacture = $parameters['adressePostaleReceptionFacture'];
        $default_language= $parameters['default_language'];
        $devise= $parameters['devise'];
        $typeValidation= $parameters['typeValidation'];
        $conditionGeneralAchat= $parameters['conditionGeneralAchat'];
        $use_tva= $parameters['use_tva'];
        $valideur= $parameters['valideur'];
        $montant= $parameters['montant'];
        $site_installation = $parameters['site_installation'];
        $denomination = $parameters['denomination'];
        $projet =  Projet::find($id);
        $projet->libelle=$libelle;
        $projet->chantier=$chantier;
        $projet->id_pays=$id_pays;
        $projet->site_installation= $site_installation;

        $projet->denomination_courte=$denomination_courte;
        $projet->denomination_longue=$denomination_longue;
        $projet->n_rccm=$n_rccm;
        $projet->n_cc=$n_cc;
        $projet->siege_social=$siege_social;
        $projet->portEPIObligatoire=$portEPIObligatoire;
        $projet->adresseGeographique=$adresse_geographique;
        $projet->adressePostale=$adressePostale;
        $projet->adresseReceptionFacture=$adresseReceptionFacture;
        $projet->adressePostaleReceptionFacture=$adressePostaleReceptionFacture;
        $projet->defaultLanguage=$default_language;
        $projet->defaultDevise=$devise;
        $projet->typeValidation=$typeValidation;

        $projet->conditionGeneralAchat=$conditionGeneralAchat;
        $projet->use_tva=$use_tva;
        $projet->valideur1=$valideur[0];
        $projet->montant1=$montant[0];
        $projet->valideur2=$valideur[1];
        $projet->montant2=$montant[1];
        $projet->denomination=$denomination;

        $projet->save();
        return redirect()->back()->with('success', "success");
    }

}
