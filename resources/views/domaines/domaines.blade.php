@extends('layouts.app')
@section('menu_produit')
    class="active"
@endsection
@section('content')
    <h2>{{__('gestion_stock.domaine')}}  @if(isset($domaine)) {{ __('translation.update') }} @else {{ __('translation.add') }}  @endif</h2>
    </br>
    <div class="row">
        <!-- The Modal -->
        <div id="myModal" class="modal">
            <span class="close" id="close">&times;</span>
            <img class="modal-content" id="img01">
            <div id="caption"></div>
        </div>

        <div class="col-sm-4">
            @if(isset($domaine))

                <form role="form" id="FormRegister" class="bucket-form" method="post" action="{{route('update_domaine')}}" enctype="multipart/form-data">
                    @else
                        <form role="form" id="FormRegister" class="bucket-form" method="post" action="{{route('enregistrer_domaine')}}" enctype="multipart/form-data">
                            @endif


                            @csrf<div class="form-group">
                                <b><label for="libelle" class="control-label">{{__('gestion_stock.domaine')}}</label></b>
                                <input type="text" class="form-control" id="libelle" name="libelle" placeholder="{{__('gestion_stock.domaine')}}"  value="{{isset($domaine)? $domaine->libelleDomainne:''}}" required>
                            </div>
                            <br>
                            <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="{{isset($domaine)? $domaine->id:''}}">
                            <br>
                            <div class="form-group" >
                                <button type="submit" id="submit-all" class="btn btn-success form-control">@if(isset($domaine)) {{ __('translation.update') }} @else {{ __('translation.add') }}  @endif</button>
                            </div>
                            @if(isset($domaine))
                                <a href="{{route('domaines',app()->getLocale())}}">{{ __('translation.add') }}</a>
                            @endif

                        </form>
        </div>
        <div class="col-sm-12">



            <table data-page-length='5' name ="fournisseurs" id="fournisseurs" class='table table-bordered table-striped  no-wrap '>

                <thead>

                <tr>
                    <th class="dt-head-center">id</th>
                    <th class="dt-head-center">{{__('gestion_stock.domaine')}}</th>
                    <th class="dt-head-center">{{__('gestion_stock.action')}}</th>

                </tr>
                </thead>
                <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">
                @foreach($domaines as $domaine )
                    <tr>
                        <td>{{$domaine->id}}</td>
                       <td>{{$domaine->libelleDomainne}}</td>

                        <td>
                            <a href="{{route('supprimer_domaine',['locale'=>app()->getLocale(),'id'=>$domaine->id])}}" data-toggle="modal" class="btn btn-danger col-sm-4 pull-right">
                                <i class=" fa fa-trash"></i>
                            </a>
                            <a href="{{route('modifier_domaine',['locale'=>app()->getLocale(),'id'=>$domaine->id])}}" data-toggle="modal" class="btn btn-info col-sm-4 pull-right">
                                <i class=" fa fa-pencil"></i>
                            </a>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>

            <script>
                function voir(val){
                    var modal = document.getElementById('myModal');

                    // Get the image and insert it inside the modal - use its "alt" text as a caption
                    var img = val;
                    var modalImg = document.getElementById("img01");
                    var captionText = document.getElementById("caption");
                    img.onclick = function(){
                        modal.style.display = "block";
                        modalImg.src = this.src;
                        captionText.innerHTML = this.alt;
                    }

                    // Get the <span> element that closes the modal
                    var span = document.getElementsByClassName("close")[0];

                    // When the user clicks on <span> (x), close the modal
                    span.onclick = function() {
                        modal.style.display = "none";
                    }
                }
                // Get the modal

            </script>
        </div>
        <script>

            Dropzone.options.myDropzone = {
                url: "/uploads/",
                addRemoveLinks: true,

                // Prevents Dropzone from uploading dropped files immediately
                autoProcessQueue: false,

                init: function() {
                    var submitButton = document.querySelector("#submit-all")
                    myDropzone = this; // closure

                    submitButton.addEventListener("click", function() {
                        myDropzone.processQueue(); // Tell Dropzone to process all queued files.
                    });

                    // You might want to show the submit button only when
                    // files are dropped here:
                    this.on("addedfile", function() {
                        // Show submit button here and/or inform user to click it.
                    });

                }
            };
            Dropzone.prototype.defaultOptions.dictDefaultMessage =" Glissez deposer une image ici ou cliquer dans la case pour selectionner manuellement l'image";

        </script>

    </div>
    <script>

        var table= $('#fournisseurs').DataTable({
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
                { responsivePriority: 1, targets: 0 },
                { responsivePriority: 2, targets: -1 }
            ]
        }).column(0).visible(false);
        //table.DataTable().draw();

    </script>
@endsection