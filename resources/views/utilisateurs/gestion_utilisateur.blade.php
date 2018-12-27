
@extends('layouts.app')
@section('utilisateurs')
    class='active'
@endsection
@section('parent_fournisseurs')
    class='active'
@endsection
@section('content')
    <h2>LES UTILISATEURS - {{isset($utilisateur)? 'MODIFIER UTILISATEUR':'AJOUTER UTILISATEUR'}}</h2><br/><br/><br/>

    <div class="row">
        @if(isset($utilisateur))
        <form role="form" id="FormRegister" class="bucket-form" method="post" action="{{route('modifier_utilisateur')}}">
        @else
        <form role="form" id="FormRegister" class="bucket-form" method="post" action="{{route('Validutilisateurs')}}">
        @endif

        <div class="col-sm-4">
            @csrf
            <div class="form-group">
                <b><label for="nom" class="control-label">Nom</label></b>
                <input type="text" class="form-control" id="nom" name="nom" placeholder="nom" value="{{isset($utilisateur)? $utilisateur->nom:''}}" required>
            </div>

            <div class="form-group">
                <label for="prenoms">Prénoms</label>
                <input type="prenoms" class="form-control" id="prenoms" name="prenoms" placeholder="Condition de Paiement" value="{{isset($utilisateur)? $utilisateur->prenoms:''}}">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{old('mail')}}">
            </div>

            <input type="hidden" class="form-control" id="slug" name="slug" placeholder="" value="{{isset($utilisateur)? $utilisateur->slug:''}}"/>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label for="responsable">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="responsable" value="{{isset($utilisateur)? $utilisateur->password:''}}">
            </div>

            <div class="form-group">
                <label for="domaine">Abréviation</label>
                <input type="text" class="form-control" id="abréviation" name="abréviation" placeholder="abréviation"  value="{{isset($utilisateur)? $utilisateur->abréviation:''}}">
            </div>

            <div class="form-group">
                <label for="contact">Contact</label>
                <input type="text" class="form-control" id="contact" name="contact" placeholder="Contact" value="{{isset($utilisateur)? $utilisateur->contact:''}}">
            </div>
        </div>

        <div class="col-sm-4">
            <fieldset><title>Habilitation</title>

            <div class="form-group">
                <label for="domaine">Fonction</label>
                <input type="text" class="form-control" id="function" name="function" placeholder="function" value="{{isset($utilisateur)? $utilisateur->function:''}}">
            </div>

            <div class="form-group">
                <b><label for="service">Service</label></b>
                <select class="form-control selectpicker" id="id_service" name="id_service" data-live-search="true" data-size="6" noneSelectedText="SELECTIONNER UN SERVICE">
                    <option value="">SELECTIONNER UN SERVICE</option>

                    <option {{isset($utilisateur)&&$utilisateur->service=="Service matériel"? "selected":''}} value="Service matériel">Service matériel</option>
                    <option  {{isset($utilisateur)&&$utilisateur->service=="Direction"? "selected":''}} value="Direction">Direction</option>
                    <option {{isset($utilisateur)&&$utilisateur->service=="Secrétariat"? "selected":''}} value="Secrétariat">Secrétariat</option>
                    <option  {{isset($utilisateur)&&$utilisateur->service=="Service travaux"? "selected":''}}value="Service travaux">Service travaux </option>
                    <option {{isset($utilisateur)&&$utilisateur->service=="Service méthodes"? "selected":''}} value="Service méthodes">Service méthodes </option>
                    <option {{isset($utilisateur)&&$utilisateur->service=="Service informatique"? "selected":''}} value="Service informatique">Service informatique </option>
                </select>
            </div>

            <div class="form-group">
                    <label for="domaine">Les Roles</label>

                    <select class="form-control selectpicker" id="roles" name="roles[]" data-live-search="true" data-size="6" noneSelectedText="SELECTIONNER LE(S) ROLE(S)"  multiple required >
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

        <div class="row">
            <div class="col-sm-12">
                @include('utilisateurs/list_utilisateur')
            </div>
        </div>

<!-- Script pour générer l'adresse e-mail à partir du nom et prénoms saisi -->
<script type="application/javascript">

    var txtnom = document.getElementById('nom');
    var txtprenoms = document.getElementById('prenoms');

    function génère_mail()
    {
        var mail = txtprenoms.value +'.'+ txtnom.value + '@eiffage.com';
        document.getElementById('email').value = mail;
    }

    txtprenoms.addEventListener('keydown', function (e) {génère_mail()});
    txtnom.addEventListener('keydown', function (e) {génère_mail()});

    $(document).ready(function (e) {
        génère_mail();
    });
</script>
@endsection