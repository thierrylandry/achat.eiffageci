
@extends('layouts.app')
@section('content')
    <style>
        div.dropdown-menu.open { width: 100%; } ul.dropdown-menu.inner>li>a { white-space: initial; }
        thead {
            display:none;
        }
        .valider{background-color: palegreen !important; }
    </style>

    <div class="alert alert-warning ">
        <span class="alert-icon"><i class="fa fa-bell-o"></i></span>
        <div class="notification-info">
            <ul class="clearfix notification-meta">
                <li class="pull-left notification-sender">Vous avez  <b style="font-size: 24px">{{sizeof($panier_demande->lignebesoins()->where('etat','<>',0)->where('etat','<',2)->get())}}</b>  Demande d'achat dans votre panier. Seul les demandes avec le code de gestion et l'usage seront validés</li>

            </ul>
            <p>
                ...
            </p>
        </div>
    </div>
    <h2><i class="fa fa-shopping-basket"></i> MON PANIER </h2>
    </br>
    </br>
    <div class="row" style="overflow-x: auto">


            <form id="myForm" method="POST" action="{{route('modifier_panier')}}">
                @csrf
                <input type="hidden" name="id_panier" value="{{isset($panier_demande)?$panier_demande->id:""}}"/>
            <table  name ="panier" id="panier" class='table table-bordered table-striped  no-wrap '>

                <thead>

                <tr>
                    <th class="dt-head-center">id</th>
                    <th class="dt-head-center">libelle Mareriel</th>
                    <th class="dt-head-center">code de gestion</th>
                    <th class="dt-head-center">code tache</th>
                    <th class="dt-head-center">Demandeur</th>
                    <th class="dt-head-center">Usage</th>
                    <th class="dt-head-center">Nature</th>
                    <th class="dt-head-center">Quantite</th>
                    <th class="dt-head-center">Unite</th>
                    <th class="dt-head-center">Pour le</th>
                    <th class="dt-head-center">Description</th>
                </tr>
                </thead>
                <tbody >
                @foreach($panier_demande->lignebesoins()->where('etat','<>',0)->where('etat','<',2)->get() as $lignebesoin)
                <tr class="{{$lignebesoin->id_codeGestion!="" && $lignebesoin->usage!="" ?'valider':''}}">
                    <td class="dt-head-center">{{$lignebesoin->id}}</td>
                    <td class="dt-head-center">{{$lignebesoin->designation->libelle}} </br>{{$lignebesoin->id_materiel}}</td>
                    <td class="dt-head-center"> <div class="form-group" style="max-width: 200px;">
                            <label for="type">Code de gestion</label>
                            <select class="form-control selectpicker col-sm-2"  id="id_codeGestion{{$lignebesoin->id}}" name="id_codeGestion{{$lignebesoin->id}}" data-live-search="true" data-size="6" required>
                                <option value="">SELECTIONNER UN CODE GESTION</option>
                                @foreach($gestions as $gestion)
                                    <option @if(isset($lignebesoin) and $gestion->id==$lignebesoin->id_codeGestion)
                                            {{'selected'}}
                                            @endif value="{{$gestion->id}}" data-subtext="{{$gestion->description}}">{{$gestion->codeGestion}}</option>
                                @endforeach
                            </select>
                        </div></td>
                    <td class="dt-head-center"> <div class="form-group" style="max-width: 200px;">
                            <label for="type">Code tache</label>
                            <select class="form-control selectpicker col-sm-1"  id="id_codeTache{{$lignebesoin->id}}" name="id_codeTache{{$lignebesoin->id}}" data-live-search="true" data-size="6">
                                <option value="">SELECTIONNER UN CODE TACHE</option>
                                @foreach($codetaches as $codetache)
                                    <option @if(isset($lignebesoin) and $codetache->id==$lignebesoin->id_codeTache)
                                            {{'selected'}}
                                            @endif value="{{$codetache->id}}" data-subtext="{{$codetache->libelle}}">{{$codetache->libelle}}</option>
                                @endforeach
                            </select>
                        </div></td>
                    <td class="dt-head-center"><label for="type">Demandeur</label><input type="text" name="demandeur{{$lignebesoin->id}}" id="demandeur{{$lignebesoin->id}}" value="{{$lignebesoin->demandeur}}" /> </td>
                    <td class="dt-head-center"><label for="type">Usage</label><input type="text" name="usage{{$lignebesoin->id}}" id="usage{{$lignebesoin->id}}" value="{{$lignebesoin->usage}}" /></td>
                    <td class="dt-head-center"> <div class="form-group">
                            <label for="type">Nature</label>
                            <select class="form-control selectpicker col-sm-4" id="id_nature{{$lignebesoin->id}}" name="id_nature{{$lignebesoin->id}}" data-live-search="true" data-size="6">
                                @foreach($natures as $nature)
                                    <option @if(isset($lignebesoin) and $nature->id==$lignebesoin->id_nature)
                                            {{'selected'}}
                                            @endif value="{{$nature->id}}">{{$nature->libelleNature}}</option>
                                @endforeach
                            </select>
                        </div></td>
                    <td class="dt-head-center"><label for="type">Quantite</label><input type="number"  step="any" class="form-control " id="quantite{{$lignebesoin->id}}" name="quantite{{$lignebesoin->id}}" placeholder="quantite" value="{{isset($lignebesoin)? $lignebesoin->quantite:''}}" min="0" required>
                    </td>
                    <td class="dt-head-center"> <div class="" style="width: 100px;">
                            <label for="type">Unité</label>
                            <select class="form-control " id="unite{{$lignebesoin->id}}" name="unite{{$lignebesoin->id}}" data-live-search="true" data-size="6">
                                @foreach($tab_unite['nothing'] as $unite)
                                    <option value="{{$unite}}" {{$unite==$lignebesoin->unite?"selected":''}}>{{$unite}}</option>
                                @endforeach
                                <optgroup label="La longeur">
                                    @if(isset($tab_unite['La longueur']))
                                        @foreach($tab_unite['La longueur'] as $unite)
                                            <option value="{{$unite}}" {{$unite==$lignebesoin->unite?"selected":''}}>{{$unite}}</option>
                                        @endforeach
                                    @endif
                                </optgroup>

                                <optgroup label="La masse">
                                    @if(isset($tab_unite['La masse']))
                                        @foreach($tab_unite['La masse'] as $unite)
                                            <option value="{{$unite}}" {{$unite==$lignebesoin->unite?"selected":''}}>{{$unite}}</option>
                                        @endforeach
                                    @endif
                                </optgroup>



                                <optgroup label="Le volume">
                                    @if(isset($tab_unite['Le volume']))
                                        @foreach($tab_unite['Le volume'] as $unite)
                                            <option value="{{$unite}}" {{$unite==$lignebesoin->unite?"selected":''}}>{{$unite}}</option>
                                        @endforeach
                                    @endif
                                </optgroup>

                                <optgroup label="La surface">
                                    @if(isset($tab_unite['La surface']))
                                        @foreach($tab_unite['La surface'] as $unite)
                                            <option value="{{$unite}}" {{$unite==$lignebesoin->unite?"selected":''}}>{{$unite}}</option>
                                        @endforeach
                                    @endif
                                </optgroup>

                            </select>
                        </div>
                    </td>
                    <td class="dt-head-center"> <div class="">
                            <label for="type">Date besoin</label>
                            <input type="date" class="form-control" id="DateBesoin{{$lignebesoin->id}}" name="DateBesoin{{$lignebesoin->id}}" placeholder="DateBesoin" value="{{isset($lignebesoin)? $lignebesoin->DateBesoin:date('Y-m-d',strtotime(date('Y-m-d'). ' + 7 days'))}}"  required>
                        </div>
                    </td>
                    <td class="dt-head-center"> <div class="form-group">
                            <label for="commentaire">Description (Attention ceci figurera sur le bon de commande) </label>
                            <textarea id="commentaire{{$lignebesoin->id}}" name="commentaire{{$lignebesoin->id}}" class="form-control col-sm-8" style="height: 100px; width: 300px" maxlength="1000">{{isset($lignebesoin)? $lignebesoin->commentaire:''}}</textarea>
                        </div>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>

        <div class="row">
            <div class="col-sm-2"><input type="submit" class="btn btn-success" id="enregistrer" value="ENREGISTRER" /> </div>
            <div class="col-sm-8"></div>
            <div class="col-sm-2"><button id="supprimer" class="btn btn-danger" ><i class="fa fa-trash"></i> Retirer du panier</button></div>

        </div>
        </form>

    </div>
    <script>
        (function($) {
            var table= $('#panier').DataTable({
                language: {
                    url: "{{ URL::asset('js/French.json') }}"
                },
                "ordering":true,
                "createdRow": function( row, data, dataIndex){

                },
                paginate:false,
                responsive: false,
                dom: 'Bfrtip',


                "columnDefs": [
                    {
                        'targets': 0,
                        'checkboxes': {
                            'selectRow': true,
                            'selectAllPages': false,

                        }
                    }
                ],
                "select": {
                    'style': 'multi'
                },
            });
            $('#enregistrer').click( function() {


                var data = table.rows().data();
                var lesId;
                var lesIdmat;
               // console.log(data);
                data.each(function (value, index) {
                    // var valeur=parseInt(value);
                    var valeur = value + '';

                    var text = valeur.split(",");

                    if (typeof(valeur) !== "undefined") {
                        lesId = lesId + ',' + text[0];
                    }


                });
                var res;
                //console.log(lesId);
                res=table.$("input, select[value!=''] ,textarea").serialize();

                console.log(lesId);
                //enregistrer_devis/"+res+"/"+lesId+"/"+lesIdmat
                var csrf_token = $('meta[name="csrf-token"]').attr('content');

                $.post("mise_ajour_info_da",{res:res,lesId:lesId,_token: "{{ csrf_token() }}"},
                        function (data) {
                            console.log(data);
                            if(data==1){
                                location.reload();
                            }
                        }
                );
                return false;

            } );
            $('#supprimer').on( 'click', function () {
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
                    $.get('retirer_du_panier/'+mavariable,function (data) {

                        console.log(data);
                        if(data==1){
                             location.reload(true);
                        }else{
                            console.log(data);
                        }

                    });
                }
            } );
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