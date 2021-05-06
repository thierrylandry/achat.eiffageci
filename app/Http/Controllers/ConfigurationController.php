<?php

namespace App\Http\Controllers;

use App\Taux_change;
use Exception;
use Illuminate\Http\Request;

use function GuzzleHttp\json_decode;

class ConfigurationController extends Controller
{
    //
    public function configuration($locale){

        return view('configuration/gestion');

    }

    public function taux_change($locale){

        try{


        $EUR_XOF = ConfigurationController::donne_moi_le_taux("EUR_XOF");
        }catch( Exception $ex){


        }
        //dd($EUR_XOF);
        try{
        $EUR_USD = ConfigurationController::donne_moi_le_taux('EUR_USD');
        }catch( Exception $ex){


         }
         try{
        $USD_XOF = ConfigurationController::donne_moi_le_taux('USD_XOF');
        }catch( Exception $ex){


        }

        $taux_changes = Taux_change::all();

        return view('taux_change/taux_change',compact('EUR_XOF','EUR_USD','USD_XOF','taux_changes'));
    }
    public  static function donne_moi_le_taux($rapport){

        $ch = 'http://free.currconv.com/api/v7/convert?q='.$rapport.'&compact=ultra&apiKey=70d29bc945007a293ffd';
       // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// get the (still encoded) JSON data:
        $json = $result = file_get_contents($ch);

// Decode JSON response:
        $conversionResult = json_decode($json,true);
//dd($conversionResult);
        return reset($conversionResult);
    }
    public function ajouter_taux_change(Request $request){

        $parameters=$request->except(['_token']);
        $EUR_XOF = $parameters['EUR_XOF'];
        $EUR_USD  = $parameters['EUR_USD'];
        $USD_XOF  = $parameters['USD_XOF'];
        $date= $parameters['date'];

        $taux = new Taux_change();
        $taux->EUR_XOF=$EUR_XOF;
        $taux->EUR_USD=$EUR_USD;
        $taux->USD_XOF=$USD_XOF;
        $taux->date=$date;
        $taux->save();
        return redirect()->back()->with('success', "success");
    }

    public function modifier_taux_change($locale,$id){

        $taux_change = Taux_change::find($id);


            $taux_changes = Taux_change::all();

            return view('taux_change/taux_change',compact('taux_changes','taux_change'));
    }
    public function supprimer_taux_change($locale,$id){

        $taux = Taux_change::find($id);
        $taux->delete();
        return redirect()->back()->with('success', "success");
    }

    public function update_taux_change(Request $request){

        $parameters=$request->except(['_token']);
        $EUR_XOF = $parameters['EUR_XOF'];
        $EUR_USD  = $parameters['EUR_USD'];
        $USD_XOF  = $parameters['USD_XOF'];
        $date= $parameters['date'];
        $id= $parameters['id'];

        $taux =  Taux_change::find($id);
        $taux->EUR_XOF=$EUR_XOF;
        $taux->EUR_USD=$EUR_USD;
        $taux->USD_XOF=$USD_XOF;
        $taux->date=$date;
        $taux->save();
        return redirect()->back()->with('success', "success");
    }
}
