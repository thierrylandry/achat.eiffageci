@extends('layouts.app')
@section('tableau_de_bord')
    class="active"
@endsection
@section('dashboard')
    <link rel="stylesheet" href="{{URL::asset('css/morris.css')}}" type="text/css"/>
    <script src="{{URL::asset('js/jquery2.0.3.min.js')}}"></script>
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



    </style>
    <div class="market-updates">
        <div class="col-md-3 market-update-gd">
            <div class="market-update-block clr-block-4">
                <div class="col-md-4 market-update-right">
                    <i class="fa fa-refresh fa-3x fa-spin  fa-fw" style="color: white"></i>
                </div>
                <div class="col-md-8 market-update-left">
                    <h4>D.A. en attente de validation</h4>
                    <h4 id="daencours">{{$daencours}}/{{$das}}</h4>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class="col-md-3 market-update-gd">
            <div class="market-update-block clr-block-2">
                <div class="col-md-4 market-update-right">
                    <i class="fa fa-refresh fa-3x fa-spin  fa-fw" style="color: white"> </i>
                </div>
                <div class="col-md-8 market-update-left">
                    <h4>B.C. en attente de signature</h4>
                    <h4 id="Boncommandeencours" title="B.C en attente de valisation">{{$Boncommandeencours}}/{{$Boncommandes}}</h4>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class="col-md-3 market-update-gd">
            <div class="market-update-block clr-block-4">
                <div class="col-md-4 market-update-right">
                    <i class="fa fa-refresh fa-3x fa-spin  fa-fw" style="color: white"> </i>
                </div>
                <div class="col-md-8 market-update-left">
                    <h4>B.C. traités et finalisés</h4>
                    <h4 id="$montant_bc">{{number_format($montant_bc, 0,".", " ")}} Fr CFA</h4>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class="col-md-3 market-update-gd">
            <div class="market-update-block clr-block-2">
                <div class="col-md-4 market-update-right">
                    <i class="fa fa-refresh fa-3x fa-spin  fa-fw" style="color: white"> </i>
                </div>
                <div class="col-md-8 market-update-left">
                    <h4>B.C. traités et retournés</h4>
                    <h4 id="montant_bct">{{number_format($montant_bct, 0,".", " ")}} Fr CFA</h4>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>

        <div class="clearfix"> </div>

    </div>
    <div class="col-md-12  market-update-gd">
        </br>

        <!--agileinfo-grap-->
        <div class="agileinfo-grap">
            <div class="agileits-box">
                <header class="agileits-box-header clearfix">
                    <h3>Cumule mensuelle des Demandes d'achat</h3>
                    <div class="toolbar">


                    </div>
                </header>
                <div id="graph11"></div>
                <script>
                    var cumuleda=[@foreach($cumuleda as $res)
                            @if($res->y!=null)
                            {{"{period:"}} '{{$res->name}}' {{",DA:"}} {{$res->y}} },
                    @endif
                    @endforeach];

                    /* data stolen from http://howmanyleft.co.uk/vehicle/jaguar_'e'_type */

                    Morris.Bar({
                        element: 'graph11',
                        data: cumuleda,
                        xkey: 'period',
                        ykeys: ['DA'],
                        labels: ["Demande d'Achats"],
                        xLabelAngle: 60
                    });
                </script>
            </div>
        </div>
        <!--//agileinfo-grap-->

    </div>

    <div class="row">
        <div class="col-md-6 chart_agile_right">
            </br>
            </br>
            <div class="chart_agile_top">
                <div class="chart_agile_bottom" style="text-align: center">

                    <div id="graph4"></div>
                    <h3> Les fournisseurs les plus sollicités</h3>
                    <script>

                        var fournisseur_sollicie=[
                            @foreach($fournisseur_sollicie as $res)
                            {{"{value:".$res->y}} {{",label:"}} '{{$res->name}}' {{",formatted:"}} '{{$res->y.' Bon(s) de commande'}}'},
                            @endforeach
                        ];
                        Morris.Donut({
                            element: 'graph4',
                            data: fournisseur_sollicie,
                            formatter: function (x, data) { return data.formatted; }
                        });
                    </script>

                </div>
            </div>
        </div>
        <div class="col-md-6 chart_agile_right">
            </br>
            </br>
            <div class="chart_agile_top">
                <div class="chart_agile_bottom" style="text-align: center">

                    <div id="graphsecond"></div>
                    <h3> Nombre de B.C. retourné / fournisseur</h3>
                    <script>

                        var fournisseur_sollicie=[
                            @foreach($fournisseur_retour as $res)
                            {{"{value:".$res->y}} {{",label:"}} '{{$res->name}}' {{",formatted:"}} '{{$res->y.' Bon(s) de commande retourné'}}'},
                            @endforeach
                        ];
                        Morris.Donut({
                            element: 'graphsecond',
                            data: fournisseur_sollicie,
                            formatter: function (x, data) { return data.formatted; }
                        });
                    </script>

                </div>
            </div>
        </div>
        <div class="col-md-6 chart_agile_right">
            </br>
            </br>
            <div class="chart_agile_top">
                <div class="chart_agile_bottom" style="text-align: center">

                    <div id="graphsretardfourn"></div>
                    <h3>  Retard de livraison/fournisseur</h3>
                    <script>

                        var fournisseur_retard=[
                            @foreach($fournisseur_retard as $res)
                                    @if($res->y!=null)
                                    {{"{value:".$res->y}} {{",label:"}} '{{$res->name}}' {{",formatted:"}} '{{$res->y.' jour de retard sur une livraison'}}'},
                                    @endif
                        @endforeach
                        ];
                        Morris.Donut({
                            element: 'graphsretardfourn',
                            data: fournisseur_retard,
                            formatter: function (x, data) { return data.formatted; }
                        });
                    </script>

                </div>
            </div>
        </div>
        <div class="col-md-6 floatcharts_w3layouts_left">
            </br>
            </br>
            <div class="floatcharts_w3layouts_top">
                <div class="floatcharts_w3layouts_bottom">
                    <div id="graph8"></div>
                    <script>

                        var boncommande=[
                            @foreach($boncommande as $res)
                                    @if($res->y!=null)

                            {"period":"{{$res->name}}", "total_ttc":{{$res->y}} },
                        @endif
                        @endforeach
                        ];

                        /* data stolen from http://howmanyleft.co.uk/vehicle/jaguar_'e'_type */

                        Morris.Bar({
                            element: 'graph8',
                            data: boncommande,
                            xkey: 'period',
                            ykeys: ['total_ttc'],
                            labels: ['Total ttc'],
                            xLabelAngle: 60
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            //BOX BUTTON SHOW AND CLOSE
            jQuery('.small-graph-box').hover(function() {
                jQuery(this).find('.box-button').fadeIn('fast');
            }, function() {
                jQuery(this).find('.box-button').fadeOut('fast');
            });
            jQuery('.small-graph-box .box-close').click(function() {
                jQuery(this).closest('.small-graph-box').fadeOut(200);
                return false;
            });

            //CHARTS
            function gd(year, day, month) {
                return new Date(year, month - 1, day).getTime();
            }

            var cumuleda=[@foreach($cumuleda as $res)
                        @if($res->y!=null)
                {{"{value:"}} '{{$res->name}}' {{",DA:"}} {{$res->y}} },
        @endif
        @endforeach];
            graphArea2 = Morris.Area({
                element: 'hero-area',
                padding: 10,
                behaveLikeLine: true,
                gridEnabled: false,
                gridLineColor: '#dddddd',
                axes: true,
                resize: true,
                smooth:true,
                pointSize: 0,
                lineWidth: 0,
                fillOpacity:0.85,
                data: cumuleda,
                lineColors:['#33FF00','#926383','#eb6f6f'],
                xkey: 'value',
                redraw: true,
                ykeys: ['DA'],
                labels: ["Demande d'achat"],
                pointSize: 2,
                hideHover: 'auto',
                resize: true
            });


        });
    </script>
