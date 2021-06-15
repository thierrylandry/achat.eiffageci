
@extends('layouts.app')
@section('configuration')
    class='active'
@endsection
@section('content')
<a href="{{route('gestion_projets',app()->getLocale())}}" class="btn btn-default  pull-right"> {{__('neutrale.retour')}}</a>
<h1>{{App\Projet::find($projet->id)->chantier}} ({{App\Projet::find($projet->id)->libelle}})</h1>
    <h2>{{ __('menu.work_flow_validation') }}   @if(isset($validation_flow)) {{ __('translation.update') }} @else {{ __('translation.add') }}  @endif</h2><br/><br/><br/>

                    <div class="row">

                        <div class="col-sm-12">

                                <form role="form" id="FormRegister" class="bucket-form" method="post" action="@if(isset($validation_flow))   {{route('update_workflow')}}  @else {{route('save_workflow')}} @endif" enctype="multipart/form-data">



                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-3" >
                                                    <div class="form-froup">
                                                        <b><label for="libelle" class="control-label">{{__('neutrale.valideur')}} * </label></b>
                                                        <input type="hidden" name="id_projet" value="{{$projet->id}}">
                                                        <select name="id_valideur" class="form-control">
                                                            <option>{{__('neutrale.selectionner')}}</option>
                                                            @foreach($users as $user)
                                                            <option value="{{$user->id}}" {{isset($validation_flow) && $validation_flow->id_valideur==$user->id?'selected':''}}>{{$user->nom}} {{$user->prenoms}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-froup">
                                                        <b><label for="libelle" class="control-label">{{__('neutrale.position')}} *</label></b>
                                                        <input type="number" class="form-control" id="position" name="position" placeholder="Position" min="0"  value="@if(isset($validation_flow)){{$validation_flow->position}}@endif" required>
                                                    <br>
                                                    </div>
                                                </div>
                                                <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="{{isset($validation_flow)? $validation_flow->id:''}}">
                                                 <br>
                                                 <div class="col-sm-2">
                                                <div class="form-group" >
                                                    <button type="submit" id="submit-all" class="btn btn-success form-control">@if(isset($validation_flow)) {{ __('translation.update') }} @else {{ __('translation.add') }}  @endif</button>
                                                </div>


                                            @if(isset($validation_flow))
                                                <a href="{{route('workflow',['locale'=>app()->getLocale(),'slug'=>$projet->id])}}">{{__('neutrale.ajouter')}}</a>
                                            @endif
                                            </div>

                                 </form>
                        </div>
                        <div class="col-sm-12 col-xr-12">



                            <table name ="projets" id="projets" class='table table-bordered table-striped  no-wrap '>

                                <thead>

                                <tr>
                                    <th class="dt-head-center">id</th>
                                    <th class="dt-head-center">valideur</th>
                                    <th class="dt-head-center">Position</th>
                                    <th class="dt-head-center">action</th>


                                </tr>
                                </thead>
                                <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">
                                    @foreach($validation_flows as $validation_flow)
                                        <tr>
                                            <td>{{$validation_flow->id}}</td>
                                            <td>{{$validation_flow->valideur->nom}} {{$validation_flow->valideur->prenoms}}</td>
                                            <td>{{$validation_flow->position}}</td>
                                            <td>
                                                <a href="{{route('supprimer_work_flow',['locale'=>app()->getLocale(),'id'=>$validation_flow->id])}}" data-toggle="modal" class="btn btn-danger pull-right">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                <a href="{{route('workflow_modifier',['locale'=>app()->getLocale(),'id'=>$validation_flow->id])}}" data-toggle="modal" class="btn btn-info pull-right">
                                                    <i class="fa fa-pencil"></i>
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
