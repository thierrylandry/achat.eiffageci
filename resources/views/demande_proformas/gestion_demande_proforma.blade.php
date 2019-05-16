
@extends('layouts.app')
@section('demande_proformas')
    class='active'
@endsection
@section('parent_demande_proformas')
    class='active'
@endsection
@section('content')

    <!-- debut  -->

<style> .pour_modal{ display: none !important;}</style>
    <div id="personnaliser_mail" class="modal fade in" aria-hidden="true" role="dialog"  >
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Personnaliser l'E-mail</h4>
                </div>

                <form action="{{route('send_it_personnalisé_ddd')}}" onsubmit="return confirm('Voulez vous envoyé?');"  method="post">

                    @csrf
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline">


                                <!-- /.card-header -->
                                <div class="card-body">
                                    <input  name="daas" id="daas" class="form-control" style="visibility: hidden"/>
                                    <label>cci :</label>
                                    <div class="form-group">

                                        <input id="To" name="To" class="form-control col-sm-9" placeholder="To:" readonly>

                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" id="objet" name="objet" placeholder="Subject:" value="EGCCI-PHB/Demande de devis -" >
                                    </div>
                                    <div class="form-group">

                                        <textarea  id="compose-textarea" name="compose-textarea" class="form-control"  style="overflow-y: scroll;max-height: 300px;min-height: 300px;"></textarea>

                                    </div>

                                </div>

                                <!-- /.card-footer -->
                            </div>
                            <!-- /. box -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="float-right">
                            <button type="submit" id="send_it_personnalisé" class="btn btn-primary"> <i class="fa fa-file-pdf-o"></i> <i class="fa fa-envelope-o"></i> <i class="fa fa-paper-plane-o"></i></button>
                        </div>

                    </div>
                </form>
            </div>

        </div>
    </div>
    <!-- fin -->

    <h2>DEMANDER DES DEVIS AUX FOURNISSEURS </h2>
    <div class="row">
        <br>
        <div class="alert alert-warning ">
            <span class="alert-icon"><i class="fa fa-bell-o"></i></span>
            <div class="notification-info">
                <ul class="clearfix notification-meta">
                    <li class="pull-left notification-sender">Vous avez  <b style="font-size: 24px">{{sizeof($types)}}</b>  domaine(s) d'activité en attente de traitement</li>

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
                                                <label> Les fournisseurs concernés</label>
                                                <input type="text" id="fournisseur" name="fournisseur"   value="" required style="visibility: hidden"/>

                                            </div>
                                            <div id="jstree" >

                                            </div>
                                        </div>

                                        </br>
                                        </br>
                                        </br>
                                        <div class="row" >
                                            <div class="col-sm-5"> <button type="submit" class="btn btn-success form-control"> ENVOYER MAIL</button></div>
                                            <div class="col-sm-3">  <a href="" data-toggle="modal" data-target="#personnaliser_mail" class="btn btn-success" id="personnaliser">
                                                    <i class="fa fa-file-pdf-o"></i><i class="fa fa-paper-plane-o"></i> personnaliser le mail
                                                </a></div>

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
                            <th class="dt-head-center">Date de la demande</th>
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
            <h3 id="titre">Historique des envois de mail :</h3>
            <table name ="historique" id="historique" class='table table-bordered table-striped  no-wrap display'>

                <thead>

                <tr>
                    <th class="dt-head-center">id</th>
                    <th class="dt-head-center" >Destinataire</th>
                    <th class="dt-head-center">Email</th>
                    <th class="dt-head-center">Objet</th>
                    <th class="dt-head-center">Contenue du mail</th>
                    <th class="dt-head-center">Date et heure</th>
                    <th class="dt-head-center">Action</th>

                </tr>
                </thead>
                <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">
