@extends('layouts.app')
@section('rapport')
    class="active"
@endsection
@if($rapport->id_type_rapport==1)
@section('performance_fournisseur')
    class="active"
@endsection
@elseif($rapport->id_type_rapport==2)
@section('rapport_stock')
    class="active"
@endsection
@elseif($rapport->id_type_rapport==3)
@section('rapport_demande_achat')
    class="active"
@endsection
@endif
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
    <style>
        ul li {
            margin-bottom:1.4rem;
        }
        .pricing-divider {
            border-radius: 20px;
            background: #f0bcb4;
            padding: 1em 0 4em;
            position: relative;
        }
        .blue .pricing-divider{
            background: #f0bcb4;
        }
        .green .pricing-divider {
            background: #f0bcb4;
        }
        .red b {
            color:#f0bcb4
        }
        .blue b {
            color:#f0bcb4
        }
        .green b {
            color:#f0bcb4
        }
        .pricing-divider-img {
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 80px;
        }
        .deco-layer {
            -webkit-transition: -webkit-transform 0.5s;
            transition: transform 0.5s;
        }
        .btn-custom  {
            background:#f0bcb4; color:#fff; border-radius:20px
        }

        .img-float {
            width:50px; position:absolute;top:-3.5rem;right:1rem
        }

        .princing-item {
            transition: all 150ms ease-out;
        }
        .princing-item:hover {
            transform: scale(1.05);
        }
        .princing-item:hover .deco-layer--1 {
            -webkit-transform: translate3d(15px, 0, 0);
            transform: translate3d(15px, 0, 0);
        }
        .princing-item:hover .deco-layer--2 {
            -webkit-transform: translate3d(-15px, 0, 0);
            transform: translate3d(-15px, 0, 0);
        }

        div.dropdown-menu.open { width: 100%; } ul.dropdown-menu.inner>li>a { white-space: initial; }
        #fournisseur_categorie > tbody .stock_min{
            background-color: red!important;
            color: white!important;
        }

    </style>
   <h2 align="center">@if(App()->getLocale()=="fr")
           {{$rapport->libelle}}
       @elseif(App()->getLocale()=="en")
           {{$rapport->libelle_en}}
       @endif  <a href="{{url()->previous()}}" class="btn btn-info pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{__('pagination.previous')}}</a></h2>

