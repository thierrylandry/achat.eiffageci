


        <table name ="fournisseurs" id="fournisseurs" class='table table-bordered table-striped  no-wrap '>

            <thead>

            <tr>
                <th class="dt-head-center">id</th>
                <th class="dt-head-center">nom</th>
                <th class="dt-head-center">prenoms</th>
                <th class="dt-head-center">abréviation</th>
                <th class="dt-head-center">fonction</th>
                <th class="dt-head-center">email</th>
                <th class="dt-head-center">Action</th>

            </tr>
            </thead>
            <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">
            @foreach($utilisateurs as $utilisateur )
                <tr>
                    <td>{{$utilisateur->id}}</td>
                    <td>{{$utilisateur->nom}}</td>
                    <td>{{$utilisateur->prenoms}}</td>
                    <td>{{$utilisateur->abréviation}}</td>
                    <td>{{$utilisateur->function}}</td>
                    <td>{{$utilisateur->email}}</td>
                    <td> <a href="{{route('voir_utilisateur',['slug'=>$utilisateur->slug])}}" data-toggle="modal" class="btn btn-info col-sm-4 pull-right">
                            <i class=" fa fa-pencil"></i>
                        </a>
                        <a href="{{route('supprimer_utilisateur',['slug'=>$utilisateur->slug])}}" data-toggle="modal" class="btn btn-danger col-sm-4 pull-right">
                            <i class=" fa fa-trash"></i>
                        </a>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>

