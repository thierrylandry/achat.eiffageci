
@extends('layouts.app')
@section('gestion_bc')
    class='active'
@endsection

@section('content')
<script> function validate(form) {

        // validation code here ...


        if(!valid) {
            alert('SVP choisissez obligatoirement une date de livraison et un service demandeur!');
            return false;
        }
        else {
            return confirm('{{__('translation.confirmation')}}');
        }
    }</script>

    <h2>{{__('reception.list_commande')}} - {{__('neutrale.numero_bc')}} : {{$bc->numBonCommande}} </h2>
    <br>
    <form method="post" action="{{route('save_ligne_bc')}}" onsubmit="return confirm('{{__('translation.confirmation')}}');">
        @csrf
        <input type="hidden" name="id_bc" id="id_bc" value="{{$bc->id}}"/>
        <input type="hidden" name="les_id_devis" value="{{$id_devi}}"/>
        <input type="hidden" name="tot_serv" id="tot_serv" value=""/>
        <input type="hidden" name="tva_serv" id="tva_serv" value=""/>
        <input type="hidden" name="ttc_serv" id="ttc_serv" value=""/>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label class="control-label" for="date_livraison">{{__('neutrale.date_livraison')}}:</label>
                <div>
                    <input type="date" class="form-control" id="date_livraison" name="date_livraison" placeholder="Enter un numero" value="{{isset($bc->date)?$bc->date:''}}"  {{$bc->etat!=1?'readonly':''}}  required>
                </div>
                <label>{{__('translation.liste')}}: @foreach($date_propose as $date)

                        <a  onclick="document.getElementById('date_livraison').value='{{$date}}'">  {{ "".$date}}</a>;
                    @endforeach</label>
            </div>
            </br>
            <div class="form-group">
                <label class="control-label" for="numbc">{{__('translation.service')}}:</label>
                <div>
                    <select class="form-control selectpicker" id="id_service" name="id_service" data-live-search="true" data-size="6" noneSelectedText="{{__('neutrale.selectionner_service')}}" {{$bc->etat!=1?'disabled':''}}  required >
                        <option value="">{{__('neutrale.selectionner_service')}}</option>
                        @foreach($services as $service)
                            <option {{isset($bc)&& $bc->service_demandeur==$service->id? "selected":''}} value="{{$service->id}}">{{$service->libelle}}</option>
                        @endforeach
                    </select>
                </div>
                <label>{{__('translation.liste')}}: @for($i=0;$i<count($service_id);$i++)
                        <a  onclick="document.getElementById('id_service').value='{{$service_id[$i]}}';$('#id_service').selectpicker('refresh')">  {{$service_libelle[$i]}}</a>;
                    @endfor</label>
            </div>
        </div>
        <div class="col-sm-4 col-sm-offset-3" style="border: double; text-align: center; vertical-align: center; padding: 12px">

             <h1>{{$fournisseur->libelle}} ({{$bc->devise_bc}})</h1>

            <input type="hidden" name='locale' value="{{App()->getLocale()}}"/>


        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div class="col-sm-6 col-sm-offset-2">
            <label for="commentaire">{{__('neutrale.commentaire_general')}} </label><br>
            <br>
            <textarea id="commentaire" name="commentaire" class="form-control col-sm-8" style="height: 100px" maxlength="1000">{{isset($bc)? $bc->commentaire_general:''}}</textarea>
        </div>

    </div>
        <br> <br>
        @if($bc->etat<4)
        <div class="alert alert-warning ">
            <span class="alert-icon"><i class="fa fa-bell-o"></i></span>
            <div class="notification-info">
                <ul class="clearfix notification-meta">
                    <li class="pull-left notification-sender">{{ __('cotation.vous_avez') }}  <b style="font-size: 24px">{{sizeof($new_devis)}}</b>   {{ __('cotation.demande_recente') }}  <button type="button" onclick="myFunction()"> détail</button></li>

                </ul>
                <p>
                    ...
                </p>
                <div id="myDIV" style="display:none">
                <table name ="ligneCommandes_a_ajouter" id="ligneCommandes_a_ajouter" class='table table-bordered table-striped  no-wrap display nowrap'>

                    <thead>

                    <tr>
                        <th class="dt-head-center">slug</th>
                        <th class="dt-head-center">{{__('reception.article')}} ({{__('reception.reference_fournisseur')}})</th>
                        <th class="dt-head-center">{{__('reception.commentaire')}}</th>
                        <th class="dt-head-center">{{__('reception.quantite')}}</th>
                        <th class="dt-head-center">{{__('gestion_stock.unite')}}</th>
                        <th class="dt-head-center">{{__('neutrale.pu')}}</th>
                        <th class="dt-head-center">{{__('neutrale.remise')}}</th>
                        <th class="">{{__('neutrale.totlal_ht')}}</th>
                        <th class="">{{__('neutrale.tva')}} /{{__('reception.article')}}</th>
                        <th class="">{{__('gestion_stock.action')}}</th>

                    </tr>
                    </thead>
                    <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">

                    @if(isset($new_devis))
                        @foreach($new_devis as $new_devi )

                            <tr>
                                <td>{{$new_devi->id}}</td>
                                <td>{{$new_devi->titre_ext}} {{isset($devi->referenceFournisseur)?"(".$devi->referenceFournisseur.")":""}}</td>
                                <td>{{$new_devi->commentaire}}</td>
                                <td>{{$new_devi->quantite}}</td>
                                <td>
                                    {{$new_devi->unite}}
                                </td>
                                <td style="text-align: right"> @if($new_devi->devise =="XOF") {{$new_devi->prix_unitaire}}  @elseif($new_devi->devise =="EUR") {{$new_devi->prix_unitaire_euro}} @elseif($new_devi->devise =="USD") {{$new_devi->prix_unitaire_usd}}  @endif </td>
                                <td>  {{$new_devi->remise}}</td>
                                <td style="text-align: right">@if($new_devi->devise =="XOF") {{($THT=($new_devi->prix_unitaire*$new_devi->quantite)-(($new_devi->remise/100*($new_devi->prix_unitaire*$new_devi->quantite))))}}  @elseif($new_devi->devise =="EUR") {{($THT=($new_devi->prix_unitaire_euro*$new_devi->quantite)-(($new_devi->remise/100*($new_devi->prix_unitaire_euro*$new_devi->quantite))))}} @elseif($new_devi->devise =="USD") {{($THT=($new_devi->prix_unitaire_usd*$new_devi->quantite)-(($new_devi->remise/100*($new_devi->prix_unitaire_usd*$new_devi->quantite))))}} @endif</td>
                                <td > @if(1==$new_devi->hastva)
                                        {{number_format(floatval(($THT*$bc->projet->use_tva)/100), 2,".", " ")}}
                                    @else
                                        {{0}}

                                    @endif </td>
                            <td><button type="button" class="btn_addbc">Ajouter</button></td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            </div>
        </div>
        @endif
        <br>
        <br>
