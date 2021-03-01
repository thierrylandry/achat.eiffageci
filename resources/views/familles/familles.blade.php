@extends('layouts.app')
@section('menu_produit')
    class="active"
@endsection
@section('content')
    <h2>LES FAMILLES DE PRODUITS - {{isset($famille)? 'MODIFIER FAMILLE':'AJOUTER UNE FAMILLE'}}</h2>
    </br>
    <div class="row">
        <!-- The Modal -->
        <div id="myModal" class="modal">
            <span class="close" id="close">&times;</span>
            <img class="modal-content" id="img01">
            <div id="caption"></div>
        </div>

        <div class="col-sm-12">
            @if(isset($famille))

                <form role="form" id="FormRegister" class="bucket-form" method="post" action="{{route('update_famille')}}" enctype="multipart/form-data">
                    @else
                        <form role="form" id="FormRegister" class="bucket-form" method="post" action="{{route('enregistrer_famille')}}" enctype="multipart/form-data">
                            @endif


                            @csrf
                            <div class="row">
                                <div class="col-sm-6">  <div class="form-group">
                                        <label for="type">Domaine</label>
                                        <select class="form-control selectpicker" id="id_domaine" name="id_domaine" data-live-search="true" data-size="6" required>
                                            <option  value="">SELECTIONNER UN DOMAINE</option>
                                            @foreach($domaines as $domaine)
                                                <option @if(isset($famille) and $domaine->id==$famille->id_domaine)
                                                        {{'selected'}}
                                                        @endif value="{{$domaine->id}}">{{$domaine->libelleDomainne}}</option>
                                            @endforeach
                                        </select>
                                    </div></div>
                                <div class="col-sm-6"><div class="form-froup">
                                        <b><label for="libelle" class="control-label">Libelle de la  famille</label></b>
                                        <input type="text" class="form-control" id="libelle" name="libelle" placeholder="libelle"  value="{{isset($famille)? $famille->libelle:''}}" required>
                                    </div></div>
                            </div>


                            <br>
                            <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="{{isset($famille)? $famille->id:''}}">
                            <br>
                            <div class="col-sm-4">
                                <div class="form-group" >
                                    <button type="submit" id="submit-all" class="btn btn-success form-control">{{isset($famille)? 'Modifier':'Ajouter'}}</button>
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
                    <th class="dt-head-center">domaine</th>
                    <th class="dt-head-center">famille</th>
                    <th class="dt-head-center">Action</th>

                </tr>
                </thead>
                <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">
                @foreach($familles as $famille )
                    <tr>
                        <td>{{$famille->id}}</td>
                       <td>{{$famille->domaine->libelleDomainne}}</td>
                       <td>{{$famille->libelle}}</td>

                        <td>
                            <a href="{{route('supprimer_famille',['locale'=>app()->getLocale(),'id'=>$famille->id])}}" data-toggle="modal" class="btn btn-danger col-sm-4 pull-right">
                                <i class=" fa fa-trash"></i>
                            </a>
                            <a href="{{route('modifier_famille',['locale'=>app()->getLocale(),'id'=>$famille->id])}}" data-toggle="modal" class="btn btn-info col-sm-4 pull-right">
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