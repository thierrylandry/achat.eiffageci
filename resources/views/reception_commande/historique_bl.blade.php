
@extends('layouts.app')
@section('historique_bl')
    class='active'
@endsection
@section('parent_reception_commande')
    class='active'
@endsection
@section('content')
    <style>
        div.dropdown-menu.open { width: 100%; } ul.dropdown-menu.inner>li>a { white-space: initial; }
    </style>
    <h2>{{ __('menu.liste_bon_livraison') }} </h2>
    </br>
    </br>
    <br>
    <br>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
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
                            </tr>
                            </thead>
                            <tbody>



                            @foreach($ligne_bonlivraisons as $lignebc)
                                <tr>
                                    <td>{{$lignebc->id}}</td>
                                    <td>{{$lignebc->numero_bl}}</td>
                                    <td>{{$lignebc->fournisseur->libelle}}</td>
                                    <td>{{$lignebc->reference}}</td>
                                    <td>{{$lignebc->quantite}}</td>
                                    <td>{{$lignebc->prix_unitaire}}</td>
                                    <td>{{$lignebc->date_reception}}</td>
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
                paging: false,
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
                                        '<tr class="group" style="background-color:#1f0707;color:white"><td colspan="11"><b>BL N° : ' + group + ' Fournisseur : '+ data[2]+'</b></td></tr>'
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
            }).column( 0 ).visible(false).column( 1 ).visible(false).column( 2 ).visible(false);
            //table.DataTable().draw();
            $('a.toggle-vis').on( 'click', function (e) {
                e.preventDefault();

                // Get the column API object
                var column = table.column( $(this).attr('data-column') );

                // Toggle the visibility
                column.visible( ! column.visible() );
            } );
            //table.DataTable().draw();

            $('#date_livraison').change(function (e) {
                var date_livraison = $('#date_livraison').val();
                $('._date_livraison').val(date_livraison);

            });
            $('._date_livraison').change(function (){
                var data = table.row($(this).closest('tr')).data();
                console.log(data[Object.keys(data)[0]]);
                var _date_livraison= $('#row_n_'+data[Object.keys(data)[0]]+'_date_livraison').val();
                if(_date_livraison!=""){
                    $('#row_n_'+data[Object.keys(data)[0]]+'_date_livraison').prop('required',true);
                    $('#row_n_'+data[Object.keys(data)[0]]+'_numerobl_livraison').prop('required',true);
                    $('#row_n_'+data[Object.keys(data)[0]]+'_qte_livraison').prop('required',true);
                }else{
                    $('#row_n_'+data[Object.keys(data)[0]]+'_date_livraison').prop('required',false);
                    $('#row_n_'+data[Object.keys(data)[0]]+'_numerobl_livraison').prop('required',false);
                    $('#row_n_'+data[Object.keys(data)[0]]+'_qte_livraison').prop('required',false);
                }

            });
            $( "#myForm" ).submit(function( event ) {
                var isValid = false;
                console.log($("._qte_livraison"));
                $("._qte_livraison").each(function() {
                    var element = $(this);
                    console.log(element);
                    if (element.val() != "") {
                        isValid = true;
                    }
                });
                console.log(isValid);

                if(!isValid){
                    event.preventDefault();
                }


            });
            $('#myForm input[type="text"]').blur(function()
            {
                if(!$(this).val()){
                    $(this).addClass("error");
                    $(this).prop('required',true);
                } else{
                    $(this).removeClass("error");
                    $(this).removeClass("error").prop('required',false);
                }
            });
            $('._numerobl_livraison').change(function (){
                var data = table.row($(this).closest('tr')).data();
                console.log(data[Object.keys(data)[0]]);

                var _numerobl_livraison=$('#row_n_'+data[Object.keys(data)[0]]+'_numerobl_livraison').val();
                if(_numerobl_livraison!=""){
                    $('#row_n_'+data[Object.keys(data)[0]]+'_date_livraison').prop('required',true);
                    $('#row_n_'+data[Object.keys(data)[0]]+'_numerobl_livraison').prop('required',true);
                    $('#row_n_'+data[Object.keys(data)[0]]+'_qte_livraison').prop('required',true);
                }else{
                    $('#row_n_'+data[Object.keys(data)[0]]+'_date_livraison').prop('required',false);
                    $('#row_n_'+data[Object.keys(data)[0]]+'_numerobl_livraison').prop('required',false);
                    $('#row_n_'+data[Object.keys(data)[0]]+'_qte_livraison').prop('required',false);
                }
            });
            $('._qte_livraison').change(function (){
                var data = table.row($(this).closest('tr')).data();


                var _qte_livraison= $('#row_n_'+data[Object.keys(data)[0]]+'_qte_livraison').val();
                if(_qte_livraison!=""){
                    $('#row_n_'+data[Object.keys(data)[0]]+'_date_livraison').prop('required',true);
                    $('#row_n_'+data[Object.keys(data)[0]]+'_numerobl_livraison').prop('required',true);
                    $('#row_n_'+data[Object.keys(data)[0]]+'_qte_livraison').prop('required',true);
                }else{
                    $('#row_n_'+data[Object.keys(data)[0]]+'_date_livraison').prop('required',false);
                    $('#row_n_'+data[Object.keys(data)[0]]+'_numerobl_livraison').prop('required',false);
                    $('#row_n_'+data[Object.keys(data)[0]]+'_qte_livraison').prop('required',false);
                }
            });
            function detectempty(){
                var nb=table.data().count();
                console.log(nb);
                for(var i=0;i<nb;i++){
                    $('#row_n_'+data[Object.keys(data)[0]]+'_date_livraison').prop('required',false);
                }

            }
            $('#numero_bl').keyup(function (e) {
                var numero_bl = $('#numero_bl').val();
                $('._numerobl_livraison').val(numero_bl);
            });



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
            $(".modifier_livraison").click(function(){
                //   var selec= this;
                alert('test');
                var data = table.row($(this).closest('tr')).data();
                //$('#id_da').val(data[Object.keys(data)[1]]);
                $('#boutonEnregistrerfac').html('Modifier');
                console.log(data[Object.keys(data)[5]]);
                /*  $.get("afficherfacture/"+data[Object.keys(data)[0]],
                 function (data) {
                 $('#dateRecepFact').val("");
                 $('#dateFacturation').val("");
                 $('#refFacture').val("");
                 $('#ctrlbcblFacture').val(1);
                 $('#ctrlbcblFacture').selectpicker('refresh');
                 $('#montantFacture').val("");
                 $('#commentaires').val("");
                 $('#dateRecepFact').val(data.dateRecepFact);
                 $('#dateFacturation').val(data.dateFacturation);
                 $('#refFacture').val(data.refFacture);
                 $('#ctrlbcblFacture').val(data.ctrlbcblFacture);
                 $('#ctrlbcblFacture').selectpicker('refresh');
                 $('#montantFacture').val(data.montantFacture);
                 $('#commentaires').val(data.commentaires);
                 $('#id_facture').val(data.id);

                 }
                 );*/
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