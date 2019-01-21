
@extends('layouts.app')
@section('gestion_bc')
    class='active'
@endsection

@section('content')


    <h2>LISTE DES COMMANDES - N° BC : {{$bc->numBonCommande}} <a href="{{route('gestion_bc')}}" class="btn btn-default pull-right"><i class="fa fa-list" aria-hidden="true"></i> Lister</a></h2>
    <br>
    <form method="post" action="{{route('save_ligne_bc')}}">
        @csrf
        <input type="hidden" name="id_bc" value="{{$bc->id}}"/>
        <input type="hidden" name="les_id_devis" value="{{$id_devi}}"/>
        <input type="hidden" name="tot_serv" id="tot_serv" value=""/>
        <input type="hidden" name="tva_serv" id="tva_serv" value=""/>
        <input type="hidden" name="ttc_serv" id="ttc_serv" value=""/>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label class="control-label" for="date_livraison">Date de livraison:</label>
                <div>
                    <input type="date" class="form-control" id="date_livraison" name="date_livraison" placeholder="Enter un numero" value="{{isset($bc->date)?$bc->date:''}}"  {{$bc->etat!=1?'readonly':''}}  required>
                </div>
                <label>LISTE DES DATES PROPOSEES: @foreach($date_propose as $date)

                        <a  onclick="document.getElementById('date_livraison').value='{{$date}}'">  {{ "".$date}}</a>;
                    @endforeach</label>
            </div>
            </br>
            <div class="form-group">
                <label class="control-label" for="numbc">Service demandeur:</label>
                <div>
                    <select class="form-control selectpicker" id="id_service" name="id_service" data-live-search="true" data-size="6" noneSelectedText="SELECTIONNER UN SERVICE" {{$bc->etat!=1?'disabled':''}}  required >
                        <option value="">SELECTIONNER UN SERVICE</option>

                        <option {{isset($bc->service_demandeur)&&$bc->service_demandeur=="Service matériel"? "selected":''}} value="Service matériel">Service matériel</option>
                        <option  {{isset($bc->service_demandeur)&&$bc->service_demandeur=="Direction"? "selected":''}} value="Direction">Direction</option>
                        <option {{isset($bc->service_demandeur)&&$bc->service_demandeur=="Secrétariat"? "selected":''}} value="Secrétariat">Secrétariat</option>
                        <option  {{isset($bc->service_demandeur)&&$bc->service_demandeur=="Service travaux"? "selected":''}}value="Service travaux">Service travaux </option>
                        <option {{isset($bc->service_demandeur)&&$bc->service_demandeur=="Service méthodes"? "selected":''}} value="Service méthodes">Service méthodes </option>
                        <option {{isset($bc->service_demandeur)&&$bc->service_demandeur=="Service informatique"? "selected":''}} value="Service informatique">Service informatique </option>
                    </select>
                </div>
                <label>LISTE DES SERVICE PROPOSES: @foreach($service as $serve)
                        <a  onclick="document.getElementById('id_service').value='{{$serve}}';$('#id_service').selectpicker('refresh')">  {{$serve}}</a>;
                    @endforeach</label>
            </div>
        </div>
        <div class="col-sm-6 col-sm-offset-2" style="border: double; text-align: center">
            <br>
             <h1>{{$fournisseur->libelle}}</h1>
<div>

</div>
            <div>

            </div>



        </div>


    </div>

