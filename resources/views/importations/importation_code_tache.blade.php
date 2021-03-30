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
                <h4 class="modal-title">{{__('menu.import_codetache')}}</h4>
                <br>
                    <form role="form" class="form-group" method="post" action="{{route('import_code_tache')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-inline">

                            <input type="hidden" class="form-control" id="id" name="id_projet" placeholder="id" value="{{$id_projet}}" required>
                            <input type="file" class="form-control" id="libelle" name="excel"  required>
                        </div>

                        <br><div class="form-inline" >
                            <button type="submit" class="btn btn-success form-control">{{__('translation.add')}}</button>
                        </div>
                    </form>

            </div>
        </div>



@endsection