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
                @if(isset($bc))
                <form class="form-horizontal" action="{{route('modifier_bc')}}" method="post">
                    @else
                        <form class="form-horizontal" action="{{route('save_bc')}}" method="post">
                        @endif
                    @csrf
                <div class="modal-body">
                        <title> Fiche de commande</title>
<input type="hidden" name="slug"  value="{{isset($bc)? $bc->slug:''}}"/>
                        <div class="form-group">
                            <label class="control-label col-sm-6" for="numbc">Bon de commande N°:</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="numbc" name="numbc" placeholder="Enter un numero" value="{{isset($bc)? $bc->numBonCommande:''}}" {{isset($bc)? 'disabled':''}}   required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-6" for="date">Date:</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="date" name="date" value="{{isset($bc)? $bc->date:''}}" >
                            </div>
                        </div>
                        <div class="form-group">
                            <b><label for="libelle" class="control-label col-sm-6">Fournisseur</label></b>
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
                                <p style="color: red;font-size: 12px">NB: Les fournisseurs qui apparaissent ici sont ceux dont les cotations ont élé choisi</p>
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




    <div id="ajoutercom" class="modal fade in" aria-hidden="true" role="dialog" >
        <div class="modal-dialog modal-md">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Commandes</h4>
                </div>
                @if(isset($bc))
                    <form  action="{{route('save_ligne_bc')}}" method="post">
                        @else
                            <form action="{{route('save_ligne_bc')}}" method="post">
                                @endif
                                @csrf

                                <div class="modal-body">
                                    <div class="form-group">
                                        <b><label for="libelle" class="control-label col-sm-6"> les  pro formas du fournisseur </label></b>
                                        <div >
                                            <select class="form-control selectpicker " id="id_reponse_fournisseur" name="id_reponse_fournisseur" data-live-search="true" data-size="6" required>
                                                <option value="" >SELECTIONNER UNE PRO FORMA</option>
                                                @foreach($reponse_fournisseurs as $reponse_fournisseur)


                                                    <option value="{{$reponse_fournisseur->id}}" {{$selec}}> Libellé:{{$reponse_fournisseur->libelleMateriel}} titre externe: ({{$reponse_fournisseur->titre_ext}})</option>
                                                @endforeach
                                            </select>
                                            <p style="color: red;font-size: 12px">NB: Les pro formas listé ici proviennent du fournisseur lié au bon de commande</p>
                                        </div>
                                    </div>

                                    <input type="hidden" name="slugbc"  value="{{isset($slugbc)? $slugbc:''}}"/>
                                    <div class="form-group">
                                        <label class="control-label col-sm-6" for="codeRubrique">Code analytique:</label>
                                        <div class="">
                                            <select class="form-control selectpicker " id="codeRubrique" name="codeRubrique" data-live-search="true" data-size="6" required>
                                                <option value="" >SELECTIONNER UN CODE ANALYTIQUE</option>
                                                @foreach($reponse_fournisseurs as $reponse_fournisseur)


                                                    <option value="{{$reponse_fournisseur->id}}" {{$selec}}> Libellé:{{$reponse_fournisseur->libelleMateriel}} titre externe: ({{$reponse_fournisseur->titre_ext}})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                 <div class="row">
                                    <div class="col-sm-6">
                                        <label class="control-label " for="date">Remise %:</label>
                                        <div class="">
                                            <input type="number" min="0" max="100" class="form-control" id="remise" name="remise" value="" >
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="control-label col-sm-6" for="quantite">Quantité:</label>
                                        <div class="">
                                            <input type="number" min="0" max="100" class="form-control" id="quantite" name="quantite" value="" >
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="control-label col-sm-6" for="Unite">Unité:</label>
                                        <div class="">
                                            <input type="text" class="form-control" id="Unite" name="Unite" value="" >
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="control-label col-sm-6" for="Prix">Prix:</label>
                                        <div class="">
                                            <input type="text"  class="form-control" id="Prix" name="Prix" value="" >
                                        </div>
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
    <script>
        $(document).ready(function () {
            $('#id_reponse_fournisseur').change(function (e) {
                var proforma=$("#id_reponse_fournisseur").val();

                $.get("../detail_rep_fournisseur/"+proforma,
                        function (data) {
$('#quantite').val(data.quantite);
$('#Unite').val(data.unite);
$('#Prix').val(data.prix);

                        }
                );
            });
        });

    </script>
@endsection

