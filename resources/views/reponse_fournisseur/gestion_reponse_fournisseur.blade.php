
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
    <div class='form-group'><label for='agree' class='control-label '>Rechercher parmit toute les D.A</label><div><input type='checkbox' style='width: 25px;' class='checkbox form-control' id='rechercher'  ></div></div>

    <div class="row">

        <form action="{{route('selection_de_la_reponse')}}" method="post"><div id="daencours" class="form-group col-sm-3">
                 <b><label for="libelle" class="control-label">Demande approvisionnement en cours</label></b>
                @csrf

            <select class="form-control selectpicker " id="da11" name="da" data-live-search="true" data-size="6">
                <option  value="">SELECTIONNER UNE D.A EN COURS</option>
                @foreach($types as $type)
                    <option value="{{$type->id}}">{{$type->libelleMateriel}} -- {{$type->quantite}} {{$type->unite}}</option>
                @endforeach
            </select>
        </div>
        <div  id="Touteda"class="form-group col-sm-3 hidden" >
            <b><label for="libelle" class="control-label">Toutes les demandes d'approvisionnement</label></b>


            <select class="form-control selectpicker " id="Tda" name="Tda" data-live-search="true" data-size="6">
                <option  value="">SELECTIONNER UNE D.A</option>
                @foreach($types as $type)
                    <option value="{{$type->id}}">{{$type->libelleMateriel}} -- {{$type->quantite}} {{$type->unite}}</option>
                @endforeach
            </select>
        </div>
        <a href="#" class="btn btn-success pull-right" id="Ajouter_pro" data-target='#ajouterrep' data-toggle='modal'>Ajouter Devis</a>   <br>

                <div class="col-sm-12">

                                    <table name ="gestion_reponse_fournisseur" id="gestion_reponse_fournisseur" class='table table-bordered table-striped  no-wrap display'>

                                        <thead>

                                        <tr>
                                            <th class="no-sort">id</th>
                                            <th class="no-sort">Choix</th>
                                            <th class="no-sort">fournisseur</th>
                                            <th class="no-sort">Titre externe du produit</th>
                                            <th class="no-sort">Quantité</th>
                                            <th class="dt-head-center">Prix</th>
                                            <th class="no-sort">remise</th>
                                            <th class="no-sort">date</th>
                                            <th class="no-sort">Action</th>
                                            <th class="no-sort">idfourn</th>


                                        </tr>
                                        </thead>
                                        <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">

                                        </tbody>
                                    </table>

                    <button class="btn btn-success pull-right" type="submit">Soumettre votre choix</button>
                </div>
        </form>

        <div id="ajouterrep" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Réponse d'un fournisseur</h4>
                    </div>
                    <form action="{{route('ajouter_reponse')}}" method="post">
                        @csrf
                    <div class="modal-body">
                        <br>
                        <input id="id_reponse" name="id_reponse" type="hidden" value="" />
                        <div class="form-group">
                            <b><label for="libelle" class="control-label">Demande approvisionnement en cours</label></b>


                            <select class="form-control selectpicker " id="id_lignebesoin" name="id_lignebesoin" data-live-search="true" data-size="6" required>
                                <option  value="">SELECTIONNER UNE D.A EN COURS</option>
                                @foreach($types as $type)
                                    <option value="{{$type->id}}">{{$type->libelleMateriel}} -- {{$type->quantite}} {{$type->unite}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                                <b><label for="libelle" class="control-label">Fournisseur</label></b>
                                <select class="form-control selectpicker" id="id_fournisseur" name="id_fournisseur" data-live-search="true" data-size="6" required>
                                    <option value="" >SELECTIONNER UN FOURNISSEUR</option>
                                </select>
                            </div>
                            <div class="form-group ">
                                <b><label for="libelle" class="control-label">Titre externe du produit</label></b>
                                <input class="form-control" type="text"  name="titre_ext" id="titre_ext"/>
                            </div>
</br>
                        <div class="form-group col-sm-6">
                            <b><label for="remise" class="control-label ">Remise %</label></b>
                            <input class="form-control" type="number"  name="remise" id="remise" required/>
                        </div>
                        <div class="form-group col-sm-6">
                            <b><label for="remise" class="control-label ">Date</label></b>
                            <input class="form-control" type="date" id="date"  name="date" required/>
                        </div>
                        <div class="form-group col-sm-4">
                            <b><label for="libelle" class="control-label ">Quantite</label></b>
                            <input class="form-control" type="number"  name="quantite_reponse" id="quantite_reponse"/>
                        </div>
                        <div class="form-group col-sm-4">
                            <b><label for="libelle" class="control-label">Unite</label></b>
                            <input class="form-control" type="text"  name="unite_reponse" id="unite_reponse"/>
                        </div>
                        <div class="form-group col-sm-4">
                            <b><label for="libelle" class="control-label">Prix  unitaire</label></b>
                            <input class="form-control" type="number"  name="prix_reponse" id="prix_reponse"/>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit"  class="btn btn-succes" name="btn_gestion_reponse"  id="btn_gestion_reponse">Ajouter</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    </div>
                    </form>
                </div>

            </div>
        </div>



<script>

    (function($) {

        //debut

//si on recherche parmit toute les D.A ou nom
        $('#rechercher').change(function(e){
            $('#da').val('');
            $('#da').selectpicker('refresh');
            $('#Tda').val('');
            $('#Tda').selectpicker('refresh');
            if($(this).prop('checked') == true){
                if($('#Touteda').hasClass('hidden')){
$('#Touteda').removeClass('hidden');
$('#daencours').addClass('hidden');

                }
                $('#gestion_reponse_fournisseur').DataTable().clear();
                $('#gestion_reponse_fournisseur').DataTable().draw();
            }else{
                if($(this).prop('checked') == false) {
                    if ($('#daencours').hasClass('hidden')) {
                        $('#daencours').removeClass('hidden');
                        $('#Touteda').addClass('hidden');

                    }
                }
                $('#gestion_reponse_fournisseur').DataTable().clear();
                $('#gestion_reponse_fournisseur').DataTable().draw();
            }
        }) ;
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
        var table1 = $('#gestion_reponse_fournisseur').DataTable({
            language: {
                url: "js/French.json"
            },
            "ordering":true,
            columnDefs: [{
                orderable: false,
                targets: "no-sort"
            }],
            "responsive": true,
        }).column(0).visible(false).column(9).visible(false);

        $('#example tbody').on( 'click', 'tr', function () {
            $(this).toggleClass('selected');
        } );

        $('#button').click( function () {
            alert( table.rows('.selected').data().length +' row(s) selected' );
        } );

        $("body").on("click","#Ajouter_pro",function(){
            $('#btn_gestion_reponse').html("Ajouter");

            $('#titre_ext').val('');
            $('#id_reponse').val('');
            $('#quantite_reponse').val('');
            $('#unite_reponse').val('');
            $('#prix_reponse').val('');
            $('#id_fournisseur').val('');

        });
        $("body").on("click",".btn_modifier",function(){

            $('#btn_gestion_reponse').html("Modifier");
            var data = table1.row($(this).closest('tr')).data();
            $('#id_lignebesoin').val($('#id_lignebesoin').val());
            var uti_entite =data[Object.keys(data)[0]];
            var libproduit =data[Object.keys(data)[3]];
            var quantite =data[Object.keys(data)[4]];
            var prix =data[Object.keys(data)[5]];
            var fournisseur =data[Object.keys(data)[9]];
            var remise =data[Object.keys(data)[6]];
            var date_precise =data[Object.keys(data)[7]];

            $('#id_reponse').val(uti_entite);
          //  $('#id_lignebesoin').val(uti_entite);
           $('#id_fournisseur').val(fournisseur);

            $('#id_fournisseur').selectpicker('refresh');
            $('#remise').val(remise);
            $('#date').val(date_precise);
            $('#titre_ext').val(libproduit);
            $('#quantite_reponse').val(parseInt(quantite));
            $('#unite_reponse').val(quantite.split(" ")[1].toString());
            $('#prix_reponse').val(prix);
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
        $('#da11').change(function(e){
            var da=$("#da11").val();
            $('#id_lignebesoin').val(da);

            if(da!=''){
                $("#id_lignebesoin").val('');
                $("#id_lignebesoin").val(da);
                $("#id_lignebesoin").selectpicker('refresh');
                $('#gestion_reponse_fournisseur').DataTable().clear();
                $.get("lister_les_reponse/"+da,
                        function (data) {
                            $.each(data, function( index, value ) {
                                var action1 ='modifier_reponse_fournisseur/'+value.slug;
                                var action2 ='lister_reponse_fournisseur/'+value.slug;
                                var route='lister_reponse_fournisseur/'+value.slug;
                                var route1='ajouter_reponse_fournisseur/'+value.slug;
                                var supprimer='supprimer_reponse_fournisseur/'+value.slug;
                                var selec='';
                                console.log(value.id_reponse_fournisseur+'=='+value.id)
                                if(value.id_reponse_fournisseur==value.id){
                                    selec='checked';
                                }
                                table1.row.add([
                                    value.slug,
                                    "<div class='form-group'><label for='agree' class='control-label col-lg-3 col-sm-3'></label><div class='col-lg-6 col-sm-9'><input type='radio' required style='width: 25px;' class='radio form-control' id='agree' name='choix' value='"+value.id+"' "+selec+"></div></div>",
                                    value.libelle,
                                    value.titre_ext,
                                    value.quantite+" "+ value.unite,
                                    value.prix,
                                    value.remise,
                                    value.date_precise,
                                   "<a href='#' id='btn_modifier' data-toggle='modal'  data-target='#ajouterrep' class='btn btn-info col-sm-4 pull-right btn_modifier'><i class=' fa fa-pencil'></i></a><a href='"+supprimer+"'  class='btn btn-danger col-sm-4 pull-right'> <i class=' fa fa-trash'></i></a>",
                                        value.id_fournisseur


                                ]);

                            });
                            table1.draw();
                        }

                );
                $.get("les_das_fournisseurs_funct_da/"+da,
                        function (data) {
                            $('#id_fournisseur').empty();
                            $('#id_fournisseur').append("<option>SELECTIONNER UN FOURNISSEUR</option>");
                            $.each(data, function( index, value ) {


                                $('#id_fournisseur').append("<option value='"+value.id+"'>"+value.libelle+"</option>");

                            });

                            $('#id_fournisseur').selectpicker('refresh');
                          //  console.log(data);
                        }
                );


            }else{
            }


        });

        $('#Tda').change(function(e){
            var da=$("#Tda").val();
            $('#id_lignebesoin').val(da);

            if(da!=''){
                $("#id_lignebesoin").val('');
                $("#id_lignebesoin").val(da);
                $("#id_lignebesoin").selectpicker('refresh');
                $('#gestion_reponse_fournisseur').DataTable().clear();
                $.get("lister_les_reponse/"+da,
                        function (data) {
                            $.each(data, function( index, value ) {
                                var action1 ='modifier_reponse_fournisseur/'+value.slug;
                                var action2 ='lister_reponse_fournisseur/'+value.slug;
                                var route='lister_reponse_fournisseur/'+value.slug;
                                var route1='ajouter_reponse_fournisseur/'+value.slug;
                                var supprimer='supprimer_reponse_fournisseur/'+value.slug;
                                var selec='';
                                console.log(value.id_reponse_fournisseur+'=='+value.id)
                                if(value.id_reponse_fournisseur==value.id){
                                    selec='checked';
                                }
                                table1.row.add([
                                    value.slug,
                                    "<div class='form-group'><label for='agree' class='control-label col-lg-3 col-sm-3'></label><div class='col-lg-6 col-sm-9'><input type='radio' required style='width: 25px;' class='radio form-control' id='agree' name='choix' value='"+value.id+"' "+selec+"></div></div>",
                                    value.libelle,
                                    value.titre_ext,
                                    value.quantite+" "+ value.unite,
                                    value.prix,
                                    value.remise,
                                    value.date_precise,
                                    "<a href='#' id='btn_modifier' data-toggle='modal'  data-target='#ajouterrep' class='btn btn-info col-sm-4 pull-right btn_modifier'><i class=' fa fa-pencil'></i></a><a href='"+supprimer+"'  class='btn btn-danger col-sm-4 pull-right'> <i class=' fa fa-trash'></i></a>",
                                    value.id_fournisseur


                                ]);

                            });
                            table1.draw();
                        }

                );
                $.get("les_das_fournisseurs_funct_da/"+da,
                        function (data) {
                            $('#id_fournisseur').empty();
                            $('#id_fournisseur').append("<option>SELECTIONNER UN FOURNISSEUR</option>");
                            $.each(data, function( index, value ) {


                                $('#id_fournisseur').append("<option value='"+value.id+"'>"+value.libelle+"</option>");

                            });

                            $('#id_fournisseur').selectpicker('refresh');
                            //console.log(data);
                        }
                );


            }else{
            }


        });
    })(jQuery);
</script>
    </div>
@endsection