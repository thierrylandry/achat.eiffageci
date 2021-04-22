@extends('layouts.app')
@section('produits')
    class='active'
@endsection
@section('parent_produits')
    class='active'
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-6">

            <form role="form" class="form-group" method="post" action="{{route('import_designation')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-inline">
                    <input type="file" class="form-control" id="libelle" name="excel"   required>
                </div>

                <br><div class="form-inline" >
                    <button type="submit" class="btn btn-success form-control">{{__('translation.add')}}</button>
                </div>
            </form>

        </div>
        <div class="col-sm-6">


            <a href="{{route("download_doc",['locale'=>app()->getLocale(),'namefile' => "trame_analytique.xlsx"])}}"><i class="fa fa-file-excel-o fa-3x" ></i><br> {{__('neutrale.telecharger_trame')}}</a>
            <br>


        </div>
    </div>



@endsection
