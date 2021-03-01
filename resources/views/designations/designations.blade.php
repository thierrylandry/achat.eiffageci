@extends('layouts.app')
@section('menu_produit')
    class="active"
@endsection
@section('content')
    <h2>LES DESIGNATIONS DE PRODUITS - {{isset($designation)? 'MODIFIER DESIGNATION':'AJOUTER UNE DESIGNATION'}}</h2>
    </br>
    <div class="row">
        <!-- The Modal -->
        <div id="myModal" class="modal">
            <span class="close" id="close">&times;</span>
            <img class="modal-content" id="img01">
            <div id="caption"></div>
        </div>

        <div class="col-sm-12">
            @if(isset($designation))

                <form role="form" id="FormRegister" class="bucket-form" method="post" action="{{route('update_designation')}}" enctype="multipart/form-data">
                    @else
                        <form role="form" id="FormRegister" class="bucket-form" method="post" action="{{route('enregistrer_designation')}}" enctype="multipart/form-data">
                            @endif


                            @csrf
                            <div class="row">
                                <div class="col-sm-1">  <div class="form-group">
                                        <label for="type">Type</label>
                                        <select class="form-control selectpicker" id="type_designation" name="type_designation" data-live-search="true" data-size="6" required>
                                            <option  value="">SELECTIONNER UN TYPE</option>
                                            @foreach($type_designations as $type_designations)
                                                <option @if(isset($designation) and $type_designations->id==$designation->type_designation)
                                                        {{'selected'}}
                                                        @endif value="{{$type_designations->id}}">{{$type_designations->libelle}}</option>
                                            @endforeach
                                        </select>
                                    </div></div>                                <div class="col-sm-3">  <div class="form-group">
                                        <label for="type">Famille</label>
                                        <select class="form-control selectpicker" id="id_famille" name="id_famille" data-live-search="true" data-size="6" required>
                                            <option  value="">SELECTIONNER UNE FAMILLE</option>
                                            @foreach($familles as $famille)
                                                <option @if(isset($designation) and $famille->id==$designation->id_famille)
                                                        {{'selected'}}
                                                        @endif value="{{$famille->id}}">{{$famille->libelle}}</option>
                                            @endforeach
                                        </select>
                                    </div></div>
                                <div class="col-sm-3"><div class="form-froup">
                                        <b><label for="libelle" class="control-label">Article</label></b>
                                        <input type="text" class="form-control" id="libelle" name="libelle" placeholder="libelle"  value="{{isset($designation)? $designation->libelle:''}}" required>
                                    </div></div>
                                <div class="col-sm-2"><div class="form-froup">
                                        <b><label for="libelle" class="control-label">Stock min</label></b>
                                        <input type="text" class="form-control" id="stock_min" name="stock_min" placeholder="Stock min"  value="{{isset($designation)? $designation->stock_min:''}}" >
                                    </div></div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="type">Code analytique par defaut</label>
                                        <select class="form-control selectpicker" id="code_analytique" name="code_analytique" data-live-search="true" data-size="6">
                                            <option  value="">SELECTIONNER UN CODE ANALYTIQUE</option>
                                            @foreach($analytiques as $analytique)
                                                <option @if(isset($designation->code_analytique) and $analytique->codeRubrique==$designation->code_analytique)
                                                        {{'selected'}}
                                                        @endif value="{{$analytique->codeRubrique}}">{{$analytique->codeRubrique}} -- {{$analytique->libelle}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                            </div>


                            <br>
                            <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="{{isset($designation)? $designation->id:''}}">
                            <br>
                            <div class="col-sm-4">
                                <div class="form-group" >
                                    <button type="submit" id="submit-all" class="btn btn-success form-control">{{isset($designation)? 'Modifier':'Ajouter'}}</button>
                                </div>
                            </div>
                            @if(isset($produit))
                                <a href="{{route('domaines')}}">Ajouter un domaine</a>
                            @endif

                        </form>
        </div>
        <div class="col-sm-12">



            <table data-page-length='5' name ="fournisseurs" id="fournisseurs" class='table table-bordered table-striped  no-wrap '>

                <thead>

                <tr>
                    <th class="dt-head-center">id</th>
                    <th class="dt-head-center">Famille</th>
                    <th class="dt-head-center">Article</th>
                    <th class="dt-head-center">Stock min</th>
                    <th class="dt-head-center">Type</th>
                    <th class="dt-head-center">Action</th>

                </tr>
                </thead>
                <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">
                @foreach($designations as $designation )
                    <tr>
                        <td>{{$designation->id}}</td>
                       <td>{{$designation->famille->libelle}}</td>
                       <td>{{$designation->libelle}}</td>
                       <td>{{$designation->stock_min}}</td>
                       <td>{{isset($designation->type_designation) && $designation->type_designation==1?'Suivi':'non suivi'}}</td>

                        <td>
                            <a href="{{route('supprimer_designation',['locale'=>app()->getLocale(),'id'=>$designation->id])}}" data-toggle="modal" class="btn btn-danger col-sm-4 pull-right">
                                <i class=" fa fa-trash"></i>
                            </a>
                            <a href="{{route('modifier_designation',['locale'=>app()->getLocale(),'id'=>$designation->id])}}" data-toggle="modal" class="btn btn-info col-sm-4 pull-right">
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