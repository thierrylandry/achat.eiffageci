
@extends('layouts.app')
@section('das')
    class='active'
@endsection
@section('encours_validation')
    class='active'
@endsection
@section('parent_da')
    class='active'
@endsection
<style>

</style>
@section('content')
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">MOTIF DU REFUS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('refuser_da',app()->getLocale())}}" method="post">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <input type="hidden" class="form-control" id="id" name="id" >
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="motif" name="motif"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger btn_refuse">refuser</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">MODIFIER LE CODE DE GESTION</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('changer_code_gestion')}}" method="post">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <input type="hidden" class="form-control" id="id_pour_cg" name="id" >
                        </div>
                        <div class="form-group">
                            <label for="libelle" class="control-label">Code gestion</label>


                            <select class="form-control selectpicker col-sm-4" id="id_codeGestion" name="id_codeGestion" data-live-search="true" data-size="6" required>
                                <option value="">SELECTIONNER UN CODE GESTION</option>
                                @foreach($gestions as $gestion)
                                    <option @if(isset($da) and $gestion->id==$da->id_codeGestion)
                                            {{'selected'}}
                                            @endif value="{{$gestion->id}}" data-subtext="{{$gestion->description}}">{{$gestion->codeGestion}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <h2>LES DEMANDES D'ACHATS - EN COURS DE VALIDATION <a href="{{route('creer_da',app()->getLocale())}}" class="btn btn-default  pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> Ajouter</a></h2>
    </br>

    <div class="row">
        <div class="col-sm-12">
            {{ $das->links() }}
            <table name ="tableDA" id="tableDA" class='table table-bordered table-striped  no-wrap responsive ' >

                <thead>

                <tr>
                    <th class="dt-head-center">case</th>
                    <th class="dt-head-center">N°D.A</th>
                    <th class="dt-head-center">statut</th>
                    <th class="dt-head-center">date de demande</th>
                    <th class="dt-head-center">type</th>
                    <th class="dt-head-center">Nature</th>
                    <th class="dt-head-center">Code Analytique</th>
                    <th class="dt-head-center">Code Gestion</th>
                    <th class="dt-head-center">Matériel et consultation</th>
                    <th class="dt-head-center">Quantité</th>
                    <th class="dt-head-center">Pour le ?</th>
                    <th class="dt-head-center">Usage</th>
                    <th class="dt-head-center">Demandeur</th>
                    <th class="dt-head-center">Auteur</th>
                    <th class="dt-head-center">Service</th>
                    <th class="dt-head-center">Action</th>

                </tr>
                </thead>
                <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">
                @foreach($das as $da )
                    <tr>
                        <td>{{$da->id}}</td>
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
                        <td><?php if(isset($da->created_at)){
                                $date = new DateTime($da->created_at);

                            echo $date->format('d-m-Y H:i:s');}?></td>
                        <td>
                            {{isset($da->materiel->domaine->libelleDomainne)?$da->materiel->domaine->libelleDomainne:''}}
                        </td>
                        <td>
                            {{isset($da->nature->libelleNature)?$da->nature->libelleNature:''}}</td>
                        <td>{{isset($da->materiel->code_analytique)?$da->materiel->code_analytique:''}}</td>
                        <td>{{isset($da->codeGestion->codeGestion)?$da->codeGestion->codeGestion:''}}</td>
                        <td>
                            {{isset($da->designation->libelle)?$da->designation->libelle:''}}
                          </td>
                        <td>{{$da->quantite}} {{$da->unite}}</td>
                        <td>{{\Carbon\Carbon::parse($da->DateBesoin)->format('d-m-Y')}}</td>
                        <td>
                            {{$da->usage}}
                        </td>
                        <td>{{$da->demandeur}}</td>
                        <td>
                            {{isset($da->user->nom)?$da->user->nom:''}}
                            {{isset($da->user->prenoms)?$da->user->prenoms:''}}
                           </td>
                        <td>
                            {{isset($da->user->leservice->libelle)?$da->user->leservice->libelle:''}}
                            </td>
                        <td>



                            @if($da->etat==1)
                                <a href="{{route('confirmer_da',['locale'=>app()->getLocale(),'slug'=>$da->slug])}} "id="btnconfirmerda2" data-toggle="modal" class="btn btn-success confirmons">
                                    <i class=" fa fa-check-circle" style="size: 40px"> Accepter ?</i>
                                </a>
                                <a href="" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" id="btnconfirmerda2" data-toggle="modal" class="btn btn-danger btn_refuser">
                                    <i class=" fa fa-check-circle" style="size: 40px"> Refuser ?</i>
                                </a>
                                <a href="" data-toggle="modal" data-target="#exampleModal1" data-whatever="@mdo"   data-toggle="modal" class="btn btn-info btnupdate_cg">
                                    <i class="fa fa-info-circle" style="size: 40px"> Code de gestion</i>
                                </a>
                                <div class="btn-group " >
                                    <button type="button" class="btn btn-default btn-flat ">Autres</button>
                                    <button type="button" class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">

                                        <a href="{{route('voir_da',['locale'=>app()->getLocale(),'slug'=>$da->slug])}}" data-toggle="modal">
                                            <i class=" fa fa-pencil"> modifier</i>
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a href="{{route('supprimer_da',['locale'=>app()->getLocale(),'slug'=>$da->slug])}}" data-toggle="modal" >
                                            <i class=" fa fa-trash">Supprimer</i>
                                        </a>
                                    </div>
                                </div>
                            @elseif($da->etat==2)
                                <a href="{{route('suspendre_da',['locale'=>app()->getLocale(),'slug'=>$da->slug])}} "id="btnconfirmerda12" data-toggle="modal" class="btn btn-warning ">
                                    <i class=" fa fa-pause" style="size: 40px"> Suspendre ?</i>
                                </a>
                                <a href="" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" id="btnconfirmerda2" data-toggle="modal" class="btn btn-danger btn_refuser">
                                    <i class=" fa fa-check-circle" style="size: 40px"> Refuser ?</i>
                                </a>
                            @elseif($da->etat==0)
                                <a href="{{route('confirmer_da',['locale'=>app()->getLocale(),'slug'=>$da->slug])}} " id="btnconfirmerda2" data-toggle="modal" class="btn btn-success confirmons">
                                    <i class=" fa fa-check-circle" > </i>Accepter ?
                                </a>


                                <div class="btn-group ">
                                    <button type="button" class="btn btn-default btn-flat ">Autres</button>
                                    <button type="button" class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">

                                        <a href="{{route('voir_da',['locale'=>app()->getLocale(),'slug'=>$da->slug])}}" data-toggle="modal">
                                            <i class=" fa fa-pencil"> modifier</i>
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a href="{{route('supprimer_da',['locale'=>app()->getLocale(),'slug'=>$da->slug])}}" data-toggle="modal" >
                                            <i class=" fa fa-trash">Supprimer</i>
                                        </a>
                                    </div>
                                </div>
                            @elseif($da->etat==3)

                            @endif

                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
            <button class="btn btn-success" id="valider_selectionner"> ACCEPTER LA SELECTION</button>
            <button class="btn btn-danger" id="refuser_selectionner"> REFUSER LA SELECTION</button>
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
                "columnDefs": [
                    {
                        'targets': 0,
                        'checkboxes': {
                            'selectRow': true,
                            'selectAllPages': false
                        }
                    }
                ],
                "select": {
                    'style': 'multi'
                },
                language: {
                    url: "{{ URL::asset('public/js/French.json') }}"
                },
                "order": [[ 0, 'desc' ]],
                "ordering":true,
                "createdRow": function( row, data, dataIndex){

                },
                responsive: false,


            });
            $('#valider_selectionner').click(function (e) {
                var rows_selected = table.column(0).checkboxes.selected();
                console.log(rows_selected);
                var mavariable="";
                $.each(rows_selected, function(index, rowId){
                    // Create a hidden element
                    console.log(rowId);
                    mavariable=mavariable+','+rowId;

                });
                if(mavariable==""){
                    alert("Veuillez selectionner au moins un élément");
                }else{
                    $.get('validation_da_collective/'+mavariable,function (data) {
                        if(data=="success"){
                            location.reload(true);
                        }else{
                            alert("Echec de validation");
                        }
                    })
                }
            });
            $('#refuser_selectionner').click(function (e) {
                var rows_selected = table.column(0).checkboxes.selected();
                console.log(rows_selected);
                var mavariable="";
                $.each(rows_selected, function(index, rowId){
                    // Create a hidden element
                    console.log(rowId);
                    mavariable=mavariable+','+rowId;

                });
                if(mavariable==""){
                    alert("Veuillez selectionner au moins un élément");
                }else{
                    $.get('refus_da_collective/'+mavariable,function (data) {
                        if(data=="success"){
                            location.reload(true);
                        }else{
                            alert("Echec de validation");
                        }
                    })
                }
            });
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


            $("body").on("click",".btn_refuser",function(){
                //   var selec= this;


                if ( $(this).parent().parent().parent().hasClass('selected') ) {
                    $(this).parent().parent().removeClass('selected');
                }
                else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).parent().parent().addClass('selected');
                }

                var data = table.row($(this).closest('tr')).data();
                $('#id').val(data[Object.keys(data)[0]]);
                console.log(data[Object.keys(data)[0]]);


            });
            $("body").on("click",".btnupdate_cg",function(){
                //   var selec= this;


                if ( $(this).parent().parent().parent().hasClass('selected') ) {
                    $(this).parent().parent().removeClass('selected');
                }
                else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).parent().parent().addClass('selected');
                }

                var data = table.row($(this).closest('tr')).data();
                $('#id_pour_cg').val(data[Object.keys(data)[0]]);
                $('#id_codeGestion').val("");
                $('#id_codeGestion').selectpicker('refresh');
                console.log(data[Object.keys(data)[0]]);


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
