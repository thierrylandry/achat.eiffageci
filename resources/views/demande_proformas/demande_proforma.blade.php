@extends('layouts.app')
@section('demande_proformas')
    class='active'
@endsection
@section('parent_demande_proformas')
    class='active'
@endsection
@section('content')
    <h2>LES PRODUITS ET SERVICES</h2>

    <div class="table-responsive">

        <table name ="fournisseurs" id="fournisseurs" class='table table-bordered table-striped  no-wrap '>

            <thead>

            <tr>
                <th class="dt-head-center">id</th>
                <th class="dt-head-center">Libelle materiel</th>
                <th class="dt-head-center">type</th>
                <th class="dt-head-center">Action</th>

            </tr>
            </thead>
            <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">
            @foreach($produits as $produit )
                <tr>
                    <td>{{$produit->id_materiel}}</td>
                    <td>{{$produit->libelleMateriel}}</td>
                    <td>{{$produit->type}}</td>
                    <td> <a href="#myModal" data-toggle="modal" class="btn btn-info col-sm-4 pull-right">
                            Mofifier
                        </a>
                        <a href="#myModal" data-toggle="modal" class="btn btn-danger col-sm-4 pull-right">
                            Supprimer
                        </a>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
        <a href="#myModal" data-toggle="modal" class="btn btn-success col-sm-2 pull-right">
            Ajouter un fournisseur
        </a>
    </div>

@endsection