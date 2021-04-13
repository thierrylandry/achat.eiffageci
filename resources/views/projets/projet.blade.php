
@extends('layouts.app')
@section('projets')
    class='active'
@endsection
@section('parent_fournisseurs')
    class='active'
@endsection
@section('content')

    <h2>{{ __('neutrale.projet') }}  @if(isset($projet)) {{ __('translation.update') }} @else {{ __('translation.add') }}  @endif</h2><br/><br/><br/>

                    <div class="row">
                        <div class="col-sm-12">

                                <form role="form" id="FormRegister" class="bucket-form" method="post" action="@if(isset($projet))   {{route('update_projet')}}  @else {{route('ajouter_projet')}} @endif" enctype="multipart/form-data">



                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-4">
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
                                                <div class="col-sm-4">
                                                    <div class="form-froup">
                                                        <b><label for="libelle" class="control-label">{{__('neutrale.projet')}}</label></b>
                                                        <input type="text" class="form-control" id="libelle" name="libelle" placeholder="libelle"  value="{{isset($projet)? $projet->libelle:''}}" required>
                                                    </div>
                                                </div>

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
                    </script>
@endsection
