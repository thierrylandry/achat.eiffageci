
@extends('layouts.app')
@section('das')
    class='active'
@endsection
@section('creer_da')
    class='active'
@endsection
@section('parent_da')
    class='active'
@endsection
@section('content')
    <h2>LES DEMANDES D'ACHATS - {{isset($da)? 'MODIFIER ':'AJOUTER '}}  <a href="{{route('lister_da')}}" class="btn btn-default pull-right"><i class="fa fa-list" aria-hidden="true"></i> Lister</a></h2>
    </br>
    </br>
    <div class="row">


                        <form role="form" id="FormRegister" class="" method="post" action="{{route('Validdas')}}" onsubmit="return confirm('Voulez vous enregistrer?');">
                            <div class="col-sm-2 " ><img id="image"  width="200px" height="200px" onclick="voir(this)"/></div>
                            <div class="col-sm-4 col-sm-offset-1">

                            @csrf<div class="form-group">
                                <label for="libelle" class="control-label">Produit et service</label>


                                <a href="{{route('gestion_produit')}}" class="fa fa-plus-circle"></a><select class="form-control selectpicker col-sm-4" id="id_materiel" name="id_materiel" data-live-search="true" data-size="6" required>
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
                                    <input type="text" class="form-control " id="demandeur" name="demandeur" placeholder="demandeur" value="{{isset($da)? $da->demandeur: \Illuminate\Support\Facades\Auth::user()->nom.' '.\Illuminate\Support\Facades\Auth::user()->prenoms}} " required>
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
                                    <input type="number" class="form-control " id="quantite" name="quantite" placeholder="quantite" value="{{isset($da)? $da->quantite:''}}" min="0" required>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="type">Unité</label>
                                    <select class="form-control selectpicker col-sm-4" id="unite" name="unite" data-live-search="true" data-size="6">
                                        <option value="u">u</option>

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
                                        <optgroup label="Le volume">
                                            <option value="m3"> m<SUP>3</SUP></option>
                                        </optgroup>
                                        <optgroup label="La surface">
                                            <option value="m²"> m²</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="type">Pour le?</label>
                                    <input type="date" class="form-control" id="DateBesoin" name="DateBesoin" placeholder="DateBesoin" value="{{isset($da)? $da->DateBesoin:date('Y-m-d',strtotime(date('Y-m-d'). ' + 7 days'))}}"  required>
                                </div>
                                <div class="form-group">
                                    <label for="commentaire">Description (Attention ceci figurera sur le bon de commande) </label>
                                    <textarea id="commentaire" name="commentaire" class="form-control col-sm-8" style="height: 100px" maxlength="60">{{isset($da)? $da->commentaire:''}}</textarea>
                                </div>

                                <input type="hidden" class="form-control" id="slug" name="slug" placeholder="" value="{{isset($da)? $da->slug:''}}">
                                <input type="hidden" class="form-control" id="id_user" name="id_user" placeholder="" value="{{ Auth::user()->id }}">
                                <br>
                                <br>
                                <br>                                <br>
                                <br>
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
        <div class="col-sm-12">
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
                                <a href="{{route('confirmer_da',['slug'=>$da->slug])}} "  id="btnconfirmerda2" data-toggle="modal" class="btn btn-success confirmons">
                                    <i class=" fa fa-check-circle" style="size: 40px"> Accepter ?</i>
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
                            @elseif($da->etat==0)
                                <a href="{{route('confirmer_da',['slug'=>$da->slug])}} " id="btnconfirmerda2" onclick="" data-toggle="modal" class="btn btn-success confirmons ">
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
    <script src="{{URL::asset('js/scriptperso.js')}}"> </script>
    <script>
        $('#id_materiel').change(function (e) {
            if(this.value==""){
                $('#image').attr('src',"images/background2.jpg");
            }
            $.get("afficher_image/" + this.value,
                    function (data) {
                        if(data!=""){
                            $('#image').attr('src',"uploads/"+data);
                        }else{
                            $('#image').attr('src',"images/background2.jpg");
                        }

                    }
            );
        });
    </script>
    <script>
        function voir(val){
            var modal = document.getElementById('myModal');

            // Get the image and insert it inside the modal - use its "alt" text as a caption
            var img = val;
            var modalImg = document.getElementById("img01");
            var captionText = document.getElementById("caption");
            img.onclick = function(){
                modal.style.display = "block";
                modalImg.src = this.src;
                captionText.innerHTML = this.alt;
            }

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }
        }
        // Get the modal

    </script>
    <script>
        (function($) {
            var table= $('#tableDA').DataTable({
                language: {
                    url: "js/French.json"
                },
                "ordering":false,
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
    <script type="application/javascript">
        function compte(){
            var text=  document.getElementById('commentaire').innerHTML;
            document.getElementById('carac').innerHTML=text.lenght;
        }
        function confirmation(e){
            if(confirm('Voulez vous confirmer la D.A.?')){

            }else{
                e.preventDefault(); e.returnValue = false; return false;
            }}
        $('#btnconfirmerda2').click(function(e){
           event.preventDefault;
        });

    </script>
@endsection