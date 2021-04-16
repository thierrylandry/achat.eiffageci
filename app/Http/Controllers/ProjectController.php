<?php

namespace App\Http\Controllers;

use App\Pays;
use App\Projet;
use App\Devise;
use App\Languages;
use App\TypeValidation;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    //

    public function gestion_projets($locale){

        $projets  = Projet::all();
        $devises = Devise::all();
        $languages = Languages::all();
        $typesValidations = TypeValidation::all();
        $payss =Pays::all();

        return view('projets/projet',compact('projets','payss','devises','languages','typesValidations'));
    }
    public function modifier_projets($locale,$id){

        $projet = Projet::find($id);
        $projets  = Projet::all();
        $devises = Devise::all();
        $languages = Languages::all();
        $typesValidations = TypeValidation::all();
        $payss =Pays::all();
        return view('projets/projet',compact('projets','payss','projet','devises','languages','typesValidations'));
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

        $projet = new Projet();
        $projet->libelle=$libelle;
        $projet->chantier=$chantier;
        $projet->id_pays=$id_pays;

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

        $projet->save();
        return redirect()->back()->with('success', "success");
    }
    public function update_projet(Request $request){

        $parameters=$request->except(['_token']);
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
        $projet =  Projet::find($id);
        $projet->libelle=$libelle;
        $projet->chantier=$chantier;
        $projet->id_pays=$id_pays;

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

        $projet->save();
        return redirect()->back()->with('success', "success");
    }
}
