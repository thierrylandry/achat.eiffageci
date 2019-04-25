@extends('mail.layoutmail')
@section('content')

    <p>Bonjour,</p>

    <p>Vous avez : {{$nb}}
        <br>
<p>Vous pouvez les consulter sur <a href="{{$adresse}}">cliquez ici</a></p>
    <p>Dans l’attente, et en vous remerciant,<br>
    <p>
        Cordialement,
        <br>
        Best regards,
    </p>
    </p>

    <p>
        ROBOT PRO-ACHAT
        <br>
        <strong>Eiffage Génie Civil Côte d’Ivoire</strong>
        <br>
        <img src="http://172.20.73.3/achat.eiffageci/images/logomail.png"/>
    </p>
@endsection