@extends('layouts.app')
@section('produits')
    class='active'
@endsection
@section('parent_produits')
    class='active'
@endsection
@section('content')
    <a href="{{route('gestion_importation',app()->getLocale())}}" class="btn btn-default  pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> {{__('translation.add')}}</a>
        <div class="row">
            <div class="col-sm-6">
                <h4 class="modal-title">{{__('menu.import_codetache')}} Format : Excel XLSX</h4>
                <br>
                    <form role="form" class="form-group" method="post" action="{{route('import_code_tache')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-inline">

                            <input type="hidden" class="form-control" id="id" name="id_projet" placeholder="id" value="{{$id_projet}}" required>
                            <input type="file" class="form-control" id="libelle" name="excel"   required>
                        </div>

                        <br><div class="form-inline" >
                            <button type="submit" class="btn btn-success form-control">{{__('translation.add')}}</button>
                        </div>
                    </form>

            </div>
            <div class="col-sm-6">


                        <a href="{{route("download_doc",['locale'=>app()->getLocale(),'namefile' => "trame_codetache.xlsx"])}}"><i class="fa fa-file-excel-o fa-3x" ></i><br> {{__('neutrale.telecharger_trame')}}</a>
                <br>


            </div>
        </div>



@endsection