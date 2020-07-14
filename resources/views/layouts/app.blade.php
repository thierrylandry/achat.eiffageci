<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ URL::asset('images/eiffagefavicon.png') }}" type="image/png" sizes="66x66">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}" >
    <!-- //bootstrap-css -->

    <link href="{{ URL::asset('css/style.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ URL::asset('css/style-responsive.css') }}" rel="stylesheet"/>
    <!-- font CSS -->
    <link href='{{ URL::asset('//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic') }}' rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{ URL::asset('css/font.css') }}" type="text/css"/>
    <link href="{{ URL::asset('css/font-awesome.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('css/default/style.min.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-select.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ URL::asset('css/jquery.dataTables.min.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ URL::asset('css/responsive.dataTables.min.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ URL::asset('css/dataTables.checkboxes.css') }}" type="text/css"/>


    <!-- //font-awesome icons -->
    <script src="{{ URL::asset('js/jquery2.0.3.min.js') }}"></script>
    <link rel="stylesheet" href="{{ URL::asset('css/jquery-confirm.min.css') }}">
    <script src="{{ URL::asset('js/jquery-confirm.min.js') }}"></script>

    <script src="{{ URL::asset('js/bootstrap.js') }}"></script>
    <script src="{{ URL::asset('js/jquery.dcjqaccordion.2.7.js') }}"></script>
    <script src="{{ URL::asset('js/scripts.js') }}"></script>
    <script src="{{ URL::asset('js/jquery.slimscroll.js') }}"></script>
    <script src="{{ URL::asset('js/jquery.nicescroll.js') }}"></script>
    <script src="{{ URL::asset('js/main.js') }}"></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="{{ URL::asset('js/flot-chart/excanvas.min.js') }}"></script><![endif]-->
    <script src="{{ URL::asset('js/jquery.scrollTo.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap-select.js') }}"></script>

    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/dataTables.bootstrap4.min.css') }}"/>
    <script type="text/javascript" src="{{ URL::asset('js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/jquery-dateformat.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/dataTable.pdfmaker.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/dataTables.editor.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/dataTables.checkboxes.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/vsf_font.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/button.html5.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/notification.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/dateFormat.js') }}"></script>

    <style>

        table.dataTable {
            margin: 0 auto;
        }


        /* Modal Content (image) */
        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        /* Caption of Modal Image */
        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        /* Add Animation */
        .modal-content, #caption {
            -webkit-animation-name: zoom;
            -webkit-animation-duration: 0.6s;
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @-webkit-keyframes zoom {
            from {-webkit-transform:scale(0)}
            to {-webkit-transform:scale(1)}
        }

        @keyframes zoom {
            from {transform:scale(0)}
            to {transform:scale(1)}
        }

        /* The Close Button */
        #close {
            position: absolute;
            top: 15px;
            right: 400px;
            color: #f10005;
            font-size: 90px;
            font-weight: bold;
            transition: 0.3s;
        }

        #close:hover,
        #close:focus {
            color: #f10005;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px){
            .modal-content {
                width: 100%;
            }
        }



        .coordonnees label {
            display: inline-block;
            width: 130px;
        }

        .coordonnees input {
            margin: 2px 0;
            padding: 2px;
            width: 300px;
        }

        .coordonnees legend {
            font-weight: bold;
            margin: 10px 0;
            font-size: 18px;
        }
        table.dataTable tbody tr.selected {
            color: white;
            background-color:#f0bcb4;
        }
    </style>
