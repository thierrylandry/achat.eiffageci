
@extends('layouts.app')
@section('bcexpress')
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
                return confirm('Voulez vous enregistrer??');
            }
        }</script>

    <h2>LISTE DES COMMANDES  <a href="" class="btn btn-info pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Retour</a></h2>
    <br>
    <form method="post" action="{{route('save_ligne_bc')}}" onsubmit="return confirm('Voulez vous enregistrer?');">
        @csrf
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="control-label" for="date_livraison">Date de livraison:</label>
                    <div>
                        <input type="date" class="form-control" id="date_livraison" name="date_livraison" placeholder="Enter un numero" value="{{isset($bc->date)?$bc->date:''}}"  required>
                    </div>
                    <label>LISTE DES DATES PROPOSEES: </label>
                </div>
                </br>
                <div class="form-group">
                    <label class="control-label" for="numbc">Service demandeur:</label>
                    <div>
                        <select class="form-control selectpicker" id="id_service" name="id_service" data-live-search="true" data-size="6" noneSelectedText="SELECTIONNER UN SERVICE"   required >
                            <option value="">SELECTIONNER UN SERVICE</option>

                            <option {{isset($bc->service_demandeur)&&$bc->service_demandeur=="Service materiel"? "selected":''}} value="Service materiel">Service matériel</option>
                            <option  {{isset($bc->service_demandeur)&&$bc->service_demandeur=="Direction"? "selected":''}} value="Direction">Direction</option>
                            <option {{isset($bc->service_demandeur)&&$bc->service_demandeur=="Secretariat"? "selected":''}} value="Secretariat">Secrétariat</option>
                            <option  {{isset($bc->service_demandeur)&&$bc->service_demandeur=="Service travaux"? "selected":''}}value="Service travaux">Service travaux </option>
                            <option {{isset($bc->service_demandeur)&&$bc->service_demandeur=="Service methodes"? "selected":''}} value="Service methodes">Service méthodes </option>
                            <option {{isset($bc->service_demandeur)&&$bc->service_demandeur=="Service informatique"? "selected":''}} value="Service informatique">Service informatique </option>
                        </select>
                    </div>
                    <label>LISTE DES SERVICE PROPOSES: </label>
                </div>
            </div>
            <div class="col-sm-6 col-sm-offset-2" style="border: double; text-align: center; vertical-align: center; padding: 12px">
                <br>
                <h1>{{$fournisseur->libelle}}</h1>
                <div>

                </div>
                <div>

                </div>



            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <div class="col-sm-6 col-sm-offset-2">
                <label for="commentaire">Commentaire général </label><br>
                <br>
                <textarea id="commentaire" name="commentaire" readonly class="form-control col-sm-8" style="height: 100px" maxlength="70">REGULARISATION</textarea>
            </div>

        </div>
        <br>
        <br>
        <br>
        <div class="">


                    <table name ="ligneCommandes" id="ligneCommandes" class='table table-bordered table-striped  no-wrap display nowrap'>

                        <thead>

                        <tr>
                            <th class="dt-head-center">slug</th>
                            <th class="">Designation</th>
                            <th class="">Code gestion</th>
                            <th class="" >QTE</th>
                            <th class="">Unité</th>
                            <th class="">Pu HT</th>
                            <th class="">remise %</th>
                            <th class="">Total  HT</th>
                            <th class="">TVA /produit</th>
                            <th class="">TVA</th>
                            <th class="">statit tva</th>
                            <th class="">Action</th>
                        </tr>
                        </thead>
                        <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">
                        @if(isset($ligne_bonlivraisons))
                            @foreach($ligne_bonlivraisons as $ligne )

                                <tr>
                                    <td>{{$ligne->id}}</td>
                                    <td>{{$ligne->reference}}</td>
                                    <td><select class="form-control selectpicker" id="row_n_{{$ligne->id}}_codeGestion" name="row_n_{{$ligne->id}}_codeGestion" data-live-search="true" data-size="6" required>
                                            <option  value="">SELECTIONNER</option>
                                            @foreach($gestions as $gestion)

                                                <option @if(isset($devi->codeGestion) && $gestion->codeGestion==$devi->codeGestion)
                                                        {{'selected'}}
                                                        @endif value="{{$gestion->codeGestion}}" data-subtext="{{$gestion->codeGestion}}">{{$gestion->codeGestion}}</option>
                                            @endforeach
                                        </select></td>
                                    <td>{{$ligne->quantite}}</td>
                                    <td>
                                        {{$ligne->unite}}
                                    </td>
                                    <td style="text-align: right"> {{number_format($ligne->prix_unitaire, 2,".", " ")}}</td>
                                    <td> <input class="form-control row_n_remise"  type="number" min="0" id="row_n_{{$ligne->id}}_remise" name="row_n_{{$ligne->id}}_remise" value="0" value="" /> </td>
                                    <td style="text-align: right">  {{number_format($THT=($ligne->prix_unitaire*$ligne->quantite)-(($ligne->remise/100*($ligne->prix_unitaire*$ligne->quantite))),2,"."," ")}}</td>
                                    <td> @if(1==$ligne->hastva)
                                            {{number_format(floatval(($THT*18)/100), 2,".", " ")}}
                                        @else
                                            {{0}}

                                        @endif </td>
                                    <td><input type="checkbox" id="row_n_{{$ligne->id}}_tva" name="row_n_{{$ligne->id}}_tva" class="row_n__tva" {{1==$ligne->hastva?"checked='checked'":""}}/>   </td>
                                    <td>{{$ligne->hastva}}</td>
                                    <td><div class="row"><div class="col-sm-6"><button type="button" class="btn_retirerbc">Retirer</button></div><div class="col-sm-6"><button type="button" class="btn_supp btn btn-danger"><i class="fa fa-trash"></i></button></div></div></td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                        <tfooter>
                            <tr> <th colspan="6" style="text-align:right" >REMISE EXCEP -:</th> <th  style="text-align: right"><input type="number" id="remise_exc" name="remise_exc" style="width: 100px" value="{{isset($ligne->remise_excep)?$ligne->remise_excep:0}}" min="0"/> </th> </tr>
                            <tr> <th colspan="6" style="text-align:right" >TOTAL HORS TAXES :</th> <th id="tot" style="text-align: right"></th> </tr>
                            <tr> <th colspan="6" style="text-align:right" >TVA :</th> <th id="tva" style="text-align: right"></th> </tr>
                            <tr> <th colspan="6" style="text-align:right" >TOTAL TTC :</th> <th id="ttc" style="text-align: right"></th> </tr>
                        </tfooter>
                    </table>

        </div>
        <div class="row"  style="width: 90%">
            <div class="col-sm-1 pull-right">

            </div>
            <div class="col-sm-1 pull-right">
                <button type="submit" onclick="" class="btn btn-success"  >METTRE EN MEMOIRE</button>

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

                    if(count!=0 && count % 3 == 0 && nombre[i+1]!='.')

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
                    remise_exc =$('#remise_exc').val();
                    $('#tot').html(lisibilite_nombre(Math.round(pageTotal-remise_exc))+" {{$devise}}");
                    $('#tot_serv').val(Math.round(pageTotal-remise_exc));
                    $('#tva').html(lisibilite_nombre(Math.round(TTva-remise_exc*0.18))+" {{$devise}}");
                    $('#tva_serv').val(Math.round(TTva-remise_exc*0.18));
                    $('#ttc').html(lisibilite_nombre(Math.round(pageTotal)+Math.round(TTva-remise_exc*0.18) - remise_exc) +" {{$devise}}");
                    $('#ttc_serv').val(Math.round(pageTotal)+Math.round(TTva-remise_exc*0.18)-Math.round(remise_exc));
                },
                responsive: true,
                columnDefs: [
                    { type: 'formatted-num', targets: 6 },
                    { type: 'formatted-num', targets: 8 },
                    { type: 'formatted-num', targets: 9 },
                    { responsivePriority: 2, targets: -2 }
                ]
            }).column(0).visible(false).column(10).visible(false);

            $('.row_n__tva').click(function (e) {

                // $(this).closest('td').next().next().html(1);
                var tva=0;
                var data = table.row($(this).parents('tr')).data();
                var num_row=$(this).parents('tr');
                var tva_prod=ilisibilite_nombre(parseFloat(ilisibilite_nombre($(this).closest('td').prev().prev().html())).toFixed(2)*18)/100;
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
                sumtva=sumtva-remise_exc*0.18;

                $('#tva').empty();
                $('#tva').html(lisibilite_nombre(sumtva)+" {{$devise}}");
                $('#tva_serv').val(Math.round(sumtva));
                var remise_exc =$('#remise_exc').val();
                var ttc=Math.round(sumtva+Math.round($('#tot_serv').val()) - remise_exc );
                $('#ttc').empty();
                $('#ttc').html(lisibilite_nombre(ttc) +" {{$devise}}");
                $('#ttc_serv').val(Math.round(ttc));

            }) ;
            $('.row_n_remise').change(function (e) {

                // $(this).closest('td').next().next().html(1);
                var tva=0;
                var data = table.row($(this).parents('tr')).data();
                console.log($(this).closest('td').prev().prev().html());
                var num_row=$(this).parents('tr');
                var tht=ilisibilite_nombre(parseFloat(ilisibilite_nombre($(this).closest('td').prev().prev().html())).toFixed(2)*18)/100;
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
                sumtva=sumtva-remise_exc*0.18;

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
                $('#tva').html(lisibilite_nombre(Math.round(TTva-remise_exc*0.18))+" {{$devise}}");
                $('#tva_serv').val(Math.round(TTva-remise_exc*0.18));
                $('#ttc').html(lisibilite_nombre(Math.round(pageTotal)+Math.round(TTva-remise_exc*0.18) - remise_exc) +" {{$devise}}");
                $('#ttc_serv').val(Math.round(pageTotal)+Math.round(TTva-remise_exc*0.18)-Math.round(remise_exc));
            });

        })(jQuery);
    </script>
@endsection