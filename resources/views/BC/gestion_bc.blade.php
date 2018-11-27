@extends('layouts.app')
@section('gestion_bc')
    class='active'
@endsection

@section('content')
    <div id="ajouterrep" class="modal fade" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Ajouter la réponse d'un fournisseur</h4>
                </div>
                <div  min-with="900 px">

                    <form action="inscription.php" method="post">
                        <fieldset class="coordonnees">
                            <legend>Vos Coordonnées</legend>

                           <div class="row">
                               <div class="col-sm-4">
                                   <img src="{{ URL::asset('images
            /Eiffage_2400_01_colour_RGB.png') }}" width="100" />
                               </div>
                               <div class="col-sm-6 col-sm-push-4">
                                 <p>Bon de commande N°<input type="text" /></p>
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

                                    </td></tr>
                            </table>

                        </fieldset>

                        <input onclick="addRow('TableID')" type="button" value="Ajouter" />
                        <input onclick="deleteRow('TableID')" type="button" value="Supprimer" />

                </div>

            </div>

        </div>
    </div>
    <a href="#" class="btn btn-success pull-right" id="Ajouter_pro" data-target='#ajouterrep' data-toggle='modal'>Ajouter Pro forma</a>   <br>
    <div class="row">
<div >    @include('BC/list_bc')</div>
    </div>

    @endsection
