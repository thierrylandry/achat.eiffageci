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
    <script src="{{ URL::asset('js/dataTables.buttons.min.js') }}"></script>

    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/dataTables.bootstrap4.min.css') }}"/>
    <script type="text/javascript" src="{{ URL::asset('js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/jquery-dateformat.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/dataTable.pdfmaker.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/dataTables.editor.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/dataTables.checkboxes.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/title-numerique.js') }}"></script>
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

            <a href="{{route('home',app()->getLocale())}}" class="logo">
                Pro-Achat
            </a>
            <p style="color: #FFFFFF">v2.0</p>
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars"></div>
            </div>
        </div>
        <!--logo end-->
        <div class="top-nav clearfix">
            <!--search & user info start-->
            <ul class="nav pull-right top-menu">

                <li>
                    @if(sizeof(Auth::user()->projets()->get())!=1)
                        <form method="post" action="{{route('switch_projet')}}">
                    <div class="header-left">

                            @csrf

                        <select data-placeholder="" tabindex="1" name="id_projet" >

                            @foreach(Auth::user()->projets()->get() as $projet )
                            <option value="{{$projet->id}}" @if(session('id_projet')==$projet->id) selected @endif> {{$projet->libelle}}</option>
                            @endforeach
                        </select>

                        <button class="btn btn-info" type="submit"><i class="fa fa-check"></i></button>
                    </div>
                        </form>
                    @endif
                </li>

