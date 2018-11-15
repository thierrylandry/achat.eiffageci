
@extends('layouts.app')
@section('demande_proformas')
    class='active'
@endsection
@section('parent_demande_proformas')
    class='active'
@endsection
@section('content')

    <script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/js/dataTables.checkboxes.min.js"></script>

    <h2>LES DEMANDES DE PROFORMA </h2>
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

                        </tr>
                        </thead>
                        <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">

                        </tbody>
                    </table>


                </div>

<script>

    (function($) {
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
            'order': [[1, 'asc']]
        });

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
                                $('#gestion_demande_proforma').DataTable().row.add([
                                    value.id,
                                    status,
                                    value.libelleMateriel,
                                    value.libelleNature,
                                    value.quantite+" "+ value.unite,
                                    value.DateBesoin,
                                    value.demandeur,
                                    value.id_valideur,

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