@extends('layouts.app')

@section('gestion_bc')
    class='active'
@endsection
@section('choix_offre')
    class='active'
@endsection

@section('content')

    <h2>DESIGNATION DE LA MEILLEUR OFFRE</h2>
    </br>
<div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <b><label for="libelle" class="control-label">Les demmandes d'approvisionnements</label></b>
                <div class="">
                    <select class="form-control selectpicker " id="id_fournisseur" name="id_fournisseur" data-live-search="true" data-size="6" required>
                        <option value="" >SELECTIONNER UN FOURNISSEUR</option>

                    </select>
                </div>
            </div>
        </div>
</div>
    <a href="#" class="btn btn-success pull-right" id="Ajouter_pro" data-target='#ajouterrep' data-toggle='modal'>Ajouter un bon de commande</a>   <br>
    <div class="row">
        <div class="col-sm-offset-2 col-sm-8" > </div>
    </div>

    @if(isset($bc))
        <script>
            $(document).ready(function () {
                $('#ajouterrep').modal('show');
            });
        </script>
    @endif
@endsection

