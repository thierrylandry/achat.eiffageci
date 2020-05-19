
@extends('layouts.app')
@section('produits')
    class='active'
@endsection
@section('parent_fournisseurs')
    class='active'
@endsection
@section('content')
    <h2>LES PRODUITS ET SERVICES - {{isset($produit)? 'MODIFIER FOURNISSEUR':'AJOUTER UN PRODUIT'}}</h2>
    </br>
    <div class="row">
        <!-- The Modal -->
        <div id="myModal" class="modal">
            <span class="close" id="close">&times;</span>
            <img class="modal-content" id="img01">
            <div id="caption"></div>
        </div>

                <div class="col-sm-4">
@if(isset($produit))

                            <form role="form" id="FormRegister" class="bucket-form" method="post" action="{{route('modifier_produit')}}" enctype="multipart/form-data">
    @else
                                    <form role="form" id="FormRegister" class="bucket-form" method="post" action="{{route('Validproduits')}}" enctype="multipart/form-data">
    @endif


                        @csrf<div class="form-group">
                                            <b><label for="libelle" class="control-label">Libelle du matériel</label></b>
                                            <input type="text" class="form-control" id="libelleMateriel" name="libelleMateriel" placeholder="libelle"  value="{{isset($produit)? $produit->libelleMateriel:''}}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="type">type</label>
                                            <select class="form-control selectpicker" id="type" name="type" data-live-search="true" data-size="6" required>
                                                <option  value="">SELECTIONNER UN DOMAINE</option>
                                                @foreach($domaines as $domaine)
                                                    <option @if(isset($produit) and $produit->type==$domaine->id)
                                                            {{'selected'}}
                                                            @endif value="{{$domaine->id}}">{{$domaine->libelleDomainne}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="type">Code analytique par defaut</label>
                                            <select class="form-control selectpicker" id="code_analytique" name="code_analytique" data-live-search="true" data-size="6" required>
                                                <option  value="">SELECTIONNER UN CODE ANALYTIQUE</option>
                                                @foreach($analytiques as $analytique)
                                                    <option @if(isset($produit->code_analytique) and $analytique->codeRubrique==$produit->code_analytique)
                                                            {{'selected'}}
                                                            @endif value="{{$analytique->codeRubrique}}">{{$analytique->codeRubrique}} -- {{$analytique->libelle}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="type">Code gestion</label>
                                            <select class="form-control selectpicker" id="id_codeGestion" name="id_codeGestion" data-live-search="true" data-size="6" required>
                                                <option  value="">SELECTIONNER UN CODE GESTION</option>
                                                @foreach($gestions as $gestion)
                                                    <option @if(isset($produit->id_codeGestion) and $gestion->id==$produit->id_codeGestion)
                                                            {{'selected'}}
                                                            @endif value="{{$gestion->id}}" data-subtext="{{$gestion->description}}">{{$gestion->codeGestion}}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <br>

                                        <!--
                                        <div class="form-group dropzone"  id="my-dropzone" name="file">

                                        </div>
                                        -->
                                        <div class="form-group" >   <input type="file" name="image"/>
                                        </div>
                        <input type="hidden" class="form-control" id="slug" name="slug" placeholder="" value="{{isset($produit)? $produit->slug:''}}">
                        <br>
                                        <div class="form-group" >
                            <button type="submit" id="submit-all" class="btn btn-success form-control">{{isset($produit)? 'Modifier':'Ajouter'}}</button>
                        </div>
                        @if(isset($produit))
                            <a href="{{route('gestion_produit')}}">Ajouter un produit</a>
                            @endif

                    </form>
                </div>
                <div class="col-sm-8">
                    @include('produits/list_produit')
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
                url: "js/French.json"
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