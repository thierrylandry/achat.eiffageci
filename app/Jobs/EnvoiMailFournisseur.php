<?php

namespace App\Jobs;

use App\Projet;
use Faker\Provider\cs_CZ\DateTime;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class EnvoiMailFournisseur implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $corps;
    private $precisions;
    private $images = [];
    private $email;
    private $domaine;
    private $date;
    private $lang;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($corps, $precisions, $images, $email,$domaine,$date,$lang)
    {
        $this->email = $email;
        $this->corps = $corps;
        $this->precisions = $precisions;
        $this->images = $images;
        $this->domaine = $domaine;
        $this->date = $date;
        $this->lang = $lang;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = $this->email;
        $corps = $this->corps;
        $precisions = $this->precisions;
        $images = $this->images;
        $domaine = $this->domaine;
        $date = $this->date;
        $lang= $this->lang;

        Mail::send('mail.mail',compact('corps','precisions','images'),function($message)use ($email,$images,$domaine,$date,$lang )
        {
            App::setLocale($lang);
            $projet =Projet::find(session('id_projet'));
            $nom_projet = explode('-',$projet->libelle);
            $message->from(Auth::user()->email ,Auth::user()->nom." ".Auth::user()->prenoms )
              // ->to("claudiane.costecalde@eiffage.com")
               // ->to("marina.oulai@eiffage.com")
                ->subject('EGCCI-'.$nom_projet[0].'/'.__('neutrale.demande_devis').' - '.$domaine.' - '.$date);
            foreach($email as $em):
                $message ->bcc($em);
                endforeach;

            foreach($images as $img):
                if($img!="vide"){
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
