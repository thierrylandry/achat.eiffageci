
@extends('layouts.app')
@section('fournisseurs')
    class='active'
@endsection
@section('parent_fournisseurs')
    class='active'
@endsection
@section('lister_fournisseurs')
    class='active'
@endsection
@section('content')
    <h2>LES FOURNISSEURS - LISTER FOURNISSEURS <a href="{{route('ajouter_fournisseur')}}" class="btn btn-default  pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> Ajouter</a></h2>
</br>
</br>
        <table name ="fournisseurs1" id="fournisseurs1" class='table table-bordered table-striped  no-wrap '>

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

                        @foreach( $domaines as $domaine)
                            @if(in_array($domaine->id, explode(",",$fournisseur->domaine))!= false)
                                {{$domaine->libelleDomainne." "}}
                            @else
                            @endif
                        @endforeach

                    </td>
                    <td>{{$fournisseur->libelle}}</td>
                    <td>{{$fournisseur->adresseGeographique}}</td>
                    <td>{{$fournisseur->responsable}}</td>
                    <td>{{$fournisseur->interlocuteur}}</td>
                    <td>{{$fournisseur->email}}</td>
                    <td> <a href="{{route('modifier_fournisseur',['slug'=>$fournisseur->slug])}}" data-toggle="modal" class="btn btn-info col-sm-4 pull-right">
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
        <script>

            var table= $('#fournisseurs1').DataTable({
                language: {
                    url: "js/French.json"
                },
                "ordering":true,
                "responsive": true,
                "createdRow": function( row, data, dataIndex){

                }
            }).column(0).visible(false);
            //table.DataTable().draw();

        </script>
@endsection