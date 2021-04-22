<?php
/**
 * Created by PhpStorm.
 * User: ckodia
 * Date: 30/03/2021
 * Time: 15:02
 */

namespace App\Imports;


use App\Designation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DesignationImport implements ToModel,WithHeadingRow
{

    public function model(array $row)
    {
       // dd($row);


        $laclasse="";
        if(isset($row['libelle'])){
            $designation = Designation::where('libelle','=',$row['libelle'])->first();
            if(isset($designation)){

                $designation->code_comptable=$row['compte_comptable'];
                $designation->code_analytique=$row['code_rubrique'];
                $designation->save();
                return $designation;
            }
        }


    }
}
