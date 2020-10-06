
@extends('layouts.app')
@section('das')
    class='active'
    @endsection
@section('recherche_da')
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
                <form action="{{route('refuser_da')}}" method="post">
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

    <h2>LES DEMANDES D'ACHATS - RECHERCHE </h2>
    </br>
    <div class="row">


        <form role="form" id="FormRegister" class="" method="post" action="{{route('recherche_da')}}">

            <div class="col-sm-4 col-sm-offset-1">

                @csrf<div class="form-group">
                    <label for="libelle" class="control-label">Taper un mot clé</label>
                    <input type="text" name="mot_cle" value="{{isset($mot_cle)?$mot_cle:''}}" class="form-control" />
                </div>




            </div>
            <div class="col-sm-4">

                <div class="form-group col-sm-4 col-sm-push-8" >
                    <button type="submit"  id="btnvalider"class="btn btn-success form-control">RECHERCHER</button>
                </div>
            </div>










        </form>

    </div>
    <div class="row">
        <div class="col-sm-12">
            <table name ="tableDA" id="tableDA" class='table table-bordered table-striped  no-wrap responsive ' >

                <thead>

                <tr>
                    <th class="dt-head-center">N°D.A</th>
                    <th class="dt-head-center">statut</th>
                    <th class="dt-head-center">date de demande</th>
                    <th class="dt-head-center">type</th>
                    <th class="dt-head-center">Nature</th>
                    <th class="dt-head-center">Matériel et consultation</th>
                    <th class="dt-head-center">Quantité</th>
                    <th class="dt-head-center">Pour le ?</th>
                    <th class="dt-head-center">Usage</th>
                    <th class="dt-head-center">Demandeur</th>
                    <th class="dt-head-center">Auteur</th>
                    <th class="dt-head-center">Service</th>
                    <th class="dt-head-center">Code Analytique/<i style="color:#00AAFF" >Code spécifique</i></th>
                    <th class="dt-head-center">Confirmer/infirmer</th>
                    <th class="dt-head-center">Consultation en cours</th>
                    <th class="dt-head-center">Fournisseur retenu</th>
                    <th class="dt-head-center">N° BC</th>
                    <th class="dt-head-center">Date du BC</th>
                    <th class="dt-head-center">Date livraison effective</th>
                    <th class="dt-head-center">Description</th>
                    <th class="dt-head-center">Action</th>

                </tr>
                </thead>
                <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">
                @if(!empty($das))
                @foreach($das as $da )
                    <tr>
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
                        <td>{{date_format( new datetime($da->created_at),'d-m-Y H:i:s')}}</td>
                        <td>
                            @foreach($materiels as $materiel )
                                @if($materiel->id==$da->id_materiel)


                                    @foreach($domaines as $domaine )
                                        @if($domaine->id==$materiel->type)
                                            {{$domaine->libelleDomainne}}

                                        @endif
                                    @endforeach

                                @endif


                            @endforeach</td>
                        <td>
                            @foreach($natures as $nature )
                                @if($nature->id==$da->id_nature)
                                    {{$nature->libelleNature}}
                                @endif
                            @endforeach</td>
                        <td>
                            @foreach($materiels as $materiel )
                                @if($materiel->id==$da->id_materiel)

                                    {{$materiel->libelleMateriel}}
                                @endif
                            @endforeach</td>
                        <td>{{$da->quantite}} {{$da->unite}}</td>
                        <td>{{\Carbon\Carbon::parse($da->DateBesoin)->format('d-m-Y')}}</td>
                        <td>
                            {{$da->usage}}
                        </td>
                        <td>{{$da->demandeur}}</td>
                        <td>
                            @foreach($service_users as $service_user )
                                @if($service_user->id==$da->id_user)
                                    {{$service_user->nom}}
                                    {{$service_user->prenoms}}
                                @endif
                            @endforeach</td>
                        <td> @foreach($service_users as $service_user )
                                @if($service_user->id==$da->id_user)
                                    <b style=" font-size: 15px; color:black ">{{$service_user->libelle}}</b>
                                @endif
                            @endforeach</td>
                        <td>{{isset($da->code_analytique)?$da->code_analytique:''}}/<i style="color: #00AAFF">{{isset($da->codeRubrique)?$da->codeRubrique:''}}</i></td>
                        <td>
                            @foreach($service_users as $service_user )
                                @if($service_user->id==$da->id_valideur)
                                    {{$service_user->nom}}
                                    {{$service_user->prenoms}} le   {{\Carbon\Carbon::parse($da->dateConfirmation)->format('d-m-Y H:i:s')}}
                                @endif
                            @endforeach</td>
                        <td>
                            @foreach($tracemails as $tracemail )

                                @if(in_array($da->id,explode(',',$tracemail->das)))
                                    @foreach($fournisseurs as $fournisseur )
                                        @if(in_array($fournisseur->id,explode(',',$tracemail->id_fournisseur)))
                                            {{$fournisseur->libelle}} /

                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </td>
                        <td>
                            {{isset($da->libelle_fournisseur)?$da->libelle_fournisseur:''}}
                        </td>
                        <th class="dt-head-center">{{isset($da->numBonCommande)?$da->numBonCommande:''}}</th>
                        <th class="dt-head-center">{{isset($da->date)?\Carbon\Carbon::parse($da->date)->format('d-m-Y'):''}}</th>
                        <td> {{$da->date_livraison_eff!=""?\Carbon\Carbon::parse($da->date_livraison_eff)->format('d-m-Y'):''}}
                        </td>
                        <th class="dt-head-center">{{$da->commentaire}}</th>
                        <td>
                            @if($da->etat==1)
                                <a href="{{route('confirmer_da_depuis_creermodifier_da',['slug'=>$da->slug])}} "id="btnconfirmerda2" data-toggle="modal" class="btn btn-success confirmons">
                                    <i class=" fa fa-check-circle" style="size: 40px"> Accepter ?</i>
                                </a>
                                <a href="" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" id="btnconfirmerda2" data-toggle="modal" class="btn btn-danger btn_refuser">
                                    <i class=" fa fa-check-circle" style="size: 40px"> Refuser ?</i>
                                </a>
                                @if($da->id_user==\Illuminate\Support\Facades\Auth::user()->id)
                                    <div class="btn-group " >
                                        <button type="button" class="btn btn-default btn-flat ">Autres</button>
                                        <button type="button" class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>


                                        <div class="dropdown-menu" role="menu">

                                            <a href="{{route('voir_da',['slug'=>$da->slug])}}" data-toggle="modal">
                                                <i class=" fa fa-pencil"> modifier</i>
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a href="{{route('supprimer_da',['slug'=>$da->slug])}}" data-toggle="modal" >
                                                <i class=" fa fa-trash">Supprimer</i>
                                            </a>
                                        </div>

                                    </div>
                                @endif
                            @elseif($da->etat==2)
                                <a href="{{route('suspendre_da',['slug'=>$da->slug])}} "id="btnconfirmerda12" data-toggle="modal" class="btn btn-warning ">
                                    <i class=" fa fa-pause" style="size: 40px"> Suspendre ?</i>
                                </a>
                                <a href="" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" id="btnconfirmerda2" data-toggle="modal" class="btn btn-danger btn_refuser">
                                    <i class=" fa fa-check-circle" style="size: 40px"> Refuser ?</i>
                                </a>
                            @elseif($da->etat==0)
                                <a href="{{route('confirmer_da_depuis_creermodifier_da',['slug'=>$da->slug])}} " id="btnconfirmerda2" data-toggle="modal" class="btn btn-success confirmons">
                                    <i class=" fa fa-check-circle" > </i>Accepter ?
                                </a>

                                @if($da->id_user==\Illuminate\Support\Facades\Auth::user()->id)
                                    <div class="btn-group ">
                                        <button type="button" class="btn btn-default btn-flat ">Autres</button>
                                        <button type="button" class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu">

                                            <a href="{{route('voir_da',['slug'=>$da->slug])}}" data-toggle="modal">
                                                <i class=" fa fa-pencil"> modifier</i>
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a href="{{route('supprimer_da',['slug'=>$da->slug])}}" data-toggle="modal" >
                                                <i class=" fa fa-trash">Supprimer</i>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @elseif($da->etat==3)

                            @endif

                        </td>

                    </tr>
                @endforeach
                    @endif
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
        (function($) {
            var date =new Date();

            var table= $('#tableDA').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [ 0,1, 2, 5,6,7,8,9,10,11,12,13,14 ]
                        },
                        text:"Copier",
                        filename: "Liste des D.A "+date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                        className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                        messageTop: "Liste des D.A "+date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),

                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [ 0,1, 2, 5,6,7,8,9,10,11,12,13,14 ]
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
                            columns: [ 0,1, 2, 5,6,7,8,9,10,11,12,13,14 ]
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
                            columns: [ 0,1, 2, 5,6,7,8,9,10,11,12,13,14 ]
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
                "order": [[ 0, 'desc' ]],
                "ordering":true,
                "paging": false,
                "createdRow": function( row, data, dataIndex){

                },
                responsive: false,
                columnDefs: [
                    { responsivePriority: 1, targets: 0 },
                    { responsivePriority: 2, targets: -1 },
                    { responsivePriority: 1, targets: 4 },

                ],
                "scrollY": 500,
                "scrollX": true,
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