</br>
</br>
</br>
    <div class="row">

        @if($rapport->id==1)
        <div class=" col-sm-12 ">
            <div class="stats-title">
            </div>
            <div class="stats-body">
                <table class="table"  id="delai_prouit" style="width: 100%">
                    <thead>
                    <tr>
                        <td>{{__('menu.fournisseurs')}}</td>
                        <td>{{__('neutrale.jour')}}</td>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($tableaux))
                        @foreach($tableaux as $res)
                            <tr>
                                <td>{{$res->libelle}}</td>
                                <td>{{number_format($res->moyenne_jour_livraison,'0',',','.')}} </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>

                </table>
            </div>
        </div>

        @elseif($rapport->id==2)
            <div class="col-md-4 chart_agile_right">
                </br>
                </br>
                <div class="chart_agile_top">
                    <div class="chart_agile_bottom" style="text-align: center">

                        <div id="graph4"></div>
                        <script>

                            var tableaux=[
                                @if(isset($tableaux))
                                        @foreach($tableaux as $res)
                                        {{"{value:".$res->chfirreaffaire}} {{",label:"}} '{{$res->libelle}}' {{",formatted:"}} '{{number_format($res->chfirreaffaire,'2',',','.').' '.$res->devise_bc}}'},
                            @endforeach
                            @endif
                            ];
                            Morris.Donut({
                                element: 'graph4',
                                data: tableaux,
                                formatter: function (x, data) { return data.formatted; }
                            });


                        </script>

                    </div>
                </div>
            </div>
            <div class=" col-sm-8 ">
                <div class="stats-title">
                </div>
                <div class="stats-body">
                    <table class="table"  id="CA" style="width: 100%">
                        <thead>
                        <tr>
                            <td>{{__('menu.fournisseurs')}}</td>
                            <td>{{__('neutrale.montant')}} </td>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($tableaux))
                            @foreach($tableaux as $res)
                                <tr>
                                    <td>{{$res->libelle}}</td>
                                    <td>{{number_format($res->chfirreaffaire,'2',',','.')}} {{$res->devise_bc}}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>

                    </table>
                </div>
            </div>

            @elseif($rapport->id==3)
            <div class=" col-sm-8 ">
                <div class="stats-title">
                    <h4 class="title" align="center">Capacité de livraison</h4>
                </div>
                <div class="stats-body">
                    <table class="table data-table tableDA">
                        <thead>
                        <tr>
                            <td>{{__('menu.fournisseurs')}}</td>
                            <td>{{__('neutrale.montant')}}</td>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($tableaux))
                            @foreach($tableaux as $res)
                                <tr>
                                    <td>{{$res->libelle}}</td>
                                    <td>{{number_format($res->chfirreaffaire,'0',',','.')}} XOF</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>

                    </table>
                </div>
            </div>
            <div class="col-md-4 chart_agile_right">
                </br>
                </br>
                <div class="chart_agile_top">
                    <div class="chart_agile_bottom" style="text-align: center">

                        <div id="graph4"></div>
                        <script>

                            var tableaux=[
                                @if(isset($tableaux))
                                        @foreach($tableaux as $res)
                                        {{"{value:".$res->chfirreaffaire}} {{",label:"}} '{{$res->libelle}}' {{",formatted:"}} '{{number_format($res->chfirreaffaire,'2',',','.').' FCFA'}}'},
                            @endforeach
                            @endif
                            ];
                            Morris.Donut({
                                element: 'graph4',
                                data: tableaux,
                                formatter: function (x, data) { return data.formatted; }
                            });


                        </script>

                    </div>
                </div>
            </div>
        @elseif($rapport->id==4)
            <div class=" col-sm-12 ">
                <div class="stats-title">
                    <?php
                    $tot=0;
                    $array= array();
                    if(isset($dependance_tableaux)){
                        foreach($dependance_tableaux as $res):
                            if(isset($array[$res->libelleDomainne])){
                                $array[$res->libelleDomainne]+= $res->prix_total+$res->valeur_tva_tot;
                            }else{
                                $array[$res->libelleDomainne]=$res->prix_total+$res->valeur_tva_tot;
                            }

                            $tot+=$res->prix_total+$res->valeur_tva_tot;
                        endforeach;

                    }

                    ?>
                </div>
                <div class="stats-body">

                    <table id="fournisseur_categorie1" class="table data-table tableDA">
                        <thead>

                        <tr>
                            <th >{{__('menu.fournisseurs')}}</th>
                            <th >{{__('neutrale.categorie')}}</th>
                            <th >{{__('neutrale.montant')}} </th>
                            <th >%</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($dependance_vu_produits))
                            @foreach($dependance_vu_produits as $res)
                                <tr>
                                    <td>{{$res->libelle}}</td>
                                    <td>{{$res->libelleDomainne}}</td>
                                    <td>{{number_format($res->prix_total+$res->valeur_tva_tot,'0',',','.')}} {{$res->devise_bc}} </td>
                                    <td>{{number_format(($res->prix_total+$res->valeur_tva_tot)*100/ $array[$res->libelleDomainne],'2',',','.')}}%</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                        <tfoot>
                        <td></td>
                        <td>Total</td>
                        <td></td>
                        </tfoot>

                    </table>
                </div>
            </div>
        @elseif($rapport->id==5)
             <div class=" col-sm-12 ">
                <div class="stats-title">
                    <?php
                    $tot=0;
                    $array= array();
                    if(isset($retour_non_conformes)){
                        foreach($retour_non_conformes as $res):
                            $tot+=$res->quantite;
                        endforeach;

                    }

                    ?>
                </div>
                <div class="stats-body">

                    <table id="retour_non_conformes" class="table data-table tableDA">
                        <thead>

                        <tr>
                            <th >{{__('menu.fournisseurs')}}</th>
                            <th >{{__('neutrale.nombre_retour')}}</th>
                            <th > %</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($retour_non_conformes))
                            @foreach($retour_non_conformes as $res)
                                <tr>
                                    <td>{{$res->fournisseur}}</td>
                                    <td>{{-1*$res->quantite}}</td>
                                    <td>{{$res->quantite*100/$tot}}%</td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
            </div>
        @elseif($rapport->id==6)
             <div class=" col-sm-12 ">
                <div class="stats-title">
                    <?php
                    $tot=0;
                    if(isset($dependance_tableaux)){
                        foreach($dependance_tableaux as $res):
                            $tot+=$res->prix_total+$res->valeur_tva_tot;
                        endforeach;

                    }


                    ?>
                </div>
                <div class="stats-body">

                    <table id="fournisseur_categorie" class="table data-table tableDA">
                        <thead>

                        <tr>
                            <th >{{__('gestion_stock.domaine')}}</th>
                            <th >{{__('gestion_stock.famille')}}</th>
                            <th >{{__('gestion_stock.article')}}</th>
                            <th >{{__('gestion_stock.quantite')}}</th>
                            <th >{{__('neutrale.montant')}} </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($stocks))
                            @foreach($stocks as $res)
                                @if($res->quantite!="0")
                                <tr>
                                    <td>{{$res->libelleDomainne}}</td>
                                    <td>{{$res->famille}}</td>
                                    <td>{{$res->libelle}}</td>
                                    <td>{{$res->quantite}}</td>
                                    <td>{{isset($tableaux[$res->id][$res->libelle])?number_format($tableaux[$res->id][$res->libelle],'0',',','.'):''}}</td>
                                </tr>
                                @endif
                            @endforeach
                        @endif
                        </tbody>
                        <tfoot>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td >Total</td>
                        <td></td>
                        </tfoot>

                    </table>
                </div>
            </div>
            @elseif($rapport->id==7)
             <div class=" col-sm-12 ">
                <div class="stats-title">
                </div>
                <div class="stats-body">

                    <table id="fournisseur_categorie" class="table data-table tableDA">
                        <thead>

                        <tr>
                            <th >{{__('gestion_stock.domaine')}}</th>
                            <th >{{__('gestion_stock.famille')}}</th>
                            <th >{{__('gestion_stock.article')}}</th>
                            <th >{{__('neutrale.quantite_consome')}}</th>
                            <th >{{__('neutrale.montant')}} </th>
                            <th >{{__('neutrale.devise')}} </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($tableaux))
                            @foreach($tableaux as $res)
                                <tr>
                                    <td>{{$res->domaine}}</td>
                                    <td>{{$res->famille}}</td>
                                    <td>{{$res->libelle}}</td>
                                    <td>{{-1*$res->quantite}}</td>
                                    <td>{{-1*$res->prix_ht_materiel}}</td>
                                    <td>{{$res->devise}}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @elseif($rapport->id==8)
             <div class=" col-sm-12 ">
                <div class="stats-title">
                </div>
                <div class="stats-body">

                    <table id="fournisseur_categorie" class="table data-table tableDA">

                        <thead>

                        <tr>
                            <th class="dt-head-center">id</th>
                            <th >{{__('gestion_stock.domaine')}}</th>
                            <th >{{__('gestion_stock.famille')}}</th>
                            <th >{{__('gestion_stock.article')}}</th>
                            <th class="dt-head-center">{{__('gestion_stock.quantite')}}</th>
                            <th class="dt-head-center">{{__('gestion_stock.unite')}}</th>
                            <th class="dt-head-center">{{__('gestion_stock.stock_min')}}</th>

                        </tr>
                        </thead>
                        <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">
                        @foreach($tableaux as $stock)
                            <tr class="@if($stock->quantite<=$stock->stock_min) stock_min @endif">
                                <td>{{$stock->id}}</td>
                                <td>{{$stock->libelleDomainne}}</td>
                                <td>{{$stock->famille}}</td>
                                <td>{{$stock->libelle}}</td>
                                <td>{{$stock->quantite}}</td>
                                <td>{{$stock->unite}}</td>
                                <td>{{$stock->stock_min}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @elseif($rapport->id==9)
            <div class=" col-sm-12 ">
                <div class="stats-title">
                </div>
                <div class="stats-body">
                    <table class="table"  id="delai_prouit" style="width: 100%">
                        <thead>
                        <tr>
                            <th >{{__('gestion_stock.domaine')}}</th>
                            <th >{{__('gestion_stock.famille')}}</th>
                            <th >{{__('gestion_stock.article')}}</th>
                            <td>{{__('neutrale.jour')}}</td>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($tableaux))
                            @foreach($tableaux as $res)
                                <tr>
                                    <td>{{$res->domaine}}</td>
                                    <td>{{$res->famille}}</td>
                                    <td>{{$res->reference}}</td>
                                    <td>{{number_format($res->moyenne_jour_livraison,'0',',','.')}} </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>

                    </table>
                </div>
            </div>
        @elseif($rapport->id==10)
            <div class=" col-sm-12 ">
                <div class="stats-title">
                </div>
                <div class="stats-body">
                    <table class="table"  id="delai_prouit" style="width: 100%">
                        <thead>
                        <tr>
                            <td>Etat</td>
                            <td>N°</td>
                            <th >{{__('gestion_stock.domaine')}}</th>
                            <th >{{__('gestion_stock.famille')}}</th>
                            <th >{{__('gestion_stock.article')}}</th>
                            <td>{{__('gestion_stock.code_tache')}}</td>
                            <td>{{__('gestion_stock.quantite')}}</td>

                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($tableaux))
                            @foreach($tableaux as $res)
                                <tr>
                                    <td>
                                        @if($res->etat==1)
                                            <i class="fa fa-circle "  style="color: red"></i>
                                            Suspendu
                                        @elseif($res->etat==2)
                                            <i class="fa fa-circle" style="color: mediumspringgreen"></i>
                                            Acceptée
                                        @elseif($res->etat==3)
                                            <i class="fa fa-circle" style="color: #f0ad4e"></i>
                                            En cours de traitement
                                        @elseif($res->etat==0)
                                            <i class="fa fa-circle" style="color: black"></i>
                                            Réfusée
                                        @elseif($res->etat==4)
                                            <i class="fa fa-circle" style="color:#00ffff"></i>
                                            Traitée et terminée
                                        @elseif($res->etat==11)
                                            <i class="fa fa-circle" style="color: violet"></i>
                                            Traitée et retournée
                                        @endif </td>
                                    <td>{{$res->id}}</td>
                                    <td>{{isset($res->designation->famille->domaine)?$res->designation->famille->domaine->libelleDomainne:'' }}</td>
                                    <td>{{$res->designation->famille->libelle}}</td>
                                    <td>{{isset($res->designation)?$res->designation->libelle:''}}</td>
                                    <td>{{isset($res->codeTache)?$res->codeTache->libelle:''}}</td>
                                    <td>{{$res->quantite}} </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>

                    </table>
                </div>
            </div>
        @elseif($rapport->id==11)
            <div class=" col-sm-12 ">
                <div class="stats-title">
                </div>
                <div class="stats-body">
                    <table class="table"  id="delai_prouit" style="width: 100%">
                        <thead>
                        <tr>
                            <td>{{__('neutrale.etat')}}</td>
                            <td>N°</td>
                            <td>{{__('menu.fournisseurs')}}</td>
                            <td>{{__('menu.users')}}</td>
                            <td>Date</td>

                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($tableaux))
                            @foreach($tableaux as $res)
                                <tr>
                                    <td>
                                        @if($res->etat==1)
                                            <i class="fa fa-circle "  style="color:  red"><p style="visibility: hidden">1</p></i>

                                        @elseif($res->etat==2)
                                            <i class="fa fa-circle" style="color: mediumspringgreen"><p style="visibility: hidden">2</p></i>
                                        @elseif($res->etat==3)
                                            <i class="fa fa-circle" style="color: #f0ad4e"><p style="visibility: hidden">3</p></i>
                                        @elseif($res->etat==4)
                                            <a href="" data-toggle="modal" class="">
                                                <i class="fa fa-circle" style="color: #00ffff"><p style="visibility: hidden">4</p></i>
                                            </a>
                                        @elseif($res->etat==11)
                                            <a href="" data-toggle="modal" class="">
                                                <i class="fa fa-circle" style="color: violet"><p style="visibility: hidden">11</p></i>
                                            </a>

                                        @elseif($bc->etat==0)
                                            <i class="fa fa-circle" style="color: black"><p style="visibility: hidden">0</p></i>
                                        @endif
                                    </td>
                                    <td>{{isset($res->numBonCommande)?$res->numBonCommande:'' }}</td>
                                    <td>{{$res->fournisseur}}</td>
                                    <td>{{$res->nom}} {{$res->prenoms}}</td>
                                    <td>{{$res->date}}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>

                    </table>
                </div>
            </div>

        @endif


    </div>



   <script>
       (function($) {
           function ilisibilite_nombre(valeur){

               for(var i=valeur.length-1; i>=0; i-- ){valeur=valeur.toString().replace('.','');

               }

               return valeur;

           }
           function lisibilite_nombre(nbr)

           {

               var nombre = ''+nbr;

               var retour = '';

               var count=0;

               for(var i=nombre.length-1 ; i>=0 ; i--)

               {

                   if(count!=0 && count % 3 == 0 && nombre[i+1]!=',')

                       retour = nombre[i]+'.'+retour ;

                   else

                       retour = nombre[i]+retour ;

                   count++;

               }

               //          alert('nb : '+nbr+' => '+retour);

               return retour;

           }
       var date =new Date();
           @if($rapport->id==1)
           var table= $('#delai_prouit').DataTable({
               dom: 'Bfrtip',
               buttons: [
                   {
                       extend: 'copyHtml5',
                       exportOptions: {
                           columns: [ 0,1]
                       },
                       text:"Copier",
                       filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                       className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                       messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),

                   },
                   {
                       extend: 'excelHtml5',
                       exportOptions: {
                           columns: [ 0,1]
                       },
                       text:"Excel",
                       filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                       className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                       messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                       orientation: 'landscape',

                   },
                   {
                       extend: 'pdfHtml5',
                       exportOptions: {
                           columns: [ 0,1]
                       },
                       text:"PDF",
                       filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                       className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                       messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                       orientation: 'landscape',

                   },
                   {
                       extend: 'print',
                       exportOptions: {
                           columns: [ 0,1]
                       },
                       text:"Imprimer",
                       filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif"+date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                       className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                       messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                       orientation: 'landscape',

                   }
               ],
               language: {
                   url: "{{ URL::asset('public/js/French.json') }}"
               },

           });
           @elseif($rapport->id==2)
           var table= $('#CA').DataTable({
                       dom: 'Bfrtip',
                       buttons: [
                           {
                               extend: 'copyHtml5',
                               exportOptions: {
                                   columns: [ 0,1]
                               },
                               text:"Copier",
                               filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                               className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                               messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),

                           },
                           {
                               extend: 'excelHtml5',
                               exportOptions: {
                                   columns: [ 0,1]
                               },
                               text:"Excel",
                               filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                               messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               orientation: 'landscape',

                           },
                           {
                               extend: 'pdfHtml5',
                               exportOptions: {
                                   columns: [ 0,1]
                               },
                               text:"PDF",
                               filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                               messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               orientation: 'landscape',

                           },
                           {
                               extend: 'print',
                               exportOptions: {
                                   columns: [ 0,1]
                               },
                               text:"Imprimer",
                               filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif"+date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                               className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                               messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               orientation: 'landscape',

                           }
                       ],
                        language: {
                           @if(App()->getLocale()=='fr')
                           url: "../../public/js/French.json"
                           @elseif(App()->getLocale()=='en')
                           url: "../../public/js/English.json"
                           @endif
                       },


                   });
                   @elseif($rapport->id==4)
           var table= $('#fournisseur_categorie1').DataTable({
                       dom: 'Bfrtip',
                       buttons: [
                           {
                               extend: 'copyHtml5',
                               exportOptions: {
                                   columns: [ 0,1,2,3]
                               },
                               text:"Copier",
                               filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                               className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                               messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),

                           },
                           {
                               extend: 'excelHtml5',
                               exportOptions: {
                                   columns: [ 0,1,2,3]
                               },
                               text:"Excel",
                               filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                               messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               orientation: 'landscape',

                           },
                           {
                               extend: 'pdfHtml5',
                               exportOptions: {
                                   columns: [ 0,1,2,3]
                               },
                               text:"PDF",
                               filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                               messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               orientation: 'landscape',

                           },
                           {
                               extend: 'print',
                               exportOptions: {
                                   columns: [ 0,1,2,3]
                               },
                               text:"Imprimer",
                               filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif"+date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                               className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                               messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               orientation: 'landscape',

                           }
                       ],
                        language: {
                           @if(App()->getLocale()=='fr')
                           url: "../../public/js/French.json"
                           @elseif(App()->getLocale()=='en')
                           url: "../../public/js/English.json"
                           @endif
                       },

               order: [[1, 'desc']],
               "drawCallback": function (settings){
                   var api = this.api();

                   // Zero-based index of the column containing names
                   var col_name = 1;
                   console.log(api.order());
                   // If ordered by column containing names
                   if (api.order()[0][0] === col_name) {
                       var rows = api.rows({ page: 'current' }).nodes();
                       var group_last = null;

                       api.column(col_name, { page: 'current' }).data().each(function (name, index){
                           var group = name;
                           var data = api.row(rows[index]).data();

                           if (group_last !== group) {
                               $(rows[index]).before(
                                       '<tr class="group" style="background-color:#6c757d;color:white"><td colspan="11"><b>'+ data[1]+'</b></td></tr>'
                               );

                               group_last = group;
                           }
                       });
                   }
               },
               rowGroup: {
                   startRender: function ( rows, group ) {
                       return 'Nombre de ligne '+' ('+rows.count()+')';

                   },
                   endRender: null,

                   dataSrc: [0]
               },
               "footerCallback": function ( row, data, start, end, display ) {
                   var api = this.api(), data;

                   // Remove the formatting to get integer data for summation
                   var intVal = function ( i ) {
                       return typeof i === 'string' ?
                       i.replace(/[\$,]/g, '')*1 :
                               typeof i === 'number' ?
                                       i : 0;
                   };

                   // Total over all pages
                   total = api
                           .column( 2 )
                           .data()
                           .reduce( function (a, b) {
                               return intVal(ilisibilite_nombre(a)) + intVal(ilisibilite_nombre(b));
                           }, 0 );


                   // Update footer
                   $( api.column( 2 ).footer() ).html(
                           lisibilite_nombre(total) +''
                   );

               },


           }).column(1).visible(false);

           var table2= $('#fournisseur_categorie').DataTable({
                       dom: 'Bfrtip',
                       buttons: [
                           {
                               extend: 'copyHtml5',
                               exportOptions: {
                                   columns: [ 0,1,2,3]
                               },
                               text:"Copier",
                               filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                               className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                               messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               footer: true

                           },
                           {
                               extend: 'excelHtml5',
                               exportOptions: {
                                   columns: [ 0,1,2,3]
                               },
                               text:"Excel",
                               filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                               messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               orientation: 'landscape',
                               footer: true

                           },
                           {
                               extend: 'pdfHtml5',
                               exportOptions: {
                                   columns: [ 0,1,2,3]
                               },
                               text:"PDF",
                               filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                               messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               orientation: 'landscape',
                               footer: true

                           },
                           {
                               extend: 'print',
                               exportOptions: {
                                   columns: [ 0,1,2,3]
                               },
                               text:"Imprimer",
                               filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif"+date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                               className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                               messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
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
               "drawCallback": function (settings){
                   var api = this.api();

                   // Zero-based index of the column containing names
                   var col_name = 0;
                   console.log(api.order());
                   // If ordered by column containing names
                   if (api.order()[0][0] === col_name) {
                       var rows = api.rows({ page: 'current' }).nodes();
                       var group_last = null;

                       api.column(col_name, { page: 'current' }).data().each(function (name, index){
                           var group = name;
                           var data = api.row(rows[index]).data();

                           if (group_last !== group) {
                               $(rows[index]).before(
                                       '<tr class="group" style="background-color:#6c757d;color:white"><td colspan="11"><b>'+ data[0]+'</b></td></tr>'
                               );

                               group_last = group;
                           }
                       });
                   }
               },
               rowGroup: {
                   startRender: function ( rows, group ) {
                       return 'Nombre de ligne '+' ('+rows.count()+')';

                   },
                   endRender: null,

                   dataSrc: [0]
               },
               "footerCallback": function ( row, data, start, end, display ) {
                   var api = this.api(), data;

                   // Remove the formatting to get integer data for summation
                   var intVal = function ( i ) {
                       return typeof i === 'string' ?
                       i.replace(/[\$,]/g, '')*1 :
                               typeof i === 'number' ?
                                       i : 0;
                   };

                   // Total over all pages
                   total = api
                           .column( 2 )
                           .data()
                           .reduce( function (a, b) {
                               return intVal(ilisibilite_nombre(a)) + intVal(ilisibilite_nombre(b));
                           }, 0 );


                   // Update footer
                   $( api.column( 2 ).footer() ).html(
                           lisibilite_nombre(total) +''
                   );

               },


                   }).column(0).visible(false);
                   @elseif($rapport->id==5)
           var table= $('#retour_non_conformes').DataTable({
                       dom: 'Bfrtip',
                       buttons: [
                           {
                               extend: 'copyHtml5',
                               exportOptions: {
                                   columns: [ 0,1]
                               },
                               text:"Copier",
                               filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                               className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                               messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),

                           },
                           {
                               extend: 'excelHtml5',
                               exportOptions: {
                                   columns: [ 0,1]
                               },
                               text:"Excel",
                               filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                               messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               orientation: 'landscape',

                           },
                           {
                               extend: 'pdfHtml5',
                               exportOptions: {
                                   columns: [ 0,1]
                               },
                               text:"PDF",
                               filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                               messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               orientation: 'landscape',

                           },
                           {
                               extend: 'print',
                               exportOptions: {
                                   columns: [ 0,1]
                               },
                               text:"Imprimer",
                               filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif"+date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                               className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                               messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               orientation: 'landscape',

                           }
                       ],
                        language: {
                           @if(App()->getLocale()=='fr')
                           url: "../../public/js/French.json"
                           @elseif(App()->getLocale()=='en')
                           url: "../../public/js/English.json"
                           @endif
                       },


                   });
                   @elseif($rapport->id==6)
                               $('#fournisseur_categorie thead th').each( function () {
                       var title = $(this).text();

                       if( $(this).html()!="{{__('gestion_stock.action')}}" && $(this).html()!="{{__('gestion_stock.quantite')}}"&& $(this).html()!="{{__('gestion_stock.unite')}}" && $(this).html()!="{{__('neutrale.montant')}} (FCFA)" ){
                           $(this).append( '<input type="text" placeholder="Search '+title+'" />' );
                       }

                   } );
           var table2= $('#fournisseur_categorie').DataTable({
                       dom: 'Bfrtip',
                       buttons: [
                           {
                               extend: 'copyHtml5',
                               exportOptions: {
                                   columns: [ 0,1,2,3,4]
                               },
                               text:"Copier",
                               filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                               className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                               messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               footer: true

                           },
                           {
                               extend: 'excelHtml5',
                               exportOptions: {
                                   columns: [ 0,1,2,3,4]
                               },
                               text:"Excel",
                               filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                               messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               orientation: 'landscape',
                               footer: true

                           },
                           {
                               extend: 'pdfHtml5',
                               exportOptions: {
                                   columns: [ 0,1,2,3,4]
                               },
                               text:"PDF",
                               filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                               messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               orientation: 'landscape',
                               footer: true

                           },
                           {
                               extend: 'print',
                               exportOptions: {
                                   columns: [ 0,1,2,3,4]
                               },
                               text:"Imprimer",
                               filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif"+date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                               className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                               messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
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

                       "footerCallback": function ( row, data, start, end, display ) {
                           var api = this.api(), data;

                           // Remove the formatting to get integer data for summation
                           var intVal = function ( i ) {
                               return typeof i === 'string' ?
                               i.replace(/[\$,]/g, '')*1 :
                                       typeof i === 'number' ?
                                               i : 0;
                           };

                           // Total over this page
                           pageTotal = api
                                   .column( 4, { page: 'current'} )
                                   .data()
                                   .reduce( function (a, b) {
                                       return intVal(ilisibilite_nombre(a)) + intVal(ilisibilite_nombre(b));
                                   }, 0 );
                           // Total over all pages
                           total = api
                                   .column( 4 )
                                   .data()
                                   .reduce( function (a, b) {
                                       return intVal(ilisibilite_nombre(a)) + intVal(ilisibilite_nombre(b));
                                   }, 0 );


                           // Update footer
                           $( api.column( 4 ).footer() ).html(
                           ''+lisibilite_nombre(pageTotal) +' FCFA ('+ lisibilite_nombre(total) +' FCFA total)'
                           );

                       },
                        "ordering": false,
                        initComplete: function () {
                   // Apply the search
                   this.api().columns().every( function () {
                       var that = this;

                       $( 'input', this.header() ).on( 'keyup change clear', function () {
                           if ( that.search() !== this.value ) {
                               that
                                       .search( this.value )
                                       .draw();
                           }
                       } );

                   } );
               },
                        });
                   @elseif($rapport->id==7)
           var table2= $('#fournisseur_categorie').DataTable({
                       dom: 'Bfrtip',
                       buttons: [
                           {
                               extend: 'copyHtml5',
                               exportOptions: {
                                   columns: [ 0,1,2,3,4]
                               },
                               text:"Copier",
                               filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                               className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                               messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),

                           },
                           {
                               extend: 'excelHtml5',
                               exportOptions: {
                                   columns: [ 0,1,2,3,4]
                               },
                               text:"Excel",
                               filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                               messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               orientation: 'landscape',

                           },
                           {
                               extend: 'pdfHtml5',
                               exportOptions: {
                                   columns: [ 0,1,2,3,4]
                               },
                               text:"PDF",
                               filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                               messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               orientation: 'landscape',

                           },
                           {
                               extend: 'print',
                               exportOptions: {
                                   columns: [ 0,1,2,3,4]
                               },
                               text:"Imprimer",
                               filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif"+date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                               className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                               messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               orientation: 'landscape',

                           }
                       ],
                        language: {
                           @if(App()->getLocale()=='fr')
                           url: "../../public/js/French.json"
                           @elseif(App()->getLocale()=='en')
                           url: "../../public/js/English.json"
                           @endif
                       },



                   });
           @elseif($rapport->id==8)
           var table= $('#fournisseur_categorie').DataTable({
                       dom: 'Bfrtip',
                       buttons: [
                           {
                               extend: 'copyHtml5',
                               exportOptions: {
                                   columns: [ 1,2,3,4,5,6]
                               },
                               text:"Copier",
                               filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                               className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                               messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),

                           },
                           {
                               extend: 'excelHtml5',
                               exportOptions: {
                                   columns: [ 1,2,3,4,5,6]
                               },
                               text:"Excel",
                               filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                               messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               orientation: 'landscape',

                           },
                           {
                               extend: 'pdfHtml5',
                               exportOptions: {
                                   columns: [ 1,2,3,4,5,6]
                               },
                               text:"PDF",
                               filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                               messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               orientation: 'landscape',

                           },
                           {
                               extend: 'print',
                               exportOptions: {
                                   columns: [ 1,2,3,4,5,6]
                               },
                               text:"Imprimer",
                               filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif"+date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                               className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                               messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               orientation: 'landscape',

                           }
                       ],
                        language: {
                           @if(App()->getLocale()=='fr')
                           url: "../../public/js/French.json"
                           @elseif(App()->getLocale()=='en')
                           url: "../../public/js/English.json"
                           @endif
                       },

                   }).column(0).visible(false);
                   @elseif($rapport->id==9)
           var table= $('#delai_prouit').DataTable({
                       dom: 'Bfrtip',
                       buttons: [
                           {
                               extend: 'copyHtml5',
                               exportOptions: {
                                   columns: [ 0,1,2,3]
                               },
                               text:"Copier",
                               filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                               className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                               messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),

                           },
                           {
                               extend: 'excelHtml5',
                               exportOptions: {
                                   columns: [ 0,1,2,3]
                               },
                               text:"Excel",
                               filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                               messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               orientation: 'landscape',

                           },
                           {
                               extend: 'pdfHtml5',
                               exportOptions: {
                                   columns: [ 0,1,2,3]
                               },
                               text:"PDF",
                               filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                               messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               orientation: 'landscape',

                           },
                           {
                               extend: 'print',
                               exportOptions: {
                                   columns: [ 0,1,2,3]
                               },
                               text:"Imprimer",
                               filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif"+date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                               className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                               messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               orientation: 'landscape',

                           }
                       ],
                        language: {
                           @if(App()->getLocale()=='fr')
                           url: "../../public/js/French.json"
                           @elseif(App()->getLocale()=='en')
                           url: "../../public/js/English.json"
                           @endif
                       },


                   });
                   @elseif($rapport->id==10)
           var table= $('#delai_prouit').DataTable({
                       dom: 'Bfrtip',
                       buttons: [
                           {
                               extend: 'copyHtml5',
                               exportOptions: {
                                   columns: [ 0,1,2,3,4,5,6]
                               },
                               text:"Copier",
                               filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                               className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                               messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),

                           },
                           {
                               extend: 'excelHtml5',
                               exportOptions: {
                                   columns: [ 0,1,2,3,4,5,6]
                               },
                               text:"Excel",
                               filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                               messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               orientation: 'landscape',

                           },
                           {
                               extend: 'pdfHtml5',
                               exportOptions: {
                                   columns: [ 0,1,2,3,4,5,6]
                               },
                               text:"PDF",
                               filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                               messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               orientation: 'landscape',

                           },
                           {
                               extend: 'print',
                               exportOptions: {
                                   columns: [ 0,1,2,3,4,5,6]
                               },
                               text:"Imprimer",
                               filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif"+date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                               className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                               messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               orientation: 'landscape',

                           }
                       ],
                       language: {
                           @if(App()->getLocale()=='fr')
                           url: "../../public/js/French.json"
                           @elseif(App()->getLocale()=='en')
                           url: "../../public/js/English.json"
                           @endif
                       },

                   });
                   @elseif($rapport->id==11)
           var table= $('#delai_prouit').DataTable({
                       dom: 'Bfrtip',
                       buttons: [
                           {
                               extend: 'copyHtml5',
                               exportOptions: {
                                   columns: [ 0,1,2,3,4]
                               },
                               text:"Copier",
                               filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                               className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                               messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),

                           },
                           {
                               extend: 'excelHtml5',
                               exportOptions: {
                                   columns: [ 0,1,2,3,4]
                               },
                               text:"Excel",
                               filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                               messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               orientation: 'landscape',

                           },
                           {
                               extend: 'pdfHtml5',
                               exportOptions: {
                                   columns: [ 0,1,2,3,4]
                               },
                               text:"PDF",
                               filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                               messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               orientation: 'landscape',

                           },
                           {
                               extend: 'print',
                               exportOptions: {
                                   columns: [ 0,1,2,3,4]
                               },
                               text:"Imprimer",
                               filename: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif"+date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                               className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                               messageTop: "@if(App()->getLocale()=="fr"){{$rapport->libelle}}@elseif(App()->getLocale()=="en"){{$rapport->libelle_en}}@endif" +date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                               orientation: 'landscape',

                           }
                       ],
                        language: {
                           @if(App()->getLocale()=='fr')
                           url: "../../public/js/French.json"
                           @elseif(App()->getLocale()=='en')
                           url: "../../public/js/English.json"
                           @endif
                       },


                   });
           @endif
       })(jQuery);
       //table.DataTable().draw();

   </script>

    @endsection