


        <table data-page-length='5' name ="fournisseurs" id="fournisseurs" class='table table-bordered table-striped  no-wrap '>

            <thead>

            <tr>
                <th class="dt-head-center">id</th>
                <th class="dt-head-center">image</th>
                <th class="dt-head-center">libelle Mareriel</th>
                <th class="dt-head-center">Type</th>
                <th class="dt-head-center">Action</th>

            </tr>
            </thead>
            <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">
            @foreach($produits as $produit )
                <tr>
                    <td>{{$produit->id}}</td>
                    <td> @if($produit->image<>"")<img src="{{ URL::asset('/uploads/'.$produit->image)}}" width="100px" height="100px" alt="Snow" onclick="voir(this)"/> @endif </td>
                    <td>{{$produit->libelleMateriel}}</td>
                    <td>
                        @foreach($domaines as $domaine )
                            @if($domaine->id==$produit->type)
                                {{$domaine->libelleDomainne}}
                            @endif
                        @endforeach</td>
                    <td> <a href="{{route('voir_produit',['slug'=>$produit->slug])}}" data-toggle="modal" class="btn btn-info col-sm-4 pull-right">
                            <i class=" fa fa-pencil"></i>
                        </a>
                        <a href="{{route('supprimer_produit',['slug'=>$produit->slug])}}" data-toggle="modal" class="btn btn-danger col-sm-4 pull-right">
                            <i class=" fa fa-trash"></i>
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