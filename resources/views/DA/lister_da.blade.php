
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
                    <button type="submit" class="btn btn-danger">refuser</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <h2>LES DEMANDES D'ACHATS - LISTER <a href="{{route('creer_da')}}" class="btn btn-default  pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> Ajouter</a></h2>
    </br>
    </br>
        <table name ="tableDA" id="tableDA" class='table table-bordered table-striped  no-wrap '>

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
                            <i class="fa fa-circle "  style="color: #f0ad4e"></i>

                           @elseif($da->etat==2)
                            <i class="fa fa-circle" style="color: mediumspringgreen"></i>
                        @elseif($da->etat==3)
                            <i class="fa fa-circle" style="color: black"></i>
                        @elseif($da->etat==0)
                            <i class="fa fa-circle" style="color: red"></i>
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

                    <td>{{$da->quantite}}</td>
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
                        @elseif($da->etat==0)
                           Réfusée
                        @endif
                    </td>
                    <td>



                        @if($da->etat==1)
                            <a href="{{route('confirmer_da',['slug'=>$da->slug])}} "id="btnconfirmerda2" data-toggle="modal" class="btn btn-success">
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
                            <a href="{{route('confirmer_da',['slug'=>$da->slug])}} " id="btnconfirmerda2" data-toggle="modal" class="btn btn-success ">
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
                            <a href="" data-toggle="modal" class="">
                                <i class="fa fa-hourglass-end"></i> Terminer
                            </a>
                        @endif

                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    <script>
        (function($) {
            var table= $('#tableDA').DataTable({
                language: {
                    url: "js/French.json"
                },
                "ordering":true,
                "responsive": true,
                "createdRow": function( row, data, dataIndex){

                },
                columnDefs: [
                    { responsivePriority: 1, targets: 0 },
                    { responsivePriority: 2, targets: -1 }
                ]
            }).column(0).visible(false);
            //table.DataTable().draw();

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
        })(jQuery);

    </script>
        @endsection
