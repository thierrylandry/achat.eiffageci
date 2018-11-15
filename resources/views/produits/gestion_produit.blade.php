
@extends('layouts.app')
@section('produits')
    class='active'
@endsection
@section('parent_fournisseurs')
    class='active'
@endsection
@section('content')
    <h2>LES PRODUITS ET SERVICES - {{isset($produit)? 'MODIFIER FOURNISSEUR':'AJOUTER UN PRODUIT'}}</h2>
    <div class="row">
                <div class="col-sm-4">
@if(isset($produit))

                            <form role="form" id="FormRegister" class="bucket-form" method="post" action="{{route('modifier_produit')}}">
    @else
                                    <form role="form" id="FormRegister" class="bucket-form" method="post" action="{{route('Validproduits')}}">
    @endif


                        @csrf<div class="form-group">
                                            <b><label for="libelle" class="control-label">Libelle du matériel</label></b>
                                            <input type="text" class="form-control" id="libelleMateriel" name="libelleMateriel" placeholder="libelle"  value="{{isset($produit)? $produit->libelleMateriel:''}}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="type">type</label>
                                            <select class="form-control selectpicker" id="type" name="type" data-live-search="true" data-size="6" required>
                                                <option  value="">SELECTIONNER UN DOMAINE</option>
                                                @foreach($domaines as $domaine)
                                                    <option @if(isset($produit) and $produit->type==$domaine->id)
                                                            {{'selected'}}
                                                            @endif value="{{$domaine->id}}">{{$domaine->libelleDomainne}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                        <input type="hidden" class="form-control" id="slug" name="slug" placeholder="" value="{{isset($produit)? $produit->slug:''}}">
                        <br>
                                        <div class="form-group" >
                            <button type="submit" class="btn btn-success form-control">{{isset($produit)? 'Modifier':'Ajouter'}}</button>
                        </div>
                        @if(isset($produit))
                            <a href="{{route('gestion_produit')}}">Ajouter un produit</a>
                            @endif

                    </form>
                </div>
                <div class="col-sm-8">
                    @include('produits/list_produit')
                </div>


    </div>
@endsection