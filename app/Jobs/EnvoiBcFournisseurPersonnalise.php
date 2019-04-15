<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EnvoiBcFournisseurPersonnalise implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $contact,$pdf,$bc,$images,$msg_contenu;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($contact,$pdf,$bc,$images,$msg_contenu)
    {
        //
        $this->contact=$contact;
        $this->pdf=$pdf;
        $this->bc=$bc;
        $this->images=$images;
        $this->msg_contenu=$msg_contenu;
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
        $bc=$this->bc;
        $images=$this->images;
        $numBonCommande=$bc->numBonCommande;
        $msg_contenu=$this->msg_contenu;
        foreach($contact as $conct):

            if($conct!=""){

                // If you want to store the generated pdf to the server then you can use the store function
                $pdf->save(storage_path('bon_commande').'\bon_de_commande_n°'.$bc->numBonCommande.'.pdf');
                Mail::send('mail.empty_mail',array("msg_contenu"=>$msg_contenu),function($message)use ($conct,$numBonCommande,$images){
                    $message->from(Auth::user()->email ,Auth::user()->nom." ".Auth::user()->prenoms)
                        ->to($conct)
                        ->to(Auth::user()->email)
                        ->subject('TRANSMISSION DE BON DE COMMANDE')
                        ->attach( storage_path('bon_commande').'\bon_de_commande_n°'.$numBonCommande.'.pdf'  );

                    foreach($images as $img):
                        $message->attach(URL::asset('uploads/'.$img));
                    endforeach;
                });
            }

        endforeach;
    }
}