@foreach($trace_mails as $trace_mail)
    <tr>
        <td>
            {{$trace_mail->id}}
        </td>
        <td>
            @foreach( explode(',',$trace_mail->id_fournisseur) as $id)

                @foreach( $fournisseurs as $fourn)
                    @if($fourn->id==$id)
                        {{$fourn->libelle}}</br>
                        @endif
                    @endforeach
                @endforeach
        </td>
        <td>
            @foreach( explode(',',$trace_mail->email) as $email)

                {{$email}}</br>

            @endforeach

        </td>
        <td>
            {{$trace_mail->objet}}
        </td>
        <td>
            {{$trace_mail->msg_contenu}}
        </td>
        <td>
            {{date_format(new DateTime($trace_mail->created_at),'d-m-Y H:i:s')}}
        </td>
        <td>
            <a href="{{route("nouveau_rappel",$trace_mail->id)}}" class="btn btn-primary">Rappel</a>
        </td>
    </tr>
    @endforeach
                </tbody>
            </table>

        </div>
    </div>


    <script src="{{ URL::asset("js/dataTables.buttons.min.js") }}"></script>
    <script src="{{ URL::asset("js/buttons.flash.min.js") }}"></script>
    <script src="{{ URL::asset("js/jszip.min.js") }}"></script>
    <script src="{{ URL::asset("js/dataTable.pdfmaker.js") }}"></script>
    <script src="{{ URL::asset("js/vfs_fonts.js") }}"></script>
    <script src="{{ URL::asset("js/buttons.html5.min.js") }}"></script>
    <script src="{{ URL::asset("js/buttons.print.min.js") }}"></script>
    <script src="{{ URL::asset('js/jstree.min.js') }}"></script>
    <script src="{{ URL::asset('js/jstree.checkbox.js') }}"></script>
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

    // variable mail//
    var mail="";

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
    function getExportFileName(){
        $('#domaine').selectpicker('refresh');
       return "Domaine :"+$('#domaine option:selected').text();
    }
        var table = $('#gestion_demande_proforma').DataTable({

            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [ 1, 2, 5,6,7 ]
                    },
                    text:"Copier",
                    filename: function () { return getExportFileName();},
                    className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                    messageTop: function () { return getExportFileName();}

                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [ 1, 2, 5,6,7 ]
                    },
                    text:"Excel",
                    filename: function () { return getExportFileName();},
                    className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                    messageTop: function () { return getExportFileName();}

                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [ 1, 2, 5,6,7 ]
                    },
                    text:"PDF",
                    filename: function () { return getExportFileName();},
                    className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                    messageTop: function () { return getExportFileName();}

                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [ 1, 2, 5,6,7 ]
                    },
                    text:"Imprimer",
                    filename: function () { return getExportFileName();},
                    className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                    messageTop: function () { return getExportFileName();}

                }
                ],
            'columnDefs': [
                {
                    'targets': 0,
                    'checkboxes': {
                        'selectRow': true
                    }
                },
                { "width": "10%", "targets": 2 }
            ],
            'select': {
                'style': 'multi'
            },
            'order': [[0, 'desc']],
            language: {
                url: "{{ URL::asset('public/js/French.json') }}"
            },
            "ordering":true,
            "responsive": true,
            "createdRow": function( row, data, dataIndex){

            }
        });
    console.log(table);
        var table1 = $('#historique').DataTable({
            language: {
                url: "{{ URL::asset('public/js/French.json') }}"
            },
            "ordering":false,
            "responsive": true,
            "autoWidth": false,
            'columnDefs': [
                { "width": "20%", "targets": 2 }
            ],
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
    $('#personnaliser').click(function(e){
        var rows_selected = table.column(0).checkboxes.selected();
        var testselect=0;
        var testrow=0;

        $.each(selection, function(index, email){
            // Create a hidden element
            //   console.log(email);
            testselect=testselect+1;

        });
        $.each(rows_selected, function(index, email){
            // Create a hidden element
            console.log(email);
            testrow=testrow+1;

        });
        console.log(testrow+" "+testselect);
        domaine=$("#domaine  option:selected").text();



        if( testrow>0 && testselect>0){
            console.log(rows_selected);
            // Iterate over all selected checkboxes
            var variable2='';
            $.each(selection, function(index, email){
                // Create a hidden element
                console.log(email);
                if(email!=""){
                    variable2=variable2+','+email.id;
                }


            });
            variable2=variable2.substring(1,variable2.length)
            $('#To').val(variable2);
            var mavariable='';
            $.each(rows_selected, function(index, rowId){
                // Create a hidden element
                console.log(rowId);
                mavariable=mavariable+','+rowId;

            });
            //$("#compose-textarea").val(mail);
            var date =new Date();
            $("#objet").val("EGCCI-PHB/Demande de devis -"+domaine+"- "+date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear());
            var corps= "";
$('#daas').val(mavariable);
            $.get("recup_infos_pour_envois_mail_perso/"+mavariable,
                    function (data) {


                        $.each(data['corps'],function (index, value) {
                            corps=corps +value+"\r\n";
                        });
                        var debumail="\r\nBonjour,\r\nVeuillez svp nous adresser votre meilleure offre pour :\r\n";

                        var precision="";

                        $.each(data['precision'],function (index, value) {
                            if(value!=""){
                                precision=+"\r\n"+precision +value;
                            }

                        });

                        var finmail="Dans l’attente, et en vous remerciant par avance. \r\n";
                        $('#compose-textarea').val(debumail+corps+precision+finmail);
                    });


        }else{
            alert("Veuillez selectionner les D.A et les fournisseurs");

            $('#compose-textarea').val("");
            $('#personnaliser_mail').modal(false);

        }
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
                                    value.created_at ,
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
            var checkbox = document.getElementById('rappel');
            if (checkbox.checked != true){
                $('#listeDA').val("");
            }else{

                $('#listeDA').val("test");
            }
        });

    })(jQuery);
</script>

@endsection