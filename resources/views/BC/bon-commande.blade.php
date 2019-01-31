@extends('BC.bc-layout')
@section('content')
    <table class="payload">
        <thead>
        <tr class="head">
            <th width="1%">N°</th>
            <th width="35%">DESIGNATION</th>
            <th width="10%">CODE ANALYTI<br/>QUE</th>
            <th width="7%">QUANTITE</th>
            <th width="8%">UNITE</th>
            <th width="10%">P.U HT</th>
            <th width="10%">REMISE %</th>
            <th width="18%">TOTAL HT</th>
        </tr>
        </thead>
        <tbody>
        @if($taille<=6)

            @if($taille==6)
                @else

            @endif
            @foreach($devis as $dev)
                @if($loop->index + 1!=6)
                <tr>
                    <td  style="border-bottom-color: white">{{$loop->index + 1}}</td>
                    <td  style="border-bottom-color: white">{{$dev->titre_ext }}<br> {{$dev->commentaire }}</td>
                    <td style=" text-align: center;border-bottom-color: white">{{$dev->codeRubrique}}</td>
                    <td style=" text-align: center;border-bottom-color: white">{{$dev->quantite}}</td>
                    <td style="border-bottom-color: white">{{$dev->unite}}</td>
                    <td style=" text-align: right;border-bottom-color: white">{{$dev->prix_unitaire}}</td>
                    <td style=" text-align: center;border-bottom-color: white">{{$dev->remise}}</td>
                    <td style=" text-align: right;border-bottom-color: white">{{$dev->prix_tot}}
                        <span style="display: none;border-bottom-color: white">{{ $tothtax +=  $dev->prix_tot }}</span>
                    </td>
                </tr>
                    @else
                    <tr>
                        <td  style="">{{$loop->index + 1}}</td>
                        <td  style="border-bottom-color: white">{{$dev->titre_ext }}</br> {{$dev->commentaire }}</td>
                        <td style=" text-align: center;">{{$dev->codeRubrique}}</td>
                        <td style=" text-align: center;">{{$dev->quantite}}</td>
                        <td style="">{{$dev->unite}}</td>
                        <td style=" text-align: right;">{{$dev->prix_unitaire}}</td>
                        <td style=" text-align: center;">{{$dev->remise}}</td>
                        <td style=" text-align: right;">{{$dev->prix_tot}}
                            <span style="display: none;">{{ $tothtax +=  $dev->prix_tot }}</span>
                        </td>
                    </tr>
                @endif
            @endforeach

            @if($bc->commentaire_general!="")
                <tr>
                    <td style="border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style="border-bottom-color: white">{{$bc->commentaire_general!=""?$bc->commentaire_general:''}}</td>
                    <td style=" text-align: center;border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style=" text-align: center;border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style="border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style=" text-align: right;border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style=" text-align: center;border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style=" text-align: right;border-bottom-color: white">&nbsp;&nbsp;&nbsp;</span>
                    </td>
                </tr>
                @endif
        @for($i=0;$i<$val=6-$taille;$i++)
            @if($i==$val-1)
                <tr>
                    <td >&nbsp;&nbsp;&nbsp;</td>
                    <td >&nbsp;&nbsp;&nbsp;</td>
                    <td >&nbsp;&nbsp;&nbsp;</td>
                    <td >&nbsp;&nbsp;&nbsp;</td>
                    <td >&nbsp;&nbsp;&nbsp;</td>
                    <td >&nbsp;&nbsp;&nbsp;</td>
                    <td >&nbsp;&nbsp;&nbsp;</td>
                    <td >&nbsp;&nbsp;&nbsp;</span>
                    </td>
                </tr>
            @else
                <tr>
                    <td style="border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style="border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style=" text-align: center;border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style=" text-align: center;border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style="border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style=" text-align: right;border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style=" text-align: center;border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style=" text-align: right;border-bottom-color: white">&nbsp;&nbsp;&nbsp;</span>
                    </td>
                </tr>
            @endif
        @endfor


            @elseif( $taille>6)
        @foreach($devis as $dev)
<<<<<<< HEAD
        <tr>
            <td>{{$loop->index + 1}}</td>
            <td  style="border-bottom-color: white">{{$dev->titre_ext }}</br> {{$dev->commentaire }}</td>
            <td style=" text-align: center;">{{$dev->codeRubrique}}</td>
            <td style=" text-align: center;">{{$dev->quantite}}</td>
            <td>{{$dev->unite}}</td>
            <td style=" text-align: right;">{{$dev->prix_unitaire}}</td>
            <td style=" text-align: center;">{{$dev->remise}}</td>
            <td style=" text-align: right;">{{$dev->prix_tot}}
                <span style="display: none;">{{ $tothtax +=  intval(str_replace(" ","",$dev->prix_tot)) }}</span>
            </td>
        </tr>
