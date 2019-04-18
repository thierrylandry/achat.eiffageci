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
use App\Jobs\EnvoiNotificationUtilisateur;
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
     * @return string
     */


    public function notificateur(){

    $users=DB::table('users')
        ->select('users.id','users.email')->get();


    foreach($users as $user):
        $mes_droits =  $this->dit_moi_qui_tu_es_je_te_dirai_tes_droits($user->id);
        $this->je_connais_tes_droits_je_te_notifie_de_linformation_qui_te_concerne($mes_droits,$user->email);
    endforeach;

    return "notifier";
}

    /**
     * @param $id_users
     * @return array
     */
    public function dit_moi_qui_tu_es_je_te_dirai_tes_droits($id_users){

        $roles=DB::table('user_role')
            ->join('roles', 'roles.id', '=', 'user_role.role_id')
            ->where('user_role.user_id','=',$id_users)
            ->select('roles.name')->get();
        $tab_roles= Array();
        foreach($roles as $rol):
            $tab_roles[]=$rol->name;
        endforeach;

        return $tab_roles;
    }

    public function je_connais_tes_droits_je_te_notifie_de_linformation_qui_te_concerne($les_droits,$email){


        if(in_array('Valideur_DA',$les_droits)){
            $this->notification_sur_les_D_A($email);
        }
        if(in_array('Valideur_BC',$les_droits)){
            $this->notification_sur_les_B_C($email);
        }

    }
    public function notification_sur_les_D_A($email){

        $das=  DA::where('etat','=',1)->get();

        $Nb=sizeof($das);;
        $adresse_da="http://172.20.73.3/achat.eiffageci/lister_da";
        if($Nb>0){
            $this->dispatch(new EnvoiNotificationUtilisateur($Nb,$email,1,$adresse_da) );
        }

    }
    public function notification_sur_les_B_C($email){

        $das=  Boncommande::where('etat','=',1)->get();

        $Nb=sizeof($das);
        $adresse_bc="http://172.20.73.3/achat.eiffageci/gestion_bc";
        if($Nb>0){

            $this->dispatch(new EnvoiNotificationUtilisateur($Nb,$email,2,$adresse_bc) );
        }

    }


    ////

}