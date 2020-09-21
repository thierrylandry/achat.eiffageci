
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
                                    {{ $das->links() }}
                                    <table name ="gestion_reponse_fournisseur" id="gestion_reponse_fournisseur" class='table table-bordered table-striped  no-wrap '>

                                        <thead>

                                        <tr>
                                            <th class="dt-head-center">N°D.A</th>
                                            <th class="dt-head-center">N°D.A</th>
                                            <th class="dt-head-center">id_materiel</th>
                                            <th class="dt-head-center">nom produit</th>
                                            <th>Code Analytique</th>
                                            <th>Code Gestion</th>
                                            <th class="dt-head-center">Matériel et consultation</th>
                                            <th>Reference </br>Fournisseur</th>
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
                                                <td>{{$da->id}}</td>
                                                <td>{{$da->id_materiel}}</td>
                                                <td>{{$da->libelleMateriel}}</td>
                                                <td>{{$da->code_analytique}}</td>
                                                <td><div class="form-group">
                                                        <select style="width: 50px;" class="form-control selectpicker" id="row_n_{{$da->id}}_codeGestion" name="row_n_{{$da->id}}_codeGestion" data-live-search="true" data-size="6" >
                                                            <option  value="">SELECT</option>
                                                            @foreach($gestions as $gestion)

                                                                <option @if(isset($da->id_codeGestion) && $gestion->id==$da->id_codeGestion)
                                                                        {{'selected'}}
                                                                        @endif value="{{$gestion->codeGestion}}" data-subtext="{{$gestion->description}}">{{$gestion->codeGestion}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                            <input  type="text" value="{{isset($tab_proposition[$da->id]->titre_ext)?$tab_proposition[$da->id]->titre_ext:$da->libelleMateriel}}" id="row_n_{{$da->id}}_titre_ext" name="row_n_{{$da->id}}_titre_ext" />
                                                </td>
                                                <td>
                                                            <input type="text" class="col-sm-12" value="" id="row_n_{{$da->id}}_ref" name="row_n_{{$da->id}}_ref"/>
                                                    <label>PROPOSITION:</br>
                                                        <a  onclick="document.getElementById('row_n_{{$da->id}}_ref').value='{{isset($tab_proposition[$da->id])?$tab_proposition[$da->id]->referenceFournisseur:''}}';$('#row_n_{{$da->id}}_ref').selectpicker('refresh')">  {{isset($tab_proposition[$da->id])?$tab_proposition[$da->id]->referenceFournisseur:''}}</a>;
                                                    </label>
                                                </td>


                                                <td> <input min="0" type="number" step="any" value="{{$da->quantite}}" class="form-control" id="row_n_{{$da->id}}_quantite" name="row_n_{{$da->id}}_quantite">

                                                        <select class="form-control selectpicker col-sm-4" id="row_n_{{$da->id}}_unite" name="row_n_{{$da->id}}_unite" data-live-search="true" data-size="6">

                                                            @foreach($tab_unite['nothing'] as $unite)
                                                                <option value="{{$unite}}" {{isset($tab_proposition[$da->id]->unite) && $tab_proposition[$da->id]->unite==$unite || $unite==$da->unite ?"selected":''}}>{{$unite}}</option>
                                                            @endforeach
                                                                @if(isset($tab_unite['La longueur']))
                                                            <optgroup label="La longeur">
                                                                @foreach($tab_unite['La longueur'] as $unite)
                                                                    <option value="{{$unite}}" {{isset($tab_proposition[$da->id]->unite) && $tab_proposition[$da->id]->unite==$unite || $unite==$da->unite ?"selected":''}}>{{$unite}}</option>
                                                                @endforeach
                                                                @endif
                                                            </optgroup>

                                                            <optgroup label="La masse">
                                                                @if(isset($tab_unite['La masse']))
                                                                @foreach($tab_unite['La masse'] as $unite)
                                                                    <option value="{{$unite}}" {{isset($tab_proposition[$da->id]->unite) && $tab_proposition[$da->id]->unite==$unite || $unite==$da->unite ?"selected":''}}>{{$unite}}</option>
                                                                @endforeach
                                                                    @endif
                                                            </optgroup>
                                                            <optgroup label="Le volume">
                                                                @if(isset($tab_unite['Le volume']))
                                                                @foreach($tab_unite['Le volume'] as $unite)
                                                                    <option value="{{$unite}}" {{isset($tab_proposition[$da->id]->unite) && $tab_proposition[$da->id]->unite==$unite || $unite==$da->unite ?"selected":''}}>{{$unite}}</option>
                                                                @endforeach
                                                                    @endif
                                                            </optgroup>
                                                                    @if(isset($tab_unite['La surface']))
                                                            <optgroup label="La surface">
                                                                @foreach($tab_unite['La surface'] as $unite)
                                                                    <option value="{{$unite}}" {{isset($tab_proposition[$da->id]->unite) && $tab_proposition[$da->id]->unite==$unite || $unite==$da->unite ?"selected":''}}>{{$unite}}</option>
                                                                @endforeach
                                                                    @endif
                                                        </select>
                                                    </td>
                                                <td>{{$da->DateBesoin}}</td>
                                                <td><select class="form-control" id="row_n_{{$da->id}}_fournisseur" name="row_n_{{$da->id}}_fournisseur">
                                                        <option value="">SELECTIONNER UN  FOURNISSEUR</option>
                                                        @foreach($fournisseurs as $fournisseur)
                                                            @if(in_array($da->type,explode(',',$fournisseur->domaine)))
                                                                <option    value="{{$fournisseur->id}}">{{$fournisseur->libelle}}</option>
                                                            @endif
                                                        @endforeach</select>
                                                    <label>PROPOSITION:
                                                        <a  onclick="document.getElementById('row_n_{{$da->id}}_fournisseur').value='{{isset($tab_proposition[$da->id])?$tab_proposition[$da->id]->id_fournisseur:''}}';$('#row_n_{{$da->id}}_fournisseur').selectpicker('refresh')">  @foreach($fournisseurs as $fournisseur)
                                                                @if(in_array($da->type,explode(',',$fournisseur->domaine)))
                                                                      @if( isset($tab_proposition[$da->id]) && $fournisseur->id==$tab_proposition[$da->id]->id_fournisseur)
                                                                             {{$fournisseur->libelle}}
                                                                             @endif
                                                                @endif
                                                            @endforeach</a>;
                                                    </label>
                                                </td>
                                                <td><input class="form-control" style="min-width: 80px;"  type="number" min="0" id="row_n_{{$da->id}}_prix_unitaire" name="row_n_{{$da->id}}_prix_unitaire" value="" />
                                                    <label>PROPOSITION:
                                                            <a  onclick="document.getElementById('row_n_{{$da->id}}_prix_unitaire').value='{{isset($tab_proposition[$da->id])?$tab_proposition[$da->id]->prix_unitaire:''}}';$('#row_n_{{$da->id}}_prix_unitaire').selectpicker('refresh')">  {{isset($tab_proposition[$da->id])?$tab_proposition[$da->id]->prix_unitaire:''}}</a>;
                                                        </label>
                                                </td>
                                                <td><input class="form-control"  type="number" min="0" id="row_n_{{$da->id}}_remise" name="row_n_{{$da->id}}_remise" value="0" value="" />
                                                    <label>PROPOSITION:
                                                        <a  onclick="document.getElementById('row_n_{{$da->id}}_remise').value='{{isset($tab_proposition[$da->id])?$tab_proposition[$da->id]->remise:''}}';$('row_n_{{$da->id}}_remise').selectpicker('refresh')">  {{isset($tab_proposition[$da->id])?$tab_proposition[$da->id]->remise:''}}</a>;
                                                    </label>
                                                </td>
                                                <td><select class="form-control" style="width: 80px;" id="row_n_{{$da->id}}_devise" name="row_n_{{$da->id}}_devise"><option  @if( isset($tab_proposition[$da->id]) && "FCFA"==$tab_proposition[$da->id]->devise)
                                                                                                                                                                              {{'selected'}}
                                                                                                                                                                              @endif value="FCFA">FCFA</option><option @if( isset($tab_proposition[$da->id]) && "EURO"==$tab_proposition[$da->id]->devise) {{'selected'}}@endif value="EURO">EURO</option></select></td>
                                                <td><input type="checkbox" value="1" id="row_n_{{$da->id}}_tva" name="row_n_{{$da->id}}_tva" checked/>   </td>
                                                <td><div class="row"><div class="col-sm-6"><button type="button" class="btn_supp btn btn-danger" title="SUPPRIMER"><i class="fa fa-trash"></i></button></div></div>   </td>
                                            </tr>
                                        @endforeach


                                        </tbody>

                                    </table>

                                    <input type="button" class="btn btn-success pull-right" id="soumettre" name="soumettre" value="Soumettre" />
                                    <input type="button" class="btn btn-danger pull-left" id="supprimer" name="supprimer" value="Suppression mutiple" />

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
                                            <th class="dt-head-center">id</th>
                                            <th class="dt-head-center">id_materiel</th>
                                            <th class="dt-head-center">N°D.A</th>
                                            <th>Code Analytique</th>
                                            <th>Code Gestion</th>
                                            <th class="dt-head-center" width="20%">Matériel et consultation</th>
                                            <th class="dt-head-center">Reference Fournisseur</th>
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
                                                    </div>
                                                </td>
                                                <td><div class="form-group">
                                                        <select class="form-control selectpicker" id="row_n_{{$devi->id}}_codeGestion" name="row_n_{{$devi->id}}_codeGestion" data-live-search="true" data-size="6" required >
                                                            <option  value="">SELECTIONNER</option>
                                                            @foreach($gestions as $gestion)

                                                                <option @if(isset($devi->codeGestion) && $gestion->codeGestion==$devi->codeGestion)
                                                                        {{'selected'}}
                                                                        @endif value="{{$gestion->codeGestion}}" data-subtext="{{$gestion->description}}">{{$gestion->codeGestion}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </td>

                                                <td>


                                                    <input type="text" value="{{$devi->titre_ext}}" id="row_n_{{$devi->id}}_titre_ext" name="row_n_{{$devi->id}}_titre_ext"/>

                                                </td>
                                                <td>
                                                    <input type="text" value="{{$devi->referenceFournisseur}}" id="row_n_{{$devi->id}}_ref" name="row_n_{{$devi->id}}_ref"/>
                                                </td>
                                                <td> <input min="0" type="number" step="any" value="{{$devi->quantite}}" class="form-control" id="row_n_{{$devi->id}}_quantite" name="row_n_{{$devi->id}}_quantite">
                                                    <select class="form-control selectpicker col-sm-4" id="row_n_{{$devi->id}}_unite" name="row_n_{{$devi->id}}_unite" data-live-search="true" data-size="6">
                                                        @foreach($tab_unite['nothing'] as $unite)
                                                            <option value="{{$unite}}" {{$unite==$devi->unite?"selected":''}}>{{$unite}}</option>
                                                        @endforeach
                                                        @if(isset($tab_unite['La longueur']))
                                                        <optgroup label="La longeur">
                                                            @foreach($tab_unite['La longueur'] as $unite)
                                                                <option value="{{$unite}}" {{$unite==$devi->unite?"selected":''}}>{{$unite}}</option>
                                                            @endforeach
                                                        </optgroup>
                                                            @endif
                                                            @if(isset($tab_unite['La masse']))
                                                        <optgroup label="La masse">
                                                            @foreach($tab_unite['La masse'] as $unite)
                                                                <option value="{{$unite}}" {{$unite==$devi->unite?"selected":''}}>{{$unite}}</option>
                                                            @endforeach
                                                        </optgroup>
                                                            @endif
                                                            @if(isset($tab_unite['Le volume']))
                                                        <optgroup label="Le volume">
                                                            @foreach($tab_unite['Le volume'] as $unite)
                                                                <option value="{{$unite}}" {{$unite==$devi->unite?"selected":''}}>{{$unite}}</option>
                                                            @endforeach
                                                        </optgroup>
                                                            @endif
                                                            @if(isset($tab_unite['La surface']))
                                                        <optgroup label="La surface">
                                                            @foreach($tab_unite['La surface'] as $unite)
                                                                <option value="{{$unite}}" {{$unite==$devi->unite?"selected":''}}>{{$unite}}</option>
                                                        @endforeach
                                                                @endif
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
                                    <input type="button" class="btn btn-danger pull-left" id="supprimer1" name="supprimer" value="Suppression mutiple" />

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
                    $.get("supprimer_def_devis/"+data[1], function(data, status){
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
                    $.get("supprimer_def_devis2/"+data[1], function(data, status){
                        console.log(data);
                        window.location.reload()
                    });

                }

            });

            //debut
            var table1 = $('#gestion_reponse_fournisseur').DataTable({
                "columnDefs": [
                    {
                        'targets': 0,
                        'checkboxes': {
                            'selectRow': true
                        }
                    }
                ],
                language: {
                    url: "public/js/French.json"
                },
                "ordering":true,
                "paging": false,
                responsive: false,
            }).column(2).visible(false);
            var table2 = $('#gestion_reponse_fournisseur1').DataTable({
                "columnDefs": [
                    {
                        'targets': 0,
                        'checkboxes': {
                            'selectRow': true
                        }
                    }
                ],
                language: {
                    url: "public/js/French.json"
                },
                "ordering":true,
                "paging": false,
                responsive: false,

            }).column(1).visible(false).column(2).visible(false);

            $('#gestion_reponse_fournisseur').on( 'click', 'tr', function () {



            } );


            $('#soumettre').click( function() {



                if( confirm('Seule les devis avec le code de gestion, le fournisseur et le prix précisés seront soumis. Voulez vous soumettre le(s) devis?')){
                    var data = table1.rows().data();
                    var lesId;
                    var lesIdmat;
                    console.log(data);
                    data.each(function (value, index) {
                        // var valeur=parseInt(value);
                        var valeur=value+'';
                        var  text=valeur.split(",");
                        if(typeof(valeur)!=="undefined"){
                            lesId=lesId+','+text[1];
                            lesIdmat=lesIdmat+','+text[2];
                        }


                    });
                    var res;
                    //console.log(lesId);
                    res=table1.$('input, select').serialize();

                    //   console.log(res);
                    //enregistrer_devis/"+res+"/"+lesId+"/"+lesIdmat
                    var csrf_token = $('meta[name="csrf-token"]').attr('content');
                    $.post("enregistrer_devis",{res:res,lesId:lesId,lesIdmat:lesIdmat,_token: "{{ csrf_token() }}"},
                            function (data) {
                                console.log(data);
                                if(data==1){
                                    location.reload();
                                }
                            }
                    );
                    return false;
                }

            } );

            $('#supprimer').click( function() {



                if( confirm(' Voulez vous supprimer le(s) devis?')){
                    var rows_selected = table1.column(0).checkboxes.selected();
                    console.log(rows_selected);
                    var lesId="";
                    $.each(rows_selected, function(index, rowId){
                        // Create a hidden element
                        lesId=lesId+','+rowId;

                    });

                       console.log(lesId);
                    //enregistrer_devis/"+res+"/"+lesId+"/"+lesIdmat
                    var csrf_token = $('meta[name="csrf-token"]').attr('content');
                    $.post("supprimer_def_devis_collectif",{lesId:lesId,_token: "{{ csrf_token() }}"},
                            function (data) {
                                console.log(data);
                                if(data=="ok"){
                                    location.reload();
                                }
                            }
                    );
                    return false;
                }

            } );
            $('#supprimer1').click( function() {



                if( confirm(' Voulez vous supprimer le(s) devis?')){
                    var rows_selected = table2.column(0).checkboxes.selected();
                    console.log(rows_selected);
                    var lesId="";
                    $.each(rows_selected, function(index, rowId){
                        // Create a hidden element
                        lesId=lesId+','+rowId;

                    });

                    console.log(lesId);
                    //enregistrer_devis/"+res+"/"+lesId+"/"+lesIdmat
                    var csrf_token = $('meta[name="csrf-token"]').attr('content');
                    $.post("supprimer_def_devis2_collectif",{lesId:lesId,_token: "{{ csrf_token() }}"},
                            function (data) {
                                console.log(data);
                                if(data=="ok"){
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