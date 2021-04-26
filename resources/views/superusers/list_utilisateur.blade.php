


        <table name ="fournisseurs" id="fournisseurs" class='table table-bordered table-striped  no-wrap '>

            <thead>

            <tr>
                <th class="dt-head-center">id</th>
                <th class="dt-head-center">{{__('translation.nom')}}</th>
                <th class="dt-head-center">{{__('translation.prenoms')}}</th>
                <th class="dt-head-center">{{__('translation.email')}}</th>
                <th class="dt-head-center">{{__('translation.role')}}</th>
                <th class="dt-head-center">{{__('neutrale.projet')}}</th>
                <th class="dt-head-center">{{__('neutrale.type_user')}}</th>
                <th class="dt-head-center">{{__('gestion_stock.action')}}</th>

            </tr>
            </thead>
            <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">
            @foreach($utilisateurs as $utilisateur )
                <tr @if($utilisateur->id_type_users==2) class="administrateur" @endif >
                    <td>{{$utilisateur->id}}</td>
                    <td>{{$utilisateur->nom}}</td>
                    <td>{{$utilisateur->prenoms}}</td>
                    <td>{{$utilisateur->email}}</td>
                    <td>
                        <ul>
                        @foreach($utilisateur->roles()->get() as $role)
                            <li>{{$role->description}}</li>
                        @endforeach
                        </ul>
                    </td>
                    <td>
                        <ul>
                        @foreach($utilisateur->projets()->get() as $projet)
                            <li>{{$projet->libelle}}</li>
                        @endforeach
                        </ul>
                    </td>
                    <td>{{isset($utilisateur->id_type_users) && $utilisateur->id_type_users==1?'Utilisateur':'Administrateur'}}</td>
                    <td> <a href="{{route('voir_superutilisateur',['locale'=>app()->getLocale(),'slug'=>$utilisateur->slug])}}" data-toggle="modal" class="btn btn-info col-sm-4 pull-right">
                            <i class=" fa fa-pencil"></i>
                        </a>
                        <a href="{{route('supprimer_utilisateur',['locale'=>app()->getLocale(),'slug'=>$utilisateur->slug])}}" data-toggle="modal" class="btn btn-danger col-sm-4 pull-right">
                            <i class=" fa fa-trash"></i>
                        </a>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>

