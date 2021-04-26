<?php

namespace App\Http\Controllers;

use App\Boncommande;
use App\DA;
use App\Vardiag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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

   $projet_choisi= ProjectController::check_projet_access();
$daencours= DB::table('lignebesoin')->where('etat','=','1')->where('id_projet','=',$projet_choisi->id)->count();
        $das= DB::table('lignebesoin')
        ->where('id_projet','=',$projet_choisi->id)
            ->where('etat','=','2')
            ->orwhere('etat','=','1')->where('id_projet','=',$projet_choisi->id)->count();
$Boncommandeencours= Boncommande::where('etat','=','1')->where('date','<>','')->where('id_projet','=',$projet_choisi->id)->count();
$montant_bc= DB::table('boncommande')
    ->where('boncommande.etat','=',4)->where('id_projet','=',$projet_choisi->id)
    ->sum('total_ttc');
        $montant_bct= DB::table('boncommande')->where('id_projet','=',$projet_choisi->id)
            ->where('boncommande.etat','=',11)
            ->sum('total_ttc');
$Boncommandes= Boncommande::where('id_projet','=',$projet_choisi->id)->count();




        $fournisseur_sollicie_tab = DB::table('boncommande')
            ->groupBy('fournisseur.id')
            ->join('fournisseur','fournisseur.id','=','boncommande.id_fournisseur')->where('boncommande.id_projet','=',$projet_choisi->id)
            ->select('fournisseur.libelle',DB::raw('count(boncommande.id) as nb'))
            ->get();

        $fournisseur_sollicie= Array();
        foreach ($fournisseur_sollicie_tab as $group):
            $vardiag = New Vardiag();
            if($group->nb>=50){
                $vardiag->name=$group->libelle;
                $vardiag->y=$group->nb;

                $fournisseur_sollicie[]=$vardiag;
            }

        endforeach;

        $fournisseur_retour_tab = DB::table('boncommande')
            ->groupBy('fournisseur.id')
            ->join('fournisseur','fournisseur.id','=','boncommande.id_fournisseur')
            ->where('etat','=',11)->where('boncommande.id_projet','=',$projet_choisi->id)
            ->select('fournisseur.libelle',DB::raw('count(boncommande.id) as nb'))
            ->get();

        $fournisseur_retour= Array();
        foreach ($fournisseur_retour_tab as $group):
            $vardiag = New Vardiag();

                $vardiag->name = $group->libelle;
                $vardiag->y = $group->nb;

                $fournisseur_retour[] = $vardiag;

        endforeach;

        $fournisseur_retard_tab = DB::table('differencedatebc')->where('id_projet','=',$projet_choisi->id)
            ->get();

        $fournisseur_retard= Array();
        foreach ($fournisseur_retard_tab as $group):

            if($group->nb>=50) {
                $vardiag = New Vardiag();
                $vardiag->name = $group->libelle;
                $vardiag->y = $group->nb;

                $fournisseur_retard[] = $vardiag;
            }
        endforeach;

        $cumuleda_tab = DB::table('cumuleda')->where('id_projet','=',$projet_choisi->id)
            ->get();

        $cumuleda= Array();
        foreach ($cumuleda_tab as $group):
            $vardiag = New Vardiag();
            $vardiag->name=$group->annee.'-'.$group->mois;
            $vardiag->y=$group->nb;

            $cumuleda[]=$vardiag;
        endforeach;

        $boncommande_tab = DB::table('boncommande')->where('id_projet','=',$projet_choisi->id)
            //->select(DB::raw("DATE_FORMAT (created_at,'%d-%b-%Y') as dat" ),DB::raw('sum(boncommande.total_ttc) as nb'))
          //  ->select(DB::raw("DATE_FORMAT (created_at,'%b-%Y') as dat" ),DB::raw('boncommande.total_ttc as nb'))
            ->select(DB::raw("DATE_FORMAT (created_at,'%b-%Y') as dat" ),'total_ttc as nb')
            ->get();

        $boncommande= Array();
        foreach ($boncommande_tab as $group):
            if(!empty(end($boncommande))){
//dd(end($boncommande)->name);
                if($group->dat==end($boncommande)->name){
                    $vardiag = New Vardiag();
                    $vardiag->name=$group->dat;
                    $vardiag->y=$group->nb+end($boncommande)->y;

                    $boncommande[sizeof($boncommande)-1]=$vardiag;
                }else{
                    $vardiag = New Vardiag();
                    $vardiag->name=$group->dat;
                    $vardiag->y=$group->nb;
                    $boncommande[]=$vardiag;
                }

            }else{
                $vardiag = New Vardiag();
                $vardiag->name=$group->dat;
                $vardiag->y=$group->nb;
                $boncommande[]=$vardiag;
            }



        endforeach;
       // dd($boncommande);
        return view('home',compact('daencours','das','Boncommandeencours','Boncommandes','montant_bc','montant_bct','fournisseur_sollicie','fournisseur_sollicie','fournisseur_retour','fournisseur_retard','cumuleda','boncommande'));
    }
    public function profiles()
    {
        return view('profiles/profiles');
    }
}