</head>
<body>
<section id="container">
    <!--header start-->
    <header class="header fixed-top clearfix">
        <!--logo start-->
        <div class="brand">

            <a href="{{route('home')}}" class="logo">
                Pro-Achat
            </a>
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars"></div>
            </div>
        </div>
        <!--logo end-->
        <div class="top-nav clearfix">
            <!--search & user info start-->
            <ul class="nav pull-right top-menu">
                <li>
                   <a href="{{env('APP_URL')}}/public/uploads/guide utilisateur.pdf" target="_blank"> &nbsp; <i class="fa fa-file-pdf-o"></i> Guide Utilisateur</a>
                </li><li>
                    <input type="text" class="form-control search" placeholder=" Search">
                </li>
                <!-- user login dropdown start-->
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                <li class="nav-item">
                    @if (Route::has('register'))
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                </li>
                @else
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="images/user.png">
                            <span class="username">{{ Auth::user()->prenoms }} {{ Auth::user()->nom }}  </span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i> Réglage</a></li>
                            <li> <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-key"></i>{{ __('Se déconnecter') }}</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </li>
                    @endguest



            </ul>
            <!--search & user info end-->
        </div>
    </header>
    <!--header end-->
    <!--sidebar start-->
    <aside>
        <div id="sidebar" class="nav-collapse">
            <!-- sidebar menu start-->
            <div class="leftside-navigation">
                <ul class="sidebar-menu" id="nav-accordion">
                    <li>
                        <a @yield('tableau_de_bord') href="{{route('home')}}">
                            <i class="fa fa-dashboard"></i>
                            <span>Tableau de Bord</span>
                        </a>
                    </li>
                    @if(Auth::user() != null && Auth::user()->hasRole('Parametrage'))
                    <li>
                        <a  href="index.html" @yield('parent_fournisseurs') >
                            <i class="fa fa-gear">

                            </i>
                            <span>Paramétrage</span>
                        </a>
                        <ul class="sub" >

                            <li @yield('utilisateurs')><a href="{{route('gestion_utilisateur')}}">Utilisateurs</a></li>
                            <li @yield('fournisseurs') ><a href="{{route('lister_fournisseur')}}"> Fournisseurs </a>

                                <ul class="sub" @yield('ul_fournisseur')>

                                    <li @yield('lister_fournisseurs') ><a href="{{route('lister_fournisseurs')}}" @yield('lister_fournisseurs') > Lister fournisseurs </a></li>
                                    <li @yield('ajouter_fournisseur') ><a href="{{route('ajouter_fournisseur')}}"> Ajouter fournisseur </a></li>

                                </ul></li>

                        </ul>
                    </li>
                    @endif
                    @if(Auth::user() != null && Auth::user()->hasAnyRole(['Gestionnaire_DA','Valideur_DA']))
                        <li @yield('produits') ><a href="{{route('gestion_produit')}}">Produits et Services</a></li>
                    <li >
                        <a  href="{{route('gestion_da')}}" @yield('das')>
                            <i class="fa fa-archive"></i>
                            <span>Les D.A.</span>
                        </a>
                        <ul class="sub">
                            @if(Auth::user() != null && Auth::user()->hasAnyRole(['Valideur_DA'])  || Auth::user()->hasAnyRole(['Gestionnaire_Pro_Forma']))
                            <li @yield('recherche_da')><a href="{{route('lister_da_recherche')}}">Rechercher une  D.A.</a></li>
                            <li @yield('lister_da')><a href="{{route('lister_da')}}">Lister les D.A.</a></li>
                            <li @yield('encours_validation')><a href="{{route('encours_validation')}}">Lister les D.A. à valider</a></li>
                            @endif
                            <li  @yield('creer_da')><a href="{{route('creer_da')}}">Creer une  D.A.</a></li>
                            <li  @yield('creer_da')><a href="{{route('da_multiple')}}">Creer plusieurs D.A.</a></li>

                        </ul>
                    </li>
                    @endif
                    @if(Auth::user() != null && Auth::user()->hasRole('Gestionnaire_Pro_Forma'))
                    <li>
                        <a  href="index.html" @yield('parent_demande_proformas')>
                            <i class="fa fa-book"></i>
                            <span>Les Dévis</span>
                        </a>
                        <ul class="sub">
                            <li  @yield('demande_proformas')><a href="{{route('gestion_demande_proformas')}}">Demande de Dévis</a></li>
                            <li @yield('reponse_fournisseur')><a href="{{route('gestion_reponse_fournisseur')}}">Reception de Dévis</a></li>
                        </ul>
                    </li>
                    @endif
                    @if(Auth::user() != null && Auth::user()->hasAnyRole(['Gestionnaire_BC']))
                    <li >
                        <a  @yield('gestion_bc') href="{{route('gestion_bc')}}">
                            <i class="fa fa-archive"></i>
                            <span>Gestion des BCs</span>
                        </a>

                    </li>
                    @endif
                    @if(Auth::user() != null && Auth::user()->hasAnyRole(['Gestionnaire_Facture']))
                        <li >
                            <a  @yield('gestion_Facture') href="{{route('Gestion_Facture')}}">
                                <i class="fa fa-archive"></i>
                                <span>Gestion des Factures</span>
                            </a>

                        </li>
                    @endif

                        @if(Auth::user() != null && Auth::user()->hasAnyRole(['Valideur_BC']))
                        <li @yield('validation_bc')>  <a href="{{route('validation_bc')}}"><i class="fa fa-check"></i><span>Validation B.C.</span></a></li>
                    @endif
                    <li style="color: ghostwhite">
                        <table   style="color: ghostwhite;size:20pt">
                            <thead>
                            <tr><th></th><th>D.A</th><th>B.C</th></tr>
                            <tr><td><div style="background-color: #CC0000; width: 25px"> &nbsp;</div></td><td> En attente de validation </td><td>En attente de validation</td></tr>
                            <tr><td><div style="background-color: mediumspringgreen; width: 25px"> &nbsp;</div></td><td>Validée </td><td>Validé</td></tr>
                            <tr><td><div style="background-color: #e0a800; width: 25px"> &nbsp;</div></td><td>Encours de traitement </td><td>Transmis</td></tr>
                            <tr><td><div style="background-color: #00ffff; width: 25px"> &nbsp;</div></td><td> Traitée et terminée </td><td>Traité, transmis et terminé</td></tr>
                            <tr><td><div style="background-color: violet; width: 25px"> &nbsp;</div></td><td> Traitée et retournée </td><td> Traité, transmis et retourné</td></tr>
                            </thead>

                        </table></li>


                </ul>            </div>

            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->
    <!--main content start-->
    <!--main content start-->
    <section id="main-content">
        <section class=" wrapper">
            <!-- //market-->
            @yield('dashboard')
            <div class="agile-grid"  style="background-color: #FFFFFF;@yield('pour_register') margin: 5px">

                @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                @endif()
                @if(Session::has('error'))
                    <div class="alert alert-danger">{{Session::get('error')}}</div>
                @endif()
                @yield('content')
            </div>
        </section>
        <!-- footer -->
        <div class="footer">
            <div class="wthree-copyright">
                <p>© 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">EIFFAGE</a></p>
            </div>
        </div>
        <!-- / footer -->
    </section>

    <!--main content end-->
</section>



</body>
</html>
