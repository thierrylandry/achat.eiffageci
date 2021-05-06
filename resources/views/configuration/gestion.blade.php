@extends('layouts.app')
@section('configuration')
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
@endsection()
@section('content')
<h1 >{{__('menu.configuration')}} </h1>
<br>
    <div >
        <div class="row justify-content-center m-auto text-center w-75">


            <div class="col-sm-3 container-fluid bg-gradient p-5">

                <a href="{{route('importation_plan_comptable',app()->getLocale())}}">

                    <div class="col-4 princing-item blue">
                        <div class="pricing-divider ">
                            <h3 class="text-light"  style="color: white">{{__('menu.import_plancomptable')}}</h3>
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
                            <image src="../images/plan-comtpable-général-pcg.jpg" width="200px" height="200px"/>
                            <button type="button" class="btn btn-lg btn-block  btn-custom "></button>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-sm-3 container-fluid bg-gradient p-5">

                <a href="{{route('super_utilisateur',app()->getLocale())}}">

                    <div class="col-4 princing-item blue">
                        <div class="pricing-divider ">
                            <h3 class="text-light"  style="color: white">{{__('neutrale.super_user')}}</h3>
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
                            <image src="../images/users.jpg" width="200px" height="200px"/>
                            <button type="button" class="btn btn-lg btn-block  btn-custom "></button>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-sm-3 container-fluid bg-gradient p-5">

                <a href="{{route('gestion_projets',app()->getLocale())}}">

                    <div class="col-4 princing-item blue">
                        <div class="pricing-divider ">
                            <h3 class="text-light"  style="color: white">{{__('neutrale.projet')}}</h3>
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
                            <image src="../images/projet.jpg" width="200px" height="200px"/>
                            <button type="button" class="btn btn-lg btn-block  btn-custom "></button>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-3 container-fluid bg-gradient p-5">

                <a href="{{route('taux_change',app()->getLocale())}}">

                    <div class="col-4 princing-item blue">
                        <div class="pricing-divider ">
                            <h3 class="text-light"  style="color: white">{{__('neutrale.taux_change')}}</h3>
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
                            <image src="../images/change.jpg" width="200px" height="200px"/>
                            <button type="button" class="btn btn-lg btn-block  btn-custom "></button>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

@endsection