<table name ="ligneCommandes" id="ligneCommandes" class='table table-bordered table-striped  no-wrap display nowrap'>

    <thead>

    <tr>
        <th class="dt-head-center">slug</th>
        <th class="">Designation</th>
        <th class="">Code Analytique</th>
        <th class="">Quantité</th>
        <th class="">Unité</th>
        <th class="">Pu HT</th>
        <th class="">remise %</th>
        <th class="">Total  HT</th>
        <th class="">TVA /produit</th>
        <th class="">TVA</th>

    </tr>
    </thead>
    <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">

    @if(isset($devis))
    @foreach($devis as $devi )

        <tr>
            <td>{{$devi->id}}</td>
            <td>{{$devi->titre_ext}}</td>
            <td><input type="text" value="{{$devi->codeRubrique}}" id="row_n_{{$devi->id}}_codeRubrique" name="row_n_{{$devi->id}}_codeRubrique" {{$bc->etat!=1?'readonly':''}} required/></td>
            <td>{{$devi->quantite}}</td>
            <td>
                {{$devi->unite}}
            </td>
            <td>  {{$devi->prix_unitaire}}</td>
            <td>  {{$devi->remise}}</td>
            <td>  {{($THT=($devi->prix_unitaire*$devi->quantite)-(($devi->remise/100*($devi->prix_unitaire*$devi->quantite))))}}</td>
            <td> @if(1==$devi->hastva)
                    {{number_format(intval(($THT*18)/100), 0,".", " ")}}
            @else
                    {{0}}

            @endif </td>
            <td><input type="checkbox" value="1" id="row_n_{{$devi->id}}_tva" name="row_n_{{$devi->id}}_tva" class="row_n__tva" {{1==$devi->hastva?"checked":''}}/>   </td>
        </tr>
    @endforeach
        @endif
    </tbody>
    <tfooter>
        <tr> <th colspan="6" style="text-align:right" >TOTAL HORS TAXES :</th> <th id="tot"></th> </tr>
        <tr> <th colspan="6" style="text-align:right" >TVA :</th> <th id="tva"></th> </tr>
        <tr> <th colspan="6" style="text-align:right" >TOTAL TTC :</th> <th id="ttc"></th> </tr>
    </tfooter>
</table>

<div class="row">
    <div class="col-sm-1 pull-right">
        <a href="{{route('valider_commande',['id'=>$bc->slug])}}" class="btn btn-info" {{$bc->etat!=1?'disabled':''}} >VALIDER LE BON</a>

    </div>
    <div class="col-sm-1 pull-right">
        <button type="submit" class="btn btn-success" {{$bc->etat!=1?'disabled':''}} >ENREGISTRER</button>

    </div>

</div>
    </form>
<script>
    (function($) {
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

                if(count!=0 && count % 3 == 0)

                    retour = nombre[i]+' '+retour ;

                else

                    retour = nombre[i]+retour ;

                count++;

            }

            //          alert('nb : '+nbr+' => '+retour);

            return retour;

        }
        var table= $('#ligneCommandes').DataTable({
            language: {
                url: '../js/French.json'
            },
            "ordering":true,
            "responsive": false,
            "createdRow": function( row, data, dataIndex){

            },
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
                        .column( 7 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(ilisibilite_nombre(a)) + intVal(ilisibilite_nombre(b));
                        }, 0 );

                // Total over this page
                pageTotal = api
                        .column( 7, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(ilisibilite_nombre(a)) + intVal(ilisibilite_nombre(b));
                        }, 0 );
                // Total tva
                TTva = api
                        .column( 8, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(ilisibilite_nombre(a)) + intVal(ilisibilite_nombre(b));
                        }, 0 );

                // Update footer
                $( api.column( 7 ).footer() ).html(
                        '$'+pageTotal +' ( $'+ total +' total)'
                );
               $('#tot').html(lisibilite_nombre(Math.round(pageTotal))+" {{$devise}}");
               $('#tot_serv').val(Math.round(pageTotal));
               $('#tva').html(lisibilite_nombre(TTva)+" {{$devise}}");
               $('#tva_serv').val(Math.round(TTva));
               $('#ttc').html(lisibilite_nombre(Math.round(pageTotal*1.18)) +" {{$devise}}");
               $('#ttc_serv').val(Math.round(pageTotal*1.18));
            },
            responsive: true,
            columnDefs: [
                { responsivePriority: 5, targets: 0 },
                { responsivePriority: 2, targets: -2 }
            ]
        }).column(0).visible(false);
        $('.row_n__tva').click(function (e) {




            var tot_serv=$('#tot_serv').val();
            var tva_serv=$('#tva_serv').val(Math.round(TTva));
            var ttc_serv=$('#ttc_serv').val(Math.round(pageTotal*1.18));
            var val_init=0;

            if($(this).prop('checked') == true){
                $(this).closest('td').prev().html(lisibilite_nombre(($(this).closest('td').prev().prev().html()*18)/100));
            }
            else {
                $(this).parent().css('border-color', 'red');
                val_init=$(this).closest('td').prev().html(0);
                $(this).closest('td').prev().html(0);
            }

            var valeur= $('#tva_serv').val()-val_init

            $('#tva_serv').val(Math.round(valeur));
            $('#ttc').html(lisibilite_nombre(Math.round(pageTotal*1.18)) +" {{$devise}}");
            $('#ttc_serv').val(Math.round(pageTotal*1.18));
        })
    })(jQuery);
</script>
@endsection