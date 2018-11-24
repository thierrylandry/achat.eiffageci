<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <title>{{ config('app.name', 'Laravel') }}</title>

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
    <link rel="stylesheet" href="css/font.css" type="text/css"/>
    <link href="{{ URL::asset('css/font-awesome.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('css/default/style.min.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-select.css') }}" type="text/css"/>
    <!-- //font-awesome icons -->
    <script src="{{ URL::asset('js/jquery2.0.3.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>

    <script src="{{ URL::asset('js/bootstrap.js') }}"></script>
    <script src="{{ URL::asset('js/jquery.dcjqaccordion.2.7.js') }}"></script>
    <script src="{{ URL::asset('js/scripts.js') }}"></script>
    <script src="{{ URL::asset('js/jquery.slimscroll.js') }}"></script>
    <script src="{{ URL::asset('js/jquery.nicescroll.js') }}"></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="{{ URL::asset('js/flot-chart/excanvas.min.js') }}"></script><![endif]-->
    <script src="{{ URL::asset('js/jquery.scrollTo.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap-select.js') }}"></script>

    <!-- DataTables -->


    <link rel="stylesheet" type="text/css" href="dataTables.bootstrap4.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
</head>
<body>
<section id="container">
    <!--header start-->
    <header class="header fixed-top clearfix">
        <!--logo start-->
        <div class="brand">

            <a href="index.html" class="logo">
                ProcAchat
            </a>
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars"></div>
            </div>
        </div>
        <!--logo end-->

        <div class="nav notify-row" id="top_menu">
            <!--  notification start -->
            <ul class="nav top-menu">
                <!-- settings start -->
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="fa fa-tasks"></i>
                        <span class="badge bg-success">8</span>
                    </a>
                    <ul class="dropdown-menu extended tasks-bar">
                        <li>
                            <p class="">You have 8 pending tasks</p>
                        </li>
                        <li>
                            <a href="#">
                                <div class="task-info clearfix">
                                    <div class="desc pull-left">
                                        <h5>Target Sell</h5>
                                        <p>25% , Deadline  12 June’13</p>
                                    </div>
                                    <span class="notification-pie-chart pull-right" data-percent="45">
                            <span class="percent"></span>
                            </span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="task-info clearfix">
                                    <div class="desc pull-left">
                                        <h5>Product Delivery</h5>
                                        <p>45% , Deadline  12 June’13</p>
                                    </div>
                                    <span class="notification-pie-chart pull-right" data-percent="78">
                            <span class="percent"></span>
                            </span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="task-info clearfix">
                                    <div class="desc pull-left">
                                        <h5>Payment collection</h5>
                                        <p>87% , Deadline  12 June’13</p>
                                    </div>
                                    <span class="notification-pie-chart pull-right" data-percent="60">
                            <span class="percent"></span>
                            </span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="task-info clearfix">
                                    <div class="desc pull-left">
                                        <h5>Target Sell</h5>
                                        <p>33% , Deadline  12 June’13</p>
                                    </div>
                                    <span class="notification-pie-chart pull-right" data-percent="90">
                            <span class="percent"></span>
                            </span>
                                </div>
                            </a>
                        </li>

                        <li class="external">
                            <a href="#">See All Tasks</a>
                        </li>
                    </ul>
                </li>
                <!-- settings end -->
                <!-- inbox dropdown start-->
                <li id="header_inbox_bar" class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="fa fa-envelope-o"></i>
                        <span class="badge bg-important">4</span>
                    </a>
                    <ul class="dropdown-menu extended inbox">
                        <li>
                            <p class="red">You have 4 Mails</p>
                        </li>
                        <li>
                            <a href="#">
                                <span class="photo"><img alt="avatar" src="images/3.png"></span>
                                <span class="subject">
                                <span class="from">Jonathan Smith</span>
                                <span class="time">Just now</span>
                                </span>
                                <span class="message">
                                    Hello, this is an example msg.
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="photo"><img alt="avatar" src="images/1.png"></span>
                                <span class="subject">
                                <span class="from">Jane Doe</span>
                                <span class="time">2 min ago</span>
                                </span>
                                <span class="message">
                                    Nice admin template
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="photo"><img alt="avatar" src="images/3.png"></span>
                                <span class="subject">
                                <span class="from">Tasi sam</span>
                                <span class="time">2 days ago</span>
                                </span>
                                <span class="message">
                                    This is an example msg.
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="photo"><img alt="avatar" src="images/2.png"></span>
                                <span class="subject">
                                <span class="from">Mr. Perfect</span>
                                <span class="time">2 hour ago</span>
                                </span>
                                <span class="message">
                                    Hi there, its a test
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">See all messages</a>
                        </li>
                    </ul>
                </li>
                <!-- inbox dropdown end -->
                <!-- notification dropdown start-->
                <li id="header_notification_bar" class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                        <i class="fa fa-bell-o"></i>
                        <span class="badge bg-warning">3</span>
                    </a>
                    <ul class="dropdown-menu extended notification">
                        <li>
                            <p>Notifications</p>
                        </li>
                        <li>
                            <div class="alert alert-info clearfix">
                                <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                                <div class="noti-info">
                                    <a href="#"> Server #1 overloaded.</a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="alert alert-danger clearfix">
                                <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                                <div class="noti-info">
                                    <a href="#"> Server #2 overloaded.</a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="alert alert-success clearfix">
                                <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                                <div class="noti-info">
                                    <a href="#"> Server #3 overloaded.</a>
                                </div>
                            </div>
                        </li>

                    </ul>
                </li>
                <!-- notification dropdown end -->
            </ul>
            <!--  notification end -->
        </div>
        <div class="top-nav clearfix">
            <!--search & user info start-->
            <ul class="nav pull-right top-menu">
                <li>
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
                            <img alt="" src="images/2.png">
                            <span class="username">{{ Auth::user()->name }} </span>
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
                    @if(Auth::user()->hasRole('Parametrage'))
                    <li>
                        <a  href="index.html" @yield('parent_fournisseurs') >
                            <i class="fa fa-gear">

                            </i>
                            <span>Paramétrage</span>
                        </a>
                        <ul class="sub">
                            <li  @yield('profils')><a href="{{route('gestion_profil')}}">Profils</a></li>
                            <li @yield('utilisateurs')><a href="{{route('gestion_utilisateur')}}">Utilisateurs</a></li>
                            <li @yield('fournisseurs') ><a href="{{route('ajouter_fournisseur')}}"> Fournisseurs </a></li>
                            <li @yield('produits') ><a href="{{route('gestion_produit')}}">Produits et Services</a></li>
                            <li @yield('prix') ><a href="{{route('gestion_prix')}}">Tablaau des prix</a></li>
                        </ul>
                    </li>
                    @endif
                    @if(Auth::user()->hasAnyRole(['Gestionnaire_DA','Valideur_DA']))
                    <li >
                        <a  href="{{route('gestion_da')}}" @yield('das')>
                            <i class="fa fa-archive"></i>
                            <span>Les D.A</span>
                        </a>
                    </li>
                    @endif
                    @if(Auth::user()->hasRole('Gestionnaire_Pro_Forma'))
                    <li>
                        <a  href="index.html" @yield('parent_demande_proformas')>
                            <i class="fa fa-book"></i>
                            <span>Les  proformas</span>
                        </a>
                        <ul class="sub">
                            <li  @yield('demande_proformas')><a href="{{route('gestion_demande_proformas')}}">Demande de Pro forma</a></li>
                            <li @yield('reponse_fournisseur')><a href="{{route('gestion_reponse_fournisseur')}}">Reception de Pro forma</a></li>
                        </ul>
                    </li>
                    @endif
                    @if(Auth::user()->hasAnyRole(['Gestionnaire_BC','Valideur_BC']))
                    <li>
                        <a  href="{{route('bon_commande_file')}}">
                            <i class="fa fa-archive"></i>
                            <span>Les  BCs</span>
                        </a>
                    </li>
                    @endif


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
            <div class="agile-grid" style="background-color: #FFFFFF; margin: 5px">

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

<script>

    var table= $('#fournisseurs').DataTable({
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

</body>
</html>
