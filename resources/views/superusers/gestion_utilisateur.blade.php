
@extends('layouts.app')
@section('utilisateurs')
    class='active'
@endsection
@section('configuration')
    class='active'
@endsection
@section('content')
    <h2>{{__('neutrale.super_user')}}  @if(isset($utilisateur)) {{ __('translation.update') }} @else {{ __('translation.add') }}  @endif</h2><br/><br/><br/>

    <div class="row">
        @if(isset($utilisateur))
        <form role="form" id="FormRegister" class="bucket-form" method="post" action="{{route('modifier_utilisateur')}}">
        @else
        <form role="form" id="FormRegister" class="bucket-form" method="post" action="{{route('Validutilisateurs')}}">
        @endif

        <div class="col-sm-4">
            @csrf
            <div class="form-group">
                <b><label for="nom" class="control-label">{{__('translation.nom')}}</label></b>
                <input type="text" class="form-control" id="nom" name="nom" placeholder="{{__('translation.nom')}}" value="{{isset($utilisateur)? $utilisateur->nom:''}}" required>
            </div>

            <div class="form-group">
                <label for="prenoms">{{__('translation.prenoms')}}</label>
                <input type="text" class="form-control" id="prenoms" name="prenoms" placeholder="{{__('translation.prenoms')}}" value="{{isset($utilisateur)? $utilisateur->prenoms:''}}">
            </div>

            <div class="form-group">
                <label for="email">{{__('translation.email')}}</label>
                <input type="email" class="form-control" id="email" name="email" value="{{isset($utilisateur)? $utilisateur->email:''}}">
            </div>

            <input type="hidden" class="form-control" id="slug" name="slug" placeholder="" value="{{isset($utilisateur)? $utilisateur->slug:''}}"/>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label for="responsable">{{__('translation.password')}}</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="{{__('translation.password')}}" value="{{isset($utilisateur)? $utilisateur->password:''}}">
            </div>

            <div class="form-group">
                <label for="domaine">{{__('translation.abreviation')}}</label>
                <input type="text" class="form-control" id="abréviation" name="abréviation" placeholder="{{__('translation.abreviation')}}"  value="{{isset($utilisateur)? $utilisateur->abréviation:''}}">
            </div>

            <div class="form-group">
                <label for="contact">{{__('translation.contact')}}</label>
                <input type="text" class="form-control" id="contact" name="contact" placeholder="{{__('translation.contact')}}" value="{{isset($utilisateur)? $utilisateur->contact:''}}">
            </div>
        </div>

        <div class="col-sm-4">
            <fieldset><title>Habilitation</title>

            <div class="form-group">
                <label for="domaine">{{__('translation.fonction')}}</label>
                <input type="text" class="form-control" id="function" name="function" placeholder="function" value="{{isset($utilisateur)? $utilisateur->function:''}}">
            </div>

            <div class="form-group">
                <b><label for="service">{{__('translation.service')}}</label></b>
                <select class="form-control selectpicker" id="id_service" name="id_service" data-live-search="true" data-size="6" noneSelectedText="SELECTIONNER UN SERVICE">
                    <option value="">SELECTIONNER UN SERVICE</option>

                    @foreach($services as $service)
                        <option {{isset($utilisateur)&& $utilisateur->service==$service->id? "selected":''}} value="{{$service->id}}">{{$service->libelle}}</option>
                        @endforeach
                </select>
            </div>

            <div class="form-group">
                    <label for="domaine">{{__('translation.les_roles')}}</label>

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

            <div class="form-group">
                <label for="domaine">{{__('neutrale.projet')}}</label>

                <select class="form-control selectpicker" id="projets" name="projets[]" data-live-search="true" data-size="6" noneSelectedText="{{__('neutrale.selectionner')}}"  multiple required >
                    <option  value="">{{__('neutrale.selectionner')}}</option>
                    @foreach($projets as $projet)
                        @if(isset($utilisateur) and $utilisateur->hasRole($projet->chantier))
                            <option value="{{$projet->id}}" selected>{{$projet->libelle}} {{$projet->chantier}}</option>
                        @else
                            <option value="{{$projet->id}}" >{{$projet->libelle}} {{$projet->chantier}}</option>
                        @endif

                    @endforeach
                </select>
        </div>
        <div class="form-group">
            <label for="domaine">{{__('neutrale.projet')}}</label>

            <select class="form-control selectpicker" id="roles" name="roles[]" data-live-search="true" data-size="6" noneSelectedText="SELECTIONNER LE(S) ROLE(S)"  multiple required >
                <option  value="">{{__('neutrale.selectionner')}}</option>
                @foreach($projets as $projet)
                    @if(isset($utilisateur) and $utilisateur->hasRole($projet->chantier))
                        <option value="{{$projet->id}}" selected>{{$projet->libelle}} {{$projet->chantier}}</option>
                    @else
                        <option value="{{$projet->id}}" >{{$projet->libelle}} {{$projet->chantier}}</option>
                    @endif

                @endforeach
            </select>
    </div>

                    <br><div class="form-group" >
                        <button type="submit" class="btn btn-success form-control " style="width: 200px;margin-right: 10px">@if(isset($utilisateur)) {{ __('translation.update') }} @else {{ __('translation.add') }}  @endif</button>
                    </div>
                    @if(isset($utilisateur))
                        <a href="{{route('gestion_utilisateur',app()->getLocale())}}">{{__('neutrale.ajouter')}}</a>
                    @endif

                </fieldset>
        </div>
        </form>
</br>
</br>
</br>
        <div class="row">
            <div class="col-sm-12 col-xr-12">
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
    txtprenoms.addEventListener('change', function (e) {génère_mail()});
    txtnom.addEventListener('change', function (e) {génère_mail()});
    txtnom.addEventListener('keydown', function (e) {génère_mail()});

    $(document).ready(function (e) {
      //  génère_mail();
    });

    var table= $('#fournisseurs').DataTable({
        language: {
            @if(App()->getLocale()=='fr')
            url: "../public/js/French.json"
            @elseif(App()->getLocale()=='en')
            url: "../public/js/English.json"
            @endif
        },
        "ordering":true,
        "responsive": true,
        "createdRow": function( row, data, dataIndex){

        },
        columnDefs: [
            { responsivePriority: 5, targets: 0 },
            { responsivePriority: 4, targets: -1 }
        ]
    }).column(0).visible(false);
    //table.DataTable().draw();


</script>
@endsection
