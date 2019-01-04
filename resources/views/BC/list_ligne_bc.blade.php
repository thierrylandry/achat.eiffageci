


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
            <td><input type="text" value="{{$devi->codeRubrique}}" id="row_n_{{$devi->id}}_codeRubrique" name="row_n_{{$devi->id}}_codeRubrique"/></td>
            <td>{{$devi->quantite}}</td>
            <td>
                {{$devi->unite}}
            </td>
            <td>  {{$devi->prix_unitaire}}</td>
            <td>  {{$devi->remise}}</td>
            <td>  {{$devi->prix_tot}}</td>

        </tr>
    @endforeach
        @endif
    </tbody>
    <tfooter>
        <tr> <th colspan="6" style="text-align:right" >Total:</th> <th id="tot"></th> </tr>
    </tfooter>
</table>



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
               $('#tot').html(lisibilite_nombre(pageTotal));
            }
        }).column(0).visible(false);
    })(jQuery);
</script>