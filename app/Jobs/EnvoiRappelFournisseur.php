<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class EnvoiRappelFournisseur implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
private $email;
private $corps;
private $domaine;
private $date;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($corps,$email,$domaine,$date)
    {
        //
        $this->email = $email;
        $this->corps = $corps;
        $this->corps = $domaine;
        $this->date = $date;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $email = $this->email;
        $corps = $this->corps;
        $domaine = $this->domaine;
        $date = $this->date;
        Mail::send('mail.rappel_mail',array('corps' =>$corps),function($message)use ($email,$domaine ,$date){


            $message->from(\Illuminate\Support\Facades\Auth::user()->email ,\Illuminate\Support\Facades\Auth::user()->nom." ".\Illuminate\Support\Facades\Auth::user()->prenoms )
                ->to("sopie.ncho@eiffage.com")
                ->subject('EGCCI-PHB/ Rappel demande de devis - '.$domaine.' -'.$date);
            foreach($email as $em):
                $message ->bcc($em);
            endforeach;

        });
    }
}
