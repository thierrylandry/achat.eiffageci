<?php
/**
 * Created by PhpStorm.
 * User: ckodia
 * Date: 30/03/2021
 * Time: 15:02
 */

namespace App\Imports;


use App\CodeTache;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CodetacheImport implements ToModel,WithHeadingRow
{

    public function model(array $row)
    {
       // dd($row['description']);


        $laclasse="";
        if(isset($row['libelle'])){
            $codtache = CodeTache::where('libelle','=',$row['libelle'])->first();
            if(!isset($codtache)){

                return new CodeTache([
                    //
                    'libelle' =>$row['libelle'],
                    'description' =>$row['description'],
                    'id_projet' =>$GLOBALS["id_projet"],
                ]);
            }
        }


    }
}