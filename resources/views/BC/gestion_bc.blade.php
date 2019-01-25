@extends('layouts.app')
@section('gestion_bc')
    class='active'
@endsection

@section('content')

    <h2>LES BONS DE COMMANDES - GESTION</h2>
    <div id="ajouterrep" class="modal fade in" aria-hidden="true" role="dialog" >
        <div class="modal-dialog modal-md">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Bon de commande</h4>
                </div>
                        <form class="form-horizontal" action="{{route('save_bc')}}" method="post">
@csrf
                <div class="modal-body">
<input type="hidden" name="slug"  value="{{isset($bc)? $bc->slug:''}}"/>
                        <div class="form-group">
                            <label class="control-label col-sm-6" for="numbc">Bon de commande N°:</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="numbc" name="numbc" placeholder="Enter un numero" value="{{isset($bc)? $bc->numBonCommande:''}}" {{isset($bc)? 'disabled':''}}   required>
                            </div>
                        </div>

                        <div class="form-group">
                            <b><label for="libelle" class="control-label col-sm-6">Fournisseur:</label></b>
                            <div class="col-sm-6">
                            <select class="form-control selectpicker " id="id_fournisseur" name="id_fournisseur" data-live-search="true" data-size="6" required>
                                <option value="" >SELECTIONNER UN FOURNISSEUR</option>
                                @foreach($fournisseurs as $fournisseur)
                                    @if(isset($bc) && $bc->id_fournisseur==$fournisseur->id)
                                       {{$selec="selected"}}
                                    @else
                                        {{$selec=""}}
                                    @endif

                                    <option value="{{$fournisseur->id}}" {{$selec}}>{{$fournisseur->libelle}}</option>
                                    @endforeach
                            </select>
                            </div>
                        </div>

                </div>
            <div class="modal-footer">

                        <button type="submit" class="btn btn-default">{{isset($bc)?'Modifier':'Enregistrer'}}</button>
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

                            <form action="{{route('send_it')}}" method="post">


                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <div class="card card-primary card-outline">

                                            <!-- /.card-header -->
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <input id="To" class="form-control" placeholder="To:" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <input class="form-control" placeholder="Subject:" value="TRANSMISSION DE BON DE COMMANDE" readonly>
                                                </div>
                                                <div class="form-group">
                    <div contentEditable="true" id="compose-textarea" class="form-control"  style="overflow-y: scroll;max-height: 300px;min-height: 300px;"></div>
                                                </div>

                                            </div>

                                            <!-- /.card-footer -->
                                        </div>
                                        <!-- /. box -->
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="float-right">
                                        <button type="submit" class="btn btn-primary"> <i class="fa fa-file-pdf-o"></i> <i class="fa fa-envelope-o"></i> <i class="fa fa-paper-plane-o"></i></button>
                                    </div>

                                </div>
                            </form>
            </div>

        </div>
    </div>
    <!-- fin -->


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
                            <form action="{{route('send_it')}}" method="post">
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
                                        <i class="fa fa-file-pdf-o"></i><i class="fa fa-paper-plane-o"></i> personnalisé le message avant de l'envoyer
                                    </a>
                                    <button type="submit" class="btn btn-default"> <i class="fa fa-file-pdf-o"></i><i class="fa fa-paper-plane-o"></i></button>
                                </div>
                            </form>
            </div>

        </div>
    </div>


    <a href="{{route('gestion_bc_ajouter')}}" class="btn btn-success pull-right" id="Ajouter_pro" >Ajouter un bon de commande</a>   <br>
    <div class="row">
        <div class="col-sm-offset-2 col-sm-8" >    @include('BC/list_bc')</div>
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
var data=table.row($(this).closest('tr')).data();
                var id=data[Object.keys(data)[0]];
                $('#bc_slug').val(id);

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

$('#personnaliser').click(function(){
    $('#To').empty();
    $("#compose-textarea").empty();
    $('#confirm_email').modal('hide');
    $('#To').val(valeur.substring(1,valeur.length));

    $.get("afficher_le_mail/9",
            function (data) {
            var    html = $.parseHTML( data ),nodeNames = [];
                console.log(html);
                $("#compose-textarea").append(html[0]);
            }
    );
})


    </script>
@endsection

