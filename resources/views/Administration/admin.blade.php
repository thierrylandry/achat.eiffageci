@extends('home')
<!------ Include the above in your HEAD tag ---------->
@section('admin')
    <form method="post" >
<div id="login">
    <h3 class="text-center text-white pt-5">Login form</h3>
    <div >
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div class="login-box col-md-12">
                    <form id="login-form" class="form" action="" method="post">
                        <h3 class="text-center text-info">Connexion Administrateur</h3>
                        <div class="form-group">
                            <label for="username" class="text-info">Email:</label><br>
                            <input type="text" name="username" id="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-info">Mot de passe:</label><br>
                            <input type="text" name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group">

                            <input type="submit" name="submit" class="btn btn-info btn-md" value="SE CONNECTER">
                        </div>
                        <label  class="text-info">RETOUR A L'APPLICATION </label><br>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div></form>
@endsection()
@section('titre')
     Administrateur
    @endsection