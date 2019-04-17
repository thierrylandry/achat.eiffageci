<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
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
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($corps, $precisions, $images, $email)
    {
        $this->email = $email;
        $this->corps = $corps;
        $this->precisions = $precisions;
        $this->images = $images;

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

        Mail::send('mail.mail',compact('corps','precisions','images'),function($message)use ($email,$images )
        {
            $message->from(Auth::user()->email ,Auth::user()->nom." ".Auth::user()->prenoms )
                ->to($email)
                ->subject('Demande de devis');
            foreach($images as $img):
                if($img!="vide"){
                    try{
                        $message->attach('public/uploads/'.$img);
                    }catch (\Exception $e){
                        logger($e->getMessage());
                    }
                }

            endforeach;
            if ($email=="marina.oulai@eiffage.com" ){
                $message->cc("claudiane.costecalde@eiffage.com");
            }else{
                $message->cc("marina.oulai@eiffage.com");
            }
        });
    }
}
