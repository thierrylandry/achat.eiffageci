<?php

namespace App\Jobs;

use Barryvdh\DomPDF\PDF;
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
    private $contact;
    private $pdf;
    private $bc;
    private $images=[];
    private $msg_contenu;
    private $numBonCommande;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($contact,$pdf,$bc,$images,$msg_contenu){
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
    public function handle(){
        //
        $contact=$this->contact;
        $pdf=$this->pdf;
        $bc=$this->bc;
        $images=$this->images;
        $numBonCommande=$bc->numBonCommande;
        $msg_contenu=$this->msg_contenu;

        $contact=array_filter($contact);


                // If you want to store the generated pdf to the server then you can use the store function
                Mail::send('mail.empty_mail',array("msg_contenu"=>$msg_contenu),function($message)use ($pdf,$bc, $contact,$numBonCommande,$images){
                    $message->from(Auth::user()->email ,Auth::user()->nom." ".Auth::user()->prenoms)
                        ->to("claudiane.costecalde@eiffage.com")
                        ->to("marina.oulai@eiffage.com")
                        ->subject('TRANSMISSION DE BON DE COMMANDE')
                        ->attach($pdf);
                    foreach($contact as $em):
                        $message ->bcc($em);
                    endforeach;

                    foreach($images as $img):
                        if($img!=""){
                            try{
                                $message->attach('public/uploads/'.$img);
                            }catch (\Exception $e){
                                logger($e->getMessage());
                            }
                        }
                    endforeach;
                });



    }
}
