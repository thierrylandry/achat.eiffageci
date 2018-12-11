@extends('layouts.app')
@section('tableau_de_bord')
    class="active"
@endsection
@section('dashboard')
    <div class="market-updates">
        <div class="col-md-3 market-update-gd">
            <div class="market-update-block clr-block-4">
                <div class="col-md-4 market-update-right">
                    <i class="fa fa-refresh fa-5x fa-spin  fa-fw" style="color: white"></i>
                </div>
                <div class="col-md-8 market-update-left">
                    <h4>D.A en attente de validation</h4>
                    <h3>{{$daencours}}/{{$das}}</h3>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class="col-md-3 market-update-gd">
            <div class="market-update-block clr-block-2">
                <div class="col-md-4 market-update-right">
                    <i class="fa fa-refresh fa-5x fa-spin  fa-fw" style="color: white"> </i>
                </div>
                <div class="col-md-8 market-update-left">
                    <h4>B.C en attente de valisation</h4>
                    <h3>{{$Boncommandeencours}}/{{$Boncommandes}}</h3>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class="col-md-3 market-update-gd">
            <div class="market-update-block clr-block-4">
                <div class="col-md-4 market-update-right">
                    <i class="fa fa-refresh fa-5x fa-spin  fa-fw" style="color: white"> </i>
                </div>
                <div class="col-md-8 market-update-left">
                    <h4>Total des B.C validés</h4>
                    <h3>{{number_format($montant_bc, 0,".", " ")}} Fr CFA</h3>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class="col-md-3 market-update-gd">
            <div class="market-update-block clr-block-2">
                <div class="col-md-4 market-update-right">
                    <i class="fa fa-refresh fa-5x fa-spin  fa-fw" style="color: white"> </i>
                </div>
                <div class="col-md-8 market-update-left">
                    <h4>Total des B.C traités</h4>
                    <h3>{{number_format($montant_bct, 0,".", " ")}} Fr CFA</h3>
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

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
