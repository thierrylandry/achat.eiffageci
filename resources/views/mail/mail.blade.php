@extends('mail.layoutmail')
@section('content')

    <p>Bonjour,</p>

    <p><strong>Veuillez nous adresser votre meilleure offre pour :</strong></p><br>
    <p>{{$corps}}</p><br/>
    <p>Dans l’attente, et en vous remerciant,<br><br>
    <p>Cordialement,</p>
    <br>
    <p>Best regards,</p>
    <br>
    {{ \Illuminate\Support\Facades\Auth::user()->name }}
    <br>
    <p><strong>Eiffage Génie Civil Côte d’Ivoire</strong></p>
    <br>
    {{ \Illuminate\Support\Facades\Auth::user()->email }}
@endsection