<?php
/**
 * Created by PhpStorm.
 * User: ckodia
 * Date: 25/10/2018
 * Time: 12:23
 */

namespace App\Http\Controllers;


use App\Analytique;
use App\Boncommande;
use App\DA;
use App\Devis;
use App\fournisseur;
use App\ligne_bc;
use App\Lignebesoin;
use App\Reponse_fournisseur;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use League\Flysystem\Exception;
use PDF;
use Spipu\Html2Pdf\Html2Pdf;
class InfoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


    public function notificateur(){

$user=DB::table('users')
    ->join('user_role', 'user_role.user_id', '=', 'users.id')
    ->join('roles', 'roles.id', '=', 'user_role.role_id')

    ->select('users.id','users.email','roles.name')->get();


        dd($user);

        return "notifier";
    }

    ////

}