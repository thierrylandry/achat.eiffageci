
@extends('layouts.app')
@section('demande_proformas')
    class='active'
@endsection
@section('parent_demande_proformas')
    class='active'
@endsection
@section('content')

    <script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/js/dataTables.checkboxes.min.js"></script>

    <h2>DEMANDER DES DEVIS AUX FOURNISSEURS </h2>
    <div class="row">
        <br>
        <div class="alert alert-warning ">
            <span class="alert-icon"><i class="fa fa-bell-o"></i></span>
            <div class="notification-info">
                <ul class="clearfix notification-meta">
                    <li class="pull-left notification-sender">Vous avez  <b style="font-size: 24px">{{sizeof($types)}}</b>  domaine(s) d'activité qui ont fait  l'objet de demande d'achat</li>

                </ul>
                <p>
                    ...
                </p>
            </div>
        </div>
        <br>
                <div class="col-sm-4">

                                    <form role="form" id="FormRegister" class="bucket-form" method="post" action="{{route('envoies')}}" onsubmit="return confirm('Voulez vous envoyer le(s) email(s)?');">
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

                        <input type="text" class="form-control" id="listeDA" name="listeDA" placeholder="" value="" style="visibility: hidden" required>
                        <br>
                                        <div class="form-group">
                                      rappel :  <input type="checkbox" name="rappel" id="rappel"/>
                                            </div>

                                        <div style="">
                                            <div class="form-group">
                                                <label> Les fournisseur concerné</label>
                                                <input type="text" id="fournisseur" name="fournisseur"   value="" required style="visibility: hidden"/>

                                            </div>
                                            <div id="jstree" >

                                            </div>
                                        </div>

                                        </br>
                                        </br>
                                        </br>
                                        <div class="form-group" >
                            <button type="submit" class="btn btn-success form-control"> ENVOYER MAIL</button>
                        </div>

                    </form>
                </div>
                <div class="col-sm-8">
                        <h3 id="titre">Domaine :</h3>
                    <table name ="gestion_demande_proforma" id="gestion_demande_proforma" class='table table-bordered table-striped  no-wrap display'>

                        <thead>

                        <tr>
                            <th class="dt-head-center">id</th>
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
    </div>
    </br>
    </br>
    <div class="row col-sm-offset-0">
        <div class="col-sm-12">
            <h3 id="titre">Hisorique des envois de mail :</h3>
            <table name ="historique" id="historique" class='table table-bordered table-striped  no-wrap display'>

                <thead>

                <tr>
                    <th class="dt-head-center">id</th>
                    <th class="dt-head-center">type de mail</th>
                    <th class="dt-head-center">Destinataire</th>
                    <th class="dt-head-center">email</th>
                    <th class="dt-head-center">Produit et service </th>
                    <th class="dt-head-center">Date et heure</th>

                </tr>
                </thead>
                <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">
@foreach($trace_mails as $trace_mail)
    <tr>
        <td>
            {{$trace_mail->id}}
        </td>
        <td>
            @if($trace_mail->rappel=="on")
            Rappel
                @else
              demande
                @endif
        </td>
        <td>
            {{$trace_mail->libelle}}
        </td>
        <td>
            {{$trace_mail->email}}
        </td>
        <td>
            {{$trace_mail->das}}
        </td>
        <td>
            {{$trace_mail->created_at}}
        </td>
    </tr>
    @endforeach
                </tbody>
            </table>

        </div>
    </div>
    <script src="{{ URL::asset('js/jstree.min.js') }}"></script>
    <script src="{{ URL::asset('js/jstree.checkbox.js') }}"></script>
    <script>
        selection= Array();
        $('#jstree').jstree({
            "core" : {
                "themes" : {
                    "variant" : "large"
                }
            },
            "checkbox" : {
                "keep_selected_style" : false
            },
            "plugins" : [ "wholerow", "checkbox" ]
        });
        $('#jstree').on("changed.jstree", function (e,data){

            selection=$('#jstree').jstree(true).get_bottom_selected(true);

            valeur="";
            $.each(selection,function (index, value) {
                if (value != null)
                    valeur=valeur+ ','+value.id;
            });
            $('#fournisseur').val(valeur);

            console.log(selection);

        })

    </script>
<script>

    (function($) {

        //debut


        //fin
       $('#fourn').selectpicker({

            noneSelectedText: 'AUCUN ELEMENT SELECTIONNE',
           selectAllText: 'Selectionner tout',
           deselectAllText: 'Désélectionner Tout',
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
        var table1 = $('#historique').DataTable({
            language: {
                url: "js/French.json"
            },
            "ordering":false,
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
var nom="";
                                if(value.prenoms!=null){
                                    nom=value.nom+" "+value.prenoms;
                                }else{
                                    nom=value.nom;
                                }

                                $('#gestion_demande_proforma').DataTable().row.add([
                                    value.id,
                                    value.libelleMateriel,
                                    value.libelleNature,
                                    value.quantite+" "+ value.unite,
                                    value.DateBesoin,
                                    value.demandeur,
                                    nom

                                ]);

                            });
                            $('#gestion_demande_proforma').DataTable().draw();
                        }

                );

                $.get("les_das_fournisseurs_funct/"+$domaine,
                        function (data) {
                         //   $('#jstree').empty();
                            var chaine= "<ul>";
                            var le_selectionne="";

                            $.each(data, function( index, value ) {


                                $('#fourn').append("<option value='"+value.slug+"'>"+value.libelle+"</option>");


                                //chaine+="<li id='"+value.slug+"'>"+value.libelle+"</li>";

                                var chaine_du_milieu="";
                                var contact= JSON.parse(value.contact);

                                le_selectionne=value.contact;
                                $.each(contact, function( indexi, valeur ) {

                                    chaine_du_milieu+="<li id='"+valeur.valeur_c+"'>"+valeur.valeur_c+"</li>";

                                });
                                chaine+="<li id='"+value.slug+"'>"+value.libelle;
                                chaine+="<ul>"+chaine_du_milieu+"</ul></li>";
                              //  console.log(value.libelle);
                                console.log(value.contact);
                            });
                            chaine+="</ul>";

                           // $('#jstree').append(chaine);
                            $('#jstree').jstree(true).settings.core.data = chaine;
                            $('#jstree').jstree(true).refresh();

                           var selec= data[0];
                           var contact= JSON.parse(selec.contact);
                            $('#jstree').jstree('select_node',contact[0].valeur_c);
                            $('#fourn').selectpicker('refresh');
                            console.log(contact[0].valeur_c);
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

        $('#fourn').change(function(e){
            $tab_fourn=$(this).val();
            $list_da=$("#listeDA").val();
            $.get("demande_ou_rappel/"+$tab_fourn+"/"+$list_da,
                    function (data) {


                    }
            );
        });
        $('#rappel').click(function(e){
  
        });

    })(jQuery);
</script>

@endsection