@endsection()
@section('content')
    <div >
        <div class="row justify-content-center m-auto text-center w-75">

            <div class="col-md-4 container-fluid bg-gradient p-5">
                <a href="{{route('creer_da')}}">
                        <div class="col-4 princing-item red">
                            <div class="pricing-divider ">
                                <h3 class="text-light" style="color: white">FAIRE UNE D.A.</h3>
                                <svg class='pricing-divider-img' enable-background='new 0 0 300 100' height='100px' id='Layer_1' preserveAspectRatio='none' version='1.1' viewBox='0 0 300 100' width='300px' x='0px' xml:space='preserve' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns='http://www.w3.org/2000/svg' y='0px'>
          <path class='deco-layer deco-layer--1' d='M30.913,43.944c0,0,42.911-34.464,87.51-14.191c77.31,35.14,113.304-1.952,146.638-4.729
	c48.654-4.056,69.94,16.218,69.94,16.218v54.396H30.913V43.944z' fill='#FFFFFF' opacity='0.6'></path>
                                    <path class='deco-layer deco-layer--2' d='M-35.667,44.628c0,0,42.91-34.463,87.51-14.191c77.31,35.141,113.304-1.952,146.639-4.729
	c48.653-4.055,69.939,16.218,69.939,16.218v54.396H-35.667V44.628z' fill='#FFFFFF' opacity='0.6'></path>
                                    <path class='deco-layer deco-layer--3' d='M43.415,98.342c0,0,48.283-68.927,109.133-68.927c65.886,0,97.983,67.914,97.983,67.914v3.716
	H42.401L43.415,98.342z' fill='#FFFFFF' opacity='0.7'></path>
                                    <path class='deco-layer deco-layer--4' d='M-34.667,62.998c0,0,56-45.667,120.316-27.839C167.484,57.842,197,41.332,232.286,30.428
	c53.07-16.399,104.047,36.903,104.047,36.903l1.333,36.667l-372-2.954L-34.667,62.998z' fill='#FFFFFF'></path>
        </svg>
                            </div>
                            <div class="card-body bg-white mt-0 shadow">
                                <image src="images/da.jpg"  width="200px" height="200px"/>
                                <button type="button" class="btn btn-lg btn-block  btn-custom "></button>
                            </div>
                        </div>
















                </a>
            </div>
            <div class="col-sm-4 container-fluid bg-gradient p-5">

                <a href="{{route('gestion_reponse_fournisseur')}}">

                <div class="col-4 princing-item blue">
                    <div class="pricing-divider ">
                        <h3 class="text-light"  style="color: white">RECEPTION DE DEVIS</h3>
                        <svg class='pricing-divider-img' enable-background='new 0 0 300 100' height='100px' id='Layer_1' preserveAspectRatio='none' version='1.1' viewBox='0 0 300 100' width='300px' x='0px' xml:space='preserve' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns='http://www.w3.org/2000/svg' y='0px'>
          <path class='deco-layer deco-layer--1' d='M30.913,43.944c0,0,42.911-34.464,87.51-14.191c77.31,35.14,113.304-1.952,146.638-4.729
	c48.654-4.056,69.94,16.218,69.94,16.218v54.396H30.913V43.944z' fill='#FFFFFF' opacity='0.6'></path>
                            <path class='deco-layer deco-layer--2' d='M-35.667,44.628c0,0,42.91-34.463,87.51-14.191c77.31,35.141,113.304-1.952,146.639-4.729
	c48.653-4.055,69.939,16.218,69.939,16.218v54.396H-35.667V44.628z' fill='#FFFFFF' opacity='0.6'></path>
                            <path class='deco-layer deco-layer--3' d='M43.415,98.342c0,0,48.283-68.927,109.133-68.927c65.886,0,97.983,67.914,97.983,67.914v3.716
	H42.401L43.415,98.342z' fill='#FFFFFF' opacity='0.7'></path>
                            <path class='deco-layer deco-layer--4' d='M-34.667,62.998c0,0,56-45.667,120.316-27.839C167.484,57.842,197,41.332,232.286,30.428
	c53.07-16.399,104.047,36.903,104.047,36.903l1.333,36.667l-372-2.954L-34.667,62.998z' fill='#FFFFFF'></path>
        </svg>
                    </div>

                    <div class="card-body bg-white mt-0 shadow">
                        <image src="images/devis.jpg" width="200px" height="200px"/>
                        <button type="button" class="btn btn-lg btn-block  btn-custom "></button>
                    </div>
                </div>
