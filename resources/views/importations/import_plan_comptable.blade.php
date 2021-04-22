@extends('layouts.app')
@section('configuration')
    class='active'
@endsection
@section('content')
    <a href="" class="btn btn-default  pull-right"> {{__('neutrale.retour')}}</a>
        <div class="row">
            <div class="col-sm-6">
                <h4 class="modal-title">{{__('menu.import_plancomptable')}} Format : Excel XLSX</h4>
                <br>
                    <form role="form" class="form-group" method="post" action="{{route('import_code_comptable')}}" enctype="multipart/form-data">
                        @csrf
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
                        <div class="form-inline">


                            <input type="file" class="form-control" id="libelle" name="excel"   required>
                        </div>

                        <br><div class="form-inline" >
                            <button type="submit" class="btn btn-success form-control">{{__('translation.add')}}</button>
                        </div>
                    </form>

            </div>
            <div class="col-sm-6">


                        <a href="{{route("download_doc",['locale'=>app()->getLocale(),'namefile' => "trame_codecomptable.xlsx"])}}"><i class="fa fa-file-excel-o fa-3x" ></i><br> {{__('neutrale.telecharger_trame')}}</a>
                <br>


            </div>
        </div>



@endsection
