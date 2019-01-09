
@extends('layouts.app')
@section('reponse_fournisseur')
    class='active'
@endsection
@section('parent_demande_proformas')
    class='active'
@endsection
@section('content')

    <script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/js/dataTables.checkboxes.min.js"></script>

    <h2>RECEPTION DE DEVIS DES FOURNISSEURS </h2>
    <div class="row">
        <div class="col-sm-12">
            </br>
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color: #f0bcb4!important;">
                        <h4 class="panel-title" style="font-size: 32px; color:white" data-toggle="collapse" data-parent="#accordion" href="#collapse1">

                            <a >  NOUVEAU(X)</a>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse in">
                        <div class="panel-body"><form action="{{route('selection_de_la_reponse')}}" method="post"><div id="daencours">

                                    <table name ="gestion_reponse_fournisseur" id="gestion_reponse_fournisseur" class='table table-bordered table-striped  no-wrap '>

                                        <thead>

                                        <tr>
                                            <th class="dt-head-center">id</th>
                                            <th class="dt-head-center">id_materiel</th>
                                            <th>Code Analytique</th>
                                            <th class="dt-head-center">Matériel et consultation</th>
                                            <th class="dt-head-center" width="5%">Quantité</th>
                                            <th class="dt-head-center">Pour le ?</th>
                                            <th class="dt-head-center">Fournisseur</th>
                                            <th class="dt-head-center">Pu HT</th>
                                            <th class="dt-head-center" width="80px">Remise %</th>
                                            <th class="dt-head-center">Devise</th>
                                        </tr>
                                        </thead>
                                        <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">

                                        @foreach($das as $da )




                                            <tr>
                                                <td>{{$da->id}}</td>
                                                <td>
                                                    @foreach($materiels as $materiel )
                                                        @if($materiel->id==$da->id_materiel)
                                                            {{$materiel->id}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td><div class="form-group">
                                                        <label for="type">Code analytique par defaut</label>
                                                        <select class="form-control selectpicker" id="row_n_{{$da->id}}_codeRubrique" name="row_n_{{$da->id}}_codeRubrique" data-live-search="true" data-size="6" required>
                                                            <option  value="">SELECTIONNER UN CODE ANALYTIQUE</option>
                                                            @foreach($analytiques as $analytique)
                                                                <option @if(isset($produit->code_analytique) and $analytique->codeRubrique==$da->id)
                                                                        {{'selected'}}
                                                                        @endif value="{{$analytique->codeRubrique}}">{{$analytique->codeRubrique}} -- {{$analytique->libelle}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    @foreach($materiels as $materiel )
                                                        @if($materiel->id==$da->id_materiel)

                                                            <input type="text" value="{{$materiel->libelleMateriel}}" id="row_n_{{$da->id}}_titre_ext" name="row_n_{{$da->id}}_titre_ext"/>
                                                        @endif
                                                    @endforeach
                                                </td>


                                                <td> <input min="0" type="number" value="{{$da->quantite}}" class="form-control" id="row_n_{{$da->id}}_quantite" name="row_n_{{$da->id}}_quantite">

                                                        <select class="form-control selectpicker col-sm-4" id="row_n_{{$da->id}}_unite" name="row_n_{{$da->id}}_unite" data-live-search="true" data-size="6">
                                                            <option value="U" {{"U"==$da->unite?"selected":''}}>U</option>

                                                            <optgroup label="La longeur">
                                                                <option value="Km" {{"Km"==$da->unite?"selected":''}}> Km</option>
                                                                <option value="m" {{"m"==$da->unite?"selected":''}}>m</option>
                                                                <option value="cm" {{"cm"==$da->unite?"selected":''}}>cm</option>
                                                                <option value="mm" {{"mm"==$da->unite?"selected":''}}>mm</option>
                                                            </optgroup>
                                                            <optgroup label="La masse">
                                                                <option value="T" {{"T"==$da->unite?"selected":''}}> T</option>
                                                                <option value="Kg" {{"Kg"==$da->unite?"selected":''}}>Kg</option>
                                                                <option value="g" {{"g"==$da->unite?"selected":''}}>g</option>
                                                                <option value="mg" {{"mg"==$da->unite?"selected":''}}>mg</option>
                                                            </optgroup>
                                                            <optgroup label="Le litre">
                                                                <option value="L" {{"L"==$da->unite?"selected":''}}> L</option>
                                                                <option value="ml" {{"ml"==$da->unite?"selected":''}}>ml</option>
                                                            </optgroup>
                                                            <optgroup label="La surface">
                                                                <option value="m²" {{"m²"==$da->unite?"selected":''}}> m²</option>
                                                            </optgroup>
                                                        </select>
                                                    </td>
                                                <td>{{$da->DateBesoin}}</td>
                                                <td><select class="form-control" id="row_n_{{$da->id}}_fournisseur" name="row_n_{{$da->id}}_fournisseur">
                                                        <option value="">SELECTIONNER UN  FOURNISSEUR</option>
                                                        @foreach($fournisseurs as $fournisseur)
                                                            @if($fournisseur->domaine==$da->type)
                                                                <option value="{{$fournisseur->id}}">{{$fournisseur->libelle}}</option>
                                                            @endif
                                                        @endforeach</select></td>
                                                <td><input class="form-control"  type="number" min="0" id="row_n_{{$da->id}}_prix_unitaire" name="row_n_{{$da->id}}_prix_unitaire" /></td>
                                                <td><input class="form-control"  type="number" min="0" id="row_n_{{$da->id}}_remise" name="row_n_{{$da->id}}_remise" /></td>
                                                <td><select class="form-control" style="width: 100px;" id="row_n_{{$da->id}}_devise" name="row_n_{{$da->id}}_devise"><option value="FCFA">FCFA</option><option value="EURO">EURO</option></select></td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>

                                    <input type="button" class="btn btn-success pull-right" id="soumettre" name="soumettre" value="Soumettre" />


                            </form></div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color: #f0bcb4!important;">
                        <h4 class="panel-title" style="font-size: 32px; color:white" data-toggle="collapse" data-parent="#accordion" href="#collapse2">

                            <a >  TRAITE(S)</a>
                        </h4>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse" >
                        <div class="panel-body" ><form action="{{route('selection_de_la_reponse')}}" method="post"><div id="daencours">

                                    <table name ="gestion_reponse_fournisseur1" id="gestion_reponse_fournisseur1" class='table table-bordered table-striped  no-wrap col-lg-push-3' >

                                        <thead>

                                        <tr>
                                            <th class="dt-head-center">id</th>
                                            <th class="dt-head-center">id_materiel</th>
                                            <th>Code Analytique</th>
                                            <th class="dt-head-center" width="20%">Matériel et consultation</th>
                                            <th class="dt-head-center" width="30px">Quantité</th>
                                            <th class="dt-head-center">Fournisseur</th>
                                            <th class="dt-head-center">Prix Unitaire</th>
                                            <th class="dt-head-center">Devise</th>
                                        </tr>
                                        </thead>
                                        <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">

                                        @foreach($devis as $devi )




                                            <tr>
                                                <td>{{$devi->id}}</td>
                                                <td>
                                                    @foreach($materiels as $materiel )
                                                        @if($materiel->id==$devi->id_materiel)
                                                            {{$materiel->id}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td><input type="text"  id="row_n_{{$devi->id}}_codeRubrique" name="row_n_{{$devi->id}}_codeRubrique" value="{{$devi->codeRubrique}}" /> </td>
                                                <td>


                                                            <input type="text" value="{{$devi->titre_ext}}" id="row_n_{{$devi->id}}_titre_ext" name="row_n_{{$devi->id}}_titre_ext"/>

                                                </td>


                                                <td> <input min="0" type="number" value="{{$devi->quantite}}" class="form-control" id="row_n_{{$devi->id}}_quantite" name="row_n_{{$devi->id}}_quantite">
                                                    <select class="form-control selectpicker col-sm-4" id="row_n_{{$devi->id}}_unite" name="row_n_{{$devi->id}}_unite" data-live-search="true" data-size="6">
                                                        <option value="U" {{"U"==$devi->unite?"selected":''}}>U</option>

                                                        <optgroup label="La longeur">
                                                            <option value="Km" {{"Km"==$devi->unite?"selected":''}}> Km</option>
                                                            <option value="m" {{"m"==$devi->unite?"selected":''}}>m</option>
                                                            <option value="cm" {{"cm"==$devi->unite?"selected":''}}>cm</option>
                                                            <option value="mm" {{"mm"==$devi->unite?"selected":''}}>mm</option>
                                                        </optgroup>
                                                        <optgroup label="La masse">
                                                            <option value="T" {{"T"==$devi->unite?"selected":''}}> T</option>
                                                            <option value="Kg" {{"Kg"==$devi->unite?"selected":''}}>Kg</option>
                                                            <option value="g" {{"g"==$devi->unite?"selected":''}}>g</option>
                                                            <option value="mg" {{"mg"==$devi->unite?"selected":''}}>mg</option>
                                                        </optgroup>
                                                        <optgroup label="Le litre">
                                                            <option value="L" {{"L"==$devi->unite?"selected":''}}> L</option>
                                                            <option value="ml" {{"ml"==$devi->unite?"selected":''}}>ml</option>
                                                        </optgroup>
                                                        <optgroup label="La surface">
                                                            <option value="m²" {{"m²"==$devi->unite?"selected":''}}> m²</option>
                                                        </optgroup>
                                                    </select>
                                                </td>
                                                <td><select class="form-control" id="row_n_{{$devi->id}}_fournisseur" name="row_n_{{$devi->id}}_fournisseur">
                                                        <option value="">SELECTIONNER UN  FOURNISSEUR</option>
                                                        @foreach($fournisseurs as $fournisseur)
                                                            @foreach($materiels as $materiel)
                                                                @if($devi->id_materiel==$materiel->id)
                                                                    @if($fournisseur->domaine==$materiel->type)
                                                                        @if($fournisseur->id==$devi->id_fournisseur)
                                                                            <option value="{{$fournisseur->id}}" selected>{{$fournisseur->libelle}}</option>
                                                                            @else
                                                                            <option value="{{$fournisseur->id}}">{{$fournisseur->libelle}}</option>
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                                @endforeach

                                                        @endforeach</select></td>
                                                <td><input class="form-control"  type="number" min="0" id="row_n_{{$devi->id}}_prix_unitaire" name="row_n_{{$devi->id}}_prix_unitaire" value="{{$devi->prix_unitaire}}" /></td>
                                                <td><select class="form-control" style="width: 100px;" id="row_n_{{$devi->id}}_devise" name="row_n_{{$devi->id}}_devise">


                                                        <option value="FCFA"  {{"FCFA"==$devi->devise?"selected":''}}>FCFA</option>
                                                        <option value="EURO" {{"EURO"==$devi->devise?"selected":''}}>EURO</option>

                                                    </select></td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>

                                    <input type="button" class="btn btn-success pull-right" id="soumettre1" name="soumettre1" value="Modifier" />


                            </form></div>
                    </div>
                </div>

            </div>

        </div>


    </div>
    <script>

        (function($) {

            //debut
            var table1 = $('#gestion_reponse_fournisseur').DataTable({
                language: {
                    url: "js/French.json"
                },
                "ordering":true,
                "paging": false,
                responsive: true,
                columnDefs: [
                    { responsivePriority: 12, targets: 0 },
                    { responsivePriority: 2, targets: -1 }
                ]
            }).column(0).visible(false).column(1).visible(false);
            var table2 = $('#gestion_reponse_fournisseur1').DataTable({
                language: {
                    url: "js/French.json"
                },
                "ordering":true,
                "paging": false,
                responsive: true,
                columnDefs: [
                    { responsivePriority: 12, targets: 0 },
                    { responsivePriority: 2, targets: -1 }
                ]
            }).column(0).visible(false).column(1).visible(false);

            $('#gestion_reponse_fournisseur').on( 'click', 'tr', function () {



            } );


            $('#soumettre').click( function() {
                var data = table1.rows().data();
                var lesId;
                var lesIdmat;
                data.each(function (value, index) {
                   // var valeur=parseInt(value);
                    var valeur=value+'';
                    var  text=valeur.split(",");
                    if(typeof(valeur)!=="undefined"){
                        lesId=lesId+','+text[0];
                        lesIdmat=lesIdmat+','+text[1];
                    }


                });
                var res= Array();
                res.push(table1.$('input, select').serialize()) ;

             //   console.log(data);
                $.get("enregistrer_devis/"+res+"/"+lesId+"/"+lesIdmat,
                        function (data) {
            if(data==1){
                location.reload();
                    }
                        }
                );
                return false;
            } );
            $('#soumettre1').click( function() {
                var data = table2.rows().data();
                var lesId;
                var lesIdmat;
                data.each(function (value, index) {
                    // var valeur=parseInt(value);
                    var valeur=value+'';

                    var  text=valeur.split(",");

                    if(typeof(valeur)!=="undefined"){
                        lesId=lesId+','+text[0];
                    }


                });
                var res= Array();
                res.push(table2.$('input, select').serialize()) ;
                //   console.log(data);

                $.get("modifier_devis/"+res+"/"+lesId,
                        function (data) {
                            if(data==1){
                                location.reload();
                            }else{
                                alert("Désolé la requette à déjà été traitée il est donc impossible de mofifier");
                                location.reload();
                            }
                        }
                );
                return false;
            } );
            $('#fourn').selectpicker({

                noneSelectedText: 'AUCUN ELEMENT SELECTIONNE',
                selectAllText: 'Selectionner tout',
                deselectAllText: 'Deselctionner Tout',
                noneResultsText: 'No results matched {0}',
                actionsBox:true,
                countSelectedText: function (numSelected, numTotal) {

                    return (numSelected == 1) ? "{0} item selected" : "{0} items selected";

                }

            });


            $('#id_lignebesoin').change(function(e){
                var da=$("#id_lignebesoin").val();
                $('#id_lignebesoin').val(da);
                $.get("les_das_fournisseurs_funct_da/"+da,
                        function (data) {
                            $('#id_fournisseur').empty();
                            $('#id_fournisseur').append("<option>SELECTIONNER UN FOURNISSEUR</option>");
                            $.each(data, function( index, value ) {


                                $('#id_fournisseur').append("<option value='"+value.id+"'>"+value.libelle+"</option>");

                            });

                            $('#id_fournisseur').selectpicker('refresh');
                            console.log(data);
                        }
                );



            });


        })(jQuery);
    </script>
@endsection