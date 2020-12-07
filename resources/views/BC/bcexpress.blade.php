
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

    <h2>LISTE DES COMMANDES - N° BC: PHB-815140-<input name="numbc" id="numbc" WIDTH="30%"  type="text"/>  Nombre de ligne :<input name="nb" id="nb" WIDTH="30%"  type="number" value="{{$nb}}"/>  <a href="{{route('gestion_bc')}}" class="btn btn-default pull-right"><i class="fa fa-list" aria-hidden="true"></i> Lister</a></h2>
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
                <h1><select class="form-control selectpicker" title="SELECTIONNER FOURNISSEUR"  data-live-search="true">
                        @foreach($fournisseurs as $fournisseur)
                            <option value="{{$fournisseur->id}}">{{$fournisseur->libelle}}</option>
                            @endforeach
                    </select></h1>
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
        <div class="">

            <div class="notification-info">
                <div>
                    <table name ="ligneCommandes" id="ligneCommandes" class='table table-bordered table-striped  no-wrap display nowrap'>

                        <thead>

                        <tr>
                            <th class="dt-head-center">slug</th>
                            <th class="">Designation (Ref fournisseur)</th>
                            <th class="">Commentaire</th>
                            <th class="">Quantité</th>
                            <th class="">Unité</th>
                            <th class="">Pu HT</th>
                            <th class="">remise %</th>
                            <th class="">Total  HT</th>
                            <th class="">TVA /produit</th>
                            <th class="">Action</th>

                        </tr>
                        </thead>
                        <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">

                        @for($i=1;$i<=$nb;$i++)

                                <tr>
                                    <td></td>
                                    <td><input type="text" name="designation" class="form-control" /> </td>
                                    <td><input type="text" name="designation" class="form-control" /></td>
                                    <td><input type="text" name="designation" class="form-control" /></td>
                                    <td>
                                        <input type="text" name="designation" class="form-control" />
                                    </td>
                                    <td style="text-align: right"> <input type="text" name="designation" class="form-control" /> </td>
                                    <td> <input type="text" name="designation" class="form-control" /> </td>
                                    <td style="text-align: right"> <input type="text" name="designation" class="form-control" /> </td>
                                    <td > <input type="text" name="designation" class="form-control" /></td>
                                    <td><input type="text" name="designation" class="form-control" /></td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
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
        function ilisibilite_nombre(valeur){

            for(var i=valeur.length-1; i>=0; i-- ){valeur=valeur.toString().replace(' ','');

            }

            return valeur;

        }
        function lisibilite_nombre(nbr) {

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
            dom: "Bfrtip",
            order: [ 1, 'asc' ],
            select: {
                style:    'os',
                selector: 'td:first-child'
            },

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
                $( api.column( 0 ).footer() ).html(
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
        }).column(0).visible(false);

        function calcule_au_click_sur_la_quantie(t){
          // console.log(t);
            var data = table.row($(t).parents('tr')).data();
            var tva=0;
            var data = table.row($(t).parents('tr')).data();
            //  console.log(data);
            var num_row=$(t).parents('tr');
            var pu=ilisibilite_nombre(($(t).closest('td').next().next().html())*18)/100;
            var tva_prod=ilisibilite_nombre(($(t).closest('td').prev().prev().html())*18)/100;
            var tht=$(t).val()*$(t).closest('td').next().next()['0'].children['0'].value;
            var remise=$(t).val()*$(t).closest('td').next().next().next()['0'].children['0'].value;
           // tht=remise-
           // alert(tht);
            console.log($(t).closest('td').next().next()['0'].children['0'].value);

        }
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




            $(".testdd").change(function (e){
                console.log("test");
            });

            $('.quantite3222').click(function (e) {
                // $(this).closest('td').next().next().html(1);
                var tva=0;
                var data = table.row($(this).parents('tr')).data();
              //  console.log(data);
                var num_row=$(this).parents('tr');
                var pu=ilisibilite_nombre(($(this).closest('td').next().next().html())*18)/100;
                var tva_prod=ilisibilite_nombre(($(this).closest('td').prev().prev().html())*18)/100;
               // alert($(this).closest('td').next().next().html().value);
               // console.log($(this).closest('td').next().next());
                console.log($(this).closest('td').next().next()['0'].children['0'].value);
               // console.log($('#'+$(this).closest('td').next().next().0.context.id).val());
/*
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
*/
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
            // ici
            var listecode="";
            var listeoptmateriel="";
            var listeoptunite="";
            $.get("list_materiel_produit/", function(data, status){

                listecode=data["optcode"];
                listeoptmateriel=data["optmateriel"];
                listeoptunite=data["optunite"];

            });

            $('#addligne').on( 'click', function () {
                table.row.add( [
                    counter +'.1',
                   "<select class='form-control'>"+"<option>SELECTIONNER UN PRODUIT</opton>"+listeoptmateriel+"</select>",
                    "<input type='text' id='commentaire_"+counter+".3'/>",
                    "<select class='form-control' class='codeRubrique'>"+"<option>SELECTIONNER</opton>"+listecode+"</select>",
                    "<input type='number' min='1' step='any' min='0' onclick='calcule_au_click_sur_la_quantie(this)' class=' form-control quantite' id='quantite"+counter+".5' style='width:100px;'/>",
                    "<select class='form-control unite selectpicker col-sm-4' id='unite_"+counter+".6' name='unite_"+counter+".6' data-live-search='true' data-size='6'>"+listeoptunite+"</select>",
                    "<input type='number' min='1' id='prix_unitaire' class='prix_unitaire'/>",
                    "<input type='number' min='1' id='remise"+counter+".8' style='width:50px;'/>",
                    "",
                    counter +'.10',
                    counter +'.11',
                    counter +'.12',
                    counter +'.13',
                    counter +'.14',
                ] ).draw( true );
                $('.unite').selectpicker('refresh');
                $('.quantite').selectpicker('refresh');
                $('.codeRubrique').selectpicker('refresh');
                counter++;
            } );

$('.quantite').click(function (e){
 //   alert('dd');
});
            // Automatically add a first row of data
        })(jQuery);
    </script>
    <script type="application/javascript">
        $("#addrow").click(function (e) {
            $($("#lignetemplate").html()).appendTo($("#contenu_tableau_ligne"));
        });
    </script>
@endsection