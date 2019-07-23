@extends('mail.layoutmail')
@section('content')

    <p>Bonjour,</p>

    <p>Ci-joint un  bon de commande concernant les produits ou services suivant:</br>

        @for($i=0;$i<sizeof($corps);$i++)

            <br> <strong>{{$corps[$i]}}</strong>

            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{isset($precisions[$i]) && $precisions[$i]!=""?" ".$precisions[$i]:''}}
    @if(isset($images[$i]) && $images[$i]!="")
                voir piece jointe : {{$images[$i]}}
        @endif



    @endfor

<p></p><br>

            <?php         if(in_array('3',$tab)){
               echo "MERCI ET BONNE RECEPTION";

            }elseif(in_array('1',$tab)){
 echo "Merci de nous confirmer la date de livraison svp";
            }elseif(in_array('2',$tab)){
                echo "Merci de nous confirmer la date d’exécution des travaux svp";
            }?>
           <br/>
    <p>Dans l’attente, et en vous remerciant,<br>
        <br>
    <p>
        Cordialement,
        <br>
        <br>
        Best regards,
    </p></p><br>


    <strong>Marina OULAÏ</strong>
        <br>

        <strong>Eiffage Génie Civil Côte d’Ivoire</strong>
        <br>
        <br>
    Assistante Achats <br>
    Purchases Assistant <br>
        <label>Téléphone : </label>+225 87 47 11 25
        <br>
        <label>Mail : </label>marina.oulai@eiffage.com
        <br>
        <img src="http://172.20.73.3/achat.eiffageci/images/logomail.png"/>
    </p>
@endsection