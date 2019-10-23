
@extends('layouts.app')
@section('gestion_Facture')
    class='active'
@endsection
@section('gestion_Facture_parent')
    class='active'
@endsection
<style>
    tr.odd td:first-child,
    tr.even td:first-child {
        padding-left: 4em;
    }
    tbody#contenu_tableau_entite>tr.dtrg-group .dtrg-start .dtgr-level-0{
        background-color: black !important;
    }
</style>
@section('content')
    <div id="list_facture" class="modal fade in" aria-hidden="true" role="dialog" >
        <div class=" modal-md">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">DA N°  <input type="text" readonly id="numda" value="" />   </h4>
                </div>
                <form method="post" action="{{route('preciser_les_date_de_livraison')}}">
                    @csrf
                    <input type="hidden" name="lesidd" id="lesidd" value=""/>
                    <div class="modal-body" >
                        <h4>Liste des des factures </h4>
                        <table id="contenu_facture" class='table table-bordered table-striped  no-wrap '>
                            <thead>
                            <tr>
                                <th>id_facture</th>
                                <th>Date de reception</th>
                                <th>Date de facturation</th>
                                <th>Refference Facture</th>
                                <th>Ctrl BC-BL-Facture</th>
                                <th>Montant</th>
                                <th>Commantaires</th>
                                <th>action</th>
                            </tr>

                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-default" id="btn_enregistrer_date_livraison1"> <i class="fa fa-calendar-check-o"></i>Enregistrer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
