
@extends('layouts.app')
@section('das')
    class='active'
@endsection
@section('historique_achat')
    class='active'
@endsection
@section('parent_da')
    class='active'
@endsection
@section('content')
    <style>
        div.dropdown-menu.open { width: 100%; } ul.dropdown-menu.inner>li>a { white-space: initial; }
    </style>
    <h2>{{__('menu.historique')}}</h2>

    <br>
    <br>
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading" style="background-color: #f0bcb4!important;">
                <h4 class="panel-title" style="font-size: 32px; color:white" data-toggle="collapse" data-parent="#accordion" href="#collapse1">

                    <a >  {{__('menu.demande_achat')}} </a>
                </h4>
            </div>
            <div id="collapse1" class="panel-collapse collapse in">
                <table name ="tableDA" id="tableDA" class='table table-bordered table-striped  no-wrap responsive ' >

                    <thead>

                    <tr>
                        <th class="dt-head-center">{{__('neutrale.numero_da')}}</th>
                        <th class="dt-head-center">{{__('neutrale.statut')}}</th>
                        <th class="dt-head-center">{{__('neutrale.date_demande')}}</th>
                        <th class="dt-head-center">{{__('neutrale.nature')}}</th>
                        <th class="dt-head-center">{{__('gestion_stock.code_analytique')}}</th>
                        <th class="dt-head-center">{{__('gestion_stock.quantite')}}</th>
                        <th class="dt-head-center">{{__('neutrale.pour_le')}}</th>
                        <th class="dt-head-center">{{__('neutrale.usage')}}</th>
                        <th class="dt-head-center">{{__('gestion_stock.code_analytique')}}</th>
                        <th class="dt-head-center">{{__('neutrale.code_gestion')}}</th>
                        <th class="dt-head-center">{{__('neutrale.description')}}</th>

                    </tr>
                    </thead>
                    <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">
                    @foreach($mesdas_news as $da )
                        <tr>
                            <td>{{$da->id}}</td>
                            <td>

                                @if($da->etat==1)
                                <i class="fa fa-circle "  style="color: orange"></i>
                                {{__('menu.suspendu')}}
                                @elseif($da->etat==2)
                                <i class="fa fa-circle" style="color: yellow"></i>
                                {{__('menu.accepted')}}
                                @elseif($da->etat==3)
                                <i class="fa fa-circle" style="color: chartreuse"></i>
                                {{__('menu.attente')}}
                                @elseif($da->etat==0)
                                <i class="fa fa-circle" style="color: red"></i>
                                {{__('menu.refuser')}}
                                @elseif($da->etat==4)
                                    <i class="fa fa-circle" style="color:green"></i>
                                    {{__('menu.traite_termine')}}
                                @elseif($da->etat==11)
                                    <i class="fa fa-circle" style="color: black"></i>
                                    {{__('menu.traite_retouner')}}
                                @endif
                            </td>
                            <td>{{date_format( new datetime($da->created_at),'d-m-Y H:i:s')}}</td>
                            <td>{{isset($da->nature->libelle)?$da->nature->libelle:''}}</td>
                            <td>{{isset($da->designation->libelle)?$da->designation->libelle:''}}</td>
                            <td>{{$da->quantite}}</td>
                            <td>{{\Carbon\Carbon::parse($da->DateBesoin)->format('d-m-Y')}}</td>
                            <td>{{$da->usage}}</td>
                            <td></td>
                            <td>{{isset($da->gestion->codeGestion)?$da->gestion->codeGestion:''}}</td>
                            <th class="dt-head-center">{{$da->commentaire}}</th>
                        </tr>
                    @endforeach
                    @foreach($mesdas as $da )
                        <tr>
                            <td>{{$da->id}}</td>
                            <td>

                                @if($da->etat==1)
                                <i class="fa fa-circle "  style="color: orange"></i>
                                {{__('menu.suspendu')}}
                                @elseif($da->etat==2)
                                <i class="fa fa-circle" style="color: yellow"></i>
                                {{__('menu.accepted')}}
                                @elseif($da->etat==3)
                                <i class="fa fa-circle" style="color: chartreuse"></i>
                                {{__('menu.attente')}}
                                @elseif($da->etat==0)
                                <i class="fa fa-circle" style="color: red"></i>
                                {{__('menu.refuser')}}
                                @elseif($da->etat==4)
                                    <i class="fa fa-circle" style="color:green"></i>
                                    {{__('menu.traite_termine')}}
                                @elseif($da->etat==11)
                                    <i class="fa fa-circle" style="color: black"></i>
                                    {{__('menu.traite_retouner')}}
                                @endif
                            </td>
                            <td>{{date_format( new datetime($da->created_at),'d-m-Y H:i:s')}}</td>
                            <td>{{$da->nature->libelle}}</td>
                            <td>{{isset($da->materiel->libelleMateriel)?$da->materiel->libelleMateriel:''}}</td>
                            <td>{{$da->quantite}}</td>
                            <td>{{\Carbon\Carbon::parse($da->DateBesoin)->format('d-m-Y')}}</td>
                            <td>{{$da->usage}}</td>
                            <td>{{isset($da->materiel->code_analytique)?$da->materiel->code_analytique:''}}</td>
                            <td>{{isset($da->gestion->codeGestion)?$da->gestion->codeGestion:''}}</td>
                            <th class="dt-head-center">{{$da->commentaire}}</th>
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
                columnDefs: [
                    { responsivePriority: 2, targets: 0 },
                    { responsivePriority: 1, targets: -1 }
                ],
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
