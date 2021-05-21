
@extends('layouts.app')
@section('reception_commande')
    class='active'
@endsection
@section('parent_reception_commande')
    class='active'
@endsection
@section('content')
    <h2>{{__('menu.reception_commande')}} - @if(isset($da)) {{ __('add') }} @else  {{ __('neutrale.ajouter') }} @endif </h2>
    </br>
    </br>
    <!-- modal de l'ajout de facture-->
    <div class="modal fade " id="ajouterfacture" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modification de livraison</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('ajouterFacture',app()->getLocale())}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input name="id_livraison" type="hidden" />
                        Quantité reçu : <input type="number"  min=1 onkeyup="" id="row_n_qte_livraison" class="_qte_livraison" name="row_n_qte_livraison" style="width:59px;"/> <input type="date" id="row_n_date_livraison" class="_date_livraison" name="row_n_date_livraison" style="width:135px;" /> Numero BL :<input type="text" id="row_n_numerobl_livraison" class="_numerobl_livraison" name="row_n_numerobl_livraison" placeholder="Numero BL" style="width:100px;" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">


        <form role="form" id="FormRegister" class="" method="post" action="{{route('reception_commande_numero',app()->getLocale())}}">
            <div class="form-group">
                <label class="control-label col-sm-1" for="id_bc">{{__('menu.bon_commande')}}:</label>
                <div class="col-sm-2">
                    <select class="form-control selectpicker " id="id_bc" name="id_bc" data-live-search="true" data-size="6" required>
                        <option value="" >{{__('reception.selectionner_commande')}}</option>
                        @foreach($bcs as $bc)
                            <option value="{{$bc->id}}" {{isset($bc_chosisi) && $bc_chosisi->id==$bc->id? 'selected':''}}>{{$bc->numBonCommande}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-1">
                @csrf
                <input type="submit"  value="{{__('reception.search')}}"/>
            </div>
        </form>

    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-sm-2">
            <div class="form-group">
                <label for="libelle" class="control-label">{{__('reception.date_livraison')}}</label>


               <input type="date" id="date_livraison" />
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label for="libelle" class="control-label">{{__('reception.numero_bl')}} : </label>


               <input type="text" id="numero_bl" />
            </div>
        </div>

    </div>
    <form id="myForm" method="POST" action="{{route('receptionner_commande',app()->getLocale())}}">
            @csrf
        <input type="hidden" name="id_bc" value="{{isset($bc_chosisi)?$bc_chosisi->id:""}}"/>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{__('reception.list_commande')}}
                </div>
                <div  class="table-responsive" STYLE="overflow-x:scroll;">
                    <table class="table table-striped b-t b-light" id="reception_commande">
                        <thead>
                        <tr>
                            <th class="dt-head-center">id</th>
                            <th class="dt-head-center">{{__('reception.article')}}</th>
                            <th class="dt-head-center">{{__('reception.reference_fournisseur')}}</th>
                            <th class="dt-head-center">{{__('reception.titre_externe')}}</th>
                            <th class="dt-head-center">{{__('reception.quantite')}}</th>
                                <th class="dt-head-center" style="min-width:350px">{{__('reception.mes_livraison')}}</th>
                                <th class="dt-head-center">{{__('reception.solde_courant')}}</th>
                            <th class="dt-head-center" style="min-width:500px">{{__('reception.new_livraison')}}</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if(isset($bc_chosisi))

                           @foreach($bc_chosisi->ligne_bcs()->get() as $lignebc)
                               <tr>
                                <td>{{$lignebc->id}}</td>
                                <td>{{isset($lignebc->designation->libelle)?$lignebc->designation->libelle:(isset($lignebc->materiel->libelleMateriel)?$lignebc->materiel->libelleMateriel:'')}}</td>
                                <td>{{$lignebc->referenceFournisseur}}</td>
                                <td>{{$lignebc->titre_ext}}</td>
                                <td>{{$lignebc->quantite}} {{$lignebc->unite}}</td>
                                   <td>
                                   <?php $solde=$lignebc->quantite;?>
                                   @if(isset($bls['ligne'.$lignebc->id]))
                                        <ul>
                                                @foreach($bls['ligne'.$lignebc->id] as $res)
                                                {{__('reception.livraison')}} n°{{isset($res)?$res->numero_bl:''}} </br> {{__('reception.quantite_livre')}}: {{isset($res)?$res->quantite:0}} {{__('reception.Livre_le')}}  {{$res->date_reception}} {{__('reception.solde')}} : @if(isset($res)){{$solde-=$res->quantite}}  @endif &nbsp; &nbsp;<a href="{{route('supprimer_livraison',['id'=>$res->id,'locale'=>App()->getLocale()])}}"><i class="fa fa-trash"></i></a> </li>

                                                            @endforeach

                                           </ul>

                                   @endif
                                   </td>
                                   <td>@if(isset($res)){{$solde}} @else() {{$solde}} @endif</td>

                                       <td>{{__('reception.quantite_recu')}}: : <input type="number"  min=1 max="{{$solde}}" onkeyup="if(this.value > {{$solde}} || this.value<=0) this.value = null;" id="row_n_{{$lignebc->id}}_qte_livraison" class="_qte_livraison" name="row_n_{{$lignebc->id}}_qte_livraison" style="width:59px;"/> <input type="date" id="row_n_{{$lignebc->id}}_date_livraison" class="_date_livraison" name="row_n_{{$lignebc->id}}_date_livraison" style="width:135px;" /> Numero BL :<input type="text" id="row_n_{{$lignebc->id}}_numerobl_livraison" class="_numerobl_livraison" name="row_n_{{$lignebc->id}}_numerobl_livraison" placeholder="Numero BL" style="width:100px;" /> </td>
                               </tr>

                           @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <input type="submit" class="btn btn-success pull-right" id="soumettre1" name="soumettre1" value="{{__('translation.save')}}" />
        </div>

        </form>

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
                "ordering":false,
                "createdRow": function( row, data, dataIndex){

                },
                responsive: true,
                columnDefs: [
                    { responsivePriority: 1, targets: 0 },
                    { responsivePriority: 2, targets: -1 }
                ]
            }).column( 0 ).visible(false);
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