<table name ="ligneCommandes" id="ligneCommandes" class=''>

    <thead>

    <tr>
        <th class="dt-head-center">slug</th>
        <th class="dt-head-center">{{__('reception.article')}} ({{__('reception.reference_fournisseur')}})</th>
        <th class="dt-head-center">{{__('reception.commentaire')}}</th>
        <th class="dt-head-center">{{__('neutrale.code_gestion')}}</th>
        <th class="dt-head-center">{{__('reception.quantite')}}</th>
        <th class="dt-head-center">{{__('gestion_stock.unite')}}</th>
        <th class="dt-head-center">{{__('neutrale.pu')}}</th>
        <th class="dt-head-center">{{__('neutrale.remise')}}</th>
        <th class="">{{__('neutrale.totlal_ht')}}</th>
        <th class="">{{__('neutrale.tva')}} /{{__('reception.article')}}</th>
        <th class="">{{__('neutrale.tva')}}</th>
        <th class="">statit tva</th>
        <th class="">{{__('gestion_stock.action')}}</th>
    </tr>
    </thead>
    <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">
    @if($bc->ligne_bcs()->get() !== null)
    @foreach($bc->ligne_bcs()->get() as $devi )

        <tr>
            <td>{{$devi->id}}</td>
            <td>{{$devi->titre_ext}} {{isset($devi->referenceFournisseur)?"(".$devi->referenceFournisseur.")":""}}</td>
            <td>{{$devi->commentaire}}</td>
            <td><select class="form-control selectpicker" id="row_n_{{$devi->id}}_codeGestion" name="row_n_{{$devi->id}}_codeGestion" data-live-search="true" data-size="6" required>
                    <option  value="">{{__('neutrale.selectionner')}}</option>
                    @foreach($gestions as $gestion)

                        <option @if(isset($devi->codeGestion) && $gestion->codeGestion==$devi->codeGestion)
                                {{'selected'}}
                                @endif value="{{$gestion->codeGestion}}" data-subtext="{{$gestion->codeGestion}}">{{$gestion->codeGestion}}</option>
                    @endforeach
                </select></td>
            <td>{{$devi->quantite}}</td>
            <td>
                {{$devi->unite}}
            </td>
            <td style="text-align: right">@if($devi->devise =="XOF") {{number_format($devi->prix_unitaire, 0,".", " ")}}  @elseif($devi->devise =="EUR") {{number_format($devi->prix_unitaire_euro, 2,".", " ")}} @elseif($devi->devise =="USD") {{number_format($devi->prix_unitaire_usd, 2,".", " ")}}  @endif </td>
            <td>  {{$devi->remise}}</td>
            <td style="text-align: right">  @if($devi->devise =="XOF") {{number_format($THT=($devi->prix_unitaire*$devi->quantite)-(($devi->remise/100*($devi->prix_unitaire*$devi->quantite))),2,"."," ")}}  @elseif($devi->devise =="EUR") {{number_format($THT=($devi->prix_unitaire_euro*$devi->quantite)-(($devi->remise/100*($devi->prix_unitaire_euro*$devi->quantite))),2,"."," ")}} @elseif($devi->devise =="USD") {{number_format($THT=($devi->prix_unitaire_usd*$devi->quantite)-(($devi->remise/100*($devi->prix_unitaire_usd*$devi->quantite))),2,"."," ")}}  @endif</td>
            <td> @if(1==$devi->hastva && $bc->projet->use_tva!=null || $bc->projet->use_tva!="")
                    {{number_format(floatval(($THT*$bc->projet->use_tva)/100), 2,".", " ")}}
            @else
                    {{0}}

            @endif </td>
            <td><input type="checkbox" id="row_n_{{$devi->id}}_tva" name="row_n_{{$devi->id}}_tva" class="row_n__tva" {{1==$devi->hastva?"checked='checked'":""}}/>   </td>
        <td>{{$devi->hastva}}</td>
            <td><div class="row"><div class="col-sm-6"><button type="button" class="btn_retirerbc">{{__('neutrale.retirer')}}</button></div><div class="col-sm-6"><button type="button" class="btn_supp btn btn-danger"><i class="fa fa-trash"></i></button></div></div></td>
        </tr>
    @endforeach
        @endif
    </tbody>
    <tfooter>
        <tr> <th colspan="7" style="text-align:right" >{{__('neutrale.remse_excep')}} -:</th> <th  style="text-align: right"><input type="number" id="remise_exc" name="remise_exc" style="width: 100px" value="{{isset($bc->remise_excep)?$bc->remise_excep:0}}" min="0"/> </th> </tr>
        <tr> <th colspan="7" style="text-align:right" >{{__('neutrale.total_hors_taxes')}} :</th> <th id="tot" style="text-align: right"></th> </tr>
        <tr> <th colspan="7" style="text-align:right" >{{__('neutrale.tva')}} :</th> <th id="tva" style="text-align: right"></th> </tr>
      <tr> <th colspan="7" style="text-align:right" >{{__('neutrale.total_ttc')}} :</th> <th id="ttc" style="text-align: right"></th> </tr>
    </tfooter>
