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
                    <h4 class="modal-title">{{__('menu.import_codetache')}}</h4>
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


@endsection