<!-- modal de l'ajout de facture-->
    <div class="modal fade" id="ajouterfacture" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Facture</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('ajouterFacture')}}" method="post">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <input type="hidden" class="form-control" id="id_da" name="id_da" >
                            <input type="hidden" class="form-control" id="id_facture" name="id_facture" >
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Date de reception de la facture:</label>
                           <input type="date" class="form-control" name="dateRecepFact" id="dateRecepFact" />
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Date de facturation:</label>
                           <input type="date" class="form-control" name="dateFacturation" id="dateFacturation"/>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Ref. Facture:</label>
                           <input type="text" class="form-control" name="refFacture"  id="refFacture" required/>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Ctrl BC-BL-Facture:</label>
                            <select name="ctrlbcblFacture" class="form-control" id="ctrlbcblFacture">
                                @foreach($etatFactures as $etatFacture)
                                <option value="{{$etatFacture->id}}">{{$etatFacture->libelle}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Montant de la facture</label>
                           <input type="number" class="form-control" name="montantFacture" id="montantFacture" required/>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Commentaire</label>
                          <textarea name="commentaires" class="form-control" id="commentaires"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- modal de l'ajout de facture-->
    <h2>GESTION DES FACTURES - LISTER <a href="{{route('creer_da')}}" class="btn btn-default  pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i>   Ajouter</a></h2>
    </br>

    <div class="row">
        <div class="col-sm-12">
            {{$das->links()}}
            <table name ="tableDA" id="tableDA" class='table table-bordered table-striped  no-wrap responsive ' >

                <thead>

                <tr>
                    <th class="dt-head-center">N° BC</th>
                    <th class="dt-head-center">N°D.A</th>
                    <th class="dt-head-center">statut</th>
                    <th class="dt-head-center">date de demande</th>
                    <th class="dt-head-center">Date du BC</th>
                    <th class="dt-head-center">Matériel et consultation</th>
                    <th class="dt-head-center">Quantité</th>
                    <th class="dt-head-center">Demandeur</th>
                    <th class="dt-head-center">Code Analytique</th>
                    <th class="dt-head-center">Confirmer</th>
                    <th class="dt-head-center">Fournisseur</th>
                    <th class="dt-head-center">Date livraison effective</th>
                    <th class="dt-head-center">Action</th>

                </tr>
                </thead>
                <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">
                @foreach($das as $da )
                    <tr>
                        <th class="dt-head-center">{{isset($da->numBonCommande)?$da->numBonCommande:''}}</th>
                        <td>{{$da->id}}</td>
                        <td>

                            @if($da->etat==1)
                                <i class="fa fa-circle "  style="color: red"></i>
                                Suspendu
                            @elseif($da->etat==2)
                                <i class="fa fa-circle" style="color: mediumspringgreen"></i>
                                Acceptée
                            @elseif($da->etat==3)
                                <i class="fa fa-circle" style="color: #f0ad4e"></i>
                                En cours de traitement
                            @elseif($da->etat==0)
                                <i class="fa fa-circle" style="color: black"></i>
                                Réfusée
                            @elseif($da->etat==4)
                                <i class="fa fa-circle" style="color:#00ffff"></i>
                                Traitée et terminée
                            @elseif($da->etat==11)
                                <i class="fa fa-circle" style="color: violet"></i>
                                Traitée et retournée
                            @endif
                        </td>
                        <td> {{\Carbon\Carbon::parse($da->created_at)->format('d-m-Y H:i:s')}}</td>
                        <th class="dt-head-center">{{isset($da->bondecommande->date)?\Carbon\Carbon::parse($da->bondecommande->date)->format('d-m-Y'):''}}</th>
                        <td>{{$da->libelleMateriel}}</td>
                        <td>{{$da->quantite}} {{$da->unite}}</td>
                        <td>{{$da->demandeur}}</td>
                        <td>{{isset($da->devis->codeRubrique)?$da->devis->codeRubrique:''}}</td>
                        <td>
                            @foreach($service_users as $service_user )
                                @if($service_user->id==$da->id_valideur)
                                    {{$service_user->nom}}
                                    {{$service_user->prenoms}} le   {{\Carbon\Carbon::parse($da->dateConfirmation)->format('d-m-Y H:i:s')}}
                                @endif
                            @endforeach</td>
                        <td>
                            {{isset($da->bondecommande->fournisseur->libelle)?$da->bondecommande->fournisseur->libelle:''}}
                        </td>
                        <td> {{$da->date_livraison_eff!=""?\Carbon\Carbon::parse($da->date_livraison_eff)->format('d-m-Y'):''}}
                        </td>
                        <td>
                            <a href="#ajouterfacture" data-toggle="modal" class="btn btn-info col-sm-12 clickici ">
                                <i class="fa fa-plus-circle"></i> Ajouter
                            </a>
                            <a href="#list_facture" data-toggle="modal" class="btn btn-success col-sm-12 lesfactures ">
                                <i class="fa fa-list"></i> Factures
                            </a>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
    <script src="{{ URL::asset("js/dataTables.buttons.min.js") }}"></script>
    <script src="{{ URL::asset("js/dataTables.rowGroup.min.js") }}"></script>
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
        (function($) {
            var date =new Date();

            var table= $('#tableDA').DataTable({

                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [ 1, 2, 5,6,7,8,9,10,11,12,13,14 ]
                        },
                        text:"Copier",
                        filename: "Liste des D.A "+date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                        className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                        messageTop: "Liste des D.A "+date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),

                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [ 1, 2, 5,6,7,8,9,10,11,12,13,14 ]
                        },
                        text:"Excel",
                        filename: "Liste des D.A "+date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                        className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                        messageTop: "Liste des D.A "+date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                        orientation: 'landscape',

                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [ 1, 2, 5,6,7,8,9,10,11,12,13,14 ]
                        },
                        text:"PDF",
                        filename: "Liste des D.A "+date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                        className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                        messageTop: "Liste des D.A "+date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                        orientation: 'landscape',

                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [ 1, 2, 5,6,7,8,9,10,11,12,13,14 ]
                        },
                        text:"Imprimer",
                        filename: "Liste des D.A"+date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                        className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                        messageTop: "Liste des D.A "+date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                        orientation: 'landscape',

                    }
                ],
                language: {
                    url: "{{ URL::asset('public/js/French.json') }}"
                },

                "ordering":true,
                "paging": false,
                "createdRow": function( row, data, dataIndex){

                    if( data[0] ==  'someVal'){
                        $(row).addClass('redClass');
                    }
                },
                "drawCallback": function (settings){
                    var api = this.api();

                    // Zero-based index of the column containing names
                    var col_name = 0;

                    // If ordered by column containing names
                    if (api.order()[0][0] === col_name) {
                        var rows = api.rows({ page: 'current' }).nodes();
                        var group_last = null;

                        api.column(col_name, { page: 'current' }).data().each(function (name, index){
                            var group = name;
                            var data = api.row(rows[index]).data();

                            if (group_last !== group) {
                                $(rows[index]).before(
                                        '<tr class="group" style="background-color:#1f0707;color:white"><td colspan="11"><b>Bon de commande : ' + group + '</b></td></tr>'
                                );

                                group_last = group;
                            }
                        });
                    }
                },
                responsive: false,
                order: [[0, 'desc']],
                columnDefs: [ {
                    targets: [ 1, 2 ],
                    visible: false
                } ],
                rowGroup: {
                    startRender: function ( rows, group ) {
                        return 'Nombre de ligne '+' ('+rows.count()+')';

                    },
                    endRender: null,

                    dataSrc: [0]
                },
            });
            var tablecontenu_facture= $('#contenu_facture').DataTable({
                dom: 'Bfrtip',
                language: {
                    url: "{{ URL::asset('public/js/French.json') }}"
                },
                "order": [[ 0, 'desc' ]],
                "ordering":true,
                "paging": false,
                "createdRow": function( row, data, dataIndex){

                },
            }).column(0).visible(false);
            //table.DataTable().draw();
            $('a.toggle-vis').on( 'click', function (e) {
                e.preventDefault();

                // Get the column API object
                var column = table.column( $(this).attr('data-column') );

                // Toggle the visibility
                column.visible( ! column.visible() );
            } );
            $('#tableDA tbody').on( 'click', 'tr', function () {
                if ( $(this).hasClass('selected') ) {
                    $(this).removeClass('selected');
                }
                else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            } );

            $('#button').click( function () {
                //   table.row('.selected').remove().draw( false );
            } );


            $("body").on("click",".clickici",function(){
                //   var selec= this;
                var data = table.row($(this).closest('tr')).data();
                $('#id_da').val(data[Object.keys(data)[1]]);
                console.log(data[Object.keys(data)[1]]);
                $('#dateRecepFact').val("");
                $('#dateFacturation').val("");
                $('#refFacture').val("");
                $('#ctrlbcblFacture').val(1);
                $('#montantFacture').val("");
                $('#commentaires').val("");

                $('#boutonEnregistrerfac').html('Enregistrer');
                $('#id_facture').val('');
            });

            $("body").on("click",".modiffac",function(){
                //   var selec= this;
              //  alert('test');
                var data = tablecontenu_facture.row($(this).closest('tr')).data();
                //$('#id_da').val(data[Object.keys(data)[1]]);
                $('#boutonEnregistrerfac').html('Modifier');
                console.log(data[Object.keys(data)[0]]);
                $.get("afficherfacture/"+data[Object.keys(data)[0]],
                        function (data) {
                            $('#dateRecepFact').val("");
                            $('#dateFacturation').val("");
                            $('#refFacture').val("");
                            $('#ctrlbcblFacture').val(1);
                            $('#ctrlbcblFacture').selectpicker('refresh');
                            $('#montantFacture').val("");
                            $('#commentaires').val("");
                            $('#dateRecepFact').val(data.dateRecepFact);
                            $('#dateFacturation').val(data.dateFacturation);
                            $('#refFacture').val(data.refFacture);
                            $('#ctrlbcblFacture').val(data.ctrlbcblFacture);
                            $('#ctrlbcblFacture').selectpicker('refresh');
                            $('#montantFacture').val(data.montantFacture);
                            $('#commentaires').val(data.commentaires);
                            $('#id_facture').val(data.id);

                        }
                );
            });

            $("body").on("click",".lesfactures",function(){
                //   var selec= this;
                var data = table.row($(this).closest('tr')).data();
                $('#numda').val(data[Object.keys(data)[1]]);
                console.log(data[Object.keys(data)[1]]);
                $.get("listfacture/"+data[Object.keys(data)[1]],
                        function (data) {
                            tablecontenu_facture.clear().draw();
                            $.each(data,function(index,value){
                                    console.log(value.montantFacture);

                                var date = value.dateRecepFact.split('-');
                                var recep =date[2]+'-'+date[1]+'-'+date[0];

                                date = value.dateFacturation.split('-');
                                var dateFacturation = date[2]+'-'+date[1]+'-'+date[0];
                                tablecontenu_facture.row.add([
                                        value.id,
                                        recep,
                                        dateFacturation,
                                        value.refFacture,
                                        value.ctrlbcblFacture,
                                        value.montantFacture,
                                        value.commentaires,
                                        "<a href='#ajouterfacture' data-toggle='modal' class='btn btn-error modiffac' ><i class='fa fa-pencil'></i></a> <a href='supprimerfacture/"+value.id+"' class='btn btn-error'><i class='fa fa-trash'></i></a>"
                                ]).draw();
                            })

                        }
                );


            });
            $('.confirmons').click( function (e) {
                //   table.row('.selected').remove().draw( false );
                if(confirm('Voulez vous confirmer la D.A.?')){}else{e.preventDefault(); e.returnValue = false; return false; }
            } );
            $('.btn_refuse').click( function (e) {
                //   table.row('.selected').remove().draw( false );
                if(confirm('Voulez vous refuser la D.A.?')){}else{e.preventDefault(); e.returnValue = false; return false; }
            } );
        })(jQuery);

    </script>
@endsection
