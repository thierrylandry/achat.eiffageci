
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
                <div class="col-sm-4">
@if(isset($produit))

                            <form role="form" id="FormRegister" class="bucket-form" method="post" action="{{route('modifier_produit')}}" enctype="multipart/form-data">
    @else
                                    <form role="form" id="FormRegister" class="bucket-form" method="post" action="{{route('Validproduits')}}">
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


                                        <br>

                                        <div class="form-group">
                                            <span class="btn btn-success fileinput-button">
                                                           <i class="glyphicon glyphicon-plus"></i>
                                                             <span>Add files...</span>
                                                <!-- The file input field used as target for the file upload widget -->
                                                            <input id="fileupload" type="file" name="files[]" multiple>

                                            </span>
                                            <br>
                                            <br>
                                            <!-- The global progress bar -->
                                            <div id="progress" class="progress">
                                                <div class="progress-bar progress-bar-success"></div>
                                            </div>
                                            <!-- The container for the uploaded files -->
                                            <div id="files" class="files"></div>
                                            <br>
                                        </div>
                        <input type="hidden" class="form-control" id="slug" name="slug" placeholder="" value="{{isset($produit)? $produit->slug:''}}">
                        <br>
                                        <div class="form-group" >
                            <button type="submit" class="btn btn-success form-control">{{isset($produit)? 'Modifier':'Ajouter'}}</button>
                        </div>
                        @if(isset($produit))
                            <a href="{{route('gestion_produit')}}">Ajouter un produit</a>
                            @endif

                    </form>
                </div>
                <div class="col-sm-8">
                    @include('produits/list_produit')
                </div>
        <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
        <script src="js/vendor/jquery.ui.widget.js"></script>
        <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
        <script src="https://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
        <!-- The Canvas to Blob plugin is included for image resizing functionality -->
        <script src="https://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>

        <script src="{{ URL::asset('js/jquery.iframe-transport.js') }}"></script>
        <!-- The basic File Upload plugin -->
        <script src="{{ URL::asset('js/jquery.fileupload.js') }}"></script>
        <!-- The File Upload processing plugin -->
        <script src="{{ URL::asset('js/jquery.fileupload-process.js') }}"></script>
        <!-- The File Upload image preview & resize plugin -->
        <script src="{{ URL::asset('js/jquery.fileupload-image.js') }}"></script>
        <!-- The File Upload audio preview plugin -->
        <script src="{{ URL::asset('js/jquery.fileupload-audio.js') }}"></script>
        <!-- The File Upload video preview plugin -->
        <script src="{{ URL::asset('js/jquery.fileupload-video.js') }}"></script>
        <!-- The File Upload validation plugin -->
        <script src="{{ URL::asset('js/jquery.fileupload-validate.js') }}"></script>
        <script>
            console.log(window.location.hostname);
            /*jslint unparam: true, regexp: true */
            /*global window, $ */
            $(function () {
                'use strict';
                // Change this to the location of your server-side upload handler:
                var url = "http://localhost:8080/achat.eiffageci/storage/image_materiel",
                        uploadButton = $('<button/>')
                                .addClass('btn btn-primary')
                                .prop('disabled', true)
                                .text('Processing...')
                                .on('click', function () {
                                    var $this = $(this),
                                            data = $this.data();
                                    $this
                                            .off('click')
                                            .text('Abort')
                                            .on('click', function () {
                                                $this.remove();
                                                data.abort();
                                            });
                                    data.submit().always(function () {
                                        $this.remove();
                                    });
                                });
                $('#fileupload').fileupload({
                    url: url,
                    dataType: 'json',
                    autoUpload: false,
                    acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
                    maxFileSize: 999000,
                    // Enable image resizing, except for Android and Opera,
                    // which actually support image resizing, but fail to
                    // send Blob objects via XHR requests:
                    disableImageResize: /Android(?!.*Chrome)|Opera/
                            .test(window.navigator.userAgent),
                    previewMaxWidth: 100,
                    previewMaxHeight: 100,
                    previewCrop: true
                }).on('fileuploadadd', function (e, data) {
                    data.context = $('<div/>').appendTo('#files');
                    $.each(data.files, function (index, file) {
                        var node = $('<p/>')
                                .append($('<span/>').text(file.name));
                        if (!index) {
                            node
                                    .append('<br>')
                                    .append(uploadButton.clone(true).data(data));
                        }
                        node.appendTo(data.context);
                    });
                }).on('fileuploadprocessalways', function (e, data) {
                    var index = data.index,
                            file = data.files[index],
                            node = $(data.context.children()[index]);
                    if (file.preview) {
                        node
                                .prepend('<br>')
                                .prepend(file.preview);
                    }
                    if (file.error) {
                        node
                                .append('<br>')
                                .append($('<span class="text-danger"/>').text(file.error));
                    }
                    if (index + 1 === data.files.length) {
                        data.context.find('button')
                                .text('Upload')
                                .prop('disabled', !!data.files.error);
                    }
                }).on('fileuploadprogressall', function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('#progress .progress-bar').css(
                            'width',
                            progress + '%'
                    );
                }).on('fileuploaddone', function (e, data) {
                    $.each(data.result.files, function (index, file) {
                        if (file.url) {
                            var link = $('<a>')
                                    .attr('target', '_blank')
                                    .prop('href', file.url);
                            $(data.context.children()[index])
                                    .wrap(link);
                        } else if (file.error) {
                            var error = $('<span class="text-danger"/>').text(file.error);
                            $(data.context.children()[index])
                                    .append('<br>')
                                    .append(error);
                        }
                    });
                }).on('fileuploadfail', function (e, data) {
                    $.each(data.files, function (index) {
                        var error = $('<span class="text-danger"/>').text('File upload failed.');
                        $(data.context.children()[index])
                                .append('<br>')
                                .append(error);
                    });
                }).prop('disabled', !$.support.fileInput)
                        .parent().addClass($.support.fileInput ? undefined : 'disabled');
            });
        </script>

    </div>
@endsection