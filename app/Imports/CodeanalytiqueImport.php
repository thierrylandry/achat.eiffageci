<?php
/**
 * Created by PhpStorm.
 * User: ckodia
 * Date: 06/04/2021
 * Time: 10:20
 */

namespace App\Imports;


use App\Analytique;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CodeanalytiqueImport implements ToModel,WithHeadingRow
{

    public function model(array $row)
    {
         //dd($row['coderubrique']);


        $laclasse="";
        if(isset($row['libelle'])){
            $code_analytique = Analytique::where('codeRubrique','=',$row['coderubrique'])->where('id_projet','=',$GLOBALS['id_projet'])->first();
            if(!isset($code_analytique)){

                $code_analytique = new Analytique();
                $code_analytique->libelle=$row['libelle'];
                $code_analytique->codeRubrique=$row['coderubrique'];
                $code_analytique->id_projet=$GLOBALS['id_projet'];
                $code_analytique->save();
                return $code_analytique;
            }
        }


    }
}