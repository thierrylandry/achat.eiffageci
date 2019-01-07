<?php
/**
 * Created by PhpStorm.
 * User: ckodia
 * Date: 25/10/2018
 * Time: 12:23
 */

namespace App\Http\Controllers;


use App\Analytique;
use App\Boncommande;
use App\DA;
use App\Devis;
use App\fournisseur;
use App\ligne_bc;
use App\Lignebesoin;
use App\Reponse_fournisseur;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use League\Flysystem\Exception;
use PDF;
use Spipu\Html2Pdf\Html2Pdf;
class BCController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function bon_commande_file($slug){
     // $bc=  Boncommande::where('slug','=',$slug)->first();
        $bc= DB::table('boncommande')
            ->join('fournisseur', 'boncommande.id_fournisseur', '=', 'fournisseur.id')
            ->where('boncommande.slug','=',$slug)
            ->select('fournisseur.libelle','boncommande.id','numBonCommande','date','boncommande.created_at','service_demandeur')->first();

        $ligne_bcs=DB::table('ligne_bc')
            ->join('devis', 'devis.id', '=', 'ligne_bc.id_devis')
            ->where('id_bonCommande','=',$bc->id)
            ->select('titre_ext','quantite_ligne_bc','unite_ligne_bc','prix_unitaire_ligne_bc','remise_ligne_bc','prix_tot','ligne_bc.slug','devis.codeRubrique','devise')->get();


        $taille=sizeof($ligne_bcs);
        // Send data to the view using loadView function of PDF facade
        $commandes='';

        //$pdf = PDF::loadView('BC.bon_commande_file', compact('bc','ligne_bcs'));
        $tothtax = 0;
        //return view('BC.bon-commande', compact('bc','ligne_bcs','tothtax'));
        $pdf = PDF::loadView('BC.bon-commande', compact('bc','ligne_bcs','tothtax','taille'));

        // If you want to store the generated pdf to the server then you can use the store function
       // $pdf->save(storage_path().'_filename.pdf');
        // Finally, you can download the file using download function
        return $pdf->download('bon_de_commande_n°'.$bc->numBonCommande.'.pdf');
      //  return $pdf->stream('bon_de_commande_n°'.$bc->numBonCommande.'.pdf');

