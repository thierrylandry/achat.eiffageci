<?php

namespace App\Http\Controllers;

use App\Boncommande;
use App\DA;
use App\Vardiag;
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
$Boncommandeencours= Boncommande::where('etat','=','1')->count();
$montant_bc= DB::table('boncommande')
    ->where('boncommande.etat','=',4)
    ->sum('total_ttc');
        $montant_bct= DB::table('boncommande')
            ->where('boncommande.etat','=',11)
            ->sum('total_ttc');
$Boncommandes= Boncommande::all()->count();




        $fournisseur_sollicie_tab = DB::table('boncommande')
            ->groupBy('fournisseur.id')
            ->join('fournisseur','fournisseur.id','=','boncommande.id_fournisseur')
            ->select('fournisseur.libelle',DB::raw('count(boncommande.id) as nb'))
            ->get();

        $fournisseur_sollicie= Array();
        foreach ($fournisseur_sollicie_tab as $group):
            $vardiag = New Vardiag();
            $vardiag->name=$group->libelle;
            $vardiag->y=$group->nb;

            $fournisseur_sollicie[]=$vardiag;
        endforeach;

        $fournisseur_retour_tab = DB::table('boncommande')
            ->groupBy('fournisseur.id')
            ->join('fournisseur','fournisseur.id','=','boncommande.id_fournisseur')
            ->where('etat','=',11)
            ->select('fournisseur.libelle',DB::raw('count(boncommande.id) as nb'))
            ->get();

        $fournisseur_retour= Array();
        foreach ($fournisseur_retour_tab as $group):
            $vardiag = New Vardiag();
            $vardiag->name=$group->libelle;
            $vardiag->y=$group->nb;

            $fournisseur_retour[]=$vardiag;
        endforeach;

        $fournisseur_retard_tab = DB::table('differencedatebc')
            ->get();

        $fournisseur_retard= Array();
        foreach ($fournisseur_retard_tab as $group):
            $vardiag = New Vardiag();
            $vardiag->name=$group->libelle;
            $vardiag->y=$group->nb;

            $fournisseur_retard[]=$vardiag;
        endforeach;

        $cumuleda_tab = DB::table('cumuleda')
            ->get();

        $cumuleda= Array();
        foreach ($cumuleda_tab as $group):
            $vardiag = New Vardiag();
            $vardiag->name=$group->annee.'-'.$group->mois;
            $vardiag->y=$group->nb;

            $cumuleda[]=$vardiag;
        endforeach;

        $boncommande_tab = DB::table('boncommande')
            //->select(DB::raw("DATE_FORMAT (created_at,'%d-%b-%Y') as dat" ),DB::raw('sum(boncommande.total_ttc) as nb'))
            ->select(DB::raw("DATE_FORMAT (created_at,'%d-%b-%Y') as dat" ),DB::raw('boncommande.total_ttc as nb'))
            ->orderBy('dat','DESC')
            ->get();
         //   dd($boncommande_tab);
        $boncommande= Array();
        foreach ($boncommande_tab as $group):
            $vardiag = New Vardiag();
            $vardiag->name=$group->dat;
            $vardiag->y=$group->nb;

            $boncommande[]=$vardiag;
        endforeach;
        return view('home',compact('daencours','das','Boncommandeencours','Boncommandes','montant_bc','montant_bct','fournisseur_sollicie','fournisseur_sollicie','fournisseur_retour','fournisseur_retard','cumuleda','boncommande'));
    }
    public function profiles()
    {
        return view('profiles/profiles');
    }
}
