
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
                <label>LISTE DES DATES PROPOSEES: @foreach($devis as $devi)
                        <a  onclick="document.getElementById('date_livraison').value='{{$devi->DateBesoin}}'">  {{ "".$devi->DateBesoin}}</a>;
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
                <label>LISTE DES SERVICE PROPOSES: @foreach($devis as $devi)
                        <a  onclick="document.getElementById('id_service').value='{{$devi->service}}';$('#id_service').selectpicker('refresh')">  {{$devi->service}}</a>;
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

<table name ="ligneCommandes" id="ligneCommandes" class='table table-bordered table-striped  no-wrap '>

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
            <td>  {{($devi->prix_unitaire*$devi->quantite)-($devi->remise*($devi->prix_unitaire*$devi->quantite))/100}}</td>

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
    <div class=" pull-right">
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
            "responsive": true,
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

                // Update footer
                $( api.column( 7 ).footer() ).html(
                        '$'+pageTotal +' ( $'+ total +' total)'
                );
               $('#tot').html(lisibilite_nombre(Math.round(pageTotal))+" {{$devise}}");
               $('#tot_serv').val(Math.round(pageTotal));
               $('#tva').html(lisibilite_nombre(Math.round((pageTotal*18)/100))+" {{$devise}}");
               $('#tva_serv').val(Math.round((pageTotal*18)/100));
               $('#ttc').html(lisibilite_nombre(Math.round(pageTotal*1.18)) +" {{$devise}}");
               $('#ttc_serv').val(Math.round(pageTotal*1.18));
            }
        }).column(0).visible(false);
    })(jQuery);
</script>
@endsection