      /*  $html22 = View('BC.bcl.bon_commande_file')->with(array('bc' => $bc,'ligne_bcs' => $ligne_bcs))->render();
        $html2pdf = new HTML2PDF('P', 'A4', 'en', true, 'UTF-8', array(0, 0, 0, 0));
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->WriteHTML($html22);
        return $html2pdf->Output('Invoice.pdf');*/

    }
    public function send_it($slug){

        $bc= DB::table('boncommande')
            ->join('fournisseur', 'boncommande.id_fournisseur', '=', 'fournisseur.id')
            ->where('boncommande.slug','=',$slug)
            ->select('fournisseur.libelle','boncommande.id','numBonCommande','date','boncommande.created_at','service_demandeur','contact')->first();


        $ligne_bcs=DB::table('ligne_bc')
            ->join('devis', 'devis.id', '=', 'ligne_bc.id_devis')
            ->where('id_bonCommande','=',$bc->id)
            ->select('titre_ext','quantite_ligne_bc','unite_ligne_bc','prix_unitaire_ligne_bc','remise_ligne_bc','prix_tot','ligne_bc.slug','devis.codeRubrique','devise')->get();

        $tothtax = 0;
        $taille=sizeof($ligne_bcs);
        // Send data to the view using loadView function of PDF facade
        $pdf = PDF::loadView('BC.bon-commande', compact('bc','ligne_bcs','tothtax','taille'));

        //$lignebesoins=Lignebesoin::where('id_bonCommande','=',$bc->id)->first();
        $lignebesoins=DB::table('lignebesoin')->where('id_bonCommande','=',$bc->id)->get();
      //  $email=$bc->email;
        $contact=\GuzzleHttp\json_decode($bc->contact);
        $interlocuteur=$contact[0];
        $numBonCommande=$bc->numBonCommande;
        $tab=Array();
        foreach($lignebesoins as $lignebesoin){
            $tab[]=$lignebesoin->id_nature;
        }


        // If you want to store the generated pdf to the server then you can use the store function
        $pdf->save(storage_path('bon_commande').'\bon_de_commande_n°'.$bc->numBonCommande.'.pdf');
        Mail::send('mail.mail_bc',array('tab' =>$tab),function($message)use ($interlocuteur,$numBonCommande){
            $message->from(\Illuminate\Support\Facades\Auth::user()->email ,\Illuminate\Support\Facades\Auth::user()->name )
                ->to(\Illuminate\Support\Facades\Auth::user()->email,$interlocuteur)
                ->subject('TRANSMISSION DE BON DE COMMANDE')
                ->attach( storage_path('bon_commande').'\bon_de_commande_n°'.$numBonCommande.'.pdf'  );

        });

      //  return redirect()->route('gestion_bc')->with('success', "Envoie d'email reussi");

        $boncom=Boncommande::where('id','=',$bc->id)->first();
        $boncom->etat=3;
        $boncom->save();
        $lignebesoin=Lignebesoin::where('id_bonCommande','=',$bc->id)->first();
        $lignebesoin->etat=3;
        $lignebesoin->save();
        // Finally, you can download the file using download function
          $pdf->download('bon_de_commande_n°'.$bc->numBonCommande.'.pdf');
        return redirect()->route('gestion_bc')->with('success', "Envoie d'email reussi");
    }
    public function bon_commande_file1($slug){
        // $bc=  Boncommande::where('slug','=',$slug)->first();
        $bc= DB::table('boncommande')
            ->join('fournisseur', 'boncommande.id_fournisseur', '=', 'fournisseur.id')
            ->where('boncommande.slug','=',$slug)
            ->select('fournisseur.libelle','boncommande.id','numBonCommande','date')->first();

        $ligne_bcs=DB::table('ligne_bc')
            ->join('reponse_fournisseur', 'reponse_fournisseur.id', '=', 'ligne_bc.id_reponse_fournisseur')
            ->join('analytique', 'analytique.id_analytique', '=', 'ligne_bc.codeRubrique')
            ->where('id_bonCommande','=',$bc->id)
            ->select('titre_ext','quantite_ligne_bc','unite_ligne_bc','prix_unitaire_ligne_bc','remise_ligne_bc','prix_tot','ligne_bc.slug','analytique.codeRubrique')->get();
        $tothtax = 0;
        return view('BC.bon-commande',compact('bc','ligne_bcs','tothtax'));
    }

    public function gestion_bc()
    {
        $bcs=  Boncommande::all();
        $utilisateurs=  User::all();
        $fournisseurs= DB::table('fournisseur')
            ->join('reponse_fournisseur', 'fournisseur.id', '=', 'reponse_fournisseur.id_fournisseur')
            ->join('lignebesoin', 'reponse_fournisseur.id', '=', 'lignebesoin.id_reponse_fournisseur')
            ->where('lignebesoin.etat', '=', 2)
            ->select('fournisseur.libelle','fournisseur.id')->distinct()->get();

        $reponse_fournisseurs= DB::table('reponse_fournisseur')
            ->join('lignebesoin', 'reponse_fournisseur.id', '=', 'lignebesoin.id_reponse_fournisseur')
            ->join('materiel', 'materiel.id', '=', 'lignebesoin.id_materiel')
            ->where('lignebesoin.etat', '=', 2)
            ->select('materiel.libelleMateriel','titre_ext','reponse_fournisseur.id')->distinct()->get();
$analytiques= Analytique::all();
        return view('BC/gestion_bc',compact('bcs','fournisseurs','utilisateurs','reponse_fournisseurs','analytiques'));
    }

    public function modifier_ligne_bc($slug)
    {
        $bcs=  Boncommande::all();
        $utilisateurs=  User::all();
        $fournisseurs= DB::table('fournisseur')
            ->join('reponse_fournisseur', 'fournisseur.id', '=', 'reponse_fournisseur.id_fournisseur')
            ->join('lignebesoin', 'reponse_fournisseur.id', '=', 'lignebesoin.id_reponse_fournisseur')
            ->where('lignebesoin.etat', '=', 2)
            ->select('fournisseur.libelle','fournisseur.id')->distinct()->get();
        $reponse_fournisseurs= DB::table('reponse_fournisseur')
            ->join('lignebesoin', 'reponse_fournisseur.id', '=', 'lignebesoin.id_reponse_fournisseur')
            ->join('materiel', 'materiel.id', '=', 'lignebesoin.id_materiel')
            ->where('lignebesoin.etat', '=', 2)
            ->select('materiel.libelleMateriel','titre_ext','reponse_fournisseur.id')->distinct()->get();
        $modifierlignebc='';
        $analytiques= Analytique::all();
        $ligne_bc=Ligne_bc::where('slug','=',$slug)->first();
        return view('BC/gestion_bc',compact('bcs','fournisseurs','utilisateurs','modifierlignebc','reponse_fournisseurs','$slug','analytiques','ligne_bc'));
    }
    public function save_ligne_bc(Request $request)
    {
        $parameters=$request->except(['_token']);

        $les_id_devis=explode(',',$parameters['les_id_devis']);

        $date= new \DateTime(null);
        foreach ($les_id_devis as $id):
            if($id!=""){
                $Devis= Devis::find($id);
                $ligne_bc= ligne_bc::where('id_devis','=',$id)->first();
                if(isset($ligne_bc->id)){

                }else{
                    $ligne_bc= new ligne_bc();

                }
               ;

                $ligne_bc->id_bonCommande=$parameters['id_bc'];
                $ligne_bc->codeRubrique=$parameters['row_n_'.$id.'_codeRubrique'];
                $ligne_bc->remise_ligne_bc=$Devis->remise;
                $ligne_bc->quantite_ligne_bc=$Devis->quantite;
                $ligne_bc->unite_ligne_bc=$Devis->unite;
                $ligne_bc->id_devis=$Devis->id;
                $ligne_bc->prix_unitaire_ligne_bc=$Devis->prix_unitaire;
                $ligne_bc->prix_tot=$Devis->prix_unitaire*$Devis->quantite-($Devis->remise*($Devis->prix_unitaire*$Devis->quantite))/100;

                $ligne_bc->slug=Str::slug($ligne_bc->id_bonCommand.$ligne_bc->codeRubrique.$ligne_bc->quantite_ligne_b.$ligne_bc->prix_unitaire_ligne_bc.$date->format('dmYhis'));
                $ligne_bc->save();
            }

            endforeach;


        $boncommande= Boncommande::find($parameters['id_bc']);

        $boncommande->date=$parameters['date_livraison'];
        $boncommande->service_demandeur=$parameters['id_service'];

        $sumligne=ligne_bc::where('id_bonCommande','=',$boncommande->id)->sum('prix_tot');
        $tot_ttc=$sumligne*1.18;

        $boncommande->total_ttc=$tot_ttc;
        $boncommande->save();

        $Devis= Devis::where('id_bc','=',$parameters['id_bc'])->first();
        $lignebesoin=Lignebesoin::find($Devis->id_da);
        $lignebesoin->id_bonCommande=$boncommande->id;
        $lignebesoin->save();

        return redirect()->route('gestion_bc')->with('success',"la commande a été ajouté avec success");
    }
    public function update_ligne_bc(Request $request)
    {
        $parameters=$request->except(['_token']);

        $date= new \DateTime(null);
        $ligne_bc= ligne_bc::where('slug','=',$parameters['slugligne'])->first();

        $ligne_bc->codeRubrique=$parameters['codeRubrique'];
        $ligne_bc->remise_ligne_bc=$parameters['remise'];
        $ligne_bc->quantite_ligne_bc=$parameters['quantite'];
        $ligne_bc->unite_ligne_bc=$parameters['Unite'];
        $ligne_bc->prix_unitaire_ligne_bc=$parameters['Prix_unitaire'];
        $ligne_bc->prix_tot=str_replace(" ","",$parameters['Prix']);
        $ligne_bc->id_reponse_fournisseur=$parameters['id_reponse_fournisseur'];

        $ligne_bc->slug=Str::slug($ligne_bc->id_bonCommand.$ligne_bc->codeRubrique.$ligne_bc->quantite_ligne_b.$ligne_bc->prix_unitaire_ligne_bc.$date->format('dmYhis'));
        $ligne_bc->save();

        $boncommande= Boncommande::where('id','=',$ligne_bc->id_bonCommande)->first();
        $sumligne=ligne_bc::where('id_bonCommande','=',$boncommande->id)->sum('prix_tot');
        $tot_ttc=$sumligne*1.18;
        $boncommande->total_ttc=$tot_ttc;
        $boncommande->save();
        return redirect()->route('gestion_bc')->with('success',"la ligne  a été mise à jour avec succes");
    }
    public function valider_commande($slug)
    {
        $date= new \DateTime(null);
        $Boncommande= Boncommande::where('slug', '=', $slug)->first();
        $Boncommande->etat=2;
        $Boncommande->save();
        return redirect()->route('gestion_bc')->with('success',"le bon de commande à été valider avec succès");
    }
    public function traite_finalise($slug)
    {
        $date= new \DateTime(null);
        $Boncommande= Boncommande::where('slug', '=', $slug)->first();
        $Boncommande->etat=4;
        $Boncommande->save();
        return redirect()->route('gestion_bc')->with('success',"le bon de commande à été traité et finalisé");
    }
    public function traite_retourne($slug)
    {
        $date= new \DateTime(null);
        $Boncommande= Boncommande::where('slug', '=', $slug)->first();
        $Boncommande->etat=11;
        $Boncommande->save();
        return redirect()->route('gestion_bc')->with('success',"le bon de commande à été traité et finalisé");
    }
    public function refuser_commande($slug)
    {
        $date= new \DateTime(null);
        $Boncommande= Boncommande::where('slug', '=', $slug)->first();
        $Boncommande->etat=0;
        $Boncommande->save();
        return redirect()->route('gestion_bc')->with('success',"le bon de commande à été valider avec succès");
    }

    public function annuler_commande($slug)
    {
        $date= new \DateTime(null);
        $Boncommande= Boncommande::where('slug', '=', $slug)->first();
        $Boncommande->etat=1;
        $Boncommande->save();
        return redirect()->route('gestion_bc')->with('success',"le bon de commande à été annuler avec succès");
    }
    public function lister_commande($id)
    {
        $bc=  Boncommande::find($id);
        $utilisateurs=  User::all();
        $fournisseur= Fournisseur::find($bc->id_fournisseur);
        $devis= DB::table('devis')
            ->leftJoin('lignebesoin', 'lignebesoin.id', '=', 'devis.id_da')
            ->leftJoin('users', 'lignebesoin.id_user', '=', 'users.id')
            ->where('devis.etat', '=', 2)
            ->where('devis.id_bc', '=', $id)
            ->select('devis.id','devis.titre_ext','id_bc','devis.codeRubrique','devis.quantite','devis.unite','devis.prix_unitaire','devis.remise','devis.devise','DateBesoin','users.service')->distinct()->get();

        $devise=$devis->first()->devise;

        $id_devi="";
        foreach($devis as $devi):
            $id_devi=$id_devi.$devi->id.",";
            endforeach;

        /*  $ligne_bcs=DB::table('ligne_bc')
            ->join('reponse_fournisseur', 'reponse_fournisseur.id', '=', 'ligne_bc.id_reponse_fournisseur')
            ->join('analytique', 'analytique.id_analytique', '=', 'ligne_bc.codeRubrique')
            ->where('id_bonCommande','=',$id)
            ->select('titre_ext','quantite_ligne_bc','unite_ligne_bc','prix_unitaire_ligne_bc','remise_ligne_bc','prix_tot','ligne_bc.slug','analytique.codeRubrique')->get();*/
        $listerbc='';
        $analytiques= Analytique::all();
        return view('BC/list_ligne_bc',compact('bc','fournisseur','utilisateurs','listerbc','devis','slugbc','analytiques','devise','id_devi'));
    }
    public function gestion_bc_ajouter()
    {
        $bcs=  Boncommande::all();
        $utilisateurs=  User::all();
        $fournisseurs= DB::table('fournisseur')
            ->join('devis', 'fournisseur.id', '=', 'devis.id_fournisseur')
            ->where('devis.etat', '=', 1)
            ->select('fournisseur.libelle','fournisseur.id')->distinct()->get();
        $reponse_fournisseurs= DB::table('reponse_fournisseur')
            ->join('lignebesoin', 'reponse_fournisseur.id', '=', 'lignebesoin.id_reponse_fournisseur')
            ->join('materiel', 'materiel.id', '=', 'lignebesoin.id_materiel')
            ->where('lignebesoin.etat', '=', 2)
            ->select('materiel.libelleMateriel','titre_ext','reponse_fournisseur.id')->distinct()->get();
        $ajouter='vrai';
        $analytiques= Analytique::all();
        return view('BC/gestion_bc',compact('bcs','fournisseurs','utilisateurs','ajouter','reponse_fournisseurs','analytiques'));
    }
    public function detail_rep_fournisseur($id){

        $reponse_fournisseur = Reponse_fournisseur::where('id','=',$id)->first();

        return response()->json($reponse_fournisseur);
    }
    public function save_bc( Request $request)
    {
        $parameters=$request->except(['_token']);

        $date= new \DateTime(null);
        $Boncommande= new Boncommande();
        $Boncommande->numBonCommande=$parameters['numbc'];
       // $Boncommande->date=$parameters['date'];
        $Boncommande->id_fournisseur=$parameters['id_fournisseur'];
        $Boncommande->id_user=\Illuminate\Support\Facades\Auth::user()->id;

        $Boncommande->slug=Str::slug($parameters['numbc'].$date->format('dmYhis'));
       // $Boncommande->save();
        try{$Boncommande->save();
        }catch (\Illuminate\Database\QueryException $ex){


            return redirect()->route('gestion_bc')->with('error',"le numero du bon de commande est déjà utilisé");
        }
        $lesdevis= Devis::where('id_fournisseur','=',$Boncommande->id_fournisseur)->get();

        foreach($lesdevis as $devi):
            $devi->id_bc=$Boncommande->id;
            //pour dire que ce la sont lie a un bon de commande
            $devi->etat=2;
            $devi->save();
        endforeach;
        return redirect()->route('gestion_bc')->with('success',"le bon de commande a été ajouté, Veuillez ajouter la listes des produits ou des services");
    }
    public function modifier_bc( Request $request)
    {
        $parameters=$request->except(['_token']);
        $slug=$parameters['slug'];
        $date= new \DateTime(null);
        $Boncommande= Boncommande::where('slug', '=', $slug)->first();
       // $Boncommande->numBonCommande=$parameters['numbc'];
        //$Boncommande->date=$parameters['date'];
       // $Boncommande->id_fournisseur=$parameters['id_fournisseur'];
        $Boncommande->id_user=\Illuminate\Support\Facades\Auth::user()->id;

       // $Boncommande->slug=Str::slug($parameters['numbc'].$date->format('dmYhis'));
        $Boncommande->save();


        return redirect()->route('gestion_bc')->with('success',"le bon de commande a été Modifier");
    }

    public function supprimer_bc($slug)
    {
        $fournisseur = Boncommande::where('slug', '=', $slug)->first();

        $devis = Devis::where('id_bc','=',$fournisseur->id)->get();
       foreach ($devis as $devi):
        $devi->etat=1;
        $devi->id_bc=null;
        $devi->save();
        endforeach;
        $ligne_bcs= ligne_bc::where('id_bonCommande','=',$fournisseur->id)->get();
        foreach ($ligne_bcs as $ligne_bc):
            $ligne_bc->delete();
            endforeach;
        $fournisseur->delete();

        return redirect()->route('gestion_bc')->with('success', "le Bon de commande a été supprimé   NB: la suppression d'un bon de commande, entraine la suppression en cascade des lignes de cet bon de commande ");
    }
    public function supprimer_ligne_bc($slug)
    {
        $ligne_bc = ligne_bc::where('slug', '=', $slug)->first();
       $id=$ligne_bc->id_bonCommande;
        $ligne_bc->delete();

        $sumligne=ligne_bc::where('id_bonCommande','=',$id)->sum('prix_tot');
        $tot_ttc=$sumligne*1.18;
        $boncommande=Boncommande::where('id','=',$id)->first();
        $boncommande->total_ttc=$tot_ttc;
        $boncommande->save();


        return redirect()->route('gestion_bc')->with('success', "La ligne du bon de commande a été supprimée avec succes ");
    }
public function gestion_offre(){
    return view('BC/choix_offres');
}

    ////

}