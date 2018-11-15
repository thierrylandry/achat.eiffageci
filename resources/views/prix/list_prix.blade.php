


        <table name ="fournisseurs" id="fournisseurs" class='table table-bordered table-striped  no-wrap '>

            <thead>

            <tr>
                <th class="dt-head-center">id</th>
                <th class="dt-head-center">Fournisseur</th>
                <th class="dt-head-center">Mareriel</th>
                <th class="dt-head-center">Prix</th>
                <th class="dt-head-center">Unité</th>
                <th class="dt-head-center">date</th>
                <th class="dt-head-center">Action</th>

            </tr>
            </thead>
            <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">
            @foreach($prixs as $prix )
                <tr>
                    <td>{{$prix->id}}</td>
                    <td>@foreach($fournisseurs as $fournisseur )
                            @if($fournisseur->id==$prix->id_fournisseur)
                               {{$fournisseur->libelle}}
                                @endif
                        @endforeach</td>
                    <td>@foreach($materiels as $materiel )
                            @if($materiel->id==$prix->id_materiel)
                                {{$materiel->libelleMateriel}}
                            @endif
                        @endforeach</td>
                    <td>{{$prix->prix}}</td>
                    <td>{{$prix->unite}}</td>
                    <td>{{$prix->date}}</td>
                    <td> <a href="{{route('voir_prix',['slug'=>$prix->slug])}}" data-toggle="modal" class="btn btn-info col-sm-4 pull-right">
                            <i class=" fa fa-pencil"></i>
                        </a>
                        <a href="{{route('supprimer_prix',['slug'=>$prix->slug])}}" data-toggle="modal" class="btn btn-danger col-sm-4 pull-right">
                            <i class=" fa fa-trash"></i>
                        </a>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>

