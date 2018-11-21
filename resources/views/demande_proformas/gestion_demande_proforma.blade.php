
@extends('layouts.app')
@section('demande_proformas')
    class='active'
@endsection
@section('parent_demande_proformas')
    class='active'
@endsection
@section('content')

    <script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/js/dataTables.checkboxes.min.js"></script>

    <h2>DEMANDER DES PRO FORMA AUX FOURNISSEURS </h2>
    <div class="row">
        <br>        <br>
                <div class="col-sm-4">

                                    <form role="form" id="FormRegister" class="bucket-form" method="post" action="{{route('envoies')}}">
                        @csrf

                                        <div class="form-group">
                                            <b><label for="libelle" class="control-label">Domaine d'activité</label></b>


                                            <select class="form-control selectpicker" id="domaine" name="domaine" data-live-search="true" data-size="6" required>
                                                <option  value="">SELECTIONNER UN DOMAINE</option>
                                                @foreach($types as $type)
                                                    <option value="{{$type->id}}">{{$type->libelleDomainne}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <b><label for="libelle" class="control-label">Les fournisseur concerné</label></b>
                                            <select class="form-control selectpicker" name="fourn"  id="fourn" data-live-search="true" data-size="6" multiple  required>

                                            </select>

                                        </div>

                        <input type="hidden" class="form-control" id="listeDA" name="listeDA" placeholder="" value="">
                        <br>
                                        <div class="form-group" >
                            <button type="submit" class="btn btn-success form-control">ENVOYER</button>
                        </div>

                    </form>
                </div>
                <div class="col-sm-8">
                        <h3 id="titre">Domaine :</h3>
                    <table name ="gestion_demande_proforma" id="gestion_demande_proforma" class='table table-bordered table-striped  no-wrap display'>

                        <thead>

                        <tr>
                            <th class="dt-head-center">id</th>
                            <th class="dt-head-center">statut</th>
                            <th class="dt-head-center">produits et services</th>
                            <th class="dt-head-center">Nature</th>
                            <th class="dt-head-center">Quantité</th>
                            <th class="dt-head-center">Pour le ?</th>
                            <th class="dt-head-center">Demandeur</th>
                            <th class="dt-head-center">Confirmer ou Infirmer par ?</th>
                            <th class="dt-head-center">Les réponses des fournisseurs</th>

                        </tr>
                        </thead>
                        <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">

                        </tbody>
                    </table>


                </div>

        <!-- Modal -->
        <div id="ajouterrep" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Ajouter la réponse d'un fournisseur</h4>
                    </div>
                    <form action="{{route('ajouter_reponse')}}" method="post">
                        @csrf
                    <div class="modal-body">

                            <div class="form-group">
                                <b><label for="libelle" class="control-label">Fournisseur</label></b>
                                <input class="form-control" type="hidden"  name="id_lignebesoin" id="id_lignebesoin"/>
                                <select class="form-control selectpicker" id="id_fournisseur" name="id_fournisseur" data-live-search="true" data-size="6" required>
                                    <option value="" >SELECTIONNER UN FOURNISSEUR</option>
                                    @foreach($fournisseurs as $fournisseur)
                                        <option @if(isset($prix) and $fournisseur->id==$prix->id_fournisseur)
                                                {{'selected'}}
                                                @endif value="{{$fournisseur->id}}">{{$fournisseur->libelle}}--{{$fournisseur->domaine}}--{{$fournisseur->conditionPaiement}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group ">
                                <b><label for="libelle" class="control-label">Titre externe du produit</label></b>
                                <input class="form-control" type="text"  name="titre_ext" id="titre_ext"/>
                            </div>
</br>
                        <div class="form-group col-sm-4">
                            <b><label for="libelle" class="control-label ">Quantite</label></b>
                            <input class="form-control" type="number"  name="quantite_reponse" id="quantite_reponse"/>
                        </div>
                        <div class="form-group col-sm-4">
                            <b><label for="libelle" class="control-label">Unite</label></b>
                            <input class="form-control" type="text"  name="unite_reponse" id="unite_reponse"/>
                        </div>
                        <div class="form-group col-sm-4">
                            <b><label for="libelle" class="control-label">Prix</label></b>
                            <input class="form-control" type="number"  name="prix_reponse" id="prix_reponse"/>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-succes" >Ajouter</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    </div>
                    </form>
                </div>

            </div>
        </div>
        <!-- Modal -->
        <div id="listerrep" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Lister les  réponses fournisseur</h4>
                    </div>

                        <div class="modal-body">


                            <table name ="gestion_reponse_fournisseur" id="gestion_reponse_fournisseur" class='table table-bordered table-striped  no-wrap display'>

                                <thead>

                                <tr>
                                    <th class="dt-head-center">id</th>
                                    <th class="dt-head-center">fournisseur</th>
                                    <th class="dt-head-center">Titre externe du produit</th>
                                    <th class="dt-head-center">Quantité</th>
                                    <th class="dt-head-center">Prix</th>
                                    <th class="dt-head-center">Action</th>

                                </tr>
                                </thead>
                                <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">

                                </tbody>
                            </table>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-succes" data-dismiss="modal">Ajouter</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        </div>

                </div>

            </div>
        </div>

<script>

    (function($) {

        //debut


        //fin
       $('#fourn').selectpicker({

            noneSelectedText: 'AUCUN ELEMENT SELECTIONNE',
           selectAllText: 'Selectionner tout',
           deselectAllText: 'Deselctionner Tout',
            noneResultsText: 'No results matched {0}',
            actionsBox:true,
            countSelectedText: function (numSelected, numTotal) {

                return (numSelected == 1) ? "{0} item selected" : "{0} items selected";

            }

        });
        var table = $('#gestion_demande_proforma').DataTable({


            'columnDefs': [
                {
                    'targets': 0,
                    'checkboxes': {
                        'selectRow': true
                    }
                }
            ],
            'select': {
                'style': 'multi'
            },
            'order': [[1, 'asc']],
            language: {
                url: "js/French.json"
            },
            "ordering":true,
            "responsive": true,
            "createdRow": function( row, data, dataIndex){

            }
        });
        var table1 = $('#gestion_reponse_fournisseur').DataTable({
            language: {
                url: "js/French.json"
            },
            "ordering":true,
            "responsive": true,
            "createdRow": function( row, data, dataIndex){

            }
        }).column(0).visible(false);

        $('#example tbody').on( 'click', 'tr', function () {
            $(this).toggleClass('selected');
        } );

        $('#button').click( function () {
            alert( table.rows('.selected').data().length +' row(s) selected' );
        } );
        $('#gestion_demande_proforma').change(function(e){
            var rows_selected = table.column(0).checkboxes.selected();
            console.log(rows_selected);
            // Iterate over all selected checkboxes
            var mavariable='';
            $.each(rows_selected, function(index, rowId){
                // Create a hidden element
               console.log(rowId);
                mavariable=mavariable+','+rowId;

            });
            $('#listeDA').val(mavariable);

        });
        $("body").on("click","#btn_lister",function(){
            var data = table.row($(this).closest('tr')).data();

            var uti_entite =data[Object.keys(data)[0]];
            $.get("lister_les_reponse/"+uti_entite,
                    function (data) {
                        $.each(data, function( index, value ) {
                            var action1 ='modifier_reponse_fournisseur/'+value.slug;
                            var action2 ='lister_reponse_fournisseur/'+value.slug;
                            var route='lister_reponse_fournisseur/'+value.slug;
                            var route1='ajouter_reponse_fournisseur/'+value.slug;
                            $('#gestion_reponse_fournisseur').DataTable().clear();
                            $('#gestion_reponse_fournisseur').DataTable().row.add([
                                value.slug,
                                value.libelle,
                                value.titre_ext,
                                value.quantite+" "+ value.unite,
                                value.prix,
                                " <a href='#' data-toggle='modal' data-target='#ajouterrep' data-target='#ajouterrep' class='btn btn-info col-sm-4 pull-right'><i class=' fa fa-pencil'></i></a><a href='action2' data-toggle='modal' class='btn btn-danger col-sm-4 pull-right'> <i class=' fa fa-trash'></i></a>"
                            ]);

                        });
                        $('#gestion_reponse_fournisseur').DataTable().draw();
                    }

            );
        });
        $("body").on("click","#btn_ajouter",function(){
            var data = table.row($(this).closest('tr')).data();

            var uti_entite =data[Object.keys(data)[0]];
            var libproduit =data[Object.keys(data)[2]];
            $('#id_lignebesoin').val(uti_entite);

            $('#titre_ext').val(libproduit);
        });
        $('#domaine').change(function(e){
            $domaine=$("#domaine").val();

            $('#fourn').empty();

            if($domaine!=''){
                $domaineText=$("#domaine option:selected").text();
                $.get("les_das_funct/"+$domaine,
                        function (data) {
                            $('#titre').empty();
                            $('#titre').append('Domaine :  '+$domaineText.toUpperCase());
                            $('#gestion_demande_proforma').DataTable().clear();
                            var status="<i class='fa fa-circle' style='color: mediumspringgreen'></i>";

                            $.each(data, function( index, value ) {
                                var route='lister_reponse_fournisseur/'+value.slug;
                                var route1='ajouter_reponse_fournisseur/'+value.slug;
                                $('#gestion_demande_proforma').DataTable().row.add([
                                    value.id,
                                    status,
                                    value.libelleMateriel,
                                    value.libelleNature,
                                    value.quantite+" "+ value.unite,
                                    value.DateBesoin,
                                    value.demandeur,
                                    value.id_valideur,
                                        "<a href='#' data-toggle='modal' data-target='#listerrep' id='btn_lister' ><li class='fa fa-list'></li>Lister</a><a href='#'  id='btn_ajouter' data-toggle='modal' data-target='#ajouterrep'>  <li class='fa fa-plus-square-o'></li>Ajouter</a>"

                                ]);

                            });
                            $('#gestion_demande_proforma').DataTable().draw();
                        }

                );

                $.get("les_das_fournisseurs_funct/"+$domaine,
                        function (data) {
                            $.each(data, function( index, value ) {


                               $('#fourn').append("<option value='"+value.id+"'>"+value.libelle+"</option>");

                                console.log(value.libelle);

                            });

                            $('#fourn').selectpicker('refresh');
                            console.log(data);
                        }
                );

            }else{
                $('#fourn').selectpicker('refresh');
                $('#gestion_demande_proforma').DataTable().clear();
                $('#gestion_demande_proforma').DataTable().draw();
                $('#titre').empty();
                $('#titre').append('Domaine :  ');
            }


        });
    })(jQuery);
</script>
    </div>
@endsection