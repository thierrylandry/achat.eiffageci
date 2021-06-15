@extends('layouts.app')
@section('gestion_bc')
    class='active'
@endsection

@section('content')

    <h2>{{strtoupper(__('neutrale.les_bons_commandes'))}}  - {{__('neutrale.gestion')}}</h2>
    <div id="ajouterrep" class="modal fade in" aria-hidden="true" role="dialog" >
        <div class="modal-dialog modal-md">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{__('dashboard.bc')}}</h4>
                </div>
                        <form class="form-horizontal" action="{{route('save_bc')}}" method="post">
@csrf
                <div class="modal-body">
<input type="hidden" name="slug"  value="{{isset($bc)? $bc->slug:''}}"/>
<input type="hidden" name="locale"  value="{{App()->getLocale()}}"/>
                    <div class="form-group">
                        <b><label for="libelle" class="control-label col-sm-6">{{__('neutrale.projet')}}:</label></b>
                        <div class="col-sm-6">
                            <select class="form-control selectpicker " id="id_projet" name="id_projet" data-live-search="true" data-size="6" required>
                                @foreach($projets as $projet)
                                    @if(isset($bc) && $bc->id_projet==$projet->id)
                                        {{$selec="selected"}}
                                    @else
                                        {{$selec=""}}
                                    @endif

                                    <option value="{{$projet->id}}" {{$selec}}>{{$projet->libelle}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                        <div class="form-group">
                            <label class="control-label col-sm-6" for="numbc">{{__('neutrale.numero_bc')}}:</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="numbc" name="numbc" placeholder="Enter un numero" value="@if(isset($bc)){{$bc->numBonCommande}}@elseif(isset($suggestion)){{$suggestion}}@else @endif" {{isset($bc)? 'disabled':''}}   required>
                            </div>
                        </div>

                        <div class="form-group">
                            <b><label for="libelle" class="control-label col-sm-6">{{__('menu.fournisseurs')}}:</label></b>
                            <div class="col-sm-6">
                            <select class="form-control selectpicker " id="id_fournisseur" name="id_fournisseur" data-live-search="true" data-size="6" required>
                                <option value="" >{{__('neutrale.selectionner_fournisseur')}}</option>
                                @foreach($fournisseurs as $fournisseur)
                                    @if(isset($bc) && $bc->id_fournisseur==$fournisseur->id)
                                       {{$selec="selected"}}
                                    @else
                                        {{$selec=""}}
                                    @endif

                                    <option value="{{$fournisseur->id}}-{{$fournisseur->devise}}" {{$selec}}>{{$fournisseur->libelle}} ({{$fournisseur->devise}})</option>
                                    @endforeach
                            </select>
                            </div>
                        </div>
                    <div class="form-group">
                            <b><label for="libelle" class="control-label col-sm-6">{{__('neutrale.expediteur')}}:</label></b>
                            <div class="col-sm-6">
                            <select class="form-control selectpicker " id="id_expediteur" name="id_expediteur" data-live-search="true" data-size="6" required>
                                <option value="" >{{__('neutrale.selectionner_expediteur')}}</option>
                                @foreach($expediteurs as $expediteur)
                                    @if( Auth::user()->id==$expediteur->id)
                                       {{$selec="selected"}}
                                    @else
                                        {{$selec=""}}
                                    @endif

                                    <option value="{{$expediteur->id}}" {{$selec}}>{{$expediteur->nom}} ({{$expediteur->email}})</option>
                                    @endforeach
                            </select>
                            </div>
                        </div>

                </div>
            <div class="modal-footer">

                        <button type="submit" class="btn btn-default">@if(!isset($bc)) {{ __('translation.add') }} @else {{ __('translation.update') }}  @endif</button>
            </div>
                </form>
        </div>

    </div>
    </div>


<!-- debut  -->


    <div id="personnaliser_mail" class="modal fade in" aria-hidden="true" role="dialog" >
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Personnaliser l'E-mail</h4>
                </div>

                            <form action="{{route('send_it_personnalisé')}}" onsubmit="return confirm('{{__('translation.confirmation')}}');"  method="post" enctype="multipart/form-data">

                                @csrf
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <div class="card card-primary card-outline">


                                            <!-- /.card-header -->
                                            <div class="card-body">
                                                <input  name="bcc" id="bcc" class="form-control" style="visibility: hidden"/>
                                                <div class="form-group">
                                                    <input id="To" name="To" class="form-control" placeholder="To:" readonly>

                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control selectpicker " name="cc" id="cc" data-live-search="true" data-size="6" multiple data-none-selected-text="Mettre en copie" >

                                                            @if(isset($users))  @foreach($users as $user)
                                                                <option value="{{$user->email}}">{{$user->nom.' '.$user->prenoms }}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>

                                                </div>
                                                <div class="form-group">
                                                    <input class="form-control" placeholder="Subject:" name="objet" id="objet" value="" >
                                                </div>
                                                <div class="form-group">

                    <textarea  id="compose-textarea" name="compose-textarea" class="form-control"  style="overflow-y: scroll;max-height: 300px;min-height: 300px;"></textarea>

                                                </div>
                                                <div class="form-group">
                                                    <input type="file" class="form-control" name="pj" id="pj" value="" >
                                                </div>

                                            </div>

                                            <!-- /.card-footer -->
                                        </div>
                                        <!-- /. box -->
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="float-right">
                                        <button type="submit" id="send_it_personnalisé" class="btn btn-primary"> <i class="fa fa-file-pdf-o"></i> <i class="fa fa-envelope-o"></i> <i class="fa fa-paper-plane-o"></i></button>
                                    </div>

                                </div>
                            </form>
            </div>

        </div>
    </div>
    <!-- test -->
    <div id="date_livraison" class="modal fade in" aria-hidden="true" role="dialog" >
        <div class="modal-dialog modal-md">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{__('reception.date_livraison')}}</h4>
                </div>

                    <form  action="{{route('add_date_livraison')}}" method="post">
                                @csrf

                                <div class="modal-body">
                                    <input type="hidden" name="bc_slug" id="bc_slug_1" required  />

                                    <input type="date" name="date_livraison" id="date_livraison" required />

                                </div>
                                <div class="modal-footer">
                                    <button type="submit" id="enregistrer_date_livraison" >
                                        <i class="fa fa-file-pdf-o"></i><i class="fa fa-paper-plane-o"></i> {{__('neutrale.enregistrer')}}
                                    </button>
                                </div>
                            </form>
            </div>

        </div>
    </div>
    <!-- fin -->
    <!-- fin -->
    <div id="list_devis" class="modal fade in" aria-hidden="true" role="dialog" >
        <div class="modal-dialog modal-md">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">BC N°  <input type="text" readonly id="numbcc" value="" />   </h4>
                </div>
