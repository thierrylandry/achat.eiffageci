@extends('layouts.app')
@section('produits')
    class='active'
@endsection
@section('parent_produits')
    class='active'
@endsection
@section('content')
    <a href="{{route('gestion_importation',['locale'=>app()->getLocale(),'id'=>$projet->id])}}" class="btn btn-default  pull-right"> {{__('neutrale.retour')}}</a>
        <div class="row">
            <div class="col-sm-6">
                <h4 class="modal-title">{{__('menu.signature')}} 1</h4>
                <br>
                    <form role="form" class="form-group" method="post" action="{{route('signature_update')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-inline">
                            <input type="hidden" class="form-control" id="type_signature" name="type_signature" value="1" required>
                            <input type="hidden" class="form-control" id="id" name="id_projet" placeholder="id" value="{{$projet->id}}" required>
                            <input type="file" class="form-control" id="signature1" name="signature"   required>
                        </div>

                        <br><div class="form-inline" >
                            <button type="submit" class="btn btn-success form-control">{{__('translation.add')}}</button>
                        </div>
                    </form>

            </div>
            <div class="col-sm-6">
                <img src="{{asset('storage/app/images/'.$projet->signature1)}}" id="blah1" width="225px" />
                <br>


            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <h4 class="modal-title">{{__('menu.signature')}} 2</h4>
                <br>
                    <form role="form" class="form-group" method="post" action="{{route('signature_update')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-inline">
                            <input type="hidden" class="form-control" id="type_signature" name="type_signature" value="2" required>
                            <input type="hidden" class="form-control" id="id" name="id_projet" placeholder="id" value="{{$projet->id}}" required>
                            <input type="file" class="form-control" id="signature2" name="signature"   required>
                        </div>

                        <br><div class="form-inline" >
                            <button type="submit" class="btn btn-success form-control">{{__('translation.add')}}</button>
                        </div>
                    </form>

            </div>
            <div class="col-sm-6">
                    <img src="{{asset('storage/app/images/'.$projet->signature2)}}" id="blah" width="225px" />
                <br>


            </div>
        </div>

<script>
    signature2.onchange = evt => {
        const [file] = signature2.files
        if (file) {
          blah.src = URL.createObjectURL(file)
        }
      }

      signature1.onchange = evt => {
        const [file] = signature1.files
        if (file) {
          blah1.src = URL.createObjectURL(file)
        }
      }
</script>

@endsection
