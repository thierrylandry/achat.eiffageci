<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Boncommande;
use Illuminate\Support\Facades\Auth;
class NotificationController extends Controller
{
    //
public function mettre_ajour(){


    $daencours= DB::table('lignebesoin')->where('etat','=','1')->count();
    $das= DB::table('lignebesoin')
        ->where('etat','=','2')
        ->orwhere('etat','=','1')->count();
    $Boncommandeencours= Boncommande::where('etat','=','2')->count();
    $montant_bc= DB::table('boncommande')
        ->where('boncommande.etat','=',2)
        ->sum('total_ttc');
    $montant_bct= DB::table('boncommande')
        ->where('boncommande.etat','=',3)
        ->sum('total_ttc');
    $Boncommandes= Boncommande::all()->count();

    $id_user= Auth::user()->id;

    $lesroles= DB::table('roles')
        ->join('user_role','roles.id','=','user_role.role_id')
        ->where('user_role.user_id','=',$id_user)->get();
    $data[]=$daencours;
    $data[]=$das;
    $data[]=$Boncommandeencours;
    $data[]=$Boncommandes;
    $data[]=$montant_bc;
    $data[]=$montant_bct;
    $data['roles']=$lesroles;
    $data['icon']=asset('images/Eiffage_2400_01_colour_RGB.png');
    return $data;

}
}
