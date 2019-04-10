
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

    <h2>LISTE DES COMMANDES - N° BC: PHB-815140-<input name="numbc" id="numbc" WIDTH="30%"  type="text"/> <a href="{{route('gestion_bc')}}" class="btn btn-default pull-right"><i class="fa fa-list" aria-hidden="true"></i> Lister</a></h2>
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
            <div class="col-sm-6 col-sm-offset-2" style="border: double; text-align: center">
                <br>
                <h1><select></select></h1>
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
                <textarea id="commentaire" name="commentaire" class="form-control col-sm-8" style="height: 100px" maxlength="70">{{isset($bc)? $bc->commentaire_general:''}}</textarea>
            </div>

        </div>
        <br>
        <br>
        <br>
        <button id="addRow" type="button">Ajouter ligne</button>
        <table name ="ligneCommandes" id="ligneCommandes" class=''>

            <thead>

            <tr>
                <th class="dt-head-center">slug</th>
                <th class="">Designation</th>
                <th class="">Commentaire</th>
                <th class="">Code Analytique</th>
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

            @if(isset($devis))
                @foreach($devis as $devi )

                    <tr>
                        <td>{{$devi->id}}</td>
                        <td>{{$devi->titre_ext}}</td>
                        <td>{{$devi->commentaire}}</td>
                        <td><select class="form-control selectpicker" id="row_n_{{$devi->id}}_codeRubrique" name="row_n_{{$devi->id}}_codeRubrique" data-live-search="true" data-size="6" required>
                                <option  value="">SELECTIONNER</option>
                                @foreach($analytiques as $analytique)

                                    <option @if(isset($devi) && $analytique->codeRubrique==$devi->codeRubrique)
                                            {{'selected'}}
                                            @endif value="{{$analytique->codeRubrique}}" data-subtext="{{$analytique->libelle}}">{{$analytique->codeRubrique}}</option>
                                @endforeach
                            </select></td>
                        <td>{{$devi->quantite}}</td>
                        <td>
                            {{$devi->unite}}
                        </td>
                        <td style="text-align: right">  {{$devi->prix_unitaire}}</td>
                        <td>  {{$devi->remise}}</td>
                        <td style="text-align: right">  {{($THT=($devi->prix_unitaire*$devi->quantite)-(($devi->remise/100*($devi->prix_unitaire*$devi->quantite))))}}</td>
                        <td> @if(1==$devi->hastva)
                                {{number_format(intval(($THT*18)/100), 0,".", " ")}}
                            @else
                                {{0}}

                            @endif </td>
                        <td><input type="checkbox" id="row_n_{{$devi->id}}_tva" name="row_n_{{$devi->id}}_tva" class="row_n__tva" {{1==$devi->hastva?"checked='checked'":""}}/>   </td>
                        <td>{{$devi->hastva}}</td>
                        <td><button type="button" class="btn_retirerbc">Retirer</button></td>
                    </tr>
                @endforeach
            @endif
            </tbody>
            <tfooter>
                <tr> <th colspan="7" style="text-align:right" >TOTAL HORS TAXES :</th> <th id="tot" style="text-align: right"></th> </tr>
                <tr> <th colspan="7" style="text-align:right" >TVA :</th> <th id="tva" style="text-align: right"></th> </tr>
                <tr> <th colspan="7" style="text-align:right" >TOTAL TTC :</th> <th id="ttc" style="text-align: right"></th> </tr>
            </tfooter>
        </table>
        <div id="contacttemplate" class="row clearfix" style="display: none">
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 form-control-label">
                <label for="titre_c[]">Interlocuteur </label>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="titre_c[]" class="titre_c form-control" placeholder="Titre contact" value="{{ old('fullname_c[]') }}">
                    </div>
                </div>
            </div>

            <div class="col-lg-1 col-md-1 col-sm-3 col-xs-4 form-control-label">
                <label for="observation_c[]">Adresse</label>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <div class="form-group">
                    <select type="text" name="type_c[]" class="type_c form-control input-field">
                        @foreach(\App\Metier\Json\Contact::$typeListe as $key => $typeliste)
                            <option value="{{ $key }}">{{ $typeliste }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg-3 col-md-2 col-sm-7 col-xs-7">
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="valeur_c[]" class="valeur_c form-control" placeholder="Valeur" value="{{ old('valeur_c[]') }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="row"  style="width: 90%">
            <div class="col-sm-1 pull-right">
                <a href="{{route('valider_commande',['id'=>1994])}}" class="btn btn-info" onclick="return confirm('Voulez vous enregistrer?');">VALIDER LE BON</a>

            </div>
            <div class="col-sm-1 pull-right">

            </div>
            <div class="col-sm-1 pull-right">
                <button type="submit" onclick="" class="btn btn-success"  >METTRE EN MEMOIRE</button>

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
                    $('#tot').html(lisibilite_nombre(Math.round(pageTotal))+" {{ "" }}");
                    $('#tot_serv').val(Math.round(pageTotal));
                    $('#tva').html(lisibilite_nombre(TTva)+" {{""}}");
                    $('#tva_serv').val(Math.round(TTva));
                    $('#ttc').html(lisibilite_nombre(Math.round(pageTotal*1.18)) +" {{""}}");
                    $('#ttc_serv').val(Math.round(pageTotal*1.18));
                },
                responsive: true,
                columnDefs: [
                    { responsivePriority: 5, targets: 0 },
                    { responsivePriority: 2, targets: -2 }
                ]
            }).column(0).visible(false).column(11).visible(false);

            $(".testdd").change(function (e){
                console.log("test");
            });
            $('.row_n__tva').click(function (e) {

                // $(this).closest('td').next().next().html(1);
                var tva=0;
                var data = table.row($(this).parents('tr')).data();
                var num_row=$(this).parents('tr');
                var tva_prod=ilisibilite_nombre(($(this).closest('td').prev().prev().html())*18)/100;

                if($(this).prop('checked') ){

                    $(this).closest('td').prev().html(lisibilite_nombre(tva_prod));
                    data[9] = lisibilite_nombre(tva_prod);
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

                $('#tva').empty();
                $('#tva').html(lisibilite_nombre(sumtva)+" {{""}}");
                $('#tva_serv').val(Math.round(sumtva));

                var ttc=Math.round(sumtva+Math.round($('#tot_serv').val()));
                $('#ttc').empty();
                $('#ttc').html(lisibilite_nombre(ttc) +" {{""}}");
                $('#ttc_serv').val(Math.round(ttc));

            })

            var counter = 1;

            $('#addRow').on( 'click', function () {
                table.row.add( [
                    counter +'.1',
                   "<input type='text' id='designation_"+counter+".2' class='testdd'/>",
                    "<input type='text' id='commentaire_"+counter+".3'/>",
                    "<input type='text' id='codeAnalitique_"+counter+".4'/>",
                    "<input type='number' min='1' id='quantite"+counter+".5' style='width:100px;'/>",
                    "<select class='form-control unite selectpicker col-sm-4' id='unite_"+counter+".6' name='unite_"+counter+".6' data-live-search='true' data-size='6'><option value='U'>U</option> <optgroup label='La longeur'><option value='Km'> Km</option><option value='m'>m</option><option value='cm'>cm</option><option value='mm'>mm</option></optgroup><optgroup label='La masse'><option value='T'> T</option><option value='Kg'>Kg</option> <option value='g'>g</option><option value='mg'>mg</option></optgroup><optgroup label='Le litre'> <option value='L'> L</option><option value='ml'>ml</option></optgroup><optgroup label='Le volume'><option value='m3'> m<SUP>3</SUP></option></optgroup><optgroup label='La surface'><option value='m²'> m²</option></optgroup> </select>",
                    "<input type='number' min='1' id='prix_unitaire' class='prix_unitaire'/>",
                    "<input type='number' min='1' id='remise"+counter+".8' style='width:50px;'/>",
                    "",
                    counter +'.10',
                    counter +'.11',
                    counter +'.12',
                    counter +'.13',
                    counter +'.14',
                ] ).draw( false );
                $('.unite').selectpicker('refresh');
                counter++;
                dom.refresh();
            } );


            // Automatically add a first row of data
            $('#addRow').click();
        })(jQuery);
    </script>
@endsection