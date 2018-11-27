@extends('layouts.app')
@section('gestion_bc')
    class='active'
@endsection

@section('content')
    <div id="ajouterrep" class="modal fade in" aria-hidden="true" role="dialog" min-width="1000px">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Ajouter la réponse d'un fournisseur</h4>
                </div>
                <form action="inscription.php" method="post" class="form-inline">
                <div class="modal-body">


                        <fieldset class="coordonnees" style="font-size: 13px">

                            <div class="row">
                                <div class="col-sm-4">
                                    <img src="{{ URL::asset('images
            /Eiffage_2400_01_colour_RGB.png') }}" width="100" />
                                </div>
                                <div class="form-group col-sm-8 col-sm-push-3">
                                    <label for="email" >Bon de commande N°:</label>
                                    <input type="text" class="form-control"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    EIFFAGE Génie Civil - Succursale de Côte d'Ivoire </br>N° RCCM : CI-ABJ-2017-B-22961 / N° CC : 1739936Z
                                </div>
                                <div class="col-sm-8 col-sm-push-3">
                                    <div class="form-group">
                                        <label for="email">Date :</label>

                                        <input type="date" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
<table border="solid">
    <tr>
            <td>Merci de libeller votre facture</td>
            <td>EIFFAGE GENIE CIVIL COTE D'IVOIRE</br>
                Tour Biao 8ème étage – Le plateau  Avenue Lamblin</br>
                01 ABIDJAN - BP 5552 ABIDJAN</td>
    </tr>
    <tr>
        <td>Merci d'envoyer votre facture à</td>
        <td>EIFFAGE GENIE CIVIL COTE D'IVOIRE</br>
            3 éme étage Immeuble SIMO / FIDECA</br>
            Bd Mamadou Konate - A coté de Foire de Chine</br>
            01 BP 154 ABIDJAN 01
        </td>
    </tr>
</table>
                                    <div class="row">
                                        <div class="col-sm-10">Toute facture doit mentionner impérativement le numéro du Bon de Commande
                                        et les numéros IBAN et BIC du compte bancaire du Fournisseur.</br>
                                        Toute facture doit être accompagnée des documents suivants :</br>
                                        - copie du Bon de Commande dûment signé,</br>
                                        - tout document justificatif pour le paiement conformément à la commande
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 " style=" font-size: 100px; align-items: center; border: solid">
                                    SOGELUX
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12" style="font-size:20px">
                                    Toute facture Fournisseurs / Sous-Traitants doit être avec la dénomination : <p style="color: red">Eiffage Génie Civil – Côte d’Ivoire.</p></br>
                                    Toute facture ne suivant pas ce principe sera refusée par le service comptable.

                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="Votre commande">
                            <legend>Votre commande</legend>


                            <title> Tableau de commande </title>


                            <table border="1" id="TableID" style="width: 350pxpx;">
                                <tr>

                                    <th bgcolor="grey" td="" width="15"></th><th bgcolor="grey" td="" width="90">Séance</th><th bgcolor="grey" td="" width="90">Référence</th><th bgcolor="grey" td="" width="75">Format</th><th bgcolor="grey" td="" width="45">Impression</th><th bgcolor="grey" td="" width="45">Quantité</th><th bgcolor="grey" td="" width="45">Tarif</th></tr>
                                <tr>
                                    <td><input name="chk" size="15" type="checkbox" /></td>
                                    <td>
                                        <select name="Séance" style="width: 90;">
                                            <option selected="" value="Choix">Sélectionner votre séance</option>
                                            <option selected="" value="Séance 1">Séance 1</option>
                                            <option value="Séance 2">Séance 2Séance 2</option>
                                        </select>

                                    <td><input name="Ref" size="25" type="text" /></td>
                                    <td>
                                        <select name="Format" style="width: 90;">
                                            <option value="10*15">10*15</option>
                                            <option value="11*15">11*15</option>
                                            <option value="20*30">20*30</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="Impression" style="width: 10;">
                                            <option value="Mat">Mat</option>
                                            <option value="Brillant">Brillant</option>
                                            <option value="Satiné">Satiné</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="Quantité" style="width: 20;">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </td>

                                    <td><input name="Prix" readonly="" type="text" /></td>

                                </tr>
                            </table>

                        </fieldset>

                        <input onclick="addRow('TableID')" type="button" value="Ajouter" />
                        <input onclick="deleteRow('TableID')" type="button" value="Supprimer" />


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>

        </div>

    </div>
    <a href="#" class="btn btn-success pull-right" id="Ajouter_pro" data-target='#ajouterrep' data-toggle='modal'>Ajouter Pro forma</a>   <br>
    <div class="row">
        <div >    @include('BC/list_bc')</div>
    </div>

@endsection
