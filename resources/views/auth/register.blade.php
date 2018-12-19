@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Inscrivez vous') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('nom'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Adresse E-mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmer mot de passe') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Enregistrer') }}
                                </button>
                            </div>
                        </div>
                    </form>







                    <div class="col-sm-4">
                        @csrf
                        <div class="form-group">
                            <b><label for="nom" class="control-label">Nom</label></b>
                            <input type="text" class="form-control" id="nom" name="nom" placeholder="nom" value="{{isset($utilisateur)? $utilisateur->nom:''}}" required>
                            @if ($errors->has('nom'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="prenoms">Prénoms</label>
                            <input type="prenoms" class="form-control" id="prenoms" name="prenoms" placeholder="Condition de Paiement" value="{{isset($utilisateur)? $utilisateur->prenoms:''}}">
                            @if ($errors->has('prenoms'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('prenoms') }}</strong>
                                    </span>
                            @endif
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
                                <select class="form-control selectpicker" id="id_service" name="id_service" data-live-search="true" data-size="6">
                                    <option value="">SELECTIONNER UN SERVICE</option>
                                </select>
                            </div>










                </div>
            </div>
        </div>
    </div>
</div>
@endsection
