
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
                                    <input type="text" class="form-control " id="usage" name="usage" placeholder="usage" value="{{isset($da)? $da->usage:''}}" required>
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
                                    <input type="number"  step="any" class="form-control " id="quantite" name="quantite" placeholder="quantite" value="{{isset($da)? $da->quantite:''}}" min="0" required>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="type">Unité</label>
                                    <select class="form-control selectpicker col-sm-4" id="unite" name="unite" data-live-search="true" data-size="6">
                                          @foreach($tab_unite['nothing'] as $unite)
                                                <option value="{{$unite}}">{{$unite}}</option>
                                            @endforeach
                                                <optgroup label="La longeur">
                                                    @if(isset($tab_unite['La longueur']))
                                                    @foreach($tab_unite['La longueur'] as $unite)
                                                        <option value="{{$unite}}">{{$unite}}</option>
                                                    @endforeach
                                                        @endif
                                                </optgroup>

                                                <optgroup label="La masse">
                                                    @if(isset($tab_unite['La masse']))
                                                    @foreach($tab_unite['La masse'] as $unite)
                                                        <option value="{{$unite}}">{{$unite}}</option>
                                                    @endforeach
                                                        @endif
                                                </optgroup>



                                                <optgroup label="Le volume">
                                                    @if(isset($tab_unite['Le volume']))
                                                    @foreach($tab_unite['Le volume'] as $unite)
                                                        <option value="{{$unite}}">{{$unite}}</option>
                                                    @endforeach
                                                        @endif
                                                </optgroup>

                                                <optgroup label="La surface">
                                                    @if(isset($tab_unite['La surface']))
                                                    @foreach($tab_unite['La surface'] as $unite)
                                                        <option value="{{$unite}}">{{$unite}}</option>
                                                    @endforeach
                                                        @endif
                                                </optgroup>

                                    </select>
                                </div>


                                
                                <div class="form-group col-sm-6">
                                    <label for="type">Pour le?</label>
                                    <input type="date" class="form-control" id="DateBesoin" name="DateBesoin" placeholder="DateBesoin" value="{{isset($da)? $da->DateBesoin:date('Y-m-d',strtotime(date('Y-m-d'). ' + 7 days'))}}"  required>
                                </div>
                                <div class="form-group">
                                    <label for="commentaire">Description (Attention ceci figurera sur le bon de commande) </label>
                                    <textarea id="commentaire" name="commentaire" class="form-control col-sm-8" style="height: 100px" maxlength="1000">{{isset($da)? $da->commentaire:''}}</textarea>
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
            {{ $das->links() }}
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
                    <th class="dt-head-center">Code Analytique</th>
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
                        <td>{{isset($da->devis->codeRubrique)?$da->devis->codeRubrique:''}}</td>
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
                            {{isset($da->bondecommande->fournisseur->libelle)?$da->bondecommande->fournisseur->libelle:''}}
                        </td>
                        <th class="dt-head-center">{{isset($da->bondecommande->numBonCommande)?$da->bondecommande->numBonCommande:''}}</th>
                        <th class="dt-head-center">{{isset($da->bondecommande->date)?\Carbon\Carbon::parse($da->bondecommande->date)->format('d-m-Y'):''}}</th>
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
                    url: "{{ URL::asset('js/French.json') }}"
                },
                "ordering":false,
                "createdRow": function( row, data, dataIndex){

                },
                responsive: false,
                columnDefs: [
                    { responsivePriority: 2, targets: 0 },
                    { responsivePriority: 1, targets: -1 }
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