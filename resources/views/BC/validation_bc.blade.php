@extends('layouts.app')
@section('validation_bc')
    class='active'
@endsection

@section('content')
    <h2>{{strtoupper(__('neutrale.les_bons_commandes'))}}  - {{__('neutrale.validation')}}</h2>

</br>
    <div class="row">
        <div class=" col-sm-12" >    @include('BC/list_bc_validation')</div>
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
                var data=table1.row($(this).closest('tr')).data();
                var id=data[Object.keys(data)[0]];
                $('#bc_slug').val(id);
                $('#bcc').val(id);

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