<form method="post" action="{{route('preciser_les_date_de_livraison')}}">
    @csrf
    <input type="hidden" name="lesidd" id="lesidd" value=""/>
                <div class="modal-body" >
                    <h4>Liste des lignes de commandes</h4>
                    <table id="contenu_devis" class='table table-bordered table-striped  no-wrap '>
                        <thead>
                        <tr>
                            <td>id_devis</td>
                            <td>titre_ext</td>
                            <td>quantite</td>
                            <td>date de livraison effective</td>
                        </tr>

                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                </div>
                                <div class="modal-footer">

                                    <button type="submit" class="btn btn-default" id="btn_enregistrer_date_livraison1"> <i class="fa fa-calendar-check-o"></i>Enregistrer</button>
                                </div>
</form>
            </div>

        </div>
    </div>

    <div id="confirm_email" class="modal fade in" aria-hidden="true" role="dialog" >
        <div class="modal-dialog modal-md">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Confirmer l'adresse email</h4>
                </div>
                @if(isset($devis))
                    <form  action="{{route('update_ligne_bc')}}" method="post">
                        @else
                            <form action="{{route('send_it')}}" onsubmit="return confirm(__('translation.confirmation'));" method="post">
                                @endif
                                @csrf

                                <div class="modal-body">
                                    <input type="text" name="bc_slug" id="bc_slug" style="visibility: hidden" required  />
                                    <input type="text" name="contact" id="contact" style="visibility: hidden" required />
                                    <div id="jstree" >

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="" data-toggle="modal" data-target="#personnaliser_mail" class="btn btn-default" id="personnaliser">
                                        <i class="fa fa-file-pdf-o"></i><i class="fa fa-paper-plane-o"></i> personnaliser le message avant de l'envoyer
                                    </a>
                                    <button type="submit" class="btn btn-default"> <i class="fa fa-file-pdf-o"></i><i class="fa fa-paper-plane-o"></i></button>
                                </div>
                            </form>
            </div>

        </div>
    </div>

<div class="row">
    <a href="{{route('gestion_bc_ajouter',app()->getLocale())}}" class="btn btn-success pull-right" id="Ajouter_pro" > {{ __('translation.add') }}</a>

