<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->

<!DOCTYPE html>
<head>
    <title>SE CONNECTER - PROCESS_ACHAT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link rel="icon" href="{{ URL::asset('images/eiffagefavicon.png') }}" type="image/png" sizes="66x66">
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/style-responsive.css" rel="stylesheet"/>
    <!-- font CSS -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="css/font.css" type="text/css"/>
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- //font-awesome icons -->
    <script src="js/jquery2.0.3.min.js"></script>
</head>
<body>

<div class="log-w3">

    <div class="w3layouts-main">

        <div class="row">
            <div class="col-sm-2"></div>
            <img  src="images/Eiffage_2400_01_colour_RGB.png" class="col-sm-8"  alt="">
            <div class="col-sm-2"></div>
        </div>
        </br>

        <!-- <h2>{{ __('Connexion') }}</h2> -->
        <div align="center" class="msg">Veuillez vous connecter pour démarrer votre session</div>
        </br>

        @foreach($errors->all() as $e)
            <div class="alert bg-red alert-dismissible ">
                {{ $e }}
            </div>
        @endforeach

        <form action="{{ route('login') }}" method="post">
            @csrf

            <div class="form-group row">
                <div class="col-md-12">
                <input type="email"  name="email" id="email" required="" class="ggg form-control{{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" placeholder="E-mail">
                <!-- @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong class="row-md-8">{{ $errors->first('email') }}</strong>
                        </span>
                    @endif -->
                </div>
            </div>

            <input type="password" id="password" name="password" required="" class="ggg form-control{{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Password">

            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong class="row-md-8">{{ $errors->first('password') }}</strong>
                </span>
            @endif

            <span><input id="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }} />Se souvenir de moi</span>
            <h6>
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Mot de passe oublié?') }}
                </a>
            </h6>
            <div class="clearfix"></div>
            <input type="submit" value="{{ __('Connexion') }}" name="login">
        </form>
        <p>Vous n'avez pas de compte ?<a href="{{ route('register') }}">Créez-en un</a></p>
    </div>
</div>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="js/jquery.scrollTo.js"></script>
</body>
</html>
