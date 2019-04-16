<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class EnvoiRappelFournisseur implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
private $email;
private $corps;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($corps,$email)
    {
        //
        $this->email = $email;
        $this->corps = $corps;
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
        Mail::send('mail.rappel_mail',array('corps' =>$corps),function($message)use ($email ){


            $message->from(\Illuminate\Support\Facades\Auth::user()->email ,\Illuminate\Support\Facades\Auth::user()->nom." ".\Illuminate\Support\Facades\Auth::user()->prenoms )
                ->to($email)
                ->subject('Rappel de demande de devis');
            if (strtoupper($email)=="MARINA.OULAI@EIFFAGE.COM" ){
                $message->cc("Claudiane.COSTECALDE@eiffage.com");
            }else{
                $message->cc("Marina.OULAI@eiffage.com");
            }

        });
    }
}
