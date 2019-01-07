@extends('layouts.app')
@section('tableau_de_bord')
    class="active"
@endsection
@section('dashboard')
    <div class="market-updates">
        <div class="col-md-3 market-update-gd">
            <div class="market-update-block clr-block-4">
                <div class="col-md-4 market-update-right">
                    <i class="fa fa-refresh fa-3x fa-spin  fa-fw" style="color: white"></i>
                </div>
                <div class="col-md-8 market-update-left">
                    <h4>D.A en attente de validation</h4>
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
                    <h4>B.C en attente de confirmation</h4>
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
@endsection()
@section('content')
    <div >
        <div class="row justify-content-center">
            <div class="col-md-8">

            </div>
        </div>
    </div>

@endsection
