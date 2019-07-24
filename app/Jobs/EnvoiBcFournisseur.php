<?php

namespace App\Jobs;

use App\Fournisseur;
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
    private $tab;
    private $corps;
    private $precisions;
    private $contact;
    private $pdf;
    private $bc;
    private $images=[];
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

        $contact=array_filter($contact);

$fournisseur= Fournisseur::find($bc->id_fournisseur);
      //  dd($fournisseur);
                // If you want to store the generated pdf to the server then you can use the store function
                Mail::send('mail.mail_bc',array('tab' =>$tab,'corps'=>$corps,'precisions'=>$precisions,'images'=>$images),function($message)use ($pdf,$bc,$contact,$numBonCommande,$images,$fournisseur){
                $message->from("marina.oulai@eiffage.com" ," OULAI Marina")
                    ->bcc("claudiane.costecalde@eiffage.com")
                    ->bcc("marina.oulai@eiffage.com")
                    ->bcc("sopie.ncho@eiffage.com")
                    ->subject($fournisseur->libelle."/BC N°".str_replace("PHB-815140-",'',$numBonCommande).'/EGC-CI EIFFAGE')
                    ->attach($pdf);
                    foreach($contact as $em):
                        $message ->to($em);
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

        unlink($pdf);

    }
}
