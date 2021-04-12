
@extends('layouts.app')
@section('projets')
    class='active'
@endsection
@section('parent_fournisseurs')
    class='active'
@endsection
@section('content')
    <h2>{{ __('neutrale.projet') }}  @if(isset($utilisateur)) {{ __('translation.update') }} @else {{ __('translation.add') }}  @endif</h2><br/><br/><br/>

                    <div class="row">
                        <div class="col-sm-12">

                                <form role="form" id="FormRegister" class="bucket-form" method="post" action="{{route('update_designation')}}" enctype="multipart/form-data">



                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-1">
                                                    <div class="form-group">
                                                        <label for="type">{{__('gestion_stock.type')}}</label>
                                                        <select class="form-control selectpicker" id="type_designation" name="type_designation" data-live-search="true" data-size="6" required>
                                                            <option  value="">{{__('sortie_materiel.selectionner_type')}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-froup">
                                                        <b><label for="libelle" class="control-label">{{__('gestion_stock.article')}}</label></b>
                                                        <input type="text" class="form-control" id="libelle" name="libelle" placeholder="libelle"  value="{{isset($designation)? $designation->libelle:''}}" required>
                                                    </div>
                                                </div>




                                                <br>
                                                <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="{{isset($designation)? $designation->id:''}}">
                                                 <br>
                                                 <div class="col-sm-4">
                                                <div class="form-group" >
                                                    <button type="submit" id="submit-all" class="btn btn-success form-control">@if(isset($designation)) {{ __('translation.update') }} @else {{ __('translation.add') }}  @endif</button>
                                                </div>
                                            </div>


                                 </form>
                        </div>
                        <div class="col-sm-12 col-xr-12">



                            <table name ="projets" id="projets" class='table table-bordered table-striped  no-wrap '>

                                <thead>

                                <tr>
                                    <th class="dt-head-center">id</th>
                                    <th class="dt-head-center">{{ __('neutrale.projet') }}</th>
                                    <th class="dt-head-center">{{__('gestion_stock.action')}}</th>

                                </tr>
                                </thead>
                                <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">
                                    @foreach($projets as $projet)
                                        <tr>
                                            <td>{{$projet->id}}</td>
                                            <td>{{$projet->libelle}}</td>
                                            <td>
                                                <a href="{{route('supprimer_utilisateur',['locale'=>app()->getLocale(),'slug'=>$projet->id])}}" data-toggle="modal" class="btn btn-danger  pull-right">
                                                    <i class=" fa fa-trash"></i>
                                                </a>
                                                <a href="{{route('voir_utilisateur',['locale'=>app()->getLocale(),'slug'=>$projet->id])}}" data-toggle="modal" class="btn btn-info  pull-right">
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

                    <!-- Script pour générer l'adresse e-mail à partir du nom et prénoms saisi -->
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
