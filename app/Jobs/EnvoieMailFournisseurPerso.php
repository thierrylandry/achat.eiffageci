<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EnvoieMailFournisseurPerso implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
private $contact,$objet,$msg_contenu,$images;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($contact,$images,$objet,$msg_contenu)
    {
        //

        $this->contact=$contact;
        $this->objet=$objet;
        $this->msg_contenu=$msg_contenu;
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
        $objet=$this->objet;
        $msg_contenu=$this->msg_contenu;
        $images=$this->images;
        Mail::send('mail/empty_mail',compact('images','msg_contenu'),function($message)use ($contact,$images,$objet,$msg_contenu )
        {
            $message->from(Auth::user()->email ,Auth::user()->nom." ".Auth::user()->prenoms )
                ->to("claudiane.costecalde@eiffage.com")
                ->bcc("sopie.ncho@eiffage.com")
                        ->subject($objet);
            foreach($contact as $em):
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
