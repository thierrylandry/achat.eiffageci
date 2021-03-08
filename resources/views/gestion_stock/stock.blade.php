
@extends('layouts.app')
@section('gestion_stock')
    class='active'
@endsection

@section('content')
    <style>
        div.dropdown-menu.open { width: 100%; } ul.dropdown-menu.inner>li>a { white-space: initial; }
        #tableDA > tbody .stock_min{
            background-color: red!important;
            color: white!important;
        }
    </style>

    <h2>LE STOCK MATERIEL  </h2>
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
                        <th class="dt-head-center">{{__('gestion_stock.domaine')}}</th>
                        <th class="dt-head-center">{{__('gestion_stock.famille')}}</th>
                        <th class="dt-head-center">{{__('gestion_stock.article')}}</th>
                        <th class="dt-head-center">{{__('gestion_stock.quantite')}}</th>
                        <th class="dt-head-center">{{__('gestion_stock.unite')}}</th>
                        <th class="dt-head-center">{{__('gestion_stock.stock_min')}}</th>
                        <th class="dt-head-center">{{__('gestion_stock.valorisation')}}</th>

                    </tr>
                    </thead>
                    <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">
                    @foreach($stocks as $stock)
                        @if($stock->quantite!="0")
                        <tr class="@if($stock->quantite<=$stock->stock_min) stock_min @endif">
                            <td>{{$stock->id}}</td>
                            <td>{{$stock->libelleDomainne}}</td>
                            <td>{{$stock->famille}}</td>
                              <td>{{$stock->libelle}}</td>
                            <td>{{$stock->quantite}}</td>
                            <td>{{$stock->unite}}</td>
                            <td>{{$stock->stock_min}}</td>
                            <td>{{isset($tableaux[$stock->id][$stock->libelle])?number_format($tableaux[$stock->id][$stock->libelle],'0',',','.'):''}}</td>
                        </tr>
                        @endif
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
            // Setup - add a text input to each footer cell
            $('#tableDA thead th').each( function () {
                var title = $(this).text();
                if($(this).html()!='{{__('gestion_stock.stock_min')}}' && $(this).html()!='{{__('gestion_stock.valorisation')}}' && $(this).html()!='{{__('gestion_stock.quantite')}}' && $(this).html()!='{{__('gestion_stock.unite')}}'){
                    $(this).append( '</br><input type="text" style="width: 100px;" placeholder="Search '+title+'" />' );
                }

            } );
            var table= $('#tableDA').DataTable({
                language: {
                @if(App()->getLocale()=='fr')
                        url: "../public/js/French.json"
                @elseif(App()->getLocale()=='en')
                        url: "../public/js/English.json"
                @endif
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
                "scrollY":"500px",


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


                $.get('reste_en_stock/'+valeur,function (data) {
                    $('#quantite').attr({"max" : data.quantite});
                    $('#unite').val(data.unite);
                    $('#unite').selectpicker('refresh');


                });
            });
        })(jQuery);

    </script>
@endsection
