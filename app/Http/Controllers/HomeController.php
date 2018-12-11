<?php

namespace App\Http\Controllers;

use App\Boncommande;
use App\DA;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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

        return view('home',compact('daencours','das','Boncommandeencours','Boncommandes','montant_bc','montant_bct'));
    }
    public function profiles()
    {
        return view('profiles/profiles');
    }
}
