<?php
/**
 * Created by PhpStorm.
 * User: ckodia
 * Date: 06/04/2021
 * Time: 10:20
 */

namespace App\Imports;

use App\Fournisseur;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Metier\Json\Contact;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class FournisseurImport implements ToModel,WithHeadingRow
{

    public function model(array $row)
    {
         //dd($row);


        $laclasse="";
        if(isset($row['libelle'])){
            $fourniseeur = Fournisseur::where('libelle','=',$row['libelle'])->where('id_projet','=',$GLOBALS['id_projet'])->first();
            if(!isset($fourniseeur)){

        $contacts = new Collection();
      $contact = new Contact();

        if($row['email_interlocuteur']!=""  ){
            $contact->titre_c = $row['interlocuteur'];
            $contact->type_c = $row['type_interlocuteur'];
            $contact->valeur_c = $row['email_interlocuteur'];
            $contacts->add($contact);

        }
        if($row['email_interlocuteur']!=""){
          $contact->titre_c = $row['interlocuteur1'];
          $contact->type_c = $row['type_interlocuteur1'];
          $contact->valeur_c = $row['email_interlocuteur1'];
          $contacts->add($contact);
        }


      $domaines= array();
      if($row['domaine']!=""){
        $domaines[]= $row['domaine'];
      }
      if($row['domaine']!=""){
        $domaines[]= $row['domaine2'];
      }
      if($row['domaine']!=""){
        $domaines[]= $row['domaine3'];
      }

      $date= new \DateTime(null);
  //$raw = $request->except("_token", "valeur_c", "type_c", "titre_c");
  $raw["contact"] = json_encode($contacts->toArray());


                $fournisseur = new Fournisseur();
                $fournisseur->libelle=$row['libelle'];
                $fournisseur->responsable=$row['responsable'];
                $fournisseur->email=$row['email'];
                $fournisseur->conditionPaiement=$row['condition_paiement'];
                $fournisseur->adresseGeographique=$row['Adresse_geographique'];
                $fournisseur->contact=$raw["contact"];
                $fournisseur->domaine=implode(',',$domaines);
                $fournisseur->id_projet=$GLOBALS['id_projet'];
                $fournisseur->slug= Str::slug($row['libelle'].$date->format('dmYhis'));

                $fournisseur->save();
                return $fournisseur;
            }
        }


    }
}
