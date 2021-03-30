<?php

namespace App\Http\Controllers;

use App\Imports\CodetacheImport;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportImportController extends Controller
{
    //
    public function gestion_importation($locale,$id){

        $id_projet = $id;
        return view('importations.menu_importation',compact('id_projet'));
    }
    public function importation_code_tache($locale,$id_projet){
        return view('importations.importation_code_tache',compact('id_projet'));
    }
    public function import_code_tache(Request $request){

        $parameters = $request->except(['_token']);

        $excel=$parameters['excel'];
        $GLOBALS["id_projet"]=$parameters['id_projet'];
       // Excel::import(new CodetacheImport(),request()->file('excel'),null,\Maatwebsite\Excel\Excel::CSV);

        try{
            Excel::import(new CodetacheImport(),request()->file('excel'),null,\Maatwebsite\Excel\Excel::XLSX);
        }catch (Exception $exception){
           //dd($exception->getMessage());
            return "format incorrect veuillez selectionner un fichier excel au format XLSX";
        }

        return redirect()->back()->with('success', "success");
    }
}
