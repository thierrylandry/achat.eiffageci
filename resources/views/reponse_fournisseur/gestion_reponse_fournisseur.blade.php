
@extends('layouts.app')
@section('reponse_fournisseur')
    class='active'
@endsection
@section('parent_demande_proformas')
    class='active'
@endsection
@section('content')

    <script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/js/dataTables.checkboxes.min.js"></script>

    <h2>RECEPTION DE DEVIS DES FOURNISSEURS </h2>
    <div class="row">
        <div class="col-sm-12">

            <form action="{{route('selection_de_la_reponse')}}" method="post"><div id="daencours">

                    <table name ="gestion_reponse_fournisseur" id="gestion_reponse_fournisseur" class='table table-bordered table-striped  no-wrap '>

                        <thead>

                        <tr>
                            <th class="dt-head-center">id</th>
                            <th class="dt-head-center">id_materiel</th>
                            <th class="dt-head-center">Service</th>
                            <th class="dt-head-center">Matériel et consultation</th>
                            <th class="dt-head-center" width="5%">Quantité</th>
                            <th class="dt-head-center" width="10%">Pour le ?</th>
                            <th class="dt-head-center">Fournisseur</th>
                            <th class="dt-head-center">Prix Unitaire</th>
                            <th class="dt-head-center">Monaie</th>
                        </tr>
                        </thead>
                        <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">

                        @foreach($das as $da )




                            <tr>
                                <td>{{$da->id}}</td>
                                <td>
                                    @foreach($materiels as $materiel )
                                        @if($materiel->id==$da->id_materiel)

                                            <input type="text" value="{{$materiel->id_materiel}}" id="row_n_{{$da->id}}_id_materiel" name="row_n_{{$da->id}}_id_materiel"/>
                                        @endif
                                    @endforeach
                                </td>
                                <td>@foreach($users as $user )
                                        @if($user->id==$da->id_user)
                                            <b style=" font-size: 15px; color:black ">{{$user->service}}</b>
                                        @endif
                                    @endforeach</td>
                                <td>
                                    @foreach($materiels as $materiel )
                                        @if($materiel->id==$da->id_materiel)

                                            <input type="text" value="{{$materiel->libelleMateriel}}" id="row_n_{{$da->id}}_titre_ext" name="row_n_{{$da->id}}_titre_ext"/>
                                        @endif
                                    @endforeach
                                </td>


                                <td> <input min="0" type="number" value="{{$da->quantite}}" class="form-control" id="row_n_{{$da->id}}_quantite" name="row_n_{{$da->id}}_quantite"> </td>
                                <td>{{$da->DateBesoin}}</td>
                                <td><select class="form-control" id="row_n_{{$da->id}}_fournisseur" name="row_n_{{$da->id}}_fournisseur">
                                        <option value="">SELECTIONNER UN  FOURNISSEUR</option>
                                        @foreach($fournisseurs as $fournisseur)
                                            @if($fournisseur->domaine==$da->type)
                                                <option value="{{$fournisseur->id}}">{{$fournisseur->libelle}}</option>
                                            @endif
                                        @endforeach</select></td>
                                <td><input class="form-control"  type="number" min="0" id="row_n_{{$da->id}}_prix_unitaire" name="row_n_{{$da->id}}_prix_unitaire" /></td>
                                <td><select class="form-control" style="width: 100px;"><option value="Fr CFA">Fr CFA</option><option value="EURO">EURO</option></select></td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                    <input type="button" class="btn btn-success pull-right" id="soumettre" name="soumettre" value="Soumettre" />


            </form>
        </div>


    </div>
    <script>

        (function($) {

            //debut
            var table1 = $('#gestion_reponse_fournisseur').DataTable({
                language: {
                    url: "js/French.json"
                },
                "ordering":true,
                "responsive": true,
            }).column(0).visible(false).column(1).visible(false);

            $('#gestion_reponse_fournisseur').on( 'click', 'tr', function () {



            } );


            $('#soumettre').click( function() {
                var data = table1.rows().data();
                var lesId;
                data.each(function (value, index) {
                    var valeur=parseInt(value);
                    if(typeof(valeur)!=="undefined"){
                        lesId=lesId+','+valeur;
                    }

                });
                var res= Array();
                res.push(table1.$('input, select').serialize()) ;

             //   console.log(data);
                $.post("enregistrer_devis/"+res+"/"+lesId,
                        function (data) {

                        }
                );
                return false;
            } );
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


            $('#id_lignebesoin').change(function(e){
                var da=$("#id_lignebesoin").val();
                $('#id_lignebesoin').val(da);
                $.get("les_das_fournisseurs_funct_da/"+da,
                        function (data) {
                            $('#id_fournisseur').empty();
                            $('#id_fournisseur').append("<option>SELECTIONNER UN FOURNISSEUR</option>");
                            $.each(data, function( index, value ) {


                                $('#id_fournisseur').append("<option value='"+value.id+"'>"+value.libelle+"</option>");

                            });

                            $('#id_fournisseur').selectpicker('refresh');
                            console.log(data);
                        }
                );



            });


        })(jQuery);
    </script>
@endsection