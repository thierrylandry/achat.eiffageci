<!-- permet de transformer \r\n en br  et les !! les interprete-->
{!! nl2br(e($msg_contenu)) !!}
<p>
    Cordialement,
    <br>
    Best regards,
<br>
{{ \Illuminate\Support\Facades\Auth::user()->name }}
<br>
<strong>Eiffage Génie Civil Côte d’Ivoire</strong>
<br>
{{ \Illuminate\Support\Facades\Auth::user()->function }}
<br>
<label>Téléphone : </label>{{ \Illuminate\Support\Facades\Auth::user()->contact }}
<br>
<label>Mail : </label>{{ \Illuminate\Support\Facades\Auth::user()->email }}
<br>
<img src="http://172.20.73.3/achat.eiffageci/images/logomail.png"/>
</p>