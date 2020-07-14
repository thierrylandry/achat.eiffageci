
@extends('layouts.app')
@section('das')
    class='active'
@endsection
@section('parent_da')
    class='active'
@endsection
@section('content')
    <h2>LES DEMANDES D'APPROVISIONNEMENT MULTIPLES - {{isset($da)? 'MODIFIER ':'AJOUTER '}} <a href="{{route('creer_da')}}" class="btn btn-default pull-right"><i class="fa fa-list" aria-hidden="true"></i> Lister</a></h2>
    </br>
    </br>
    <div class="row">

        <div class="generaltemplate" style="display: none">
            <div class="col-sm-6">

                @csrf<div class="form-group">
                    <label for="libelle" class="control-label">Produit et service</label>


                    <select class="form-control  col-sm-4"  name="id_materiel[]" data-live-search="true" data-size="6" required>
                        <option  value="">SELECTIONNER UN PRODUIT</option>
                        @foreach($materiels as $materiel)
                            <option @if(isset($da) and $materiel->id==$da->	id_materiel)
                                    {{'selected'}}
                                    @endif value="{{$materiel->id}}">{{$materiel->libelleMateriel}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="libelle" class="control-label">Code gestion</label>


                    <select class="form-control  col-sm-4"  name="id_codeGestion[]" data-live-search="true" data-size="6" required>
                        <option value="">SELECTIONNER UN CODE GESTION</option>
                        @foreach($gestions as $gestion)
                            <option @if(isset($da) and $gestion->id==$da->id_codeGestion)
                                    {{'selected'}}
                                    @endif value="{{$gestion->id}}"  data-subtext="{{$gestion->description}}">{{$gestion->codeGestion}} </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group  ">
                    <label for="type">Demandeur</label>
                    <input type="text" class="form-control "  name="demandeur[]" placeholder="demandeur" value="{{isset($da)? $da->demandeur: \Illuminate\Support\Facades\Auth::user()->nom.' '.\Illuminate\Support\Facades\Auth::user()->prenoms}} " required>
                </div>
                <div class="form-group  ">
                    <label for="type">Usage</label>
                    <input type="text" class="form-control "  name="usage[]" placeholder="usage" value="{{isset($da)? $da->usage:''}} " required>
                </div>


            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <b><label for="libelle" class="control-label">Nature</label></b>
                    <select class="form-control col-sm-4"  name="id_nature[]" data-live-search="true" data-size="6">
                        @foreach($natures as $nature)
                            <option @if(isset($da) and $nature->id==$da->id_nature)
                                    {{'selected'}}
                                    @endif value="{{$nature->id}}">{{$nature->libelleNature}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-3 ">
                    <label for="type">Quantité</label>
                    <input type="number" step="any" class="form-control " name="quantite[]" placeholder="quantite" value="{{isset($da)? $da->quantite:''}}" min="0" required>
                </div>
                <div class="form-group col-sm-3">
                    <label for="type">Unité</label>
                    <select class="form-control  col-sm-4" name="unite[]" data-live-search="true" data-size="6">
                        @foreach($tab_unite['nothing'] as $unite)
                            <option value="{{$unite}}">{{$unite}}</option>
                        @endforeach
                        <optgroup label="La longeur">
                            @foreach($tab_unite['La longueur'] as $unite)
                                <option value="{{$unite}}" >{{$unite}}</option>
                            @endforeach
                        </optgroup>

                        <optgroup label="La masse">
                            @foreach($tab_unite['La masse'] as $unite)
                                <option value="{{$unite}}" >{{$unite}}</option>
                            @endforeach
                        </optgroup>



                        <optgroup label="Le volume">
                            @foreach($tab_unite['Le volume'] as $unite)
                                <option value="{{$unite}}" >{{$unite}}</option>
                            @endforeach
                        </optgroup>

                        <optgroup label="La surface">
                            @foreach($tab_unite['La surface'] as $unite)
                                <option value="{{$unite}}" >{{$unite}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-6">
                    <label for="type">Pour le?</label>
                    <input type="date" class="form-control"id="DateBesoin" name="DateBesoin[]" placeholder="DateBesoin" value="{{isset($da)? $da->DateBesoin:''}}" required>
                </div>
                <div class="form-group">
                    <label for="commentaire">Description (Attention ceci figurera sur le bon de commande)</label>
                    <textarea  name="commentaire[]" class="form-control col-sm-8" style="height: 100px" maxlength="1000">{{isset($da)? $da->commentaire:''}}</textarea>
                </div>
                <input type="hidden" class="form-control"  name="id_user[]" placeholder="" value="{{ Auth::user()->id }}">
                <br>
                <br>
                <br>                                <br>
                <br>
                <br>
            </div>
        </div>

        <form role="form" id="FormRegister"  method="post" action="{{route('enregistrer_da_multiple')}}">
            <div class="general">
                <div class="col-sm-6">

                    @csrf<div class="form-group">
                        <label for="libelle" class="control-label">Produit et service</label>


                        <select class="form-control  col-sm-4"  name="id_materiel[]" data-live-search="true" data-size="6" required>
                            <option  value="">SELECTIONNER UN PRODUIT</option>
                            @foreach($materiels as $materiel)
                                <option @if(isset($da) and $materiel->id==$da->	id_materiel)
                                        {{'selected'}}
                                        @endif value="{{$materiel->id}}">{{$materiel->libelleMateriel}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="libelle" class="control-label">Code gestion</label>


                        <select class="form-control  col-sm-4" name="id_codeGestion[]" data-live-search="true" data-size="6" required>
                            <option value="">SELECTIONNER UN CODE GESTION</option>
                            @foreach($gestions as $gestion)
                                <option @if(isset($da) and $gestion->id==$da->id_codeGestion)
                                        {{'selected'}}
                                        @endif value="{{$gestion->id}}"  data-subtext="{{$gestion->description}}">{{$gestion->codeGestion}} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group  ">
                        <label for="type">Demandeur</label>
                        <input type="text" class="form-control "  name="demandeur[]" placeholder="demandeur" value="{{isset($da)? $da->demandeur: \Illuminate\Support\Facades\Auth::user()->nom.' '.\Illuminate\Support\Facades\Auth::user()->prenoms}} " required>
                    </div>
                    <div class="form-group  ">
                        <label for="type">Usage</label>
                        <input type="text" class="form-control "  name="usage[]" placeholder="usage" value="{{isset($da)? $da->usage:''}} " required>
                    </div>


                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <b><label for="libelle" class="control-label">Nature</label></b>
                        <select class="form-control  col-sm-4" id="id_nature" name="id_nature[]" data-live-search="true" data-size="6">
                            @foreach($natures as $nature)
                                <option  value="{{$nature->id}}">{{$nature->libelleNature}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-3 ">
                        <label for="type">Quantité</label>
                        <input type="number" step="any" class="form-control " id="quantite" name="quantite[]" placeholder="quantite" value="{{isset($da)? $da->quantite:''}}" min="0" required>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="type">Unité</label>
                        <select class="form-control  col-sm-4" id="unite" name="unite[]" data-live-search="true" data-size="6">
                            @foreach($tab_unite['nothing'] as $unite)
                                <option value="{{$unite}}">{{$unite}}</option>
                            @endforeach
                            <optgroup label="La longeur">
                                @foreach($tab_unite['La longueur'] as $unite)
                                    <option value="{{$unite}}" >{{$unite}}</option>
                                @endforeach
                            </optgroup>

                            <optgroup label="La masse">
                                @foreach($tab_unite['La masse'] as $unite)
                                    <option value="{{$unite}}" >{{$unite}}</option>
                                @endforeach
                            </optgroup>



                            <optgroup label="Le volume">
                                @foreach($tab_unite['Le volume'] as $unite)
                                    <option value="{{$unite}}" >{{$unite}}</option>
                                @endforeach
                            </optgroup>

                            <optgroup label="La surface">
                                @foreach($tab_unite['La surface'] as $unite)
                                    <option value="{{$unite}}" >{{$unite}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="type">Pour le?</label>
                        <input type="date" class="form-control" id="DateBesoin" name="DateBesoin[]" placeholder="DateBesoin" value="{{isset($da)? $da->DateBesoin:''}}" required>
                    </div>
                    <div class="form-group">
                        <label for="commentaire">Description (Attention ceci figurera sur le bon de commande)</label>
                        <textarea name="commentaire[]" class="form-control col-sm-8" style="height: 100px" maxlength="1000"></textarea>
                    </div>
                    <input type="hidden" class="form-control" id="slug" name="slug" placeholder="" value="{{isset($da)? $da->slug:''}}">
                    <input type="hidden" class="form-control" id="id_user" name="id_user[]" placeholder="" value="{{ Auth::user()->id }}">
                    <br>
                    <br>
                    <br>                                <br>
                    <br>
                    <br>

                </div>
            </div>

            <button type="button" class="btn bg-teal btn-circle waves-effect waves-circle waves-float" id="addpiece">
                Ajouter une ligne de D.A
                <i class="fa fa-plus-circle" aria-hidden="true"></i>
            </button>
            <input type="submit" class="btn btn-success pull-right" id="soumettre" name="soumettre" value="Soumettre" />

        </form>
    </div>

        <script src="{{URL::asset('js/scriptperso.js')}}"> </script>
        <script>
            $('.confirmons').click( function (e) {
                //   table.row('.selected').remove().draw( false );
                if(confirm('Voulez vous confirmer la D.A.?')){}else{e.preventDefault(); e.returnValue = false; return false; }
            } );
            $("#addpiece").click(function (e) {
                $($(".generaltemplate").html()).appendTo($(".general"));
            });
        </script>
    </div>
@endsection