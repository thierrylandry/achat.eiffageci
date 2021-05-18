<?php

namespace App\Http\Controllers;

use App\Imports\CodeanalytiqueImport;
use App\Imports\CodeComptableImport;
use App\Imports\CodetacheImport;
use App\Imports\DesignationImport;
use App\Imports\FournisseurImport;
use App\Pays;
use App\Projet;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;


class ExportImportController extends Controller
{
    //
    public function signature($locale,$id){

        $projet = Projet::find($id);
        return view('importations.signature',compact('projet'));
    }
    public function gestion_importation($locale,$id){

        $id_projet = $id;
        return view('importations.menu_importation',compact('id_projet'));
    }
    public function importation_code_tache($locale,$id_projet){
        return view('importations.importation_code_tache',compact('id_projet'));
    }
    public function importation_codeanalytique($locale,$id_projet){
        return view('importations.importation_codeanalytique',compact('id_projet'));
    }
    public function importation_fournisseur($locale,$id_projet){
        return view('importations.importation_fournisseur',compact('id_projet'));
    }
    public function importation_plan_comptable($locale){
        $payss = Pays::all();
        return view('importations.import_plan_comptable',compact('payss'));
    }

    public function importation_designation($locale){

        return view('importations.importation_designation');
    }
    public function import_code_comptable(Request $request){

        $parameters = $request->except(['_token']);

        $excel=$parameters['excel'];
        $GLOBALS['id_pays']=$parameters['id_pays'];
       // Excel::import(new CodetacheImport(),request()->file('excel'),null,\Maatwebsite\Excel\Excel::CSV);

        try{
            Excel::import(new CodeComptableImport(),request()->file('excel'),null,\Maatwebsite\Excel\Excel::XLSX);
        }catch (Exception $exception){
           //dd($exception->getMessage());
            return "format incorrect veuillez selectionner un fichier excel au format XLSX";
        }

        return redirect()->back()->with('success', "success");
    }
    public function signature_update(Request $request){

        $parameters = $request->except(['_token']);

        $type_signature=$parameters['type_signature'];
        $id_projet=$parameters['id_projet'];

        $projet= Projet::find($id_projet);

        try{
            if($request->file('signature')){

                if($type_signature==1){
                    $projet->signature1=$projet->id.$type_signature.'.'.$request->file('signature')->getClientOriginalExtension();

                }else{
                    $projet->signature2=$projet->id.$type_signature.'.'.$request->file('signature')->getClientOriginalExtension();
                }
                $projet->save();
                $path = Storage::putFileAs(
                    'images', $request->file('signature'), $projet->id.$type_signature.'.'.$request->file('signature')->getClientOriginalExtension()
                );
            }else{

            }
        }catch (Exception $exception){
           //dd($exception->getMessage());
            return "format incorrect veuillez selectionner un fichier Image";
        }

        return redirect()->back()->with('success', "success");
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
    public function import_designation(Request $request){

        $parameters = $request->except(['_token']);

        $excel=$parameters['excel'];
       // Excel::import(new CodetacheImport(),request()->file('excel'),null,\Maatwebsite\Excel\Excel::CSV);

        try{
            Excel::import(new DesignationImport(),request()->file('excel'),null,\Maatwebsite\Excel\Excel::XLSX);
        }catch (Exception $exception){
           dd($exception->getMessage());
            return "format incorrect veuillez selectionner un fichier excel au format XLSX";
        }

        return redirect()->back()->with('success', "success");
    }
    public function import_code_analytique(Request $request){

        $parameters = $request->except(['_token']);

        $excel=$parameters['excel'];
        $GLOBALS["id_projet"]=$parameters['id_projet'];
       // Excel::import(new CodetacheImport(),request()->file('excel'),null,\Maatwebsite\Excel\Excel::CSV);

        try{
            Excel::import(new CodeanalytiqueImport(),request()->file('excel'),null,\Maatwebsite\Excel\Excel::XLSX);
        }catch (Exception $exception){
           //dd($exception->getMessage());
            return "format incorrect veuillez selectionner un fichier excel au format XLSX";
        }

        return redirect()->back()->with('success', "success");
    }
    public function import_fournisseurs(Request $request){

        $parameters = $request->except(['_token']);

        $excel=$parameters['excel'];
        $GLOBALS["id_projet"]=$parameters['id_projet'];
       // Excel::import(new CodetacheImport(),request()->file('excel'),null,\Maatwebsite\Excel\Excel::CSV);

        try{
            Excel::import(new FournisseurImport(),request()->file('excel'),null,\Maatwebsite\Excel\Excel::XLSX);
        }catch (Exception $exception){
           dd($exception->getMessage());
            return "format incorrect veuillez selectionner un fichier excel au format XLSX";
        }

        return redirect()->back()->with('success', "success");
    }
    public function download_doc($locale,$namefile){
        //$namefile=str_replace('_','.',$namefile);
        // dd($namefile);
        //   dd('document/'.$slug.'/'.$namefile);
        return Storage::download('trame/'. Str::ascii($namefile,'fr'));
    }
}
