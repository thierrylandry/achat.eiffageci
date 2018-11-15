@extends('layouts.app')
@section('produits')
    class='active'
@endsection
@section('parent_produits')
    class='active'
@endsection
@section('content')
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 class="modal-title">Modifier un fournisseur</h4>
                </div>
                <div class="modal-body">

                    <form role="form" class="bucket-form" method="post" action="{{route('Validfournisseur')}}">
                        @csrf
                        <div class="form-group">
                            <b><label for="libelle" class="control-label">Libelle du matériel</label></b>
                            <input type="text" class="form-control" id="libelle" name="libelle" placeholder="libelle" required>
                        </div>
                        <div class="form-group">
                            <label for="domaine">type</label>
                            <input type="text" class="form-control" id="domaine" name="domaine" placeholder="Domaine" required>
                        </div>
                        <br><div class="form-group" >
                            <button type="submit" class="btn btn-success form-control">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 class="modal-title">Modifier un fournisseur</h4>
                </div>
                <div class="modal-body">

                    <form role="form" class="bucket-form" method="post" action="{{route('Validfournisseur')}}">
                        @csrf
                        <div class="form-group">
                            <b><label for="libelle" class="control-label">Libelle du matériel</label></b>
                            <input type="text" class="form-control" id="libelle" name="libelle" placeholder="libelle" required>
                        </div>
                        <div class="form-group">
                            <label for="domaine">type</label>
                            <input type="text" class="form-control" id="domaine" name="domaine" placeholder="Domaine" required>
                        </div>
                        <br><div class="form-group" >
                            <button type="submit" class="btn btn-success form-control">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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