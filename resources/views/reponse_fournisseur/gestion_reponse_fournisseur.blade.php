
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
                        <div class="panel-body"><form action="" method="post"><div id="daencours">

                                    <table name ="gestion_reponse_fournisseur" id="gestion_reponse_fournisseur" class='table table-bordered table-striped  no-wrap '>

                                        <thead>

                                        <tr>
                                            <th class="dt-head-center">N°D.A</th>
                                            <th class="dt-head-center">id_materiel</th>
                                            <th>Code Analytique</th>
                                            <th class="dt-head-center">Matériel et consultation</th>
                                            <th class="dt-head-center" width="5%">Quantité</th>
                                            <th class="dt-head-center">Pour le ?</th>
                                            <th class="dt-head-center">Fournisseur</th>
                                            <th class="dt-head-center">Pu HT</th>
                                            <th class="dt-head-center" width="80px">Remise %</th>
                                            <th class="dt-head-center">Devise</th>
                                            <th class="dt-head-center">TVA</th>
                                            <th class="dt-head-center">Action</th>
                                        </tr>
                                        </thead>

                                        <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">

                                        @foreach($das as $da )




                                            <tr>
                                                <td>{{$da->id}}</td>
                                                <td>{{$da->id_materiel}}</td>
                                                <td><div class="form-group">
                                                        <select class="form-control selectpicker" id="row_n_{{$da->id}}_codeRubrique" name="row_n_{{$da->id}}_codeRubrique" data-live-search="true" data-size="6" >
                                                            <option  value="">SELECTIONNER</option>
                                                            @foreach($analytiques as $analytique)

                                                                <option @if(isset($da->code_analytique) && $analytique->codeRubrique==$da->code_analytique)
                                                                        {{'selected'}}
                                                                        @endif value="{{$analytique->codeRubrique}}" data-subtext="{{$analytique->libelle}}">{{$analytique->codeRubrique}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                            <input type="text" value="{{isset($tab_proposition[$da->id]->titre_ext)?$tab_proposition[$da->id]->titre_ext:$da->libelleMateriel}}" id="row_n_{{$da->id}}_titre_ext" name="row_n_{{$da->id}}_titre_ext"/>
                                                </td>


                                                <td> <input min="0" type="number" step="any" value="{{$da->quantite}}" class="form-control" id="row_n_{{$da->id}}_quantite" name="row_n_{{$da->id}}_quantite">

                                                        <select class="form-control selectpicker col-sm-4" id="row_n_{{$da->id}}_unite" name="row_n_{{$da->id}}_unite" data-live-search="true" data-size="6">
                                                            @foreach($tab_unite['nothing'] as $unite)
                                                                <option value="{{$unite}}" {{isset($tab_proposition[$da->id]->unite) && $tab_proposition[$da->id]->unite==$unite || $unite==$da->unite ?"selected":''}}>{{$unite}}</option>
                                                            @endforeach
                                                            <optgroup label="La longeur">
                                                                @foreach($tab_unite['La longueur'] as $unite)
                                                                    <option value="{{$unite}}" {{isset($tab_proposition[$da->id]->unite) && $tab_proposition[$da->id]->unite==$unite || $unite==$da->unite ?"selected":''}}>{{$unite}}</option>
                                                                @endforeach
                                                            </optgroup>

                                                            <optgroup label="La masse">
                                                                @foreach($tab_unite['La masse'] as $unite)
                                                                    <option value="{{$unite}}" {{isset($tab_proposition[$da->id]->unite) && $tab_proposition[$da->id]->unite==$unite || $unite==$da->unite ?"selected":''}}>{{$unite}}</option>
                                                                @endforeach
                                                            </optgroup>
                                                            <optgroup label="Le volume">
                                                                @foreach($tab_unite['Le volume'] as $unite)
                                                                    <option value="{{$unite}}" {{isset($tab_proposition[$da->id]->unite) && $tab_proposition[$da->id]->unite==$unite || $unite==$da->unite ?"selected":''}}>{{$unite}}</option>
                                                                @endforeach
                                                            </optgroup>

                                                            <optgroup label="La surface">
                                                                @foreach($tab_unite['La surface'] as $unite)
                                                                    <option value="{{$unite}}" {{isset($tab_proposition[$da->id]->unite) && $tab_proposition[$da->id]->unite==$unite || $unite==$da->unite ?"selected":''}}>{{$unite}}</option>
                                                                @endforeach
                                                        </select>
                                                    </td>
                                                <td>{{$da->DateBesoin}}</td>
                                                <td><select class="form-control" id="row_n_{{$da->id}}_fournisseur" name="row_n_{{$da->id}}_fournisseur">
                                                        <option value="">SELECTIONNER UN  FOURNISSEUR</option>
                                                        @foreach($fournisseurs as $fournisseur)
                                                            @if(in_array($da->type,explode(',',$fournisseur->domaine)))
                                                                <option  @if( isset($tab_proposition[$da->id]) && $fournisseur->id==$tab_proposition[$da->id]->id_fournisseur)
                                                                         {{'selected'}}
                                                                         @endif  value="{{$fournisseur->id}}">{{$fournisseur->libelle}}</option>
                                                            @endif
                                                        @endforeach</select></td>
                                                <td><input class="form-control" style="min-width: 150px;"  type="number" min="0" id="row_n_{{$da->id}}_prix_unitaire" name="row_n_{{$da->id}}_prix_unitaire" value="{{isset($tab_proposition[$da->id])?$tab_proposition[$da->id]->prix_unitaire:''}}" /></td>
                                                <td><input class="form-control"  type="number" min="0" id="row_n_{{$da->id}}_remise" name="row_n_{{$da->id}}_remise" value="0" value="{{isset($tab_proposition[$da->id])?$tab_proposition[$da->id]->remise:''}}" /></td>
                                                <td><select class="form-control" style="width: 100px;" id="row_n_{{$da->id}}_devise" name="row_n_{{$da->id}}_devise"><option  @if( isset($tab_proposition[$da->id]) && "FCFA"==$tab_proposition[$da->id]->devise)
                                                                                                                                                                              {{'selected'}}
                                                                                                                                                                              @endif value="FCFA">FCFA</option><option @if( isset($tab_proposition[$da->id]) && "EURO"==$tab_proposition[$da->id]->devise) {{'selected'}}@endif value="EURO">EURO</option></select></td>
                                                <td><input type="checkbox" value="1" id="row_n_{{$da->id}}_tva" name="row_n_{{$da->id}}_tva" checked/>   </td>
                                                <td><div class="row"><div class="col-sm-6"><button type="button" class="btn_supp btn btn-danger" title="SUPPRIMER"><i class="fa fa-trash"></i></button></div></div>   </td>
                                            </tr>

                                        @endforeach

                                        </tbody>

                                    </table>

                                    <input type="button" class="btn btn-success pull-right" id="soumettre" name="soumettre" value="Soumettre" />

                                </div>
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
                        <div class="panel-body" >
                            <form action="{{route('selection_de_la_reponse')}}" method="post">
                                <div id="daencours">

                                    <table name ="gestion_reponse_fournisseur1" id="gestion_reponse_fournisseur1" class='table table-bordered table-striped  no-wrap col-lg-push-3' >

                                        <thead>

                                        <tr>
                                            <th class="dt-head-center">id</th>
                                            <th class="dt-head-center">id_materiel</th>
                                            <th class="dt-head-center">N°D.A</th>
                                            <th>Code Analytique</th>
                                            <th class="dt-head-center" width="20%">Matériel et consultation</th>
                                            <th class="dt-head-center" width="30px">Quantité</th>
                                            <th class="dt-head-center">Fournisseur</th>
                                            <th class="dt-head-center">Prix Unitaire</th>
                                            <th class="dt-head-center" width="80px">Remise %</th>
                                            <th class="dt-head-center">Devise</th>
                                            <th class="dt-head-center">TVA</th>
                                            <th class="dt-head-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite" onload="alert('jai chargé')">

                                        @foreach($devis as $devi )




                                            <tr>
                                                <td>{{$devi->id}}</td>
                                                <td>{{ $devi->libelleMateriel}}</td>
                                                <td>{{$devi->id_da}}</td>
                                                <td> <div class="form-group">
                                                        <select class="form-control selectpicker" id="row_n_{{$devi->id}}_codeRubrique" name="row_n_{{$devi->id}}_codeRubrique" data-live-search="true" data-size="6" required>
                                                            <option  value="">SELECTIONNER</option>
                                                            @foreach($analytiques as $analytique)

                                                                <option @if(isset($devi) && $analytique->codeRubrique==$devi->codeRubrique)
                                                                        {{'selected'}}
                                                                        @endif value="{{$analytique->codeRubrique}}" data-subtext="{{$analytique->libelle}}">{{$analytique->codeRubrique}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div></td>
                                                <td>


                                                    <input type="text" value="{{$devi->titre_ext}}" id="row_n_{{$devi->id}}_titre_ext" name="row_n_{{$devi->id}}_titre_ext"/>

                                                </td>
                                                <td> <input min="0" type="number" step="any" value="{{$devi->quantite}}" class="form-control" id="row_n_{{$devi->id}}_quantite" name="row_n_{{$devi->id}}_quantite">
                                                    <select class="form-control selectpicker col-sm-4" id="row_n_{{$devi->id}}_unite" name="row_n_{{$devi->id}}_unite" data-live-search="true" data-size="6">
                                                        @foreach($tab_unite['nothing'] as $unite)
                                                            <option value="{{$unite}}" {{$unite==$devi->unite?"selected":''}}>{{$unite}}</option>
                                                        @endforeach
                                                        <optgroup label="La longeur">
                                                            @foreach($tab_unite['La longueur'] as $unite)
                                                                <option value="{{$unite}}" {{$unite==$devi->unite?"selected":''}}>{{$unite}}</option>
                                                            @endforeach
                                                        </optgroup>

                                                        <optgroup label="La masse">
                                                            @foreach($tab_unite['La masse'] as $unite)
                                                                <option value="{{$unite}}" {{$unite==$devi->unite?"selected":''}}>{{$unite}}</option>
                                                            @endforeach
                                                        </optgroup>
                                                        <optgroup label="Le volume">
                                                            @foreach($tab_unite['Le volume'] as $unite)
                                                                <option value="{{$unite}}" {{$unite==$devi->unite?"selected":''}}>{{$unite}}</option>
                                                            @endforeach
                                                        </optgroup>

                                                        <optgroup label="La surface">
                                                            @foreach($tab_unite['La surface'] as $unite)
                                                                <option value="{{$unite}}" {{$unite==$devi->unite?"selected":''}}>{{$unite}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><select class="form-control" id="row_n_{{$devi->id}}_fournisseur" name="row_n_{{$devi->id}}_fournisseur">
                                                        <option value="">SELECTIONNER UN  FOURNISSEUR</option>
                                                        @foreach($fournisseurs as $fournisseur)

                                                                    @if(in_array($devi->type,explode(',',$fournisseur->domaine)))
                                                                        @if($fournisseur->id==$devi->id_fournisseur)
                                                                            <option value="{{$fournisseur->id}}" selected>{{$fournisseur->libelle}}</option>
                                                                        @else
                                                                            <option value="{{$fournisseur->id}}">{{$fournisseur->libelle}}</option>
                                                                        @endif
                                                                    @endif


                                                        @endforeach</select></td>
                                                <td><input class="form-control"  type="number" min="0" id="row_n_{{$devi->id}}_prix_unitaire" name="row_n_{{$devi->id}}_prix_unitaire" value="{{$devi->prix_unitaire}}" /></td>
                                                <td><input class="form-control"  type="number" min="0" id="row_n_{{$devi->id}}_remise" name="row_n_{{$devi->id}}_remise" value="{{$devi->remise}}" /></td>
                                                <td><select class="form-control" style="width: 100px;" id="row_n_{{$devi->id}}_devise" name="row_n_{{$devi->id}}_devise">


                                                        <option value="FCFA"  {{"FCFA"==$devi->devise?"selected":''}}>FCFA</option>
                                                        <option value="EURO" {{"EURO"==$devi->devise?"selected":''}}>EURO</option>

                                                    </select></td>
                                                <td><input type="checkbox" value="1" id="row_n_{{$devi->id}}_tva" name="row_n_{{$devi->id}}_tva" {{1==$devi->hastva?"checked":''}}/>   </td>
                                                <td><div class="row"><div class="col-sm-6"><button type="button" class="btn_supp2 btn btn-danger" title="SUPPRIMER"><i class="fa fa-trash"></i></button></div></div>   </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>

                                    <input type="button" class="btn btn-success pull-right" id="soumettre1" name="soumettre1" value="Modifier" />

                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>


    </div>
    <script>

        (function($) {
            $(".btn_supp").click(function (){
                var data = table1.row($(this).parents('tr')).data();
              //  var id_bc= $("#id_bc").val();
                if(confirm("Voulez vous supprimer définitivement cette ligne?")){
                    $.get("supprimer_def_devis/"+data[0], function(data, status){
                        console.log(data);
                        window.location.reload()
                    });

                }

            });
            $(".btn_supp2").click(function (){
                var data = table2.row($(this).parents('tr')).data();
                //  var id_bc= $("#id_bc").val();
                console.log(data);
                if(confirm("Voulez vous supprimer définitivement cette ligne?")){
                    $.get("supprimer_def_devis2/"+data[0], function(data, status){
                        console.log(data);
                        window.location.reload()
                    });

                }

            });

            //debut
            var table1 = $('#gestion_reponse_fournisseur').DataTable({
                language: {
                    url: "public/js/French.json"
                },
                "ordering":true,
                "paging": false,
                responsive: false,
            }).column(1).visible(false);
            var table2 = $('#gestion_reponse_fournisseur1').DataTable({
                language: {
                    url: "public/js/French.json"
                },
                "ordering":true,
                "paging": false,
                responsive: false,

            }).column(0).visible(false).column(1).visible(false);

            $('#gestion_reponse_fournisseur').on( 'click', 'tr', function () {



            } );


            $('#soumettre').click( function() {

                if( confirm('Voulez vous soumettre le(s) devis?')){
                    var data = table1.rows().data();
                    var lesId;
                    var lesIdmat;
                    console.log(data);
                    data.each(function (value, index) {
                        // var valeur=parseInt(value);
                        var valeur=value+'';
                        var  text=valeur.split(",");
                        if(typeof(valeur)!=="undefined"){
                            lesId=lesId+','+text[0];
                            lesIdmat=lesIdmat+','+text[1];
                        }


                    });
                    var res;
                    console.log(lesId);
                    res=table1.$('input, select').serialize();

                    //   console.log(data);
                    //enregistrer_devis/"+res+"/"+lesId+"/"+lesIdmat
                    var csrf_token = $('meta[name="csrf-token"]').attr('content');
                    $.post("enregistrer_devis",{res:res,lesId:lesId,lesIdmat:lesIdmat,_token: "{{ csrf_token() }}"},
                            function (data) {
                                if(data==1){
                                    location.reload();
                                }
                            }
                    );
                    return false;
                }

            } );
            $('#soumettre1').click( function() {
                if( confirm('Voulez vous modifier le(s) devis?')) {
                    var data = table2.rows().data();
                    var lesId;
                    var lesIdmat;
                    data.each(function (value, index) {
                        // var valeur=parseInt(value);
                        var valeur = value + '';

                        var text = valeur.split(",");

                        if (typeof(valeur) !== "undefined") {
                            lesId = lesId + ',' + text[0];
                        }


                    });
                    var res ;
                    res=table2.$('input, select').serialize();
                       //console.log(res);
                    var csrf_token = $('meta[name="csrf-token"]').attr('content');
                    $.post("modifier_devis",{res:res,lesId:lesId,_token: "{{ csrf_token() }}"},
                            function (data) {
                                console.log(data);
                                if (data == 1) {
                                    location.reload();
                                } else {
                                    alert("Désolé la requette à déjà été traitée il est donc impossible de mofifier");
                                    location.reload();
                                }
                            }
                    );

                    return false;
                }
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