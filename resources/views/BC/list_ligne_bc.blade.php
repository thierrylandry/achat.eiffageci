


<table name ="ligneCommandes" id="ligneCommandes" class='table table-bordered table-striped  no-wrap '>

    <thead>

    <tr>
        <th class="dt-head-center">slug</th>
        <th class="">Designation</th>
        <th class="">Code Analytique</th>
        <th class="">Quantité</th>
        <th class="">Unité</th>
        <th class="">Pu HT</th>
        <th class="">remise %</th>
        <th class="">Total  HT</th>
        <th class="">Action</th>

    </tr>
    </thead>
    <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">
    @foreach($ligne_bcs as $ligne_bc )
        <tr>
            <td>{{$ligne_bc->slug}}</td>
            <td>{{$ligne_bc->titre_ext}}</td>
            <td>{{$ligne_bc->quantite_ligne_bc}}</td>
            <td>
                {{$ligne_bc->unite_ligne_bc}}
            </td>
            <td>  {{$ligne_bc->prix_unitaire_ligne_bc}}</td>
            <td>  {{$ligne_bc->remise_ligne_bc}}</td>
            <td>  {{$ligne_bc->prix_tot}}</td>
            <td>
                <a href="{{route('supprimer_bc',['slug'=>$bc->slug])}}" data-toggle="modal" class="btn btn-danger col-sm-1 ">
                    <i class=" fa fa-trash"></i>
                </a>

                <a href="{{route('voir_bc',['slug'=>$bc->slug])}}" data-toggle="modal" class="btn btn-info col-sm-1 ">
                    <i class=" fa fa-pencil"></i>
                </a>

            </td>

        </tr>
    @endforeach
    </tbody>
</table>

</script>