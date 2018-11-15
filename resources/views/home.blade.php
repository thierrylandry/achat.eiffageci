@extends('layouts.app')
@section('tableau_de_bord')
    class="active"
@endsection
@section('dashboard')
    <div class="market-updates">
        <div class="col-md-3 market-update-gd">
            <div class="market-update-block clr-block-2">
                <div class="col-md-4 market-update-right">
                    <i class="fa fa-eye"> </i>
                </div>
                <div class="col-md-8 market-update-left">
                    <h4>Nombre de DA en cours</h4>
                    <h3>13,500</h3>
                    <p>Other hand, we denounce</p>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class="col-md-3 market-update-gd">
            <div class="market-update-block clr-block-1">
                <div class="col-md-4 market-update-right">
                    <i class="fa fa-users" ></i>
                </div>
                <div class="col-md-8 market-update-left">
                    <h4>Nombre de fournisseur</h4>
                    <h3>1,250</h3>
                    <p>Other hand, we denounce</p>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class="col-md-3 market-update-gd">
            <div class="market-update-block clr-block-3">
                <div class="col-md-4 market-update-right">
                    <i class="fa fa-usd"></i>
                </div>
                <div class="col-md-8 market-update-left">
                    <h4>Montant  total des Achats</h4>
                    <h3>1,500</h3>
                    <p>Other hand, we denounce</p>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class="col-md-3 market-update-gd">
            <div class="market-update-block clr-block-4">
                <div class="col-md-4 market-update-right">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                </div>
                <div class="col-md-8 market-update-left">
                    <h4>Nombre d'utilisateurs</h4>
                    <h3>1,500</h3>
                    <p>Other hand, we denounce</p>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class="clearfix"> </div>
    </div>
@endsection()
@section('content')
    <div >
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}

                            </div>
                        @endif

                        You are logged in!

                        <p>{{ Auth::user()->id_profil }} est un boss</p>
                        @yield('test')
                        @switch( Auth::user()->id_profil )
                        @case(1)
                        @yield('admin')
                        @break

                        @case(2)
                        <span>je suis un demandeur </span>
                        @break

                        @default
                        <span>je suis un controlleur </span>
                        @endswitch
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
