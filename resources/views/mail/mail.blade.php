@extends('mail.layoutmail')
@section('content')

    <p>Bonjour,</p>

    <p>Veuillez nous faire parvenir s'il vous plait une Pro forma pour les produits suivant:  </strong></br>
       <p> {{$corps}}</p>
    <br/>En attente de votre reponse, Monsieur, Madame, veuillez recevoir nos sincères salutations.</p>


    <br/>
    <p>Cordialement,</p>
    </br>
    </br>
    {{ \Illuminate\Support\Facades\Auth::user()->name }}
    </br>
    {{ \Illuminate\Support\Facades\Auth::user()->email }}
@endsection