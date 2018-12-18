
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
@section('content')
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Motif</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">slug:</label>
                            <input type="text" class="form-control" id="slug">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">refuser</button>
                </div>
            </div>
        </div>
    </div>

    <h2>LES DEMANDES D'ACHATS - LISTER</h2>
    </br>
    </br>
        <table name ="fournisseurs" id="fournisseurs" class='table table-bordered table-striped  no-wrap '>

            <thead>

            <tr>
                <th class="dt-head-center">id</th>
                <th class="dt-head-center">statut</th>
                <th class="dt-head-center">produits et services</th>
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
                                {{$user->name}}
                            @endif
                        @endforeach</td>
                    <td>{{$da->id_valideur}}</td>
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
                            <a href="" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" id="btnconfirmerda2" data-toggle="modal" class="btn btn-danger ">
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
                            <a href="" data-toggle="modal" data-target="#exampleModal" data-whatever="test" id="btnconfirmerda2" data-toggle="modal" class="btn btn-danger ">
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
        @endsection
