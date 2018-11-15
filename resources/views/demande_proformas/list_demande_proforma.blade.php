


        <table name ="fournisseurs" id="fournisseurs" class='table table-bordered table-striped  no-wrap '>

            <thead>

            <tr>
                <th class="dt-head-center">id</th>
                <th class="dt-head-center">libelle Mareriel</th>
                <th class="dt-head-center">Type</th>
                <th class="dt-head-center">Action</th>

            </tr>
            </thead>
            <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">
            @foreach($produits as $produit )
                <tr>
                    <td>{{$produit->id}}</td>
                    <td>{{$produit->libelleMateriel}}</td>
                    <td>{{$produit->type}}</td>
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

