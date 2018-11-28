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
                        <title> Fiche de commande</title>

                        <div class="form-group">
                            <label class="control-label col-sm-6" for="numbc">Bon de commande N°:</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="numbc" name="numbc" placeholder="Enter un numero" value="{{isset($bc)? $bc->numBonCommande:''}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-6" for="date">Date:</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="date" name="date" >
                            </div>
                        </div>
                        <div class="form-group">
                            <b><label for="libelle" class="control-label col-sm-6">Fournisseur</label></b>
                            <div class="col-sm-6">
                            <select class="form-control selectpicker " id="id_fournisseur" name="id_fournisseur" data-live-search="true" data-size="6" required>
                                <option value="" >SELECTIONNER UN FOURNISSEUR</option>
                                @foreach($fournisseurs as $fournisseur)
                                    <option value="{{$fournisseur->id}}">{{$fournisseur->libelle}}</option>
                                    @endforeach
                            </select>
                            </div>
                        </div>

                </div>
            <div class="modal-footer">
                        <button type="submit" class="btn btn-default">Enregistrer</button>
            </div>
                </form>
        </div>

    </div>
    </div>
    <a href="#" class="btn btn-success pull-right" id="Ajouter_pro" data-target='#ajouterrep' data-toggle='modal'>Ajouter un bon de commande</a>   <br>
    <div class="row">
        <div class="col-sm-offset-2 col-sm-8" >    @include('BC/list_bc')</div>
    </div>

    @if(isset($bc))
    <script>
        $(document).ready(function () {
            $('#ajouterrep').modal('show');
        });
    </script>
    @endif
@endsection

