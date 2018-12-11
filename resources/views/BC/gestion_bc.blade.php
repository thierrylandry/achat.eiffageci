@extends('layouts.app')
@section('gestion_bc')
    class='active'
@endsection

@section('content')

    <h2>LES BONS DE COMMANDES - GESTION</h2>
    <div id="ajouterrep" class="modal fade in" aria-hidden="true" role="dialog" >
        <div class="modal-dialog modal-md">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Bon de commande</h4>
                </div>
                @if(isset($bc))
                <form class="form-horizontal" action="{{route('modifier_bc')}}" method="post">
                    @else
                        <form class="form-horizontal" action="{{route('save_bc')}}" method="post">
                        @endif
                    @csrf
                <div class="modal-body">
<input type="hidden" name="slug"  value="{{isset($bc)? $bc->slug:''}}"/>
                        <div class="form-group">
                            <label class="control-label col-sm-6" for="numbc">Bon de commande N°:</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="numbc" name="numbc" placeholder="Enter un numero" value="{{isset($bc)? $bc->numBonCommande:''}}" {{isset($bc)? 'disabled':''}}   required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-6" for="date">Date:</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="date" name="date" value="{{isset($bc)? $bc->date:''}}" >
                            </div>
                        </div>
                        <div class="form-group">
                            <b><label for="libelle" class="control-label col-sm-6">Fournisseur</label></b>
                            <div class="col-sm-6">
                            <select class="form-control selectpicker " id="id_fournisseur" name="id_fournisseur" data-live-search="true" data-size="6" required>
                                <option value="" >SELECTIONNER UN FOURNISSEUR</option>
                                @foreach($fournisseurs as $fournisseur)
                                    @if(isset($bc) && $bc->id_fournisseur==$fournisseur->id)
                                       {{$selec="selected"}}
                                    @else
                                        {{$selec=""}}
                                    @endif

                                    <option value="{{$fournisseur->id}}" {{$selec}}>{{$fournisseur->libelle}}</option>
                                    @endforeach
                            </select>
                                <p style="color: red;font-size: 12px">NB: Les fournisseurs qui apparaissent ici sont ceux dont les cotations ont élé choisi</p>
                            </div>
                        </div>

                </div>
            <div class="modal-footer">

                        <button type="submit" class="btn btn-default">{{isset($bc)?'Modifier':'Enregistrer'}}</button>
            </div>
                </form>
        </div>

    </div>
    </div>




    <div id="ajoutercom" class="modal fade in" aria-hidden="true" role="dialog" >
        <div class="modal-dialog modal-md">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">fiche de Commande</h4>
                </div>
                @if(isset($ligne_bc))
                    <form  action="{{route('update_ligne_bc')}}" method="post">
                        @else
                            <form action="{{route('save_ligne_bc')}}" method="post">
                                @endif
                                @csrf

                                <div class="modal-body">
                                    <div class="form-group">
                                        <b><label for="libelle" class="control-label col-sm-6"> les  pro formas du fournisseur </label></b>
                                        <div >
                                            <select class="form-control selectpicker " id="id_reponse_fournisseur" name="id_reponse_fournisseur" data-live-search="true" data-size="6" required>
                                                <option value="" >SELECTIONNER UNE PRO FORMA</option>
                                                @foreach($reponse_fournisseurs as $reponse_fournisseur)


                                                    <option value="{{$reponse_fournisseur->id}}" {{isset($ligne_bc) ?'selected':''}}> Libellé:{{$reponse_fournisseur->libelleMateriel}} titre externe: ({{$reponse_fournisseur->titre_ext}})</option>
                                                @endforeach
                                            </select>
                                            <p style="color: red;font-size: 12px">NB: Les pro formas listés ici proviennent du fournisseur lié au bon de commande</p>
                                        </div>
                                    </div>
                                    <input type="hidden" name="slugbc"  value="{{isset($slugbc)? $slugbc:''}}"/>
                                    <input type="hidden" name="slugligne"  value="{{isset($ligne_bc) ?$ligne_bc->slug:''}}"/>
                                    <div class="form-group">
                                        <label class="control-label col-sm-6" for="codeRubrique">Code analytique:</label>
                                        <div class="">
                                            <select class="form-control selectpicker " id="codeRubrique" name="codeRubrique" data-live-search="true" data-size="6" required>
                                                <option value="" >SELECTIONNER UN CODE ANALYTIQUE</option>
                                                @foreach($analytiques as $analytique)


                                                    <option value="{{$analytique->id_analytique}}" {{isset($ligne_bc) && $ligne_bc->codeRubrique==$analytique->id_analytique  ?'selected':''}}> {{$analytique->codeRubrique}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                 <div class="row">
                                    <div class="col-sm-6">
                                        <label class="control-label " for="date">Remise %:</label>
                                        <div class="">
                                            <input type="number" min="0" max="100" class="form-control" id="remise" name="remise" value="{{isset($ligne_bc) ?$ligne_bc->remise_ligne_bc:''}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="control-label col-sm-6" for="quantite">Quantité:</label>
                                        <div class="">
                                            <input type="number" min="0" max="100" class="form-control" id="quantite" name="quantite" value="{{isset($ligne_bc) ?$ligne_bc->quantite_ligne_bc:''}}" >
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="control-label col-sm-6" for="Unite">Unité:</label>
                                        <div class="">
                                            <input type="text" class="form-control" id="Unite" name="Unite" value="{{isset($ligne_bc) ?$ligne_bc->unite_ligne_bc:''}}"  readonly>
                                        </div>
                                    </div>
                                     <div class="col-sm-6">
                                         <label class="control-label col-sm-6" for="Prix">Prix unitaire:</label>
                                         <div class="">
                                             <input type="text"  class="form-control" id="Prix_unitaire" name="Prix_unitaire" value="{{isset($ligne_bc) ?$ligne_bc->prix_unitaire_ligne_bc:''}}" readonly>
                                         </div>
                                     </div>
                                    <div class="col-sm-6">
                                        <label class="control-label col-sm-6" for="Prix">Prix total:</label>
                                        <div class="">
                                            <input type="text"  class="form-control" id="Prix" name="Prix" value="{{isset($ligne_bc) ?$ligne_bc->prix_tot-($ligne_bc->prix_tot*$ligne_bc->remise_ligne_bc)/100:''}}" readonly>
                                        </div>
                                    </div>
                                 </div>

                                </div>
                                <div class="modal-footer">

                                    <button type="submit" class="btn btn-default">{{isset($modifierlignebc)?'Modifier':'Enregistrer'}}</button>
                                </div>
                            </form>
            </div>

        </div>
    </div>
    <div id="listerbc" class="modal fade in" aria-hidden="true" role="dialog" >
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Liste des commandes</h4>
                </div>

                                <div class="modal-body">
@include('BC/list_ligne_bc')
                                </div>
            </div>

        </div>
    </div>


    <a href="{{route('gestion_bc_ajouter')}}" class="btn btn-success pull-right" id="Ajouter_pro" >Ajouter un bon de commande</a>   <br>
    <div class="row">
        <div class="col-sm-offset-2 col-sm-8" >    @include('BC/list_bc')</div>
    </div>

    @if(isset($bc) || isset($ajouter))
    <script>
        $(document).ready(function () {
            $('#ajouterrep').modal('show');
        });
    </script>
    @endif

    @if(isset($ajouterbc))
        <script>
            $(document).ready(function () {
                $('#ajoutercom').modal('show');
            });
        </script>
    @endif
    @if(isset($listerbc))
        <script>
            $(document).ready(function () {
                $('#listerbc').modal('show');
            });
        </script>
    @endif
    @if(isset($modifierlignebc))
        <script>
            $(document).ready(function () {
                $('#ajoutercom').modal('show');

            });
        </script>
    @endif

    <script>

        function lisibilite_nombre(nbr)

        {

            var nombre = ''+nbr;

            var retour = '';

            var count=0;

            for(var i=nombre.length-1 ; i>=0 ; i--)

            {

                if(count!=0 && count % 3 == 0)

                    retour = nombre[i]+' '+retour ;

                else

                    retour = nombre[i]+retour ;

                count++;

            }

            //          alert('nb : '+nbr+' => '+retour);

            return retour;

        }

        function ilisibilite_nombre(valeur){

            for(var i=valeur.length-1; i>=0; i-- ){valeur=valeur.toString().replace(' ','');

            }

            return valeur;

        }

        $(document).ready(function () {
            $('#id_reponse_fournisseur').change(function (e) {
                var proforma=$("#id_reponse_fournisseur").val();
                if(proforma!=''){
                    $.get("../detail_rep_fournisseur/"+proforma,
                            function (data) {
                                $('#quantite').val(data.quantite);
                                $('#Unite').val(data.unite);
                                $('#Prix').val(lisibilite_nombre(data.prix-(data.prix*data.remise)/100));
                                $('#Prix_unitaire').val(data.prix);
                                $('#remise').val(data.remise);

                            }
                    );
                }else{
                    $('#quantite').val('');
                    $('#Unite').val('');
                    $('#Prix').val('');
                    $('#Prix_unitaire').val('');
                    $('#remise').val('');
                }

            });

        $('#quantite').change(function (e){
 var qte= $('#quantite').val();
            var remise= $('#remise').val();

            var prix_unitaire=$('#Prix_unitaire').val();
            var tot=qte*prix_unitaire;
            var remise_montant=(tot*remise)/100;
            var tot_avec_remise=tot-remise_montant
            $('#Prix').val(lisibilite_nombre(tot_avec_remise));
        });


        });

    </script>
@endsection

