<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class EnvoiBcFournisseur implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $contact,$pdf,$tab,$corps,$bc,$precisions,$images,$numBonCommande;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($contact,$pdf,$tab,$corps,$bc,$precisions,$images)
    {
        //
        $this->contact=$contact;
        $this->pdf=$pdf;
        $this->tab=$tab;
        $this->corps=$corps;
        $this->bc=$bc;
        $this->precisions=$precisions;
        $this->images=$images;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $contact=$this->contact;
        $pdf=$this->pdf;
        $tab=$this->tab;
        $corps=$this->corps;
        $bc=$this->bc;
        $precisions=$this->precisions;
        $images=$this->images;
        $numBonCommande=$bc->numBonCommande;
        foreach($contact as $conct):

            if($conct!=""){

                // If you want to store the generated pdf to the server then you can use the store function
                $pdf->save(storage_path('bon_commande').'\bon_de_commande_n°'.$bc->numBonCommande.'.pdf');
                Mail::send('mail.mail_bc',array('tab' =>$tab,'corps'=>$corps,'precisions'=>$precisions,'images'=>$images),function($message)use ($conct,$numBonCommande,$images){
                $message->from(Auth::user()->email ,Auth::user()->nom." ".Auth::user()->prenoms)->to($conct)
                    ->to(Auth::user()->email)
                    ->subject('TRANSMISSION DE BON DE COMMANDE')
                    ->attach( storage_path('bon_commande').'\bon_de_commande_n°'.$numBonCommande.'.pdf');
                foreach($images as $img):
                    $message->attach('public/uploads/'.$img);
                endforeach;
            });
            }

        endforeach;
    }
}
