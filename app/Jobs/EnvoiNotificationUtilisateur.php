<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class EnvoiNotificationUtilisateur implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
private $Nb,$email,$action,$adresse;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($Nb,$email,$action,$adresse)
    {
        //
        $this->Nb=$Nb;
        $this->email=$email;
        $this->action=$action;
        $this->adresse=$adresse;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $Nb=$this->Nb;
        $email=$this->email;
        $action=$this->action;
        $adresse=$this->adresse;
        if($action==1){

            Mail::send('mail.notif_mail',array('nb' =>$Nb." demande(s) d'achat(s) en attente de validation",'adresse'=>$adresse),function($message)use ($email,$Nb ){


                $message->from("noreply@eiffage.com" ,"PRO-ACHAT" )
                    ->to($email)
                    ->subject('Vous avez '.$Nb." demande(s) d'achat(s) en attente de validation ");


            });
        }elseif($action==3){
            //envoie de notification aux utilisateurs qui doivent soumettre les D.A aux fournisseur
            Mail::send('mail.notif_mail',array('nb' =>$Nb." demande(s) d'achat(s) validée(s)",'adresse'=>$adresse),function($message)use ($email,$Nb ){


                $message->from("noreply@eiffage.com" ,"PRO-ACHAT" )
                    ->to($email)
                    ->subject('Vous avez '.$Nb." demande(s) d'achat(s) validée(s ");


            });

        }elseif($action==4){
            //envoie de notification aux utilisateurs pour les informer que les BC on été confirmé
            Mail::send('mail.notif_mail',array('nb' =>$Nb." Bon de commande(s) validé(s)",'adresse'=>$adresse),function($message)use ($email,$Nb ){


                $message->from("noreply@eiffage.com" ,"PRO-ACHAT" )
                    ->to($email)
                    ->subject('Vous avez '.$Nb." Bon de commande(s) validé(s) ");


            });

        }else{
            Mail::send('mail.notif_mail',array('nb' =>$Nb." bon de commande(s) en attente de signature",'adresse'=>$adresse),function($message)use ($email,$Nb ){


                $message->from("noreply@eiffage.com" ,"PRO-ACHAT" )
                    ->to($email)
                    ->subject('Vous avez '.$Nb." bon(s) de commande(s) en attente de signature");


            });
        }
    }
}
