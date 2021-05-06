<?php

namespace App\Jobs;

use App\Fournisseur;
use App\Projet;
use App\User;
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
    private $contactDemandeur;
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
    public function __construct($contact,$pdf,$tab,$corps,$contactDemandeur,$bc,$precisions,$images)
    {
        //
        $this->contact=$contact;
        $this->pdf=$pdf;
        $this->tab=$tab;
        $this->corps=$corps;
        $this->contactDemandeur=$contactDemandeur;
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
        $contactDemandeur=$this->contactDemandeur;
        $bc=$this->bc;
        $precisions=$this->precisions;
        $images=$this->images;
        $numBonCommande=$bc->numBonCommande;

        $contact=array_filter($contact);

$fournisseur= Fournisseur::find($bc->id_fournisseur);
      //  dd($fournisseur);
      $user_en_copies = array();

            $users = User::where('id_projet','=',$bc->id_projet)->get();
            foreach($users as $user):
                if($user->hasRole('Gestionnaire_Pro_Forma')){
                    $user_en_copies[]= $user->email;
                }

            endforeach;

                // If you want to store the generated pdf to the server then you can use the store function
                Mail::send('mail.mail_bc',array('tab' =>$tab,'bc'=>$bc),function($message)use ($pdf,$bc,$contact,$contactDemandeur,$user_en_copies,$numBonCommande,$fournisseur){
                    $projet =Projet::find($bc->id_projet);

                    $message->from($bc->expediteur->email ,$bc->expediteur->nom." ".$bc->expediteur->prenoms)
                    ->bcc("cyriaque.kodia@eiffage.com")
                    ->subject($fournisseur->libelle."/".__('neutrale.demande_devis').' '.str_replace($projet->libelle,'',$numBonCommande).'/EGC-CI EIFFAGE')
                    ->attach($pdf);
                    foreach($contact as $em):
                        $message ->to($em);
                    endforeach;
                    foreach($contactDemandeur as $em):
                        $message ->bcc($em);
                    endforeach;
                    foreach($user_en_copies as $em):
                        $message ->bcc($em);
                    endforeach;
            });

        unlink($pdf);

    }
}
