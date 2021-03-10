
@extends('layouts.app')
@section('das')
    class='active'
@endsection
@section('demande_achat')
    class='active'
@endsection
@section('parent_da')
    class='active'
@endsection
@section('content')
    <style>
        div.dropdown-menu.open { width: 100%; } ul.dropdown-menu.inner>li>a { white-space: initial; }
    </style>
    <h2>{{__('neutrale.catalogue_article')}} / {{__('menu.demande_achat')}}  <a href="{{route('lister_da',app()->getLocale())}}" class="btn btn-default pull-right"><i class="fa fa-list" aria-hidden="true"></i> {{__('translation.liste')}}</a></h2>
    </br>
    </br>
    <div class="row">


        <form role="form" id="FormRegister" class="" method="post" action="{{route('Validdas')}}" onsubmit="return confirm('Voulez vous enregistrer?');">

            <div id="events"></div>
    <input type="button" class="btn btn-info" value="{{__('gestion_stock.lister_selection')}} " id="action_liste"> <input type="button" class="btn btn-success" value="{{__('gestion_stock.ajouter_au_panier')}} " id="ajouter_panier">
            <table  name ="produits" id="produits" class='table table-bordered table-striped  no-wrap '>

                <thead>

                <tr>
                    <th class="dt-head-center">id</th>
                    <th class="dt-head-center">{{__('gestion_stock.image')}}</th>
                    <th class="dt-head-center">{{__('gestion_stock.article')}}</th>
                    <th class="dt-head-center">{{__('gestion_stock.famille')}}</th>
                    <th class="dt-head-center">{{__('gestion_stock.domaine')}}</th>
                </tr>
                </thead>
                <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">
                @foreach($materiels as $produit )
                    <tr>
                        <td>{{$produit->id}}</td>
                        <td> @if($produit->image<>"")<img src="{{ URL::asset('/uploads/'.$produit->image)}}" width="100px" height="100px" alt="Snow" onclick="voir(this)"/> @endif </td>
                        <td>{{$produit->libelle}}</td>
                        <td>
                            {{$produit->famille->libelle}}
                        </td>
                        <td>
                            {{(isset($produit->famille->domaine->libelleDomainne)?$produit->famille->domaine->libelleDomainne:'')}}
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>


        </form>

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
            var events = $('#events');
            var table= $('#produits').DataTable({
                dom: 'Bfrtip',

                buttons: [
                    {
                        text: 'Lister ma selection',
                        action: function () {
                            var count  = table.column(0).checkboxes.selected();

                            events.prepend( '<div>'+count+' row(s) selected</div>' );
                        }
                    }
                ],
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
                responsive: false,
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

                order: [[ 1, 'asc' ]]
            });
            //table.DataTable().draw();
            $('#ajouter_panier').on( 'click', function (e) {
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
                    events.html('');
                }else{
                    $.get('creation_ajout_de_panier/'+mavariable,function (data) {

                        console.log(data);
                        if(data==1){
                           // location.reload(true);

                            alert('produit ajouté au panier');
                        }else{
                            console.log(data);
                            alert('produit déjà dans le panier');
                        }
                        afficher_contenue_panier();
                    });
                }
            } );
            afficher_contenue_panier();
            function afficher_contenue_panier() {

                $.get('afficher_contenue_panier',function (data) {



                  //  nb_article

                    $('#nb_article').html(data.length);

                    var adresse="{{route('mon_panier',app()->getLocale())}}";

                    var res=" <li class='external'><a href='"+adresse+"' class='btn btn-success'>>>Ouvrir mon panier<<</a> </li>";
                    $.each(data,function (index,value) {
                        res=res+"<li><a href='#'><div class='task-info clearfix'><div class='desc pull-left'><h5>"+value+"</h5></div> <span class='notification-pie-chart pull-right' data-percent='45'> <span class='percent'></span> </span> </div> </a> </li>";
                    });
                        $('#list_panier').html(res);
                });

            }
            $('#action_liste').on( 'click', function (e) {
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
                    events.html('');
                }else{
                    $.get('donne_moi_le_nom_des_designations/'+mavariable,function (data) {

                        events.html(data);
                    });
                }
            } );
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

            $('#tableDAsevice tbody').on( 'click', 'tr', function () {
                if ( $(this).hasClass('selected') ) {
                    $(this).removeClass('selected');
                }
                else {
                    table1.$('tr.selected').removeClass('selected');
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