
@extends('layouts.app')
@section('das')
    class='active'
    @endsection
@section('lister_da')
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

    <h2>LES DEMANDES D'ACHATS - LISTER <a href="{{route('creer_da')}}" class="btn btn-default  pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> Ajouter</a></h2>
    </br>
    </br>
    <div>
        AFFICHER OU CACHER DES COLONNES: <a class="toggle-vis" data-column="1">Service</a> - <a class="toggle-vis" data-column="2">statut</a> - <a class="toggle-vis" data-column=
        "3">Matériel et consultation</a> - <a class="toggle-vis" data-column="4">type</a> - <a class="toggle-vis" data-column="5">Nature</a> - <a class="toggle-vis" data-column=
        "6">Quantité</a>- <a class="toggle-vis" data-column=
        "7">Pour le ?</a>- <a class="toggle-vis" data-column=
        "8">Demandeur</a>- <a class="toggle-vis" data-column=
        "9">Auteur</a>- <a class="toggle-vis" data-column=
        "10">Confirmer/infirmer</a>- <a class="toggle-vis" data-column=
        "11">Etat</a>- <a class="toggle-vis" data-column=
        "12">Usage</a>- <a class="toggle-vis" data-column=
        "13">Description</a>
    </div>
    </br>
    <div class="row">
        <div class="col-sm-12">
            <table name ="tableDA" id="tableDA" class='table table-bordered table-striped  no-wrap responsive ' style="width: 40%">

                <thead>

                <tr>
                    <th class="dt-head-center">id</th>
                    <th class="dt-head-center">Service</th>
                    <th class="dt-head-center">statut</th>
                    <th class="dt-head-center">Matériel et consultation</th>
                    <th class="dt-head-center">type</th>
                    <th class="dt-head-center">Nature</th>
                    <th class="dt-head-center">Quantité</th>
                    <th class="dt-head-center">Pour le ?</th>
                    <th class="dt-head-center">Demandeur</th>
                    <th class="dt-head-center">Auteur</th>
                    <th class="dt-head-center">Confirmer/infirmer</th>
                    <th class="dt-head-center">Etat</th>
                    <th class="dt-head-center">Usage</th>
                    <th class="dt-head-center">Description</th>
                    <th class="dt-head-center">Action</th>

                </tr>
                </thead>
                <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">
                @foreach($das as $da )
                    <tr>
                        <td>{{$da->id}}</td>
                        <td>@foreach($users as $user )
                                @if($user->id==$da->id_user)
                                    <b style=" font-size: 15px; color:black ">{{$user->service}}</b>
                                @endif
                            @endforeach</td>
                        <td>

                            @if($da->etat==1)
                                <i class="fa fa-circle "  style="color: red"></i>

                            @elseif($da->etat==2)
                                <i class="fa fa-circle" style="color: mediumspringgreen"></i>
                            @elseif($da->etat==3)
                                <i class="fa fa-circle" style="color: #f0ad4e"></i>
                            @elseif($da->etat==0)
                                <i class="fa fa-circle" style="color: black"></i>
                            @elseif($da->etat==4)
                                <i class="fa fa-circle" style="color:#00ffff"></i>
                            @elseif($da->etat==11)
                                <i class="fa fa-circle" style="color: violet"></i>
                            @endif
                        </td>
                        <td>
                            @foreach($materiels as $materiel )
                                @if($materiel->id==$da->id_materiel)

                                    {{$materiel->libelleMateriel}}
                                @endif
                            @endforeach</td>
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
                        <td>{{$da->nature}}
                            @foreach($natures as $nature )
                                @if($nature->id==$da->id_nature)
                                    {{$nature->libelleNature}}
                                @endif
                            @endforeach</td>

                        <td>{{$da->quantite}} {{$da->unite}}</td>
                        <td>{{$da->DateBesoin}}</td>
                        <td>{{$da->demandeur}}</td>
                        <td>@foreach($users as $user )
                                @if($user->id==$da->id_user)
                                    {{$user->nom}}
                                    {{$user->prenom}}
                                @endif
                            @endforeach</td>
                        <td>
                            @foreach($users as $user )
                                @if($user->id==$da->id_valideur)
                                    {{$user->nom}}
                                    {{$user->prenom}}
                                @endif
                            @endforeach</td>
                        <td>
                            @if($da->etat==1)
                                Suspendu
                            @elseif($da->etat==2)
                                Acceptée
                            @elseif($da->etat==3)
                                En attente de reception
                            @elseif($da->etat==0)
                                Réfusée
                            @elseif($da->etat==4)
                                Achevée
                            @elseif($da->etat==11)
                                Retournée
                            @endif
                        </td>
                        <td>
                            {{$da->usage}}
                        </td>
                        <td>
                            {{$da->commentaire}}
                        </td>
                        <td>



                            @if($da->etat==1)
                                <a href="{{route('confirmer_da',['slug'=>$da->slug])}} "id="btnconfirmerda2" data-toggle="modal" class="btn btn-success confirmons">
                                    <i class=" fa fa-check-circle" style="size: 40px"> Accepter ?</i>
                                </a>
                                <a href="" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" id="btnconfirmerda2" data-toggle="modal" class="btn btn-danger btn_refuser">
                                    <i class=" fa fa-check-circle" style="size: 40px"> Refuser ?</i>
                                </a>
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
                            @elseif($da->etat==2)
                                <a href="{{route('suspendre_da',['slug'=>$da->slug])}} "id="btnconfirmerda12" data-toggle="modal" class="btn btn-warning ">
                                    <i class=" fa fa-pause" style="size: 40px"> Suspendre ?</i>
                                </a>
                                <a href="" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" id="btnconfirmerda2" data-toggle="modal" class="btn btn-danger btn_refuser">
                                    <i class=" fa fa-check-circle" style="size: 40px"> Refuser ?</i>
                                </a>
                            @elseif($da->etat==0)
                                <a href="{{route('confirmer_da',['slug'=>$da->slug])}} " id="btnconfirmerda2" data-toggle="modal" class="btn btn-success confirmons">
                                    <i class=" fa fa-check-circle" > </i>Accepter ?
                                </a>


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
                            @elseif($da->etat==3)

                            @endif

                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <script>
        (function($) {
            var table= $('#tableDA').DataTable({
                language: {
                    url: "{{ URL::asset('public/js/French.json') }}"
                },
                "order": [[ 0, 'desc' ]],
                "ordering":true,
                "createdRow": function( row, data, dataIndex){

                },
                responsive: false,
                columnDefs: [
                    { responsivePriority: 2, targets: 0 },
                    { responsivePriority: 1, targets: -1 }
                ]
            }).column(0).visible(false).column(4).visible(false).column(5).visible(false).column(9).visible(false).column(11).visible(false).column(13).visible(false);
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
