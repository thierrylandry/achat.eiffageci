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

class FournisseurImport implements ToModel,WithHeadingRow
{

    public function model(array $row)
    {
         dd($row);


        $laclasse="";
        if(isset($row['libelle'])){
            $fourniseeur = Fournisseur::where('libelle','=',$row['libelle'])->where('id_projet','=',$GLOBALS['id_projet'])->first();
            if(!isset($fourniseeur)){

 "interlocuteur" => "interlocuteur 1"
  "type_interlocuteur" => "Pour devis & BC"
  "email_interlocuteur" => "interlocuteur@gmail.com"
  "interlocuteur1" => "interlocuteur 2"
  "type_interlocuteur1" => "Pour devis & BC"
  "email_interlocuteur1" => "interlocuteur2@gmail.com"
  "domaine" => "Formation"
  "domaine2" => "Matériels de topographie"
  "domaine3" => "Bois"
                $fourniseeur = new Fournisseur();
                $fourniseeur->libelle=$row['libelle'];
                $fourniseeur->responsable=$row['responsable'];
                $fourniseeur->email=$row['email'];
                $fourniseeur->conditionPaiement=$row['condition_paement'];
                $fourniseeur->adresseGeographique=$row['commentaire'];
                $fourniseeur->interlocuteur=$row['interlocuteur'];
                $fourniseeur->interlocuteur=$row['interlocuteur'];
                $fourniseeur->interlocuteur=$row['interlocuteur'];
                $fourniseeur->interlocuteur=$row['interlocuteur'];
                $fourniseeur->interlocuteur=$row['interlocuteur'];
                $fourniseeur->interlocuteur=$row['interlocuteur'];
                $fourniseeur->id_projet=$GLOBALS['id_projet'];
                $fourniseeur->save();
                return $fourniseeur;
            }
        }


    }
}
