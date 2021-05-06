
@extends('layouts.app')
@section('configuration')
    class='active'
@endsection
@section('content')


    <h2>{{ __('neutrale.taux_change') }}  @if(isset($projet)) {{ __('translation.update') }} @else {{ __('translation.add') }}  @endif</h2><br/><br/><br/>

                    <div class="row">

                        <div class="col-sm-12">

                                <form role="form" id="FormRegister" class="bucket-form" method="post" action="@if(isset($taux_change))   {{route('update_taux_change')}}  @else {{route('ajouter_taux_change')}} @endif" enctype="multipart/form-data">



                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-3" >
                                                    <div class="form-froup">
                                                        <b><label for="libelle" class="control-label">Date</label></b>
                                                        <input type="date" class="form-control" id="date" name="date" placeholder="libelle"  value="{{isset($taux_change)? $taux_change->date:date('Y-m-d')}}" required>
                                                    <br>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-froup">
                                                        <b><label for="libelle" class="control-label">EUR_XOF</label></b>
                                                        <input type="number" class="form-control" id="EUR_XOF" name="EUR_XOF" placeholder="EUR_XOF"  value="@if(isset($taux_change)){{$taux_change->EUR_XOF}}@elseif(isset($EUR_XOF)){{$EUR_XOF}}@else   @endif" required>
                                                    <br>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-froup">
                                                        <b><label for="libelle" class="control-label">EUR_USD</label></b>
                                                        <input type="number" class="form-control" id="EUR_USD" name="EUR_USD" placeholder="EUR_USD"  value="@if(isset($taux_change)){{$taux_change->EUR_USD}}@elseif(isset($EUR_USD)){{$EUR_USD}}@else   @endif" required>
                                                    </div>
                                                    <br>
                                                </div>
                                                <div class="col-sm-2" >
                                                    <div class="form-froup">
                                                        <b><label for="libelle" class="control-label">USD_XOF</label></b>
                                                        <input type="number" class="form-control" id="USD_XOF" name="USD_XOF" placeholder="USD_XOF"  value="@if(isset($taux_change)){{$taux_change->USD_XOF}}@elseif(isset($USD_XOF)){{$USD_XOF}}@else   @endif" required>
                                                    </div>
                                                    <br>
                                                </div>
                                                <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="{{isset($taux_change)? $taux_change->id:''}}">
                                                 <br>
                                                 <div class="col-sm-2">
                                                <div class="form-group" >
                                                    <button type="submit" id="submit-all" class="btn btn-success form-control">@if(isset($taux_change)) {{ __('translation.update') }} @else {{ __('translation.add') }}  @endif</button>
                                                </div>


                                                @if(isset($taux_change))
                                                <a href="{{route('taux_change',app()->getLocale())}}">{{__('neutrale.ajouter')}}</a>
                                            @endif
                                            </div>

                                 </form>
                        </div>
                        <div class="col-sm-12 col-xr-12">



                            <table name ="projets" id="projets" class='table table-bordered table-striped  no-wrap '>

                                <thead>

                                <tr>
                                    <th class="dt-head-center">id</th>
                                    <th class="dt-head-center">Date</th>
                                    <th class="dt-head-center">EUR_XOF</th>
                                    <th class="dt-head-center">EUR_USD</th>
                                    <th class="dt-head-center">USD_XOF</th>
                                    <th class="dt-head-center">action</th>


                                </tr>
                                </thead>
                                <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">

                                    @foreach ($taux_changes as $taux_change )
                                        <tr>
                                            <td>{{$taux_change->id}}</td>
                                            <td>{{$taux_change->date}}</td>
                                            <td>{{$taux_change->EUR_XOF}}</td>
                                            <td>{{$taux_change->EUR_USD}}</td>
                                            <td>{{$taux_change->USD_XOF}}</td>
                                            <td>
                                                <a href="{{route('supprimer_taux_change',['locale'=>app()->getLocale(),'id'=>$taux_change->id])}}" data-toggle="modal" class="btn btn-danger pull-right">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                <a href="{{route('modifier_taux_change',['locale'=>app()->getLocale(),'id'=>$taux_change->id])}}" data-toggle="modal" class="btn btn-info pull-right">
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
