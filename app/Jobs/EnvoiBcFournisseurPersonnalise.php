<?php

namespace App\Jobs;

use App\Fournisseur;
use Barryvdh\DomPDF\PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class EnvoiBcFournisseurPersonnalise implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $contact;
    private $pdf;
    private $bc;
    private $images=[];
    private $msg_contenu;
    private $numBonCommande;
    private $objet;
    private $pj;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($contact,$pdf,$bc,$images,$msg_contenu,$objet,$pj){
        //
        $this->contact=$contact;
        $this->pdf=$pdf;
        $this->bc=$bc;
        $this->images=$images;
        $this->msg_contenu=$msg_contenu;
        $this->objet=$objet;
        $this->pj=$pj;
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
        $objet=$this->objet;
        $pj=$this->pj;

        $contact=array_filter($contact);
        $fournisseur= Fournisseur::find($bc->id_fournisseur);

                // If you want to store the generated pdf to the server then you can use the store function
                Mail::send('mail.empty_mail',array("msg_contenu"=>$msg_contenu),function($message)use ($pdf,$bc, $contact,$numBonCommande,$images,$fournisseur,$objet,$pj){
                    $message->from(Auth::user()->email ,Auth::user()->nom." ".Auth::user()->prenoms)
                      //  ->bcc("claudiane.costecalde@eiffage.com")
                       // ->bcc("marina.oulai@eiffage.com")
                        ->subject($objet)
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
                    if($pj!=""){
                        try{
                          //  dd(Storage::url('app/pj/'.$pj));
                            $message->attach(Storage::url('app/pj/'.$pj));
                        }catch (\Exception $e){
                            logger($e->getMessage());
                        }
                    }
                });

        unlink($pdf);
        Storage::delete('app/pj/'.$pj);
    }
}
