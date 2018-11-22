
@extends('layouts.app')
@section('fournisseurs')
    class='active'
@endsection
@section('parent_fournisseurs')
    class='active'
@endsection
@section('content')
    <h2>LES FOURNISSEURS - {{isset($fournisseur)? 'MODIFIER FOURNISSEUR':'AJOUTER FOURNISSEUR'}}</h2>
    <div class="row">
                <div class="col-sm-4">
@if(isset($fournisseur))

                            <form role="form" id="FormRegister" class="bucket-form" method="post" action="{{route('modifier_fournisseur')}}">
    @else
                                    <form role="form" id="FormRegister" class="bucket-form" method="post" action="{{route('Validfournisseur')}}">
    @endif


                        @csrf
                        <div class="form-group">
                            <b><label for="libelle" class="control-label">Libelle</label></b>
                            <input type="text" class="form-control" id="libelle" name="libelle" placeholder="libelle" value="{{isset($fournisseur)? $fournisseur->libelle:''}}" required>
                        </div>
                        <div class="form-group">
                            <label for="domaine">Domaine</label>

                            <select class="form-control selectpicker" id="domaine" name="domaine[]" data-live-search="true" data-size="6"  multiple required>
                                <option  value="">SELECTIONNER UN DOMAINE</option>
                                @foreach($domaines as $domaine)
                                    <option @if(isset($fournisseur) and  in_array($domaine->id, explode(",",$fournisseur->domaine))!= false)
                                            {{'selected'}}
                                            @endif value="{{$domaine->id}}">{{$domaine->libelleDomainne}}</option>
                                @endforeach
                            </select>
                        </div>   <div class="form-group">
                            <label for="domaine">Adresse Géographique</label>
                            <input type="text" class="form-control" id="adresseGeographique" name="adresseGeographique" placeholder="Domaine" value="{{isset($fournisseur)? $fournisseur->adresseGeographique:''}}">
                        </div>
                        <div class="form-group">
                            <label for="domaine">Condition de paiement</label>
                            <input type="text" class="form-control" id="conditionPaiement" name="conditionPaiement" placeholder="Condition de Paiement" value="{{isset($fournisseur)? $fournisseur->conditionPaiement:''}}">
                        </div>

                        <div class="form-group">
                            <label for="responsable">Responsable</label>
                            <input type="text" class="form-control" id="responsable" name="responsable" placeholder="responsable" value="{{isset($fournisseur)? $fournisseur->responsable:''}}">
                        </div>
                        <div class="form-group">
                            <label for="interlocuteur">Interlocuteur</label>
                            <input type="text" class="form-control" id="interlocuteur" name="interlocuteur" placeholder="interlocuteur" required value="{{isset($fournisseur)? $fournisseur->interlocuteur:''}}" >
                        </div>
                        <div class="form-group">
                            <label for="email">E - mail</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="E -mail" value="{{isset($fournisseur)? $fournisseur->email:''}}" required>
                        </div>
                        <div class="form-group">
                            <label for="commentaire">Commentaire</label>
                            <textarea id="commentaire" name="commentaire" class="form-control col-sm-8">{{isset($fournisseur)? $fournisseur->commentaire:''}}</textarea>
                        </div>
                        <input type="hidden" class="form-control" id="slug" name="slug" placeholder="" value="{{isset($fournisseur)? $fournisseur->slug:''}}">
                        <br><div class="form-group" >
                            <button type="submit" class="btn btn-success form-control">{{isset($fournisseur)? 'Modifier':'Ajouter'}}</button>
                        </div>
                        @if(isset($fournisseur))
                            <a href="{{route('ajouter_fournisseur')}}">Ajouter un fournisseur</a>
                            @endif

                    </form>
                </div>
                <div class="col-sm-8">
                    @include('fournisseurs/list_fournisseur')
                </div>

        <script>

            var table= $('#fournisseurs1').DataTable({
                language: {
                    url: "js/French.json"
                },
                "ordering":true,
                "responsive": true,
                "createdRow": function( row, data, dataIndex){

                }
            }).column(0).visible(false);
            //table.DataTable().draw();

        </script>
    </div>
@endsection