@extends('layouts.app')
@section('menu_produit')
    class="active"
@endsection
@section('content')
    <h2>{{__('gestion_stock.article')}} / @if(isset($famille)) {{ __('translation.update') }} @else {{ __('translation.add') }}  @endif</h2>
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
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="type">{{__('gestion_stock.type')}}</label>
                                        <select class="form-control selectpicker" id="type_designation" name="type_designation" data-live-search="true" data-size="6" required>
                                            <option  value="">{{__('sortie_materiel.selectionner_type')}}</option>
                                            @foreach($type_designations as $type_designations)
                                                <option @if(isset($designation) and $type_designations->id==$designation->type_designation)
                                                        {{'selected'}}
                                                        @endif value="{{$type_designations->id}}">{{$type_designations->libelle}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="type">{{__('gestion_stock.famille')}}</label>
                                        <select class="form-control selectpicker" id="id_famille" name="id_famille" data-live-search="true" data-size="6" required>
                                            <option  value="">{{__('sortie_materiel.selectionner_famille')}}</option>
                                            @foreach($familles as $famille)
                                                <option @if(isset($designation) and $famille->id==$designation->id_famille)
                                                        {{'selected'}}
                                                        @endif value="{{$famille->id}}">{{$famille->libelle}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-froup">
                                        <b><label for="libelle" class="control-label">{{__('gestion_stock.article')}}</label></b>
                                        <input type="text" class="form-control" id="libelle" name="libelle" placeholder="libelle"  value="{{isset($designation)? $designation->libelle:''}}" required>
                                    </div>

                                </div>
                                <div class="col-sm-3">
                                    <div class="form-froup">
                                        <b><label for="libelle" class="control-label">{{__('gestion_stock.stock_min')}}</label></b>
                                        <input type="text" class="form-control" id="stock_min" name="stock_min" placeholder="{{__('gestion_stock.stock_min')}}"  value="{{isset($designation)? $designation->stock_min:''}}" >
                                    </div>
                                    <div class="form-group">
                                        <label for="type">{{__('gestion_stock.code_analytique')}}</label>
                                        <select class="form-control selectpicker" id="code_analytique" name="code_analytique" data-live-search="true" data-size="6">
                                            <option  value="">{{__('sortie_materiel.selectionner_code_analytique')}}</option>
                                            @foreach($analytiques as $analytique)
                                                <option @if(isset($designation->code_analytique) and $analytique->codeRubrique==$designation->code_analytique)
                                                        {{'selected'}}
                                                        @endif value="{{$analytique->codeRubrique}}">{{$analytique->codeRubrique}} -- {{$analytique->libelle}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="type">{{__('menu.code_comptable')}} </label>
                                        <select class="form-control selectpicker" id="code_comptable" name="code_comptable" data-live-search="true" data-size="6">
                                            <option  value="">{{__('neutrale.selectionner')}}</option>
                                            @foreach($code_comptables as $code_comptable)
                                                <option @if(isset($designation->code_comptable) and $code_comptable->code==$designation->code_comptable)
                                                        {{'selected'}}
                                                        @endif value="{{$code_comptable->code}}" >{{$code_comptable->code}} -- {{$code_comptable->libelle}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <br>
                                         <div class="form-group" >
                                            <button type="submit" id="submit-all" class="btn btn-success form-control">@if(isset($designation)) {{ __('translation.update') }} @else {{ __('translation.add') }}  @endif</button>
                                        </div>

                                    @if(isset($designation))
                                        <a href="{{route('designations',app()->getLocale())}}">@if(isset($designation)) {{ __('translation.add') }} @else {{ __('translation.update') }}  @endif</a>
                                    @endif
                                </div>


                            <br>
                            <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="{{isset($designation)? $designation->id:''}}">


                        </form>
        </div>
        <div class="col-sm-12">



            <table data-page-length='5' name ="fournisseurs" id="fournisseurs" class='table table-bordered table-striped  no-wrap '>

                <thead>

                <tr>
                    <th class="dt-head-center">id</th>
                    <th class="dt-head-center">{{__('gestion_stock.famille')}}</th>
                    <th class="dt-head-center">{{__('gestion_stock.article')}}</th>
                    <th class="dt-head-center">{{__('gestion_stock.code_analytique')}}</th>
                    <th class="dt-head-center">{{__('menu.code_comptable')}}</th>
                    <th class="dt-head-center">{{__('gestion_stock.stock_min')}}</th>
                    <th class="dt-head-center">{{__('gestion_stock.type')}}</th>
                    <th class="dt-head-center">{{__('gestion_stock.action')}}</th>

                </tr>
                </thead>
                <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">
                @foreach($designations as $designation )
                    <tr>
                        <td>{{$designation->id}}</td>
                       <td>{{$designation->famille->libelle}}</td>
                       <td>{{$designation->libelle}}</td>
                       <td>{{isset($designation->lecode_analytique)?$designation->lecode_analytique->codeRubrique:''}}- {{isset($designation->lecode_analytique)?$designation->lecode_analytique->libelle:''}}</td>
                       <td>{{isset($designation->lecode_comptable)?$designation->lecode_comptable->codeRubrique:''}}- {{isset($designation->lecode_comptable)?$designation->lecode_analytique->libelle:''}}</td>
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
