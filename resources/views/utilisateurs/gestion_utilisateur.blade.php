
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
        @if(isset($utilisateur))

            <form role="form" id="FormRegister" class="bucket-form" method="post" action="{{route('modifier_utilisateur')}}">
                @else
                    <form role="form" id="FormRegister" class="bucket-form" method="post" action="{{route('Validutilisateurs')}}">
                        @endif

                        <div class="col-sm-4">


                        @csrf
                        <div class="form-group">
                            <b><label for="name" class="control-label">Nom</label></b>
                            <input type="text" class="form-control" id="name" name="name" placeholder="name" value="{{isset($utilisateur)? $utilisateur->name:''}}" required>
                        </div>


                        <div class="form-group">
                            <label for="email">E - mail</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Condition de Paiement" value="{{isset($utilisateur)? $utilisateur->email:''}}">
                        </div>
                                        <div class="form-group">
                                            <label for="contact">Contact</label>
                                            <input type="text" class="form-control" id="contact" name="contact" placeholder="Contact" value="{{isset($utilisateur)? $utilisateur->contact:''}}">
                                        </div>

                        <div class="form-group">
                            <label for="responsable">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="responsable" value="{{isset($utilisateur)? $utilisateur->password:''}}">
                        </div>

                        <input type="hidden" class="form-control" id="slug" name="slug" placeholder="" value="{{isset($utilisateur)? $utilisateur->slug:''}}"/>



                </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="domaine">Abréviation</label>
                <input type="text" class="form-control" id="abréviation" name="abréviation" placeholder="abréviation"  value="{{isset($utilisateur)? $utilisateur->abréviation:''}}">
            </div>   <div class="form-group">
                <label for="domaine">fonction</label>
                <input type="text" class="form-control" id="function" name="function" placeholder="function" value="{{isset($utilisateur)? $utilisateur->function:''}}">
            </div>
            <div class="form-group">
                <b><label for="service">Service</label></b>
                <select class="form-control selectpicker" id="id_service" name="id_service" data-live-search="true" data-size="6">
                    <option value="">SELECTIONNER UN SERVICE</option>
                </select>
            </div>
        </div>
        <div class="col-sm-4">
            <fieldset><title>Habilitation</title>
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
                <br><div class="form-group" >
                    <button type="submit" class="btn btn-success form-control " style="width: 200px;margin-right: 10px">{{isset($utilisateur)? 'Modifier':'Ajouter'}}</button>
                </div>
                @if(isset($utilisateur))
                    <a href="{{route('gestion_utilisateur')}}">Ajouter un utilisateur</a>
                @endif

            </fieldset>
        </div>

                    </form>
    </div>
    <div class="row">

        <div class="col-sm-12">
            @include('utilisateurs/list_utilisateur')
        </div>


    </div>
@endsection