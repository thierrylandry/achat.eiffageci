
@extends('layouts.app')
@section('prix')
    class='active'
@endsection
@section('parent_fournisseurs')
    class='active'
@endsection
@section('content')
    <h2>LES TABLEAUX DES PRIX - {{isset($prix)? 'MODIFIER LE PRIX':'AJOUTER UN PRIX'}}</h2>
    <div class="row">
                <div class="col-sm-4">
@if(isset($prix))

                            <form role="form" id="FormRegister" class="bucket-form" method="post" action="{{route('modifier_prix')}}">
    @else
                                    <form role="form" id="FormRegister" class="bucket-form" method="post" action="{{route('Validprixs')}}">
    @endif


                        @csrf
                                        <div class="form-group">
                                            <b><label for="libelle" class="control-label">Fournisseur</label></b>
                                        <select class="form-control selectpicker" id="id_fournisseur" name="id_fournisseur" data-live-search="true" data-size="6" required>
                                            <option value="" >SELECTIONNER UN FOURNISSEUR</option>
                                            @foreach($fournisseurs as $fournisseur)
                                                <option @if(isset($prix) and $fournisseur->id==$prix->id_fournisseur)
                                                        {{'selected'}}
                                                        @endif value="{{$fournisseur->id}}">{{$fournisseur->libelle}}--{{$fournisseur->domaine}}--{{$fournisseur->conditionPaiement}}</option>
                                                @endforeach
                                        </select>
                                        </div>
                                        <div class="form-group">
                                            <b><label for="libelle" class="control-label">Materiel</label></b>
                                            <select class="form-control  selectpicker" id="id_materiel" name="id_materiel" data-live-search="true" data-size="6" required>
                                                <option value="" >SELECTIONNER UN MATERIEL</option>
                                                @foreach($materiels as $materiel)
                                                    <option
                                                            @if(isset($prix) and $materiel->id==$prix->id_materiel)
                                                            {{'selected'}}
                                                            @endif value="{{$materiel->id}}">{{$materiel->libelleMateriel}}--{{$materiel->type}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <b><label for="libelle" class="control-label">Prix</label></b>
                                            <input type="number" class="form-control" id="prix" name="prix" placeholder="libelle"  value="{{isset($prix)? $prix->prix:''}}" required>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <b><label for="libelle" class="control-label ">Quantité</label></b>
                                            <input type="number" class="form-control"  placeholder="libelle"   value="1" required disabled>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="type">Unite</label>
                                            <input type="text" class="form-control " id="unite" name="unite" placeholder="unite" value="{{isset($prix)? $prix->unite:''}}" required>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="type">Date</label>
                                            <input type="date" class="form-control " id="date" name="date" placeholder="date" value="{{isset($prix)? $prix->date:''}}" required>
                                        </div>
                        <input type="hidden" class="form-control" id="slug" name="slug" placeholder="" value="{{isset($prix)? $prix->slug:''}}">
                        <br>
                                        <div class="form-group" >
                            <button type="submit" class="btn btn-success form-control">{{isset($prix)? 'Modifier':'Ajouter'}}</button>
                        </div>
                        @if(isset($prix))
                            <a href="{{route('gestion_prix')}}">Ajouter un prix</a>
                            @endif

                    </form>
                </div>
                <div class="col-sm-8">
                    @include('prix/list_prix')
                </div>


    </div>
@endsection