
@extends('layouts.app')
@section('reception_sans_commande')
    class='active'
@endsection
@section('parent_reception_commande')
    class='active'
@endsection
@section('content')
    <style>
        div.dropdown-menu.open { width: 100%; } ul.dropdown-menu.inner>li>a { white-space: initial; }
    </style>
    <h2>{{__('menu.reception_commande_sans_bc')}} / @if(isset($ligne_bonlivraison)) {{ __('translation.update') }}  <a href="{{route('reception_commande_sans_bc',app()->getLocale())}}" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Ajouter</a> @else {{ __('translation.add') }}  @endif </h2>
    </br>
    </br>
    <div class="row">


        <form role="form" id="FormRegister" class="" method="post" action="{{isset($ligne_bonlivraison)? route('receptionner_commande_sans_bc_update'):route('receptionner_commande_sans_bc')}}">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="libelle" class="control-label">{{__('gestion_stock.domaine')}}:</label>


                        <select class="form-control selectpicker " id="domaines" name="domaines" data-live-search="true" data-size="6">
                            <option value="" >{{__('sortie_materiel.selectionner_domaine')}}</option>
                            @foreach($domaines as $domaine)
                                <option value="{{$domaine->id}}" {{isset($ligne_bonlivraison->reference) && $ligne_bonlivraison->reference==$domaine->libelleDomainne?'selected':''}} >{{$domaine->libelleDomainne}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="libelle" class="control-label">{{__('gestion_stock.famille')}}:</label>


                        <select class="form-control selectpicker " id="famille" name="famille" data-live-search="true" data-size="6">
                            <option value="" >{{__('sortie_materiel.selectionner_famille')}}</option>
                            @foreach($familles as $famille)
                                <option value="{{$famille->id}}" {{isset($ligne_bonlivraison->reference) && $ligne_bonlivraison->reference==$famille->libelle?'selected':''}} >{{$famille->libelle}}</option>
                            @endforeach
                        </select>
                    </div>
                </div> <div class="col-sm-4">
                    <div class="form-group">
                        <label for="libelle" class="control-label">{{__('gestion_stock.article')}}:</label>


                        <select class="form-control selectpicker " id="refference" name="refference" data-live-search="true" data-size="6" required>
                            <option value="" >{{__('sortie_materiel.selectionner_article')}}</option>
                            @foreach($produits as $produit)
                                <option value="{{$produit->libelle}}" {{isset($ligne_bonlivraison->reference) && $ligne_bonlivraison->reference==$produit->libelle?'selected':''}} >{{$produit->libelle}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="libelle" class="control-label">{{__('menu.fournisseurs')}}:</label>
                            @csrf
                        <input type="hidden" name="id" value="{{isset($ligne_bonlivraison->id)? $ligne_bonlivraison->id:''}}" />
                        <select class="form-control selectpicker " id="id_fournisseur" name="id_fournisseur" data-live-search="true" data-size="6" required>
                            <option value="" >{{__('neutrale.selectionner_fournisseur')}}</option>
                            @foreach($fournisseurs as $fournisseur)
                                <option value="{{$fournisseur->id}}" {{isset($ligne_bonlivraison->id_fournisseur) && $ligne_bonlivraison->id_fournisseur==$fournisseur->id?'selected':''}} >{{$fournisseur->libelle}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <label for="libelle" class="control-label">{{__('reception.numero_bl')}}: </label>
                    <div class="form-group">
                        <input type="text" class="form-control" id="numero_bl" name="numero_bl" value="{{isset($ligne_bonlivraison->numero_bl)? $ligne_bonlivraison->numero_bl:''}}" />
                    </div>
                </div>


                <div class="col-sm-4">
                    <label class="control-label" for="id_bc">{{__('neutrale.pu')}}:</label>
                    <div class="form-group">
                        <input type="number" name="prix_unitaire" class="form-control" value="{{isset($ligne_bonlivraison->prix_unitaire)? $ligne_bonlivraison->prix_unitaire:''}}" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <label class="control-label col-sm-1" for="id_bc">{{__('gestion_stock.quantite')}}:</label>
                    <div class="form_group">
                        <input type="number" min="1" name="quantite" class="form-control" value="{{isset($ligne_bonlivraison->quantite)? $ligne_bonlivraison->quantite:''}}" />
                    </div>
                </div>
                <div class="form-group col-sm-4">
                    <label for="type">{{__('gestion_stock.unite')}}</label>
                    <select class="form-control selectpicker col-sm-4" id="unite" name="unite" data-live-search="true" data-size="6">
                        @foreach($tab_unite['nothing'] as $unite)
                            <option value="{{$unite}}" {{isset($ligne_bonlivraison) && $unite==$ligne_bonlivraison->unite?"selected":''}}>{{$unite}}</option>
                        @endforeach
                        <optgroup label="La longeur">
                            @foreach($tab_unite['La longueur'] as $unite)
                                <option value="{{$unite}}" {{isset($ligne_bonlivraison) && $unite==$ligne_bonlivraison->unite?"selected":''}}>{{$unite}}</option>
                            @endforeach
                        </optgroup>

                        <optgroup label="La masse">
                            @foreach($tab_unite['La masse'] as $unite)
                                <option value="{{$unite}}" {{isset($ligne_bonlivraison) && $unite==$ligne_bonlivraison->unite?"selected":''}}>{{$unite}}</option>
                            @endforeach
                        </optgroup>



                        <optgroup label="Le volume">
                            @foreach($tab_unite['Le volume'] as $unite)
                                <option value="{{$unite}}" {{isset($ligne_bonlivraison) && $unite==$ligne_bonlivraison->unite?"selected":''}}>{{$unite}}</option>
                            @endforeach
                        </optgroup>

                        <optgroup label="La surface">
                            @foreach($tab_unite['La surface'] as $unite)
                                <option value="{{$unite}}" {{isset($ligne_bonlivraison) && $unite==$ligne_bonlivraison->unite?"selected":''}}>{{$unite}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="libelle" class="control-label">{{__('reception.date_livraison')}}</label>


                        <input type="date" id="date_livraison" name="date_livraison" value="{{isset($ligne_bonlivraison->date_livraison)? $ligne_bonlivraison->date_livraison:''}}"/>
                    </div>
                </div>
                <div class="col-sm-3">
                    @csrf
                    <label for="libelle" class="control-label"></label>
                    <input type="submit"  value="@if(isset($ligne_bonlivraison)) {{ __('translation.update') }}  @else {{ __('translation.add') }}  @endif"/>
                </div>
            </div>




        </form>

    </div>
    <br>
    <br>
    <form id="myForm" method="POST" action="{{route('receptionner_commande')}}">
        @csrf
        <input type="hidden" name="id_bc" value="{{isset($bc_chosisi)?$bc_chosisi->id:""}}"/>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                       {{__('neutrale.Liste_des_sans_BC')}}
                    </div>
                    <div  class="table-responsive" STYLE="overflow-x:scroll;">
                        <table class="table table-striped b-t b-light" id="reception_commande">
                            <thead>
                            <tr>
                                <th class="dt-head-center">id</th>
                                <th class="dt-head-center">{{__('reception.numero_bl')}}</th>
                                <th class="dt-head-center">{{__('menu.fournisseurs')}}</th>
                                <th class="dt-head-center">{{__('gestion_stock.article')}}</th>
                                <th class="dt-head-center">{{__('gestion_stock.quantite')}}</th>
                                <th class="dt-head-center">{{__('neutrale.pu')}}</th>
                                <th class="dt-head-center">{{__('reception.date_livraison')}}</th>
                                <th class="dt-head-center">{{__('gestion_stock.action')}}</th>
                            </tr>
                            </thead>
                            <tbody>



                                @foreach($ligne_bonlivraisons as $lignebc)
                                    <tr>
                                        <td>{{$lignebc->id}}</td>
                                        <td>{{$lignebc->numero_bl}}</td>
                                        <td>{{$lignebc->fournisseur->libelle}}</td>
                                        <td>{{$lignebc->reference}}</td>
                                        <td>{{$lignebc->quantite}} {{$lignebc->unite}}</td>
                                        <td>{{$lignebc->prix_unitaire}}</td>
                                        <td>{{$lignebc->date_reception}}</td>
                                        <td><a href="{{route('reception_commande_sans_bc_edit',['locale'=>app()->getLocale(),'id'=>$lignebc->id])}}" class="btn btn-info"><i class="fa fa-pencil"></i></a>&nbsp;<a href="{{route('supprimer_livraison_sans_bc',['locale'=>app()->getLocale(),'id'=>$lignebc->id])}}" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

    </form>

    <script src="{{URL::asset('js/scriptperso.js')}}"> </script>
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
            var table= $('#reception_commande').DataTable({
                language: {
                    @if(App()->getLocale()=='fr')
                    url: "../public/js/French.json"
                    @elseif(App()->getLocale()=='en')
                    url: "../public/js/English.json"
                    @endif
                },
                "ordering":true,
                "createdRow": function( row, data, dataIndex){

                },
                responsive: true,
                columnDefs: [
                    { responsivePriority: 1, targets: 0 },
                    { responsivePriority: 2, targets: -1 }
                ],
                order: [[1, 'desc']],
                "drawCallback": function (settings){
                    var api = this.api();

                    // Zero-based index of the column containing names
                    var col_name = 1;
console.log(api.order());
                    // If ordered by column containing names
                    if (api.order()[0][0] === col_name) {
                        var rows = api.rows({ page: 'current' }).nodes();
                        var group_last = null;

                        api.column(col_name, { page: 'current' }).data().each(function (name, index){
                            var group = name;
                            var data = api.row(rows[index]).data();

                            if (group_last !== group) {
                                $(rows[index]).before(
                                        '<tr class="group" style="background-color:#1f0707;color:white"><td colspan="11"><b>BL N° : ' + group + '</b></td></tr>'
                                );

                                group_last = group;
                            }
                        });
                    }
                },
                rowGroup: {
                    startRender: function ( rows, group ) {
                        return 'Nombre de ligne '+' ('+rows.count()+')';

                    },
                    endRender: null,

                    dataSrc: [0]
                },
            }).column( 0 ).visible(false);

            var route="{{asset('')}}";
            $('#domaines').change(function (e) {
                var domaines = $('#domaines').val();

                    if(domaines==''){
                    domaines="tout";}

                $.get(route+'/donne_moi_les_famille/'+domaines,function (data) {

                    console.log(data);

                    $('#famille').html('');
                    $('#famille').html(data);
                    $('#famille').selectpicker('refresh');

                });

            });
                $('#famille').change(function (e) {
                var famille = $('#famille').val();

                    if(famille==''){
                    famille="tout";}

                $.get(route+'/donne_moi_les_designation/'+famille,function (data) {

                    console.log(data);

                    $('#refference').html('');
                    $('#refference').html(data);
                    $('#refference').selectpicker('refresh');

                });

            });

                     $('#refference').change(function (e) {
                var refference = $('#refference').val();

                $.get(route+'/donne_moi_toute_la_refference/'+refference,function (data) {

                    console.log(data);

                    $('#famille').val(data.id_famille);
                    $('#famille').selectpicker('refresh');

                    $('#domaines').val(data.id_domaine);
                    $('#domaines').selectpicker('refresh');


                });

            });

            function defaut(){
            var route="{{asset('')}}";
             var refference = $('#refference').val();

                            $.get(route+'/donne_moi_toute_la_refference/'+refference,function (data) {

                                console.log(data);

                                $('#famille').val(data.id_famille);
                                $('#famille').selectpicker('refresh');

                                $('#domaines').val(data.id_domaine);
                                $('#domaines').selectpicker('refresh');


                            });
            }
          //  defaut();
            setTimeout(defaut, 5000);
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
