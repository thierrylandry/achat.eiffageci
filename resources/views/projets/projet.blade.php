
@extends('layouts.app')
@section('projets')
    class='active'
@endsection
@section('parent_fournisseurs')
    class='active'
@endsection
@section('content')
    <h2>{{ __('neutrale.projet') }}  @if(isset($utilisateur)) {{ __('translation.update') }} @else {{ __('translation.add') }}  @endif</h2><br/><br/><br/>

    <div class="row">
        @if(isset($utilisateur))
            <form role="form" id="FormRegister" class="bucket-form" method="post" action="{{route('modifier_utilisateur')}}">
                @else
                    <form role="form" id="FormRegister" class="bucket-form" method="post" action="{{route('Validutilisateurs')}}">
                        @endif

                    </form>
                    </br>
                    </br>
                    </br>
                    <div class="row">
                        <div class="col-sm-12 col-xr-12">



                            <table name ="projets" id="projets" class='table table-bordered table-striped  no-wrap '>

                                <thead>

                                <tr>
                                    <th class="dt-head-center">id</th>
                                    <th class="dt-head-center">{{ __('neutrale.projet') }}</th>
                                    <th class="dt-head-center">{{__('gestion_stock.action')}}</th>

                                </tr>
                                </thead>
                                <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">

                                </tbody>
                            </table>


                        </div>
                    </div>

                    <!-- Script pour générer l'adresse e-mail à partir du nom et prénoms saisi -->
                    <script type="application/javascript">

                        var txtnom = document.getElementById('nom');
                        var txtprenoms = document.getElementById('prenoms');

                        function génère_mail()
                        {
                            var mail = txtprenoms.value +'.'+ txtnom.value + '@eiffage.com';
                            document.getElementById('email').value = mail;
                        }

                        txtprenoms.addEventListener('keydown', function (e) {génère_mail()});
                        txtprenoms.addEventListener('change', function (e) {génère_mail()});
                        txtnom.addEventListener('change', function (e) {génère_mail()});
                        txtnom.addEventListener('keydown', function (e) {génère_mail()});

                        $(document).ready(function (e) {
                            //  génère_mail();
                        });

                        var table= $('#fournisseurs').DataTable({
                            language: {
                                @if(App()->getLocale()=='fr')
                                url: "../public/js/French.json"
                                @elseif(App()->getLocale()=='en')
                                url: "../public/js/English.json"
                                @endif
                            },
                            "ordering":true,
                            "responsive": true,
                            "createdRow": function( row, data, dataIndex){

                            },
                            columnDefs: [
                                { responsivePriority: 5, targets: 0 },
                                { responsivePriority: 4, targets: -1 }
                            ]
                        }).column(0).visible(false);
                        //table.DataTable().draw();


                    </script>
@endsection