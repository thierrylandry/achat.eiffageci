
@extends('layouts.app')
@section('utilisateurs')
    class='active'
@endsection
@section('parent_fournisseurs')
    class='active'
@endsection
@section('content')
    <h2>LES UTILISATEURS - {{isset($utilisateur)? 'MODIFIER UTILISATEUR':'AJOUTER UTILISATEUR'}}</h2>
    <div class="row">
                <div class="col-sm-4">
@if(isset($utilisateur))

                            <form role="form" id="FormRegister" class="bucket-form" method="post" action="{{route('modifier_utilisateur')}}">
    @else
                                    <form role="form" id="FormRegister" class="bucket-form" method="post" action="{{route('Validutilisateurs')}}">
    @endif


                        @csrf
                        <div class="form-group">
                            <b><label for="name" class="control-label">Nom</label></b>
                            <input type="text" class="form-control" id="name" name="name" placeholder="name" value="{{isset($utilisateur)? $utilisateur->name:''}}" required>
                        </div>
                        <div class="form-group">
                            <label for="domaine">Abréviation</label>
                            <input type="text" class="form-control" id="abréviation" name="abréviation" placeholder="abréviation" required value="{{isset($utilisateur)? $utilisateur->abréviation:''}}">
                        </div>   <div class="form-group">
                            <label for="domaine">fonction</label>
                            <input type="text" class="form-control" id="function" name="function" placeholder="function" value="{{isset($utilisateur)? $utilisateur->function:''}}">
                        </div>
                        <div class="form-group">
                            <label for="email">E - mail</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Condition de Paiement" value="{{isset($utilisateur)? $utilisateur->email:''}}">
                        </div>

                        <div class="form-group">
                            <label for="responsable">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="responsable" value="{{isset($utilisateur)? $utilisateur->password:''}}">
                        </div>
                                        <div class="form-group">
                                            <label for="domaine">Les Roles</label>

                                            <select class="form-control selectpicker" id="roles" name="roles[]" data-live-search="true" data-size="6"  multiple required>
                                                <option  value="">SELECTIONNER LE(S) ROLE(S)</option>
                                                @foreach($roles as $role)
                                                    @if(isset($utilisateur) and $utilisateur->hasRole($role->name))
                                                        <option value="{{$role->name}}" selected>{{$role->description}}</option>
                                                        @else
                                                        <option value="{{$role->name}}" >{{$role->description}}</option>
                                                    @endif

                                                @endforeach
                                            </select>
                                        </div>
                        <input type="hidden" class="form-control" id="slug" name="slug" placeholder="" value="{{isset($utilisateur)? $utilisateur->slug:''}}">
                        <br><div class="form-group" >
                            <button type="submit" class="btn btn-success form-control">{{isset($utilisateur)? 'Modifier':'Ajouter'}}</button>
                        </div>
                        @if(isset($utilisateur))
                            <a href="{{route('gestion_utilisateur')}}">Ajouter un utilisateur</a>
                            @endif


                    </form>
                </div>
                <div class="col-sm-8">
                    @include('utilisateurs/list_utilisateur')
                </div>


    </div>
    <div class="row">



    </div>
@endsection