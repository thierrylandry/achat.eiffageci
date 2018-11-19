@extends('mail.layoutmail')
@section('content')

    <p></p>

    <p>Bonjour,</p>

    <p>Veuillez nous faire parvenir s'il vous plait une Pro forma pour les produits suivant:  </strong></br>
       <p> {{$corps}}</p>
        <br/>En attente de votre reponse, nous sommes diponible pour des dicussions visant votre satisfaction.</p>


    <p>Sincères salutation</p>
    <br/>
    {{ \Illuminate\Support\Facades\Auth::user()->email }} {{ \Illuminate\Support\Facades\Auth::user()->name }}
@endsection