</div>
       <div class="row">
        <div class=" col-sm-12" >    @include('BC/list_bc')</div>
    </div>

    @if(isset($bc) || isset($ajouter))
    <script>
        $(document).ready(function () {
            $('#ajouterrep').modal('show');
        });
    </script>
    @endif

    @if(isset($ajouterbc))
        <script>
            $(document).ready(function () {
                $('#ajoutercom').modal('show');
            });
        </script>
    @endif
    @if(isset($listerbc))
        <script>
            $(document).ready(function () {
                $('#listerbc').modal('show');
            });
        </script>
    @endif
    @if(isset($modifierlignebc))
        <script>
            $(document).ready(function () {
                $('#ajoutercom').modal('show');

            });
        </script>
    @endif

    <script>

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

        function ilisibilite_nombre(valeur){

            for(var i=valeur.length-1; i>=0; i-- ){valeur=valeur.toString().replace(' ','');

            }

            return valeur;

        }

        $(document).ready(function () {
            $('#personnaliser').click(function(e){
                var rows_selected = table.column(0).checkboxes.selected();
                var testselect=0;
                var testrow=0;

            });


            $('#id_reponse_fournisseur').change(function (e) {
                var proforma=$("#id_reponse_fournisseur").val();
                if(proforma!=''){
                    $.get("../detail_rep_fournisseur/"+proforma,
                            function (data) {
                                $('#quantite').val(data.quantite);
                                $('#Unite').val(data.unite);
                                $('#Prix').val(lisibilite_nombre(data.prix-(data.prix*data.remise)/100));
                                $('#Prix_unitaire').val(data.prix);
                                $('#remise').val(data.remise);

                            }
                    );
                }else{
                    $('#quantite').val('');
                    $('#Unite').val('');
                    $('#Prix').val('');
                    $('#Prix_unitaire').val('');
                    $('#remise').val('');
                }

            });

        $('#quantite').change(function (e){
 var qte= $('#quantite').val();
            var remise= $('#remise').val();

            var prix_unitaire=$('#Prix_unitaire').val();
            var tot=qte*prix_unitaire;
            var remise_montant=(tot*remise)/100;
            var tot_avec_remise=tot-remise_montant
            $('#Prix').val(lisibilite_nombre(tot_avec_remise));
        });




            $('#id_fournisseur').change(function (e){
                $('#lesemails').empty();
                var valeur=$('#id_fournisseur').val();
                $.get("les_das_fournisseurs_funct_da/"+valeur,
                        function (data) {
var resultat=JSON.parse(data);
                            console.log(valeur);
                            var chaine="";
                            $.each(resultat, function( indexi, value ) {

                                chaine+="<option value='"+value.valeur_c+"'>"+value.valeur_c+"</option>";

                            });

                            $('#lesemails').empty();
                            $('#lesemails').append(chaine);
                            $('#lesemails').selectpicker('refresh');
                        }
                );
            });

            $("body").on("click","#envoie_fourniseur",function(){
var data=table1.row($(this).closest('tr')).data();
                var id=data[Object.keys(data)[0]];
                var fournisseur=data[Object.keys(data)[3]];
                var numbbc=data[Object.keys(data)[2]];
                $('#bc_slug').val(id);
                $('#bcc').val(id);
                $('#objet').val(fournisseur+"/BC N°"+numbbc.replace("PHB-815140-","")+"/EGC-CI EIFFAGE");

                $.get("list_contact/"+id,
                        function (data) {
                            //   $('#jstree').empty();
                            var chaine= "<ul>";

                            var resultat= JSON.parse(data);
                            console.log(resultat);

var le_selectionne="";
                            $.each(resultat, function( indexi, valeur ) {
                                if(le_selectionne==''){
                                    le_selectionne=valeur.valeur_c;
                                }

                                chaine+="<li id='"+valeur.valeur_c+"'>"+valeur.valeur_c+"</li>";

                            });

                            chaine+="</ul>";
                            // $('#jstree').append(chaine);
                            $('#jstree').jstree(true).settings.core.data = chaine;
                            $('#jstree').jstree(true).refresh();
                            $('#jstree').jstree('select_node', le_selectionne);

                           // $('#fourn').selectpicker('refresh');
                            console.log(data);
                        }
                );

            });

            $('#jstree').on("changed.jstree", function (e,data){

                selection=$('#jstree').jstree(true).get_bottom_selected(true);

                valeur="";
                $.each(selection,function (index, value) {


                        valeur=valeur+ ','+value.id;
                });
                $('#contact').val(valeur);

                console.log(selection);

            });



        });

        $('#compose-textarea').change(function(){
            $('#msg').empty();
            var valeur=$("#compose-textarea").html();
            $('#msg').append(valeur);
        });
        $("#btn_add_date_livraison").click(function (e) {
            var data=table1.row($(this).closest('tr')).data();
            var id=data[Object.keys(data)[0]];
            $('#bc_slug_1').val(id);
        });
$('#personnaliser').click(function(){
    $('#To').empty();
    $("#compose-textarea").empty();
    $('#confirm_email').modal('hide');
    $('#To').val(valeur.substring(1,valeur.length));

    var bc_slug="";

    bc_slug=$('#bc_slug').val();

    $.get("afficher_le_mail/"+bc_slug,
            function (data) {
            var    html = $.parseHTML( data ),nodeNames = [];
                console.log(html);
             //   $("#compose-textarea").val(html[0].innerText);
                $('#bcc').val(bc_slug);
            }
    );
})



    </script>
@endsection

