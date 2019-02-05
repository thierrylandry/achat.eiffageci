@extends('mail.layoutmail')
@section('content')

    <p>Bonjour,</p>

    <p>Veuillez nous adresser votre meilleure offre pour :
        <br>
        @for($i=0;$i<sizeof($corps);$i++)

            <br> <strong>{{$corps[$i]}}</strong>

            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{isset($precisions[$i]) && $precisions[$i]!=""?" ".$precisions[$i]:''}}
            @if(isset($images[$i]) && $images[$i]!="")
                voir piece jointe : {{$images[$i]}}
    @endif



    @endfor

    <p></p><br>
        <p>Dans l’attente, et en vous remerciant,<br>
        <br>
        <p>
        Cordialement,
        <br>
        Best regards,
        </p>
    </p>

    <p>
        {{ \Illuminate\Support\Facades\Auth::user()->nom }}
        {{ \Illuminate\Support\Facades\Auth::user()->prenoms }}
        <br>
        <strong>Eiffage Génie Civil Côte d’Ivoire</strong>
        <br>
        {{ \Illuminate\Support\Facades\Auth::user()->function }}
        <br>
        <label>Téléphone : </label>{{ \Illuminate\Support\Facades\Auth::user()->contact }}
        <br>
        <label>Mail : </label>{{ \Illuminate\Support\Facades\Auth::user()->email }}
        <br>
        <img src="{{ URL::asset('images/logomail.png') }}"/>
    </p>
@endsection