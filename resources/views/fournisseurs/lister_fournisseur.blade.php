
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
    <script src="{{ URL::asset("js/dataTables.buttons.min.js") }}"></script>
    <script src="{{ URL::asset("js/buttons.flash.min.js") }}"></script>
    <script src="{{ URL::asset("js/jszip.min.js") }}"></script>
    <script src="{{ URL::asset("js/dataTable.pdfmaker.js") }}"></script>
    <script src="{{ URL::asset("js/vfs_fonts.js") }}"></script>
    <script src="{{ URL::asset("js/buttons.html5.min.js") }}"></script>
    <script src="{{ URL::asset("js/buttons.print.min.js") }}"></script>
    <script src="{{ URL::asset('js/jstree.min.js') }}"></script>
    <script src="{{ URL::asset('js/jstree.checkbox.js') }}"></script>
    <script src="{{ URL::asset('js/jstree.min.js') }}"></script>
    <script src="{{ URL::asset('js/jstree.checkbox.js') }}"></script>

    <link rel="stylesheet" href="{{URL::asset('css/morris.css')}}" type="text/css"/>
    <script src="{{URL::asset('js/raphael-min.js')}}"></script>
    <script src="{{URL::asset('js/morris.js')}}"></script>

    <h2>{{__('menu.fournisseurs')}} - {{__('translation.liste')}} <a href="{{route('ajouter_fournisseur',app()->getLocale())}}" class="btn btn-default  pull-right"> {{ __('translation.add') }}</a></h2>
</br>
</br>
        <table name ="fournisseurs1" id="fournisseurs1" class='table table-bordered table-striped  no-wrap ' >

            <thead>

            <tr>
                <th class="dt-head-center">id</th>
                <th class="dt-head-center">{{__('gestion_stock.domaine')}}</th>
                <th class="dt-head-center">{{__('gestion_stock.titre')}}</th>

                <th class="dt-head-center">{{__('gestion_stock.adresse_geographique')}}</th>
                <th class="dt-head-center">{{__('gestion_stock.responsable')}}</th>
                <th class="dt-head-center">{{__('gestion_stock.interlocuteur')}}</th>
                <th class="dt-head-center">{{__('translation.email')}}</th>
                <th class="dt-head-center">{{__('gestion_stock.action')}}</th>

            </tr>
            </thead>
            <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">
            @foreach($fournisseurs as $fournisseur )
                <tr>
                    <td>{{$fournisseur->id_fournisseur}}</td>
                    <td>
                        @foreach( $domaines as $domaine) @if(in_array($domaine->id, explode(",",$fournisseur->domaine))!= false) {{$domaine->libelleDomainne." "}}, @else @endif @endforeach
                    </td>
                    <td>{{$fournisseur->libelle}}</td>
                    <td>{{$fournisseur->adresseGeographique}}</td>
                    <td>{{$fournisseur->responsable}}</td>
                    <td>{{$fournisseur->interlocuteur}}</td>
                    <td>{{$fournisseur->email}}</td>
                    <td> <a href="{{route('modifier_fournisseur',['slug'=>$fournisseur->slug,'locale'=>app()->getLocale()])}}" data-toggle="modal" class="btn btn-info col-sm-4 pull-right">
                            <i class=" fa fa-pencil"></i>
                        </a>
                        <a href="{{route('supprimer_fournisseur',['slug'=>$fournisseur->slug,'locale'=>app()->getLocale()])}}" data-toggle="modal" class="btn btn-danger col-sm-4 pull-right">
                            <i class=" fa fa-trash"></i>
                        </a>
                    </td>

                </tr>
            @endforeach

            </tbody>
        </table>
        <script>
            var date =new Date();
            var table= $('#fournisseurs1').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [ 1,2,3,4,5]
                        },
                        text:"Copier",
                        filename: "{{__('menu.fournisseurs')}}" +date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                        className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                        messageTop: "{{__('menu.fournisseurs')}}" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                        footer: true

                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [ 1,2,3,4,5]
                        },
                        text:"Excel",
                        filename: "{{__('menu.fournisseurs')}} "+date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                        className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                        messageTop: "{{__('menu.fournisseurs')}}" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                        orientation: 'landscape',
                        footer: true

                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [ 1,2,3,4,5]
                        },
                        text:"PDF",
                        filename: "{{__('menu.fournisseurs')}}" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                        className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                        messageTop: "{{__('menu.fournisseurs')}}" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                        orientation: 'landscape',
                        footer: true

                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [ 1,2,3,4,5]
                        },
                        text:"Imprimer",
                        filename: "{{__('menu.fournisseurs')}}"+date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                        className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                        messageTop: "{{__('menu.fournisseurs')}}" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                        orientation: 'landscape',
                        footer: true

                    }
                ],
                language: {
                    @if(App()->getLocale()=='fr')
                    url: "../../public/js/French.json"
                    @elseif(App()->getLocale()=='en')
                    url: "../../public/js/English.json"
                    @endif
                },

                order: [[0, 'desc']],
                "createdRow": function( row, data, dataIndex){

                },
                responsive: true,
                columnDefs: [
                    { responsivePriority: 7, targets: 0 },
                    { responsivePriority: 2, targets: -2 }
                ],

            }).column(0).visible(false).column(5).visible(false);
            //table.DataTable().draw();

        </script>
@endsection