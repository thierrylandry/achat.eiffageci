
@extends('layouts.app')
@section('das')
    class='active'
@endsection
@section('parent_da')
    class='active'
@endsection
@section('content')
    <h2>LES DEMANDES D'APPROVISIONNEMENT - {{isset($da)? 'MODIFIER ':'AJOUTER '}} <a href="{{route('lister_da')}}" class="btn btn-default pull-right"><i class="fa fa-list" aria-hidden="true"></i> Lister</a> <a href="{{route('creer_da')}}" class="btn btn-default  pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> Ajouter</a></h2>
    </br>
    </br>
    <div class="row">



                        <form role="form" id="FormRegister" class="" method="post" action="{{route('modifier_da')}}">
                            <div class="col-sm-2">
                                @foreach($materiels as $materiel)

                                     @if(isset($da) and $materiel->id==$da->	id_materiel)
                                        <img id="image"  width="200px" height="200px" src="{{isset($da)? '../uploads/'.$materiel->image:''}}"/>
                                            @endif
                                @endforeach
                                    </div>
                            <div class="col-sm-4">

                                @csrf<div class="form-group">
                                    <label for="libelle" class="control-label">Produit et service</label>


                                    <select class="form-control selectpicker col-sm-4" id="id_materiel" name="id_materiel" data-live-search="true" data-size="6" required>
                                        <option  value="">SELECTIONNER UN PRODUIT</option>
                                        @foreach($materiels as $materiel)
                                            <option @if(isset($da) and $materiel->id==$da->	id_materiel)
                                                    {{'selected'}}
                                                    @endif value="{{$materiel->id}}">{{$materiel->libelleMateriel}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group  ">
                                    <label for="type">Demandeur</label>
                                    <input type="text" class="form-control " id="demandeur" name="demandeur" placeholder="demandeur" value="{{isset($da)? $da->demandeur:''}}" required>
                                </div>
                                <div class="form-group  ">
                                    <label for="type">Usage</label>
                                    <input type="text" class="form-control " id="demandeur" name="usage" placeholder="usage" value="{{isset($da)? $da->usage:''}} " required>
                                </div>


                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <b><label for="libelle" class="control-label">Nature</label></b>
                                    <select class="form-control selectpicker col-sm-4" id="id_nature" name="id_nature" data-live-search="true" data-size="6">
                                        @foreach($natures as $nature)
                                            <option @if(isset($da) and $nature->id==$da->id_nature)
                                                    {{'selected'}}
                                                    @endif value="{{$nature->id}}">{{$nature->libelleNature}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-sm-3 ">
                                    <label for="type">Quantité</label>
                                    <input type="number" class="form-control " id="quantite" name="quantite" placeholder="quantite" value="{{isset($da)? $da->quantite:''}}" required>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="type">Unité</label>
                                    <select class="form-control selectpicker col-sm-4" id="unite" name="unite" data-live-search="true" data-size="6">
                                        <option value="U">U</option>

                                        <optgroup label="La longeur">
                                            <option value="Km"> Km</option>
                                            <option value="m">m</option>
                                            <option value="cm">cm</option>
                                            <option value="mm">mm</option>
                                        </optgroup>
                                        <optgroup label="La masse">
                                            <option value="T"> T</option>
                                            <option value="Kg">Kg</option>
                                            <option value="g">g</option>
                                            <option value="mg">mg</option>
                                        </optgroup>
                                        <optgroup label="Le litre">
                                            <option value="L"> L</option>
                                            <option value="ml">ml</option>
                                        </optgroup>
                                        <optgroup label="La surface">
                                            <option value="m²"> m²</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="type">Pour le?</label>
                                    <input type="date" class="form-control" id="DateBesoin" name="DateBesoin" placeholder="DateBesoin" value="{{isset($da)? $da->DateBesoin:''}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="commentaire">Commentaire</label>
                                    <textarea id="commentaire" name="commentaire" class="form-control col-sm-8" style="height: 100px">{{isset($da)? $da->commentaire:''}}</textarea>
                                </div>
                                <input type="hidden" class="form-control" id="slug" name="slug" placeholder="" value="{{isset($da)? $da->slug:''}}">
                                <input type="hidden" class="form-control" id="id_user" name="id_user" placeholder="" value="{{ Auth::user()->id }}">
                                <br>
                                <div class="form-group col-sm-4 col-sm-push-8" >
                                    <button type="submit"  id="btnvalider"class="btn btn-success form-control">{{isset($da)? 'Modifier':'Ajouter'}}</button>
                                </div>
                            </div>










                        </form>
    </div>
    <h2>MES DEMANDES D'ACHATS  </h2>
    <br>
    <br>
    <div class="row">
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
            "13">Commentaire</a>
        </div>
        </br>
        <table name ="tableDA" id="tableDA" class='table table-bordered table-striped  no-wrap responsive '>

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
                <th class="dt-head-center">Commentaire</th>
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
                        @elseif($da->etat==4)
                            <i class="fa fa-hourglass-end"></i>
                        @elseif($da->etat==11)
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

                        @endif

                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
    </div>
    <div class="row">
</br>

<script src="{{URL::asset('js/scriptperso.js')}}"> </script>
        <script>
            var table= $('#tableDA').DataTable({
                language: {
                    url: "js/French.json"
                },
                "ordering":true,
                "createdRow": function( row, data, dataIndex){

                },
                responsive: false,
                columnDefs: [
                    { responsivePriority: 2, targets: 0 },
                    { responsivePriority: 1, targets: -1 }
                ]
            }).column(0).visible(false).column(4).visible(false).column(5).visible(false).column(9).visible(false).column(11).visible(false);
            //table.DataTable().draw();
            $('a.toggle-vis').on( 'click', function (e) {
                e.preventDefault();

                // Get the column API object
                var column = table.column( $(this).attr('data-column') );

                // Toggle the visibility
                column.visible( ! column.visible() );
            } );
            $('#id_materiel').change(function (e) {
                if(this.value==""){
                    $('#image').attr('src',"../images/background2.jpg");
                }
                $.get("../afficher_image/" + this.value,
                        function (data) {
                            if(data!=""){
                                $('#image').attr('src',"../uploads/"+data);
                            }else{
                                $('#image').attr('src',"../images/background2.jpg");
                            }

                        }
                );
            });
        </script>
    </div>
@endsection