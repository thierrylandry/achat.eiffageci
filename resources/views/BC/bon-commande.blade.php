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
        @if($taille<=$taille_minim)

            @if($bc->commentaire_general!="")

                <tr>
                    <td style="border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style="border-bottom-color: white; font-weight:bold; ">{{$bc->commentaire_general!=""?$bc->commentaire_general:''}}</td>
                    <td style=" text-align: center;border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style=" text-align: center;border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style="border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style=" text-align: right;border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style=" text-align: center;border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style=" text-align: right;border-bottom-color: white">&nbsp;&nbsp;&nbsp;</span>
                    </td>
                </tr>
            @endif
            @foreach($devis as $dev)
                @if($loop->index + 1!=$taille_minim)
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
                        <td  style="">{{$dev->titre_ext }}</br> {{$dev->commentaire }}</td>
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


        @for($i=0;$i<$val=$taille_minim-$taille;$i++)
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


            @elseif( $taille>$taille_minim)
            @if($bc->commentaire_general!="")

                <tr>
                    <td style="border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style="border-bottom-color: white; font-weight:bold; ">{{$bc->commentaire_general!=""?$bc->commentaire_general:''}}</td>
                    <td style=" text-align: center;border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style=" text-align: center;border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style="border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style=" text-align: right;border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style=" text-align: center;border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style=" text-align: right;border-bottom-color: white">&nbsp;&nbsp;&nbsp;</span>
                    </td>
                </tr>
            @endif
        @foreach($devis as $dev)


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

        @endforeach
        @for($i=0;$i<$val=30-$taille;$i++)
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
                    <p style="font-size: 10px">SITE INSTALLATION DU CHANTIER, LAGUNE EBRIE RIVE SUD, TREICHVILLE, AVENUE CHRISTIANI</p>
                </div>
                <br/>
                <div class="rubrique">
                    <p style="border-bottom: none;" align="center"><b>Date et modalité de livraison</b></p>
                    <p>{{(new \Illuminate\Support\Carbon($bc->date))->format('d/m/Y')}}</p>
                </div>
                <p align="center"><b>Condition de paiement</b></p>
                <div class="rubrique">
                    <p style="font-size: 10px"><b>RIB à mentionner sur la facture</b> <br/>
                    {{$bc->conditionPaiement}}</p>
                </div>  <div class="rubrique">
                    <p style="font-size: 10px"><b><p><t style="color:#761c19;">Port d’EPI</t>  obligatoire  (casque, chasuble, chaussures et gants) pour toute intervention sur le chantier et après autorisation d’un personnel HSE</p></b> <br/></p>
                </div>
            </th>
            <th colspan="6" valign="top" style="margin: 0; padding: 0; ">
                <table class="ssfacture" style="margin: 0; padding: 0;">
                    <tr>
                        <td width="61.8%" style="text-align:right"><b>Total Hors Taxes en FCFA</b> </td>
                        <td class="value">{{ number_format($tothtax, 0,".", " ")." ".$devis[0]->devise  }}</td>
                    </tr>
                    <tr>
                        <td style="text-align:right" ><b>TVA </b></td>
                        <td class="value">
                            @if(1==$dev->hastva)
                                {{ number_format($tothtax*0.18, 0,".", " ")." ".$devis[0]->devise }}
                            @else
                                {{0}}

                            @endif
                                </td>
                    </tr>
                    <tr>
                        <td style="text-align:right" ><b>TOTAL TTC EN FCFA </b></td>
                        <td class="value">
                            @if(1==$dev->hastva)
                                {{ number_format($tothtax*1.18, 0,".", " ")." ".$devis[0]->devise }}
                            @else
                                {{ number_format($tothtax, 0,".", " ")." ".$devis[0]->devise  }}

                            @endif</td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th style="text-align:left; border-right: none;">Demandeur :(Nom/Téléphone)</th>
                        <th style="text-align:center; border-left: none;">{{strtoupper($bc->libelle_service)}}</th>
                    </tr>
                    <tr>

                        <th colspan="2" style="text-align:left; border-bottom-color: white" >
                            SIGNATURE


                        </th>
                    </tr>
                    <tr><th colspan="2" style="padding-left: 100px"><img src="{{ asset("images/Signature_Nicolas.jpg") }}" width="225px" /></th> </tr>
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