<?php
/**
 * Created by PhpStorm.
 * User: ckodia
 * Date: 30/03/2021
 * Time: 15:02
 */

namespace App\Imports;

use App\Code_comptable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CodeComptableImport implements ToModel,WithHeadingRow
{

    public function model(array $row)
    {
       // dd($row['description']);


        $laclasse="";
        if(isset($row['libelle'])){
            $code_comptable = Code_comptable::where('libelle','=',$row['libelle'])->where('code','=',$row['code'])->where('id_pays','=',$GLOBALS['id_pays'])->first();
            if(!isset($code_comptable)){

                $code_comptable = new Code_comptable();
                $code_comptable->code=$row['code'];
                $code_comptable->libelle=$row['libelle'];
                $code_comptable->id_pays=$GLOBALS['id_pays'];
                $code_comptable->save();
                return $code_comptable;
            }
        }


    }
}
