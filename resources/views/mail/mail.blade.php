@extends('mail.layoutmail')
@section('content')

    <p>Bonjour,</p>

    <p>Veuillez nous adresser votre meilleure offre pour :
        <br>
        <br><strong>{{$corps}}</strong><br/>
        <p>Dans l’attente, et en vous remerciant,<br>
        <br>
        <p>
        Cordialement,
        <br>
        Best regards,
        </p>
    </p>
    <p>
        {{ \Illuminate\Support\Facades\Auth::user()->name }}
        <br>
        <strong>Eiffage Génie Civil Côte d’Ivoire</strong>
        <br>
        {{ \Illuminate\Support\Facades\Auth::user()->function }}
        <br>
        <label>Téléphone : </label>{{ \Illuminate\Support\Facades\Auth::user()->telephone }}
        <br>
        <label>Mail : </label>{{ \Illuminate\Support\Facades\Auth::user()->email }}
        <br>
        <img src="{{ URL::asset('images/logomail.png') }}"/>
    </p>
@endsection