


        <table name ="fournisseurs" id="fournisseurs" class='table table-bordered table-striped  no-wrap '>

            <thead>

            <tr>
                <th class="dt-head-center">id</th>
                <th class="dt-head-center">Domaine</th>
                <th class="dt-head-center">Libelle</th>

                <th class="dt-head-center">Adresse Géographique</th>
                <th class="dt-head-center">Responsable</th>
                <th class="dt-head-center">Interlocuteur</th>
                <th class="dt-head-center">E-mail</th>
                <th class="dt-head-center">Action</th>

            </tr>
            </thead>
            <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">
            @foreach($fournisseurs as $fournisseur )
                <tr>
                    <td>{{$fournisseur->id_fournisseur}}</td>
                    <td>
                        @foreach($domaines as $domaine )
                            @if($domaine->id==$fournisseur->domaine)
                                {{$domaine->libelleDomainne}}
                            @endif
                        @endforeach

                    </td>
                    <td>{{$fournisseur->libelle}}</td>
                    <td>{{$fournisseur->adresseGeographique}}</td>
                    <td>{{$fournisseur->responsable}}</td>
                    <td>{{$fournisseur->interlocuteur}}</td>
                    <td>{{$fournisseur->email}}</td>
                    <td> <a href="{{route('voir_fournisseur',['slug'=>$fournisseur->slug])}}" data-toggle="modal" class="btn btn-info col-sm-4 pull-right">
                            <i class=" fa fa-pencil"></i>
                        </a>
                        <a href="{{route('supprimer_fournisseur',['slug'=>$fournisseur->slug])}}" data-toggle="modal" class="btn btn-danger col-sm-4 pull-right">
                            <i class=" fa fa-trash"></i>
                        </a>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>

