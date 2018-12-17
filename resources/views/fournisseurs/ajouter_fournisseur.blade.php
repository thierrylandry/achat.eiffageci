
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

            @if(isset($fournisseur))

                <form role="form" id="FormRegister" class="bucket-form" method="post" action="{{route('modifier_fournisseur')}}">
                    @else
                        <form role="form" id="FormRegister" class="bucket-form" method="post" action="{{route('Validfournisseur')}}">
                            @endif


                            @csrf
                            <div class="col-sm-3">
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
                            </div>
                            <div class="col-sm-3">

                                <div class="form-group">
                                    <label for="domaine">Condition de paiement</label>
                                    <textarea id="conditionPaiement" name="conditionPaiement" class="form-control col-sm-8">{{isset($fournisseur)? $fournisseur->commentaire:''}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="responsable">Responsable</label>
                                    <input type="text" class="form-control" id="responsable" name="responsable" placeholder="responsable" value="{{isset($fournisseur)? $fournisseur->responsable:''}}">
                                </div>
                                <div class="form-group">
                                    <label for="commentaire">Commentaire</label>
                                    <textarea id="commentaire" name="commentaire" class="form-control col-sm-8">{{isset($fournisseur)? $fournisseur->commentaire:''}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="email">E - mail</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="E -mail" value="{{isset($fournisseur)? $fournisseur->email:''}}" required>
                                </div>
                            </div>
                            <div class="col-sm-6">


                                <h4>Contacts</h4>
                                Ajouter un champ
                                <button type="button" class="btn bg-teal btn-circle waves-effect waves-circle waves-float" id="addcontact">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                </button>
                                </br>
                                </br>
                                </br>
                                <div id="contacts">
                                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 form-control-label">
                                        <label for="titre_c[]">Interlocuteur </label>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="titre_c[]" class="titre_c form-control" placeholder="Titre contact" value="{{ old('fullname_c[]') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-1 col-md-1 col-sm-3 col-xs-4 form-control-label">
                                        <label for="observation_c[]">Adresse</label>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <div class="form-group">
                                            <select type="text" name="type_c[]" class="type_c form-control input-field">
                                                @foreach(\App\Metier\Json\Contact::$typeListe as $key => $typeliste)
                                                    <option value="{{ $key }}">{{ $typeliste }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-2 col-sm-7 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="valeur_c[]" class="valeur_c form-control" placeholder="Valeur" value="{{ old('valeur_c[]') }}">
                                            </div>
                                        </div>
                                    </div>                                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 form-control-label">
                                        <label for="titre_c[]">Interlocuteur </label>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="titre_c[]" class="titre_c form-control" placeholder="Titre contact" value="{{ old('fullname_c[]') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-1 col-md-1 col-sm-3 col-xs-4 form-control-label">
                                        <label for="observation_c[]">Adresse</label>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <div class="form-group">
                                            <select type="text" name="type_c[]" class="type_c form-control input-field">
                                                @foreach(\App\Metier\Json\Contact::$typeListe as $key => $typeliste)
                                                    <option value="{{ $key }}">{{ $typeliste }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-2 col-sm-7 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="valeur_c[]" class="valeur_c form-control" placeholder="Valeur" value="{{ old('valeur_c[]') }}">
                                            </div>
                                        </div>
                                    </div>                                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 form-control-label">
                                        <label for="titre_c[]">Interlocuteur </label>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="titre_c[]" class="titre_c form-control" placeholder="Titre contact" value="{{ old('fullname_c[]') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-1 col-md-1 col-sm-3 col-xs-4 form-control-label">
                                        <label for="observation_c[]">Adresse</label>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <div class="form-group">
                                            <select type="text" name="type_c[]" class="type_c form-control input-field">
                                                @foreach(\App\Metier\Json\Contact::$typeListe as $key => $typeliste)
                                                    <option value="{{ $key }}">{{ $typeliste }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-2 col-sm-7 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="valeur_c[]" class="valeur_c form-control" placeholder="Valeur" value="{{ old('valeur_c[]') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="contacttemplate" class="row clearfix" style="display: none">
                                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 form-control-label">
                                        <label for="titre_c[]">Interlocuteur </label>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="titre_c[]" class="titre_c form-control" placeholder="Titre contact" value="{{ old('fullname_c[]') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-1 col-md-1 col-sm-3 col-xs-4 form-control-label">
                                        <label for="observation_c[]">Adresse</label>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <div class="form-group">
                                            <select type="text" name="type_c[]" class="type_c form-control input-field">
                                                @foreach(\App\Metier\Json\Contact::$typeListe as $key => $typeliste)
                                                    <option value="{{ $key }}">{{ $typeliste }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-2 col-sm-7 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="valeur_c[]" class="valeur_c form-control" placeholder="Valeur" value="{{ old('valeur_c[]') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </br>
                                <input type="hidden" class="form-control" id="slug" name="slug" placeholder="" value="{{isset($fournisseur)? $fournisseur->slug:''}}">
                                <br><div class="form-group" >
                                    <button type="submit" class="btn btn-success form-control" style="width: 200px;">{{isset($fournisseur)? 'Modifier':'Ajouter'}}</button>
                                </div>
                                @if(isset($fournisseur))
                                    <a href="{{route('ajouter_fournisseur')}}">Ajouter un fournisseur</a>
                                @endif

                            </div>
                            <div class="row">
                                <div class="col-sm-8"> </div>
                            </div>




                        </form>
        </div>
    <div class="row">

                <div class="col-sm-12">
                    @include('fournisseurs.lister_fournisseur')
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
    <script type="application/javascript">
        $("#addcontact").click(function (e) {
            $($("#contacttemplate").html()).appendTo($("#contacts"));
        });
    </script>
@endsection