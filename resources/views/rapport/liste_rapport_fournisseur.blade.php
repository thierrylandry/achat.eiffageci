@extends('layouts.app')
@section('rapport')
    class="active"
@endsection
@section('performance_fournisseur')
    class="active"
@endsection
@section('content')
    <h2>{{strtoupper('Performances fournisseurs et relations')}}  </h2>
    </br>
    <div class="row">
        <div class="col-sm-12">



            <table data-page-length='5' name ="fournisseurs" id="fournisseurs" class='table table-bordered table-striped  no-wrap '>

                <thead>

                <tr>
                    <th class="dt-head-center">id</th>
                    <th class="dt-head-center">Rapport</th>
                    <th class="dt-head-center">Action</th>
                </tr>
                </thead>
                <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">
                @foreach($rapports as $rapport )
                    <tr>
                        <td>{{$rapport->id}}</td>
                        <td>{{$rapport->libelle}}</td>
                        <td>
                            <a href="{{route('rapport',['id'=>$rapport->id,'locale'=>App()->getLocale()])}}" data-toggle="modal" class=" btn btn-default col-sm-4 pull-right">
                                <i class=" fa fa-area-chart">    </i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
            </script>
        </div>
    </div>
@endsection