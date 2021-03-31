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
            $codtache = CodeTache::where('libelle','=',$row['libelle'])->where('id_projet','=',$GLOBALS['id_projet'])->first();
            if(!isset($codtache)){

                $codetache = new CodeTache();
                $codetache->libelle=$row['libelle'];
                $codetache->description=$row['description'];
                $codetache->id_projet=$GLOBALS['id_projet'];
                $codetache->save();
                return $codetache;
            }
        }


    }
}