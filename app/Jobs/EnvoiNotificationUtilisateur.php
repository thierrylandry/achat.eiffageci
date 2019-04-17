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
private $Nb,$email,$action;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($Nb,$email,$action)
    {
        //
        $this->Nb=$Nb;
        $this->email=$email;
        $this->action=$action;
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
        if($action==1){
            Mail::send('mail.notif_mail',array('nb' =>$Nb." demande(s) d'achat(s)"),function($message)use ($email,$Nb ){


                $message->from("noreply@eiffage.com" ,"PRO-ACHAT" )
                    ->to($email)
                    ->subject('Vous avez '.$Nb." demande(s) d'achat(s) en attente de validation ");


            });
        }else{

            Mail::send('mail.notif_mail',array('nb' =>$Nb." demande(s) d'achat(s)"),function($message)use ($email,$Nb ){


                $message->from("noreply@eiffage.com" ,"PRO-ACHAT" )
                    ->to($email)
                    ->subject('Vous avez '.$Nb." bon(s) de commande(s) en attente de signature");


            });
        }
    }
}
