@extends('layouts.app')
@section('fournisseurs')
    class='active'
@endsection
@section('parent_fournisseurs')
    class='active'
    @endsection
@section('content')

    <h2>LES FOURNISSEURS</h2>

    <div class="table-responsive">
    @include('fournisseurs/list_fournisseur')
        <a href="{{route('ajouter_fournisseur')}}"  class="btn btn-success col-sm-2 pull-right" >
            Ajouter un fournisseur
        </a>

    </div>
@endsection