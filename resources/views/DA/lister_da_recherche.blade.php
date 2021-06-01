
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

    <h2>{{__('menu.les_da')}} / {{__('neutrale.search')}} </h2>
    </br>
    <div class="row">


        <form role="form" id="FormRegister" class="" method="post" action="{{route('recherche_da')}}">

            <div class="col-sm-4 col-sm-offset-1">

                @csrf<div class="form-group">
                    <label for="libelle" class="control-label">{{__('neutrale.taper_cle')}}</label>
                    <input type="text" name="mot_cle" value="{{isset($mot_cle)?$mot_cle:''}}" class="form-control" />
                </div>




            </div>
            <div class="col-sm-4">

                <div class="form-group col-sm-4 col-sm-push-8" >
                    <button type="submit"  id="btnvalider"class="btn btn-success form-control">{{__('neutrale.search')}}</button>
                </div>
            </div>










        </form>

    </div>
    <div class="row">
        <div class="col-sm-12">
            <table name ="tableDA" id="tableDA" class='table table-bordered table-striped  no-wrap responsive ' >

                <thead>

                <tr>
                    <th class="dt-head-center">{{__('neutrale.numero_da')}}</th>
                    <th class="dt-head-center">{{__('neutrale.statut')}}</th>
                    <th class="dt-head-center">{{__('neutrale.date_demande')}}</th>
                    <th class="dt-head-center">{{__('neutrale.type')}}</th>
                    <th class="dt-head-center">{{__('neutrale.nature')}}</th>
                    <th class="dt-head-center">{{__('gestion_stock.article')}}</th>
                    <th class="dt-head-center">{{__('gestion_stock.quantite')}}</th>
                    <th class="dt-head-center">{{__('neutrale.pu')}}</th>
                    <th class="dt-head-center">{{__('neutrale.pour_le')}}</th>
                    <th class="dt-head-center">{{__('neutrale.usage')}}</th>
                    <th class="dt-head-center">{{__('sortie_materiel.demandeur')}}</th>
                    <th class="dt-head-center">{{__('gestion_stock.auteur')}}</th>
                    <th class="dt-head-center">{{__('translation.service')}}</th>
                    <th class="dt-head-center">{{__('gestion_stock.code_analytique')}}</th>
                    <th class="dt-head-center">{{__('neutrale.confirmer_infirmer')}}</th>
                    <th class="dt-head-center">{{__('neutrale.consultation_encours')}}</th>
                    <th class="dt-head-center">{{__('neutrale.fournisseur_retenue')}}</th>
                    <th class="dt-head-center">{{__('neutrale.numero_bc')}}</th>
                    <th class="dt-head-center">{{__('neutrale.date_bc')}}</th>
                    <th class="dt-head-center">{{__('neutrale.date_livraison')}}</th>
                    <th class="dt-head-center">{{__('neutrale.description')}}</th>
                    <th class="dt-head-center">{{__('gestion_stock.action')}}</th>

                </tr>
                </thead>
                <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">
                @if(!empty($das))
                @foreach($das as $da )
                    <tr>
                        <td>{{$da->id}}</td>
                        <td>

                            @if($da->etat==1)
                            <i class="fa fa-circle "  style="color: orange"></i>
                            {{__('menu.suspendu')}}
                            @elseif($da->etat==2)
                            <i class="fa fa-circle" style="color: yellow"></i>
                            {{__('menu.accepted')}}
                            @elseif($da->etat==3)
                            <i class="fa fa-circle" style="color: chartreuse"></i>
                            {{__('menu.attente')}}
                            @elseif($da->etat==0)
                            <i class="fa fa-circle" style="color: red"></i>
                            {{__('menu.refuser')}}
                            @elseif($da->etat==4)
                                <i class="fa fa-circle" style="color:green"></i>
                                {{__('menu.traite_termine')}}
                            @elseif($da->etat==11)
                                <i class="fa fa-circle" style="color: black"></i>
                                {{__('menu.traite_retouner')}}
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
                        <td>{{$da->prix_unitaire}}</td>
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
                            columns: [ 0,1, 2, 5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20 ]
                        },
                        text:"{{__('neutrale.copier')}}",
                        filename: "Liste des D.A "+date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                        className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                        messageTop: "Liste des D.A "+date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),

                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [ 0,1, 2, 5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20 ]
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
                            columns: [ 0,1, 2, 5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20]
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
                            columns: [ 0,1, 2, 5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20 ]
                        },
                        text:"{{__('neutrale.imprimer')}}",
                        filename: "Liste des D.A"+date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                        className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                        messageTop: "Liste des D.A "+date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                        orientation: 'landscape',

                    }
                ],
                language: {
                    @if(App()->getLocale()=='fr')
                    url: "../public/js/French.json"
                    @elseif(App()->getLocale()=='en')
                    url: "../public/js/English.json"
                    @endif
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
