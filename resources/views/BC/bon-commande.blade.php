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
        @if($taille<=9)

            @if($taille==9)
                @else

            @endif
            @foreach($ligne_bcs as $ligne_bc)
                @if($loop->index + 1!=9)
                <tr>
                    <td  style="border-bottom-color: white">{{$loop->index + 1}}</td>
                    <td  style="border-bottom-color: white">{{$ligne_bc->titre_ext }}</td>
                    <td style=" text-align: center;border-bottom-color: white">{{$ligne_bc->codeRubrique}}</td>
                    <td style=" text-align: center;border-bottom-color: white">{{$ligne_bc->quantite_ligne_bc}}</td>
                    <td style="border-bottom-color: white">{{$ligne_bc->unite_ligne_bc}}</td>
                    <td style=" text-align: right;border-bottom-color: white">{{$ligne_bc->prix_unitaire_ligne_bc}}</td>
                    <td style=" text-align: center;border-bottom-color: white">{{$ligne_bc->remise_ligne_bc}}</td>
                    <td style=" text-align: right;border-bottom-color: white">{{$ligne_bc->prix_tot}}
                        <span style="display: none;border-bottom-color: white">{{ $tothtax +=  $ligne_bc->prix_tot }}</span>
                    </td>
                </tr>
                    @else
                    <tr>
                        <td  style="">{{$loop->index + 1}}</td>
                        <td  style="">{{$ligne_bc->titre_ext }}</td>
                        <td style=" text-align: center;">{{$ligne_bc->codeRubrique}}</td>
                        <td style=" text-align: center;">{{$ligne_bc->quantite_ligne_bc}}</td>
                        <td style="">{{$ligne_bc->unite_ligne_bc}}</td>
                        <td style=" text-align: right;">{{$ligne_bc->prix_unitaire_ligne_bc}}</td>
                        <td style=" text-align: center;">{{$ligne_bc->remise_ligne_bc}}</td>
                        <td style=" text-align: right;">{{$ligne_bc->prix_tot}}
                            <span style="display: none;">{{ $tothtax +=  $ligne_bc->prix_tot }}</span>
                        </td>
                    </tr>
                @endif
            @endforeach

        @for($i=0;$i<$val=9-$taille;$i++)
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
            @elseif( $taille>9)
        @foreach($ligne_bcs as $ligne_bc)
            <tr >
                <td style="border-bottom-color: white">{{$loop->index + 1}} </td>
                <td style="border-bottom-color: white">{{$ligne_bc->titre_ext }}</td>
                <td style=" text-align: center;border-bottom-color: white">{{$ligne_bc->codeRubrique}}</td>
                <td style=" text-align: center;border-bottom-color: white">{{$ligne_bc->quantite_ligne_bc}}</td>
                <td style="border-bottom-color: white">{{$ligne_bc->unite_ligne_bc}}</td>
                <td style=" text-align: right;border-bottom-color: white">{{$ligne_bc->prix_unitaire_ligne_bc}}</td>
                <td style=" text-align: center;border-bottom-color: white">{{$ligne_bc->remise_ligne_bc}}</td>
                <td style=" text-align: right;border-bottom-color: white">{{$ligne_bc->prix_tot}}
                    <span style="display: none;border-bottom-color: white">{{ $tothtax +=  $ligne_bc->prix_tot }}</span>
                </td>
            </tr>

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
                        <td class="value">{{ number_format(intval($tothtax), 0,".", " ")  }}</td>
                    </tr>
                    <tr>
                        <td style="text-align:right" ><b>TVA </b></td>
                        <td class="value">{{ number_format($tothtax*0.18, 0,".", " ") }}</td>
                    </tr>
                    <tr>
                        <td style="text-align:right" ><b>TOTAL TTC EN FCFA </b></td>
                        <td class="value">{{ number_format($tothtax*1.18, 0,".", " ") }}</td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th style="text-align:left; border-right: none;">Demandeur :(Nom/Téléphone)</th>
                        <th style="text-align:center; border-left: none;">SERVICE MATERIEL</th>
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