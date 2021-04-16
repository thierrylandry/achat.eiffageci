
@extends('layouts.app')
@section('projets')
    class='active'
@endsection
@section('parent_fournisseurs')
    class='active'
@endsection
@section('content')

<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">MODIFIER LE CODE DE GESTION</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('changer_code_gestion')}}" method="post">
                @csrf
                <div class="modal-body">

                    <div id="contacts">

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="valideur[]">{{ __('neutrale.valideur') }} </label>
                                <div class="col-sm-2">
                                    <input type="text" name="valideur[]" class="titre_c form-control" placeholder="" value="{{ old('valideur[]') }}">
                                </div>

                                <label class="col-sm-2 col-form-label" for="titre_c[]">{{ __('neutrale.montant') }} min </label>
                                <div class="col-sm-2">
                                    <input type="number" name="montant[]" class="montant form-control" placeholder="{{ __('neutrale.montant') }}" value="{{ old('montant[]') }}">
                                </div>

                                <label class="col-sm-2 col-form-label" for="titre_c[]">{{ __('neutrale.montant') }} max </label>
                                <div class="col-sm-2">
                                    <input type="number" name="montant[]" class="montant form-control" placeholder="{{ __('neutrale.montant') }}" value="{{ old('montant[]') }}">
                                </div>
                                <br>
                                {{ __('translation.add') }}
                                <button type="button" class="btn bg-teal btn-circle waves-effect waves-circle waves-float" id="addcontact">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                </button>
                                </br>
                                </br>
                                </br>
                            </div>
                    </div>
                    <div class="col-sm-12 col-lg-push-3">




                    </div>
                    <div id="contacttemplate" class="row clearfix" style="display: none">
                        <label class="col-sm-2 col-form-label" for="valideur[]">{{ __('neutrale.valideur') }} </label>
                        <div class="col-sm-2">
                            <input type="text" name="valideur[]" class="titre_c form-control" placeholder="" value="{{ old('valideur[]') }}">
                        </div>

                        <label class="col-sm-2 col-form-label" for="titre_c[]">{{ __('neutrale.montant') }} min </label>
                        <div class="col-sm-2">
                            <input type="number" name="montant[]" class="montant form-control" placeholder="{{ __('neutrale.montant') }}" value="{{ old('montant[]') }}">
                        </div>

                        <label class="col-sm-2 col-form-label" for="titre_c[]">{{ __('neutrale.montant') }} max </label>
                        <div class="col-sm-2">
                            <input type="number" name="montant[]" class="montant form-control" placeholder="{{ __('neutrale.montant') }}" value="{{ old('montant[]') }}">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <h2>{{ __('neutrale.projet') }}  @if(isset($projet)) {{ __('translation.update') }} @else {{ __('translation.add') }}  @endif</h2><br/><br/><br/>

                    <div class="row">

                        <div class="col-sm-12">

                                <form role="form" id="FormRegister" class="bucket-form" method="post" action="@if(isset($projet))   {{route('update_projet')}}  @else {{route('ajouter_projet')}} @endif" enctype="multipart/form-data">



                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div>
                                                        <div class="form-group">
                                                            <label for="type">{{__('neutrale.pays')}} </label>
                                                            <select class="form-control selectpicker" id="id_pays" name="id_pays" data-live-search="true" data-size="6" required>
                                                                <option  value="">{{__('neutrale.selectionner_pays')}}</option>
                                                                @foreach ( $payss as$pays )
                                                                    <option value="{{$pays->id}}" {{isset($projet) && $projet->id_pays==$pays->id?'selected':''}}>{{$pays->nom_fr_fr}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div >
                                                        <div class="form-froup">
                                                            <b><label for="libelle" class="control-label">{{__('neutrale.chantier')}}</label></b>
                                                            <input type="text" class="form-control" id="chantier" name="chantier" placeholder="libelle"  value="{{isset($projet)? $projet->chantier:''}}" required>
                                                        <br>
                                                        </div>
                                                    </div>
                                                    <div >
                                                        <div class="form-froup">
                                                            <b><label for="libelle" class="control-label">{{__('neutrale.prefix_bc')}}</label></b>
                                                            <input type="text" class="form-control" id="libelle" name="libelle" placeholder="libelle"  value="{{isset($projet)? $projet->libelle:''}}" required>
                                                        <br>
                                                        </div>
                                                    </div>
                                                    <div >
                                                        <div class="form-froup">
                                                            <b><label for="libelle" class="control-label">{{__('neutrale.denomination_courte')}}</label></b>
                                                            <input type="text" class="form-control" id="denomination_courte" name="denomination_courte" placeholder="libelle"  value="{{isset($projet)? $projet->denomination_courte:''}}" required>
                                                        </div>
                                                        <br>
                                                    </div>
                                                    <div >
                                                        <div class="form-froup">
                                                            <b><label for="libelle" class="control-label">{{__('neutrale.denomination_longue')}}</label></b>
                                                            <input type="text" class="form-control" id="denomination_longue" name="denomination_longue" placeholder="libelle"  value="{{isset($projet)? $projet->denomination_longue:''}}" required>
                                                        </div>
                                                        <br>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div >
                                                        <div class="form-froup">
                                                            <b><label for="libelle" class="control-label">{{__('neutrale.n_rccm')}}</label></b>
                                                            <input type="text" class="form-control" id="n_rccm" name="n_rccm" placeholder="libelle"  value="{{isset($projet)? $projet->	n_rccm:''}}" required>
                                                        </div>
                                                        <br>
                                                    </div>
                                                    <div >
                                                        <div class="form-froup">
                                                            <b><label for="libelle" class="control-label">{{__('neutrale.n_cc')}}</label></b>
                                                            <input type="text" class="form-control" id="n_cc" name="n_cc" placeholder="libelle"  value="{{isset($projet)? $projet->	n_cc:''}}" required>
                                                        </div>
                                                        <br>
                                                    </div>
                                                    <div >
                                                        <div class="form-froup">
                                                            <b><label for="libelle" class="control-label">{{__('neutrale.siege_social')}}</label></b>
                                                            <textarea class="form-control" id="siege_social" name="siege_social"> {{isset($projet)? $projet->siege_social:''}}</textarea>

                                                        </div>
                                                        <br>
                                                    </div>
                                                    <div >
                                                        <div class="form-froup">
                                                            <b><label for="libelle" class="control-label">{{__('neutrale.portEPIObligatoire')}}</label></b>
                                                            <textarea class="form-control" id="portEPIObligatoire" name="portEPIObligatoire"> {{isset($projet)? $projet->	portEPIObligatoire:''}}</textarea>

                                                        </div>
                                                        <br>
                                                    </div>

                                                    <br>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div >
                                                        <div >
                                                            <div class="form-froup">
                                                                <b><label for="libelle" class="control-label">{{__('gestion_stock.adresse_geographique')}}</label></b>
                                                                <textarea class="form-control" id="adresse_geographique" name="adresse_geographique"> {{isset($projet)? $projet->	adresseGeographique:''}}</textarea>

                                                            </div>
                                                        </div>
                                                        <div class="form-froup">
                                                            <b><label for="libelle" class="control-label">{{__('neutrale.adressePostale')}}</label></b>
                                                            <input type="text" class="form-control" id="adressePostale" name="adressePostale" placeholder="libelle"  value="{{isset($projet)? $projet->adressePostale:''}}" required>
                                                        </div>
                                                        <br>
                                                    </div>
                                                    <div >
                                                        <div class="form-froup">
                                                            <b><label for="libelle" class="control-label">{{__('neutrale.adresseReceptionFacture')}}</label></b>
                                                            <textarea class="form-control" id="adresseReceptionFacture" name="adresseReceptionFacture"> {{isset($projet)? $projet->adresseReceptionFacture:''}}</textarea>

                                                        </div>
                                                        <br>
                                                    </div>
                                                    <div >
                                                        <div class="form-froup">
                                                            <b><label for="libelle" class="control-label">{{__('neutrale.adressePostaleReceptionFacture')}}</label></b>
                                                            <input type="text" class="form-control" id="adressePostaleReceptionFacture" name="adressePostaleReceptionFacture" placeholder="libelle"  value="{{isset($projet)? $projet->adressePostaleReceptionFacture:''}}" required>
                                                        </div>
                                                        <br>
                                                    </div>

                                                    <br>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div >
                                                        <div class="form-group">
                                                            <label for="type">{{__('neutrale.default_language')}} </label>
                                                            <select class="form-control selectpicker" id="default_language" name="default_language" data-live-search="true" data-size="6" required>
                                                                <option  value="">{{__('neutrale.selectionner_default_language')}}</option>
                                                                @foreach ( $languages as$language )
                                                                    <option value="{{$language->language}}" {{isset($projet) && $projet->	defaultLanguage==$language->language?'selected':''}}>{{$language->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div >
                                                        <div class="form-group">
                                                            <label for="type">{{__('neutrale.devise')}} </label>
                                                            <select class="form-control selectpicker" id="devise" name="devise" data-live-search="true" data-size="6" required>
                                                                <option  value="">{{__('neutrale.selectionner_devise')}}</option>
                                                                @foreach ( $devises as$devise )
                                                                    <option value="{{$devise->devise}}" {{isset($projet) && $projet->defaultDevise==$devise->devise?'selected':''}}>{{$devise->devise}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div >
                                                        <div class="form-group">
                                                            <label for="type">{{__('neutrale.typeValidation')}} <a href="" data-toggle="modal" data-target="#exampleModal1" data-whatever="@mdo"   data-toggle="modal" class="btn btn-info btnupdate_cg">
                                                                <i class="fa fa-info-circle" style="size: 40px">{{__('neutrale.valideur')}} (s) </i>
                                                            </a> </label>
                                                            <select class="form-control selectpicker" id="typeValidation" name="typeValidation" data-live-search="true" data-size="6" required>
                                                                <option  value="">{{__('neutrale.selectionner_typeValidation')}}</option>
                                                                @foreach ( $typesValidations as$typesValidation )
                                                                    <option value="{{$typesValidation->id}}" {{isset($projet) && $projet->typeValidation==$typesValidation->id?'selected':''}}>{{app()->getLocale()=='fr'?$typesValidation->libelle:$typesValidation->libelle_en}}</option>
                                                                @endforeach
                                                            </select>

                                                        </div>

                                                    </div>
                                                    <div >
                                                        <div class="form-froup">
                                                            <b><label for="libelle" class="control-label">{{__('neutrale.conditionGeneralAchat')}}</label></b>
                                                            <textarea name="conditionGeneralAchat" class="form-control">{{isset($projet)? $projet->conditionGeneralAchat:''}}</textarea>
                                                        </div>
                                                        <br>
                                                    </div>
                                                    <div >
                                                        <div class="form-inline">
                                                            <b><label for="libelle" class="control-label">{{__('neutrale.use_tva')}}</label></b>
                                                            <input type="number" class="form-control" min=0 max="100" style="width: 75px" id="use_tva" name="use_tva" placeholder="libelle"  value="{{isset($projet)? $projet->use_tva:''}}" required>%
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="{{isset($projet)? $projet->id:''}}">
                                                 <br>
                                                 <div class="col-sm-2">
                                                <div class="form-group" >
                                                    <button type="submit" id="submit-all" class="btn btn-success form-control">@if(isset($projet)) {{ __('translation.update') }} @else {{ __('translation.add') }}  @endif</button>
                                                </div>


                                                @if(isset($projet))
                                                <a href="{{route('gestion_projets',app()->getLocale())}}">{{__('neutrale.ajouter')}}</a>
                                            @endif
                                            </div>


                                 </form>
                        </div>
                        <div class="col-sm-12 col-xr-12">



                            <table name ="projets" id="projets" class='table table-bordered table-striped  no-wrap '>

                                <thead>

                                <tr>
                                    <th class="dt-head-center">id</th>
                                    <th class="dt-head-center">{{ __('neutrale.projet') }}</th>
                                    <th class="dt-head-center">{{ __('neutrale.pays') }}</th>
                                    <th class="dt-head-center">{{__('gestion_stock.action')}}</th>

                                </tr>
                                </thead>
                                <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">
                                    @foreach($projets as $projet)
                                        <tr>
                                            <td>{{$projet->id}}</td>
                                            <td>{{$projet->libelle}}</td>
                                            <td>{{$projet->pays->nom_fr_fr}}</td>
                                            <td>
                                                <a href="{{route('supprimer_utilisateur',['locale'=>app()->getLocale(),'slug'=>$projet->id])}}" data-toggle="modal" class="btn btn-danger  pull-right">
                                                    <i class=" fa fa-trash"></i>
                                                </a>
                                                <a href="{{route('modifier_projets',['locale'=>app()->getLocale(),'id'=>$projet->id])}}" data-toggle="modal" class="btn btn-info  pull-right">
                                                    <i class=" fa fa-pencil"></i>
                                                </a>

                                                <a href="{{route('gestion_importation',['locale'=>app()->getLocale(),'slug'=>$projet->id])}}" data-toggle="modal" class="btn btn-default pull-right">
                                                    <i class="fa  fa-upload"></i> Importations
                                                </a>

                                            </td>
                                        </tr>
                                        @endforeach
                                </tbody>
                            </table>


                        </div>
                    </div>


                    <script type="application/javascript">
                        var table= $('#projets').DataTable({
                            language: {
                                @if(App()->getLocale()=='fr')
                                url: "../public/js/French.json"
                                @elseif(App()->getLocale()=='en')
                                url: "../public/js/English.json"
                                @endif
                            },
                            "ordering":true,
                            "createdRow": function( row, data, dataIndex){

                            },
                            responsive: true,
                            paging: false,

                        }).column( 0 ).visible(false);
                        $("#addcontact").click(function (e) {
                            $($("#contacttemplate").html()).appendTo($("#contacts"));
                        });
                    </script>
@endsection
