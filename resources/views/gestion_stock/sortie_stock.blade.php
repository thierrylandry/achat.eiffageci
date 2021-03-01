
@extends('layouts.app')
@section('gestion_stock')
    class='active'
@endsection

@section('content')
    <style>
        div.dropdown-menu.open { width: 100%; } ul.dropdown-menu.inner>li>a { white-space: initial; }
    </style>
    <h2>SORTIES DE MATERIEL - {{isset($mouvement)? 'MODIFIER ':'AJOUTER '}} UN MOUVEMENT @if(isset($mouvement)) <a href="{{route('sortie_stock',App()->getLocale())}}" class="btn btn-success pull-right"><i class="fa fa-plus" aria-hidden="true"></i> Ajouter</a> @endif &nbsp;</h2>
    </br>
    </br>
    <div class="row">


        <form role="form" id="FormRegister" class="" method="post" @if(isset($mouvement)) action="{{route('modifier_mouvement',App()->getLocale())}} @else  action="{{route('enregistrer_mouvement',App()->getLocale())}}" @endif  onsubmit="return confirm('Voulez vous enregistrer?');">

            <div class="col-sm-4">
                <div class="form-group">
                    <label for="libelle" class="control-label">Domaine:</label>


                    <select class="form-control selectpicker " id="domaines" name="domaines" data-live-search="true" data-size="6">
                        <option value="" >SELECTIONNER UN DOMAINE</option>
                        @foreach($domaines as $domaine)
                            <option value="{{$domaine->id_domaine}}"> {{$domaine->libelle_domaine}}</option>
                        @endforeach
                    </select>
                </div>


            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="libelle" class="control-label">Famille:</label>


                    <select class="form-control selectpicker " id="famille" name="famille" data-live-search="true" data-size="6">
                        <option value="" >SELECTIONNER UNE FAMILLE</option>
                        @foreach($familles as $famille)
                            <option value="{{$famille->id_famille}}"> {{$famille->libelle_famille}}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <input type="hidden" name="id" value="{{isset($mouvement)?$mouvement->id:''}}">
                    <label for="libelle" class="control-label">Article</label>


                    <select class="form-control selectpicker col-sm-4" id="id_materiel" name="id_mouvement" data-live-search="true" data-size="6" required>
                        <option  value="">SELECTIONNER UN ARICLE</option>
                        @foreach($mouvement_materiels as $mouvement_materiel)
                            <optgroup label="code tache: {{$mouvement_materiel->codetache}}">
                                <option @if(isset($mouvement) and $mouvement_materiel->id==$mouvement->id_mouvement)
                                        {{'selected'}}  <?php $stock_max=$mouvement_materiel->quantite+$mouvement->quantite*(-1); ?>
                                        @endif value="{{$mouvement_materiel->id}}">{{$mouvement_materiel->libelle}} Stock: {{$mouvement_materiel->quantite}} {{$mouvement_materiel->unite}}   </option>
                            </optgroup>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-4">

                @csrf

                <div class="form-group">
                    <label for="libelle" class="control-label">Code tache</label>


                    <select class="form-control selectpicker col-sm-4" id="id_imputation" name="id_imputation" data-live-search="true" data-size="6" required>
                        <option value="">SELECTIONNER UN CODE TACHE</option>
                        @foreach($codetaches as $codetache)
                            <optgroup label="Picnic">
                            <option @if(isset($mouvement) and $codetache->id==$mouvement->id_imputation)
                                    {{'selected'}}
                                    @endif value="{{$codetache->id}}" data-subtext="{{$codetache->description}}">{{$codetache->libelle}}</option>
                            </optgroup>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <b><label for="libelle" class="control-label">Demandeur</label></b>
                    <select class="form-control selectpicker col-sm-4" id="id_demandeur" name="id_demandeur" data-live-search="true" data-size="6">
                        @foreach($demandeurs as $demandeur)
                            <option @if(isset($mouvement) and $demandeur->id==$mouvement->id_demandeur)
                                    {{'selected'}}
                                    @endif value="{{$demandeur->id}}">{{$demandeur->nom}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group col-sm-3 ">
                    <label for="type">Quantité</label>
                    <input type="number"  step="any" class="form-control " id="quantite" name="quantite" placeholder="quantite" max="{{isset($mouvement)? $stock_max:''}}" value="{{isset($mouvement)? $mouvement->quantite*(-1):''}}"   min="1" required>
                </div>
                <div class="form-group col-sm-3">
                    <label for="type">Unité</label>
                    <select class="form-control selectpicker col-sm-4" id="unite" name="unite" data-live-search="true" data-size="6">
                        @foreach($tab_unite['nothing'] as $unite)
                            <option value="{{$unite}}" {{isset($mouvement) && $unite==$mouvement->unite?"selected":''}}>{{$unite}}</option>
                        @endforeach
                        <optgroup label="La longeur">
                            @foreach($tab_unite['La longueur'] as $unite)
                                <option value="{{$unite}}" {{isset($mouvement) && $unite==$mouvement->unite?"selected":''}}>{{$unite}}</option>
                            @endforeach
                        </optgroup>

                        <optgroup label="La masse">
                            @foreach($tab_unite['La masse'] as $unite)
                                <option value="{{$unite}}" {{isset($mouvement) && $unite==$mouvement->unite?"selected":''}}>{{$unite}}</option>
                            @endforeach
                        </optgroup>



                        <optgroup label="Le volume">
                            @foreach($tab_unite['Le volume'] as $unite)
                                <option value="{{$unite}}" {{isset($mouvement) && $unite==$mouvement->unite?"selected":''}}>{{$unite}}</option>
                            @endforeach
                        </optgroup>

                        <optgroup label="La surface">
                            @foreach($tab_unite['La surface'] as $unite)
                                <option value="{{$unite}}" {{isset($mouvement) && $unite==$mouvement->unite?"selected":''}}>{{$unite}}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" class="form-control" id="id_user" name="id_user" placeholder="" value="{{ Auth::user()->id }}">
                <br>
                <br>
                <br>                                <br>
                <br>
                <br>
                <div class="form-group col-sm-4 col-sm-push-8" >
                    <button type="submit"  id="btnvalider"class="btn btn-success form-control">{{isset($mouvement)? 'Modifier':'Ajouter'}}</button>
                </div>
            </div>










        </form>

    </div>
    <h2>LES SORTIES MATERIELS  </h2>
    <br>
    <br>
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading" style="background-color: #f0bcb4!important;">
                <h4 class="panel-title" style="font-size: 32px; color:white" data-toggle="collapse" data-parent="#accordion" href="#collapse1">

                    <a >   </a>
                </h4>
            </div>
            <div id="collapse1" class="panel-collapse collapse in">
                <table name ="tableDA" id="tableDA" class='table table-bordered table-striped  no-wrap responsive ' >

                    <thead>

                    <tr>
                        <th class="dt-head-center">id</th>
                        <th class="dt-head-center">Domaine</th>
                        <th class="dt-head-center">Famille</th>
                        <th class="dt-head-center">Article</th>
                        <th class="dt-head-center">Quantite</th>
                        <th class="dt-head-center">Unité</th>
                        <th class="dt-head-center">Code tache</th>
                        <th class="dt-head-center">Demandeur</th>
                        <th class="dt-head-center">Auteur</th>
                        <th class="dt-head-center">Action</th>

                    </tr>
                    </thead>
                    <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">
                    @foreach($mouvements as $mouvement)
                        <tr>
                            <td>{{$mouvement->id}}</td>
                            <td>{{$mouvement->designation->famille->domaine->libelleDomainne}}</td>
                            <td>{{$mouvement->designation->famille->libelle}}</td>
                            <td>{{$mouvement->designation->libelle}}</td>
                            <td>{{$mouvement->quantite}}</td>
                            <td>{{$mouvement->unite}}</td>
                            <td>{{$mouvement->imputation->libelle}}</td>
                            <td>{{$mouvement->demandeur->nom}}</td>
                            <td>{{$mouvement->auteur->nom}}</td>
                            <td><a href="{{route('edit_mouvement',['id'=>$mouvement->id,'locale'=>App()->getLocale()])}}" class="btn btn-info"><i class="fa fa-pencil"></i></a>&nbsp;<a href="{{route('delete_mouvement',['id'=>$mouvement->id,'locale'=>App()->getLocale()])}}" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <script src="{{URL::asset('js/scriptperso.js')}}"> </script>
    <script>
        $('#id_materiel').change(function (e) {
            if(this.value==""){
                $('#image').attr('src',"images/background2.jpg");
            }
            var route ="{{asset('')}}";
            $.get(route+"/afficher_image/" + this.value,
                    function (data) {
                        if(data!=""){
                            $('#image').attr('src',"uploads/"+data);
                        }else{
                            $('#image').attr('src',"images/background2.jpg");
                        }

                    }
            );
            /*    $.get(route+"/code_gestion_produit/" + this.value,
             function (data) {
             if(data!=""){
             $('#id_codeGestion').val(data);
             $('#id_codeGestion').selectpicker('refresh');
             }else{
             $('#id_codeGestion').val('');
             $('#id_codeGestion').selectpicker('refresh');
             }

             }
             );*/
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
            $('#tableDA thead th').each( function () {
                var title = $(this).text();

                if( $(this).html()!="Action" && $(this).html()!="Quantite"&& $(this).html()!="Unité" ){
                    $(this).append( '<input type="text" placeholder="Search '+title+'" />' );
                }

            } );
            var table= $('#tableDA').DataTable({
                language: {
                    url: "{{ URL::asset('js/French.json') }}"
                },
                "ordering":false,
                "createdRow": function( row, data, dataIndex){

                },
                responsive: false,
                initComplete: function () {
                    // Apply the search
                    this.api().columns().every( function () {
                        var that = this;

                        $( 'input', this.header() ).on( 'keyup change clear', function () {
                            if ( that.search() !== this.value ) {
                                that
                                        .search( this.value )
                                        .draw();
                            }
                        } );
                    } );
                },
                "scrollY": 500,
                "scrollX": true,
                "fixedHeader": true
            }).column(0).visible(false);
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

            $('#id_materiel').change(function(e){

                var valeur = $(this).val();

                $('#quantite').val(1);
                $.get('reste_en_stock/'+valeur,function (data) {
                    $('#quantite').attr({"max" : data.quantite});
                    $('#unite').val(data.unite);
                    $('#unite').selectpicker('refresh');

                 //   $('#id_demandeur').val(data.id_user);
                   // $('#id_demandeur').selectpicker('refresh');

                    $('#id_imputation option:contains('+data.codetache+')').prop('selected', true);

                    $('#id_imputation').selectpicker('refresh');

                });
            });

            var route="{{asset('')}}";
            $('#domaines').change(function (e) {
                var domaines = $('#domaines').val();

                if(domaines==''){
                    domaines="tout";}

                $.get(route+'/donne_moi_les_famille_disponible/'+domaines,function (data) {

                    console.log(data);

                    $('#famille').html('');
                    $('#famille').html(data);
                    $('#famille').selectpicker('refresh');

                    $.get(route+'/donne_moi_les_designation_disponible/'+famille,function (data) {

                        console.log(data);

                        $('#id_materiel').html('');
                        $('#id_materiel').html(data);
                        $('#id_materiel').selectpicker('refresh');

                    });

                });

            });
            $('#famille').change(function (e) {
                var famille = $('#famille').val();

                if(famille==''){
                    famille="tout";}

                $.get(route+'/donne_moi_les_designation_disponible/'+famille,function (data) {

                    console.log(data);

                    $('#id_materiel').html('');
                    $('#id_materiel').html(data);
                    $('#id_materiel').selectpicker('refresh');

                });

            });

            $('#refference').change(function (e) {
                var refference = $('#refference').val();

                $.get(route+'/donne_moi_toute_la_refference_disponible/'+refference,function (data) {

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
@endsection