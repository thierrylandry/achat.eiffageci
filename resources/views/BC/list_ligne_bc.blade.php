
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
            return confirm('Voulez vous enregistrer??');
        }
    }</script>

    <h2>LISTE DES COMMANDES - N° BC : {{$bc->numBonCommande}} <a href="{{route('gestion_bc')}}" class="btn btn-default pull-right"><i class="fa fa-list" aria-hidden="true"></i> Lister</a></h2>
    <br>
    <form method="post" action="{{route('save_ligne_bc')}}" onsubmit="return confirm('Voulez vous enregistrer?');">
        @csrf
        <input type="hidden" name="id_bc" id="id_bc" value="{{$bc->id}}"/>
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

                        <option {{isset($bc->service_demandeur)&&$bc->service_demandeur=="Service materiel"? "selected":''}} value="Service materiel">Service matériel</option>
                        <option  {{isset($bc->service_demandeur)&&$bc->service_demandeur=="Direction"? "selected":''}} value="Direction">Direction</option>
                        <option {{isset($bc->service_demandeur)&&$bc->service_demandeur=="Secretariat"? "selected":''}} value="Secretariat">Secrétariat</option>
                        <option  {{isset($bc->service_demandeur)&&$bc->service_demandeur=="Service travaux"? "selected":''}}value="Service travaux">Service travaux </option>
                        <option {{isset($bc->service_demandeur)&&$bc->service_demandeur=="Service methodes"? "selected":''}} value="Service methodes">Service méthodes </option>
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
        <br> <br>
        @if($bc->etat<4)
        <div class="alert alert-warning ">
            <span class="alert-icon"><i class="fa fa-bell-o"></i></span>
            <div class="notification-info">
                <ul class="clearfix notification-meta">
                    <li class="pull-left notification-sender">Vous avez  <b style="font-size: 24px">{{sizeof($new_devis)}}</b>   demande(s) d'achat recente(s). Ajoutez aux bons de commande <button type="button" onclick="myFunction()"> détail</button></li>

                </ul>
                <p>
                    ...
                </p>
                <div id="myDIV" style="display:none">
                <table name ="ligneCommandes_a_ajouter" id="ligneCommandes_a_ajouter" class='table table-bordered table-striped  no-wrap display nowrap'>

                    <thead>

                    <tr>
                        <th class="dt-head-center">slug</th>
                        <th class="">Designation</th>
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

                    @if(isset($new_devis))
                        @foreach($new_devis as $new_devi )

                            <tr>
                                <td>{{$new_devi->id}}</td>
                                <td>{{$new_devi->titre_ext}}</td>
                                <td>{{$new_devi->commentaire}}</td>
                                <td>{{$new_devi->quantite}}</td>
                                <td>
                                    {{$new_devi->unite}}
                                </td>
                                <td style="text-align: right">  {{$new_devi->prix_unitaire}}</td>
                                <td>  {{$new_devi->remise}}</td>
                                <td style="text-align: right">  {{($THT=($new_devi->prix_unitaire*$new_devi->quantite)-(($new_devi->remise/100*($new_devi->prix_unitaire*$new_devi->quantite))))}}</td>
                                <td > @if(1==$new_devi->hastva)
                                        {{number_format(intval(($THT*18)/100), 0,".", " ")}}
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
            <td><div class="row"><div class="col-sm-6"><button type="button" class="btn_retirerbc">Retirer</button></div><div class="col-sm-6"><button type="button" class="btn_supp btn btn-danger"><i class="fa fa-trash"></i></button></div></div></td>
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

<div class="row"  style="width: 90%">
    <div class="col-sm-1 pull-right">
        <a href="{{route('valider_commande',['id'=>$bc->slug])}}" class="btn btn-info" {{$bc->etat!=1?'disabled':''}} onclick="return confirm('Voulez vous enregistrer?');">VALIDER LE BON</a>

    </div>
    <div class="col-sm-1 pull-right">

    </div>
    <div class="col-sm-1 pull-right">
        <button type="submit" onclick="" class="btn btn-success" {{$bc->etat!=1?'disabled':''}} >METTRE EN MEMOIRE</button>

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

                if(count!=0 && count % 3 == 0)

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
                url: '../js/French.json'
            },
            "ordering":true,
            "createdRow": function( row, data, dataIndex){

            },
            "paging": false,
            columnDefs: [
                { responsivePriority: 5, targets: 0 },
                { responsivePriority: 2, targets: -2 }
            ]
        }).column(0).visible(false);

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
        }).column(0).visible(false).column(11).visible(false);

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
            $('#tva').html(lisibilite_nombre(sumtva)+" {{$devise}}");
            $('#tva_serv').val(Math.round(sumtva));

            var ttc=Math.round(sumtva+Math.round($('#tot_serv').val()));
            $('#ttc').empty();
            $('#ttc').html(lisibilite_nombre(ttc) +" {{$devise}}");
            $('#ttc_serv').val(Math.round(ttc));

        })

    })(jQuery);
</script>
@endsection