@if(isset($panini) )
<li class="dropdown">
     <a data-toggle="dropdown" class="dropdown-toggle" href="#">
       {{__('neutrale.mon_panier')}}  <i class="fa fa-shopping-basket"></i>
         <span class="badge bg-success" id="nb_article">0</span>
     </a>
     <ul class="dropdown-menu extended tasks-bar" id="list_panier">



     </ul>
 </li>
 @endif
 <li><a href="{{route('change',['lang'=>'fr'])}}">Français</a>
    </li>
    <li> <a href="{{route('change',['lang'=>'en'])}}">English</a>
    </li>
    <li>
     <input type="text" class="form-control search" placeholder=" Search">
 </li>
 <!-- user login dropdown start-->
 @guest
 <li class="nav-item">
     <a class="nav-link" href="{{ route('login', app()->getLocale()) }}">{{ __('Login') }}</a>
 </li>
 <li class="nav-item">
     @if (Route::has('register', app()->getLocale()))
         <a class="nav-link" href="{{ route('register',app()->getLocale()) }}">{{ __('Register') }}</a>
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
             <li><a href="{{route('monprofile',['$lug'=> \Illuminate\Support\Facades\Auth::user()->slug,'locale'=>app()->getLocale()])}}"><i class=" fa fa-suitcase"></i>{{ __('menu.mon_profile') }}  </a></li>
             <li> <a class="dropdown-item" href="{{ route('logout', app()->getLocale()) }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-key"></i>{{ __('menu.se_deconnecter') }}</a></li>
             <form id="logout-form" action="{{ route('logout', app()->getLocale()) }}" method="POST" style="display: none;">
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
         <a @yield('tableau_de_bord') href="{{route('home',app()->getLocale())}}">
             <i class="fa fa-dashboard"></i>
             <span>{{ __('menu.dashboard') }} </span>
         </a>
     </li>
     <li>
         <a  href="" @yield('rapport')>
             <i class="fa fa-bar-chart"></i>
             <span>{{ __('menu.Reports') }}</span>
         </a>
         <ul class="sub" >

             <li @yield('performance_fournisseur') ><a href="{{route('performance_fournisseur',app()->getLocale())}}" @yield('performance_fournisseur') > {{ __('menu.performance_fournisseur') }} </a></li>
             <li @yield('rapport_stock') ><a href="{{route('rapport_stock',app()->getLocale())}}"> {{ __('menu.Stocks') }} </a></li>
             <li @yield('rapport_demande_achat') ><a href="{{route('rapport_demande_achat',app()->getLocale())}}"> {{ __('menu.demande_achat') }} </a></li>

         </ul>
     </li>
     @if(Auth::user() != null && Auth::user()->hasRole('Gestion_stock'))
     <li>
         <a @yield('gestion_stock') href="{{route('gestion_stock',app()->getLocale())}}">
             <i class="fa fa-houzz"></i>
             <span>{{ __('menu.gestion_stock') }}</span>
         </a>
     </li>
     @endif
     @if(Auth::user() != null && Auth::user()->hasRole('Parametrage'))
     <li>
         <a  href="index.html" @yield('parent_fournisseurs') >
             <i class="fa fa-gear">

             </i>
             <span>{{ __('menu.setting') }}</span>
         </a>
         <ul class="sub" >

             <li @yield('utilisateurs')><a href="{{route('gestion_utilisateur',app()->getLocale())}}">{{ __('menu.users') }}</a></li>
             <li @yield('fournisseurs') ><a href="{{route('lister_fournisseur',app()->getLocale())}}"> {{ __('menu.fournisseurs') }} </a>

                 <ul class="sub" @yield('ul_fournisseur')>

                     <li @yield('lister_fournisseurs') ><a href="{{route('lister_fournisseurs',app()->getLocale())}}" @yield('lister_fournisseurs') >{{ __('menu.liser_fournisseurs') }}</a></li>
                     <li @yield('ajouter_fournisseur') ><a href="{{route('ajouter_fournisseur',app()->getLocale())}}">{{ __('menu.add_fournisseurs') }}</a></li>

                 </ul></li>

         </ul>
     </li>
     @endif
     @if(Auth::user() != null && Auth::user()->hasRole('configuration'))
     <li @yield('configuration') >
         <a  @yield('configuration') href="{{route('configuration',app()->getLocale())}}" >
             <i class="fa fa-cogs">

             </i>
             <span>{{ __('menu.configuration') }}</span>
         </a>
     </li>
     @endif
     @if(Auth::user() != null && Auth::user()->hasAnyRole(['Gestionnaire_DA','Valideur_DA']))
         <li @yield('menu_produit') ><a href="{{route('menu_produit',app()->getLocale())}}" @yield('menu_produit')>{{ __('menu.produit_service') }}</a></li>
     <li >
         <a  href="{{route('gestion_da',app()->getLocale())}}" @yield('das')>
             <i class="fa fa-archive"></i>
             <span>{{ __('menu.les_da') }}</span>
         </a>
         <ul class="sub">
          <li  @yield('demande_achat')><a  href="{{route('demande_achat',app()->getLocale())}}">{{ __('menu.faire_une_demande_achat') }}</a></li>
             <li @yield('recherche_da')><a href="{{route('lister_da_recherche',app()->getLocale())}}">{{ __('menu.search_da') }}</a></li>
             @if(Auth::user() != null && Auth::user()->hasAnyRole(['Valideur_DA'])  || Auth::user()->hasAnyRole(['Gestionnaire_Pro_Forma']))
             <li @yield('encours_validation')><a href="{{route('encours_validation',app()->getLocale())}}">{{ __('menu.list_da_valider') }}</a></li>
             @endif
            <li  @yield('historique_achat')><a href="{{route('historique_achat',app()->getLocale())}}">{{ __('menu.historique') }}</a></li>

         </ul>
     </li>
     @endif
     @if(Auth::user() != null && Auth::user()->hasRole('Gestionnaire_Pro_Forma'))
     <li>
         <a  href="index.html" @yield('parent_demande_proformas')>
             <i class="fa fa-book"></i>
             <span>{{ __('menu.les_devis') }}</span>
         </a>
         <ul class="sub">
             <li  @yield('demande_proformas')><a href="{{route('gestion_demande_proformas',app()->getLocale())}}">{{ __('menu.demande_devis') }}</a></li>
             <li @yield('reponse_fournisseur')><a href="{{route('gestion_reponse_fournisseur',app()->getLocale())}}">{{ __('menu.reception_devis') }}</a></li>
         </ul>
     </li>
     @endif
     @if(Auth::user() != null && Auth::user()->hasAnyRole(['Gestionnaire_BC']))
     <li >
         <a  @yield('gestion_bc') href="{{route('gestion_bc',app()->getLocale())}}">
             <i class="fa fa-archive"></i>
             <span>{{ __('menu.gestion_bc') }}</span>
         </a>

     </li>
         <li >
         <a  @yield('regularisation') href="{{route('regularisation',app()->getLocale())}}">
             <i class="fa fa-archive"></i>
             <span>{{ __('menu.regularisation_bc') }}</span>
         </a>

     </li>
     @endif

         @if(Auth::user() != null && Auth::user()->hasAnyRole(['Valideur_BC']))
         <li >  <a @yield('validation_bc')  href="{{route('validation_bc',app()->getLocale())}}"><i class="fa fa-check"></i><span>{{ __('menu.validation_bc') }}</span></a></li>
     @endif
     @if(Auth::user() != null && Auth::user()->hasRole('Gestionnaire_Pro_Forma'))
         <li>
             <a  href="index.html" @yield('parent_reception_commande')>
                 <i class="fa fa-archive"></i>
                 <span>{{ __('menu.reception_commande') }}</span>
             </a>
             <ul class="sub">
                 <li  @yield('reception_commande')><a href="{{route('reception_commande',app()->getLocale())}}"> {{ __('menu.avec_bc') }}</a></li>
                 <li @yield('reception_sans_commande')><a href="{{route('reception_commande_sans_bc',app()->getLocale())}}">{{ __('menu.sans_bc') }}</a></li>
                 <li @yield('historique_bl')><a href="{{route('historique_bl',app()->getLocale())}}">{{ __('menu.liste_bon_livraison') }}</a></li>
             </ul>
         </li>
     @endif
     <li style="color: ghostwhite">
         <table   style="color: ghostwhite;size:20pt">
             <thead>
             <tr><th></th><th>D.A</th><th>B.C</th></tr>
             <tr><td><div style="background-color: #CC0000; width: 25px"> &nbsp;</div></td><td> {{ __('menu.attente') }} </td><td>{{ __('menu.attente') }}</td></tr>
             <tr><td><div style="background-color: mediumspringgreen; width: 25px"> &nbsp;</div></td><td>{{ __('menu.valide') }} </td><td>{{ __('menu.valide') }}</td></tr>
             <tr><td><div style="background-color: #e0a800; width: 25px"> &nbsp;</div></td><td>{{ __('menu.encours') }} </td><td>{{ __('menu.transmis') }}</td></tr>
             <tr><td><div style="background-color: #00ffff; width: 25px"> &nbsp;</div></td><td> {{ __('menu.traite_termine') }} </td><td>{{ __('menu.traite_termine_transmis') }}</td></tr>
             <tr><td><div style="background-color: violet; width: 25px"> &nbsp;</div></td><td>  {{ __('menu.traite_retourne') }} </td><td>{{ __('menu.traite_transmis_retourne') }} </td></tr>
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
