
@extends('layouts.app')
@section('das')
    class='active'
@endsection
@section('creer_da')
    class='active'
@endsection
@section('parent_da')
    class='active'
@endsection
@section('content')
    <h2>LES DEMANDES D'ACHATS - {{isset($da)? 'MODIFIER ':'AJOUTER '}}</h2>
    </br>
    </br>
    <div class="row">


                        <form role="form" id="FormRegister" class="" method="post" action="{{route('Validdas')}}">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-4">

                            @csrf<div class="form-group">
                                <label for="libelle" class="control-label">Produit et service</label>


                                <select class="form-control selectpicker col-sm-4" id="id_materiel" name="id_materiel" data-live-search="true" data-size="6" required>
                                    <option  value="">SELECTIONNER UN PRODUIT</option>
                                    @foreach($materiels as $materiel)
                                        <option @if(isset($da) and $materiel->id==$da->	id_materiel)
                                                {{'selected'}}
                                                @endif value="{{$materiel->id}}">{{$materiel->libelleMateriel}}</option>
                                    @endforeach
                                </select>
                            </div>

                                <div class="form-group  ">
                                    <label for="type">Demandeur</label>
                                    <input type="text" class="form-control " id="demandeur" name="demandeur" placeholder="demandeur" value="{{isset($da)? $da->demandeur:''}}" required>
                                </div>



                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <b><label for="libelle" class="control-label">Nature</label></b>
                                    <select class="form-control selectpicker col-sm-4" id="id_nature" name="id_nature" data-live-search="true" data-size="6">
                                        @foreach($natures as $nature)
                                            <option @if(isset($da) and $nature->id==$da->id_nature)
                                                    {{'selected'}}
                                                    @endif value="{{$nature->id}}">{{$nature->libelleNature}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-sm-3 ">
                                    <label for="type">Quantité</label>
                                    <input type="number" class="form-control " id="quantite" name="quantite" placeholder="quantite" value="{{isset($da)? $da->quantite:''}}" required>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="type">Unité</label>
                                    <input type="text" class="form-control" id="unite" name="unite" placeholder="unite" value="{{isset($da)? $da->unite:''}}" required>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="type">Pour le?</label>
                                    <input type="date" class="form-control" id="DateBesoin" name="DateBesoin" placeholder="DateBesoin" value="{{isset($da)? $da->DateBesoin:''}}" required>
                                </div>

                                <input type="hidden" class="form-control" id="slug" name="slug" placeholder="" value="{{isset($da)? $da->slug:''}}">
                                <input type="hidden" class="form-control" id="id_user" name="id_user" placeholder="" value="{{ Auth::user()->id }}">
                                <br>
                                <div class="form-group col-sm-4 col-sm-push-8" >
                                    <button type="submit"  id="btnvalider"class="btn btn-success form-control">{{isset($da)? 'Modifier':'Ajouter'}}</button>
                                </div>
                            </div>










                        </form>

    </div>
    <script src="{{URL::asset('js/scriptperso.js')}}"> </script>
@endsection