</table>

<div class="row"  style="width: 90%">
    <div class="col-sm-1 pull-right">
        <a href="{{route('valider_commande',['locale'=>app()->getLocale(),'id'=>$bc->slug])}}" class="btn btn-info" {{$bc->etat!=1?'disabled':''}} onclick="">{{strtoupper(__('neutrale.valider_bon'))}}</a>

    </div>
    <div class="col-sm-1 pull-right">

    </div>
    <div class="col-sm-1 pull-right">
        <button type="submit" onclick="" class="btn btn-success" {{$bc->etat!=1?'disabled':''}} >{{__('neutrale.mettre_memoire')}}</button>

    </div>

</div>
    </form>
<script>

    function myFunction() {
        var x = document.getElementById("myDIV");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
    (function($) {

        $(".btn_addbc").click(function (){
            var data = table1.row($(this).parents('tr')).data();

var id_bc= $("#id_bc").val();

            $.get("../add_new_da_to_bc/"+data[0]+"/"+id_bc, function(data, status){
             //   alert(data);
                window.location.reload()
            });

        });
        $(".btn_retirerbc").click(function (){
            var data = table.row($(this).parents('tr')).data();
            var id_bc= $("#id_bc").val();
            $.get("../retirer_da_to_bc/"+data[0]+"/"+id_bc, function(data, status){
                console.log(data);
               window.location.reload()
            });
        });
        $(".btn_supp").click(function (){
            var data = table.row($(this).parents('tr')).data();
            var id_bc= $("#id_bc").val();
            if(confirm("Voulez vous supprimer définitivement cette ligne?")){
                $.get("../supprimer_def_da_to_bc/"+data[0]+"/"+id_bc, function(data, status){
                    console.log(data);
                    window.location.reload()
                });

            }

        });
        function ilisibilite_nombre(valeur){

            for(var i=valeur.length-1; i>=0; i-- ){valeur=valeur.toString().replace(' ','');

            }

            return valeur;

        }
        function lisibilite_nombre(nbr)

        {

            var nombre = ''+nbr;

            var retour = '';

            var count=0;

            for(var i=nombre.length-1 ; i>=0 ; i--)

            {

                if(count!=0 && count % 3 == 0 && nombre[i+1]!='.')

                    retour = nombre[i]+' '+retour ;

                else

                    retour = nombre[i]+retour ;

                count++;

            }

            //          alert('nb : '+nbr+' => '+retour);

            return retour;

        }
        var table1= $('#ligneCommandes_a_ajouter').DataTable({
            language: {
                @if(App()->getLocale()=='fr')
                url: "../../public/js/French.json"
                @elseif(App()->getLocale()=='en')
                url: "../../public/js/English.json"
                @endif
            },
            "ordering":true,
            "createdRow": function( row, data, dataIndex){

            },
            "paging": false,
            columnDefs: [
                { responsivePriority: 5, targets: 0 },
                { responsivePriority: 2, targets: -2 },
                { "type": "numeric-comma", targets: 6 }
            ]
        }).column(0).visible(false);

        var table= $('#ligneCommandes').DataTable({
            language: {
                @if(App()->getLocale()=='fr')
                url: "../../public/js/French.json"
                @elseif(App()->getLocale()=='en')
                url: "../../public/js/English.json"
                @endif
            },
            "ordering":true,
            "paging": false,

            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;

                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                    i : 0;
                };

                // Total over all pages
                total = api
                        .column( 8 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(ilisibilite_nombre(a)) + intVal(ilisibilite_nombre(b));
                        }, 0 );

                // Total over this page
                pageTotal = api
                        .column( 8, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(ilisibilite_nombre(a)) + intVal(ilisibilite_nombre(b));
                        }, 0 );
                // Total tva
                TTva = api
                        .column( 9, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(ilisibilite_nombre(a)) + intVal(ilisibilite_nombre(b));
                        }, 0 );

                // Update footer
                $( api.column( 8 ).footer() ).html(
                        '$'+pageTotal +' ( $'+ total +' total)'
                );
                remise_exc =$('#remise_exc').val();
                $('#tot').html(lisibilite_nombre(Math.round(pageTotal-remise_exc))+" {{$devise}}");
                $('#tot_serv').val(Math.round(pageTotal-remise_exc));
                @if($bc->projet->use_tva!="")
                    $('#tva').html(lisibilite_nombre(Math.round(TTva-remise_exc*{{$bc->projet->use_tva/100}}))+" {{$devise}}");
                    $('#tva_serv').val(Math.round(TTva-remise_exc*{{$bc->projet->use_tva/100}}));
                    $('#ttc').html(lisibilite_nombre(Math.round(pageTotal)+Math.round(TTva-remise_exc*{{$bc->projet->use_tva/100}}) - remise_exc) +" {{$devise}}");
                    $('#ttc_serv').val(Math.round(pageTotal)+Math.round(TTva-remise_exc*{{$bc->projet->use_tva/100}})-Math.round(remise_exc));
                @else
                    $('#tva').html(lisibilite_nombre(Math.round(TTva-remise_exc*0))+" {{$devise}}");
                    $('#tva_serv').val(Math.round(TTva-remise_exc*0));
                    $('#ttc').html(lisibilite_nombre(Math.round(pageTotal)+Math.round(TTva-remise_exc*0) - remise_exc) +" {{$devise}}");
                    $('#ttc_serv').val(Math.round(pageTotal)+Math.round(TTva-remise_exc*0)-Math.round(remise_exc));
                @endif

            },
            responsive: true,
            columnDefs: [
                { type: 'formatted-num', targets: 6 },
                { type: 'formatted-num', targets: 8 },
                { type: 'formatted-num', targets: 9 },
                { responsivePriority: 2, targets: -2 }
            ]
        }).column(0).visible(false).column(11).visible(false);

        $('.row_n__tva').click(function (e) {

           // $(this).closest('td').next().next().html(1);
            var tva=0;
            var data = table.row($(this).parents('tr')).data();
            var num_row=$(this).parents('tr');
            @if($bc->projet->use_tva!="")
            var tva_prod=ilisibilite_nombre(parseFloat(ilisibilite_nombre($(this).closest('td').prev().prev().html())).toFixed(2)*{{$bc->projet->use_tva/100}});
            @else
            var tva_prod=ilisibilite_nombre(parseFloat(ilisibilite_nombre($(this).closest('td').prev().prev().html())).toFixed(2)*0)/100;
            @endif

         var   remise_exc =$('#remise_exc').val();
            if($(this).prop('checked') ){


                $(this).closest('td').prev().html(lisibilite_nombre(tva_prod.toFixed(2)));
                data[9] = tva_prod.toFixed(2);
                data[10] = 1;

            }
            else {


                data[10] = 0;
               // var valeur=Math.round(ilisibilite_nombre(data[8])+Math.round(tva_prod));
                data[9]=0;
                $(this).closest('td').prev().html(0);





            }

            var data = table.rows().data();
            var sumtva=0;
            data.each(function (value, index) {
//alert(value[8]);

                    sumtva+=Math.round(ilisibilite_nombre(value[9]));


            });
            @if($bc->projet->use_tva!="")
            sumtva=sumtva-remise_exc*{{$bc->projet->use_tva/100}};
            @else
            sumtva=sumtva-remise_exc*0;
            @endif

            $('#tva').empty();
            $('#tva').html(lisibilite_nombre(sumtva)+" {{$devise}}");
            $('#tva_serv').val(Math.round(sumtva));
            var remise_exc =$('#remise_exc').val();
            var ttc=Math.round(sumtva+Math.round($('#tot_serv').val()) - remise_exc );
            $('#ttc').empty();
            $('#ttc').html(lisibilite_nombre(ttc) +" {{$devise}}");
            $('#ttc_serv').val(Math.round(ttc));

        })

        $("#remise_exc").change(function (e){
            remise_exc =$('#remise_exc').val();
            $('#tot').html(lisibilite_nombre(Math.round(pageTotal-remise_exc))+" {{$devise}}");
            $('#tot_serv').val(Math.round(pageTotal-remise_exc));
            @if($bc->projet->use_tva!="")
            $('#tva').html(lisibilite_nombre(Math.round(TTva-remise_exc*{{$bc->projet->use_tva/100}}))+" {{$devise}}");
            $('#tva_serv').val(Math.round(TTva-remise_exc*{{$bc->projet->use_tva/100}}));
            $('#ttc').html(lisibilite_nombre(Math.round(pageTotal)+Math.round(TTva-remise_exc*{{$bc->projet->use_tva/100}}) - remise_exc) +" {{$devise}}");
            $('#ttc_serv').val(Math.round(pageTotal)+Math.round(TTva-remise_exc*{{$bc->projet->use_tva/100}})-Math.round(remise_exc));
            @else
            $('#tva').html(lisibilite_nombre(Math.round(TTva-remise_exc*0))+" {{$devise}}");
            $('#tva_serv').val(Math.round(TTva-remise_exc*0));
            $('#ttc').html(lisibilite_nombre(Math.round(pageTotal)+Math.round(TTva-remise_exc*0) - remise_exc) +" {{$devise}}");
            $('#ttc_serv').val(Math.round(pageTotal)+Math.round(TTva-remise_exc*0)-Math.round(remise_exc));
            @endif
        });

    })(jQuery);
</script>
@endsection