</a>
            </div>
            <div class="col-sm-4 container-fluid bg-gradient p-5">


                <a href="{{route('gestion_bc_ajouter')}}">

                <div class="col-4 princing-item green">
                    <div class="pricing-divider ">
                        <h3 class="text-light"  style="color: white">CREATION DE B.C.</h3>

                        <svg class='pricing-divider-img' enable-background='new 0 0 300 100' height='100px' id='Layer_1' preserveAspectRatio='none' version='1.1' viewBox='0 0 300 100' width='300px' x='0px' xml:space='preserve' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns='http://www.w3.org/2000/svg' y='0px'>
          <path class='deco-layer deco-layer--1' d='M30.913,43.944c0,0,42.911-34.464,87.51-14.191c77.31,35.14,113.304-1.952,146.638-4.729
	c48.654-4.056,69.94,16.218,69.94,16.218v54.396H30.913V43.944z' fill='#FFFFFF' opacity='0.6'></path>
                            <path class='deco-layer deco-layer--2' d='M-35.667,44.628c0,0,42.91-34.463,87.51-14.191c77.31,35.141,113.304-1.952,146.639-4.729
	c48.653-4.055,69.939,16.218,69.939,16.218v54.396H-35.667V44.628z' fill='#FFFFFF' opacity='0.6'></path>
                            <path class='deco-layer deco-layer--3' d='M43.415,98.342c0,0,48.283-68.927,109.133-68.927c65.886,0,97.983,67.914,97.983,67.914v3.716
	H42.401L43.415,98.342z' fill='#FFFFFF' opacity='0.7'></path>
                            <path class='deco-layer deco-layer--4' d='M-34.667,62.998c0,0,56-45.667,120.316-27.839C167.484,57.842,197,41.332,232.286,30.428
	c53.07-16.399,104.047,36.903,104.047,36.903l1.333,36.667l-372-2.954L-34.667,62.998z' fill='#FFFFFF'></path>
        </svg>
                    </div>

                    <div class="card-body bg-white mt-0 shadow">
                      <image src="images/bc.png"  width="200px" height="200px"/>
                        <button type="button" class="btn btn-lg btn-block  btn-custom "></button>
                    </div>
                </div>

</a>
            </div>
        </div>
    </div>

@endsection