=======
            <tr >
                <td style="border-bottom-color: white">{{$loop->index + 1}} </td>
                <td  style="border-bottom-color: white">{{$dev->titre_ext }}</br> {{$dev->commentaire }}</td>
                <td style=" text-align: center;border-bottom-color: white">{{$dev->codeRubrique}}</td>
                <td style=" text-align: center;border-bottom-color: white">{{$dev->quantite}}</td>
                <td style="border-bottom-color: white">{{$dev->unite}}</td>
                <td style=" text-align: right;border-bottom-color: white">{{$dev->prix_unitaire}}</td>
                <td style=" text-align: center;border-bottom-color: white">{{$dev->remise}}</td>
                <td style=" text-align: right;border-bottom-color: white">{{$dev->prix_tot}}
                    <span style="display: none;border-bottom-color: white">{{ $tothtax +=  $dev->prix_tot }}</span>
                </td>
            </tr>

>>>>>>> c33f50ea4cecb6a3eef53b8e2530a4c7ef4c8cc6
        @endforeach
        @for($i=0;$i<$val=38-$taille;$i++)
            @if($i==$val-1)
                <tr>
                    <td >&nbsp;&nbsp;&nbsp;</td>
                    <td >&nbsp;&nbsp;&nbsp;</td>
                    <td >&nbsp;&nbsp;&nbsp;</td>
                    <td >&nbsp;&nbsp;&nbsp;</td>
                    <td >&nbsp;&nbsp;&nbsp;</td>
                    <td >&nbsp;&nbsp;&nbsp;</td>
                    <td >&nbsp;&nbsp;&nbsp;</td>
                    <td >&nbsp;&nbsp;&nbsp;</span>
                    </td>
                </tr>
            @else
                <tr>
                    <td style="border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style="border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style=" text-align: center;border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style=" text-align: center;border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style="border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style=" text-align: right;border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style=" text-align: center;border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style=" text-align: right;border-bottom-color: white">&nbsp;&nbsp;&nbsp;</span>
                    </td>
                </tr>
            @endif
        @endfor
@endif
        </tbody>
        <tfoot style="margin: 0; padding: 0;">
        <tr style="margin: 0; padding: 0;">
            <th colspan="2" style="margin: 0; padding: 0;">
                <p align="center"><b>Adresse de livraison</b></p>
                <div class="rubrique">
                    <p style="border-bottom: none;"><b>Chantier : PONT FELIX HOUPHOUET BOIGNY</b></p>
                    <p>SITE INSTALATION DU CHANTIER, LAGUNE EBRIE RIVE SUD, TREICHVILLE, AVENUE CHRISTIANI</p>
                </div>
                <br/>
                <div class="rubrique">
                    <p style="border-bottom: none;" align="center"><b>Date et modalité de livraison</b></p>
                    <p>{{(new \Illuminate\Support\Carbon($bc->date))->format('d/m/Y')}}</p>
                </div>
                <p align="center"><b>Condition de paiement</b></p>
                <div class="rubrique">
                    <p><b>RIB à mentionner sur la facture</b> <br/>
                    Par virement ou chèque 30 jours fin de mois <br/>
                    date de réception de facture.</p>
                </div>
            </th>
            <th colspan="6" valign="top" style="margin: 0; padding: 0;">
                <table class="ssfacture" style="margin: 0; padding: 0;">
                    <tr>
                        <td width="61.8%" style="text-align:right"><b>Total Hors Taxes en FCFA</b> </td>
                        <td class="value">{{ number_format($tothtax, 0,".", " ")." ".$devis[0]->devise  }}</td>
                    </tr>
                    <tr>
                        <td style="text-align:right" ><b>TVA </b></td>
                        <td class="value">{{ number_format($tothtax*0.18, 0,".", " ")." ".$devis[0]->devise }}</td>
                    </tr>
                    <tr>
                        <td style="text-align:right" ><b>TOTAL TTC EN FCFA </b></td>
                        <td class="value">{{ number_format($tothtax*1.18, 0,".", " ")." ".$devis[0]->devise }}</td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th style="text-align:left; border-right: none;">Demandeur :(Nom/Téléphone)</th>
                        <th style="text-align:center; border-left: none;">{{strtoupper($bc->service_demandeur)}}</th>
                    </tr>
                    <tr>
                        <th colspan="2" style="text-align:left;border-bottom-color: white" >
                            SIGNATURE
                            <br/><br/><br/><br/><br/><br/><br/><br/>
                        </th>
                    </tr>
                    <tr>
                        <th style="border-right: none;border-bottom-color: white "> Nom du Signataire Habilité : </th>
                        <th style="border-left: none;border-bottom-color: white" >NICOLAS DESCAMPS</th>
                    </tr>
                </table>
            </th>
        </tr>
        </tfoot>
    </table>
@endsection