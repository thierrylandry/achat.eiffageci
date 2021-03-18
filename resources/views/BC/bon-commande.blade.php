@extends('BC.bc-layout')
@section('content')
    <table class="payload">
        <thead>
        <tr class="head">
            <th width="1%">n° </th>
            <th width="25%">{{__('reception.article')}} </th>
            <th width="5%">{{__('reception.reference_fournisseur')}}</th>
            <th width="5%">{{__('gestion_stock.code_analytique')}}</th>
            <th width="10%">{{__('neutrale.code_gestion')}}</th>
            <th width="1%">{{__('reception.quantite')}}</th>
            <th width="7%">{{__('gestion_stock.unite')}}</th>
            <th width="10%">{{__('neutrale.pu')}}</th>
            <th width="2%">{{__('neutrale.remise')}}</th>
            <th width="30%">{{__('neutrale.totlal_ht')}}</th>
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
                    <td style=" text-align: center;border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
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
                    <td  style="border-bottom-color: white">{{$dev->referenceFournisseur }}</td>
                    <td style=" text-align: center;border-bottom-color: white">{{$dev->codeRubrique}}</td>
                    <td style=" text-align: center;border-bottom-color: white">{{$dev->codeGestion}}</td>
                    <td style=" text-align: center;border-bottom-color: white">{{$dev->quantite}}</td>
                    <td style="border-bottom-color: white">{{$dev->unite}}</td>
                    <td style=" text-align: right;border-bottom-color: white">{{number_format($dev->prix_unitaire, 0,".", " ")}}</td>
                    <td style=" text-align: center;border-bottom-color: white">{{$dev->remise}}</td>
                    <td style=" text-align: right;border-bottom-color: white">{{number_format($dev->prix_tot, 0,".", " ")}}
                        <span style="display: none;border-bottom-color: white">{{ $tothtax +=  $dev->prix_tot }}</span>
                    </td>
                </tr>
                    @else
                    <tr>
                        <td  style="">{{$loop->index + 1}}</td>
                        <td  style="">{{$dev->titre_ext }}</br> {{$dev->commentaire }}</td>
                        <td  style="border-bottom-color: white">{{$dev->referenceFournisseur }}</td>
                        <td style=" text-align: center;">{{$dev->codeRubrique}}</td>
                        <td style=" text-align: center;border-bottom-color: white">{{$dev->codeGestion}}</td>
                        <td style=" text-align: center;">{{$dev->quantite}}</td>
                        <td style="">{{$dev->unite}}</td>
                        <td style=" text-align: right;">{{number_format($dev->prix_unitaire, 0,".", " ")}}</td>
                        <td style=" text-align: center;">{{$dev->remise}}</td>
                        <td style=" text-align: right;">{{number_format($dev->prix_tot, 0,".", " ")}}
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
                    <td >&nbsp;&nbsp;&nbsp;</td>
                    <td >&nbsp;&nbsp;&nbsp;</td>
                    <td >&nbsp;&nbsp;&nbsp;</span>
                    </td>
                </tr>
            @else
                <tr>
                    <td style="border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style="border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style="border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style=" text-align: center;border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style=" text-align: center;border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style=" text-align: center;border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style="border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style=" text-align: right;border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style=" text-align: center;border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style=" text-align: center;border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
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
                    <td style="border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style=" text-align: right;border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style=" text-align: center;border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style=" text-align: center;border-bottom-color: white">&nbsp;&nbsp;&nbsp;</td>
                    <td style=" text-align: right;border-bottom-color: white">&nbsp;&nbsp;&nbsp;</span>
                    </td>
                </tr>
            @endif
        @foreach($devis as $dev)


            <tr >
                <td style="border-bottom-color: white">{{$loop->index + 1}} </td>
                <td  style="border-bottom-color: white">{{$dev->titre_ext }}</br> {{$dev->commentaire }}</td>
                <td  style="border-bottom-color: white">{{$dev->referenceFournisseur }}</td>
                <td style=" text-align: center;border-bottom-color: white">{{$dev->codeRubrique}}</td>
                <td style=" text-align: center;border-bottom-color: white">{{$dev->codeGestion}}</td>
                <td style=" text-align: center;border-bottom-color: white">{{$dev->quantite}}</td>
                <td style="border-bottom-color: white">{{$dev->unite}}</td>
                <td style=" text-align: right;border-bottom-color: white">{{number_format($dev->prix_unitaire, 0,".", " ")}}</td>
                <td style=" text-align: center;border-bottom-color: white">{{$dev->remise}}</td>
                <td style=" text-align: right;border-bottom-color: white">{{number_format($dev->prix_tot, 0,".", " ")}}
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
                <p align="center"><b>{{__('neutrale.adresse_livraison')}}</b></p>
                <div class="rubrique">
                    <p style="border-bottom: none;"><b>{{__('neutrale.chantier')}} : PONT FELIX HOUPHOUET BOIGNY</b></p>
                    <p style="font-size: 10px">SITE INSTALLATION DU CHANTIER, LAGUNE EBRIE RIVE SUD, TREICHVILLE, AVENUE CHRISTIANI</p>
                </div>
                <br/>
                <div class="rubrique">
                    <p style="border-bottom: none;" align="center"><b>Date et modalité de livraison</b></p>
                    <p>{{(new \Illuminate\Support\Carbon($bc->date))->format('d/m/Y')}}</p>
                </div>
                <p align="center"><b>{{__('gestion_stock.condition_paiement')}}</b></p>
                <div class="rubrique">
                    <p style="font-size: 10px"><b>{{__('neutrale.rib')}}</b> <br/>
                    {{$bc->conditionPaiement}}</p>
                </div>  <div class="rubrique">
                    <p style=""><b><p style="font-size: 7pt"><t style="color:#761c19;">{{__('neutrale.port_epi')}}Port d’EPI</t>  obligatoire  (casque, chasuble, chaussures et gants) pour toute intervention sur le chantier et après autorisation d’un personnel HSE</p></b> <br/></p>
                </div>
            </th>
            <th colspan="8" valign="top" style="margin: 0; padding: 0; ">
                <table class="ssfacture" style="margin: 0; padding: 0;">
                    @if($bc->remise_excep!=0)
                        <tr>
                            <td style="text-align:right" ><b>{{__('neutrale.remise_excep')}} </b></td>
                            <td class="value">

                                {{number_format($bc->remise_excep,0,"."," ")." ".$devis[0]->devise}}
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td width="61.8%" style="text-align:right"><b>{{__('neutrale.totlal_ht')}}</b> </td>
                        <td class="value">{{ number_format($tothtax-$bc->remise_excep, 0,".", " ")." ".$devis[0]->devise  }}</td>
                    </tr>
                    <tr>
                        <td style="text-align:right" ><b>{{__('neutrale.totlal_ht')}} </b></td>
                        <td class="value">
                            <?php
                                    $tva=0;
                                foreach($devis as $dev):
                                    if(1==$dev->hastva){
                                        $tva+=$dev->prix_tot*0.18;
                                    }else{
                                        $tva+=0;
                                    }

                                    endforeach;
                                if($bc->remise_excep!=0){
                                    $tva=$tva-($bc->remise_excep*0.18);
                                }

                                    echo number_format($tva, 0,".", " ")." ".$devis[0]->devise;
                            ?>
                                </td>
                    </tr>
                        <tr>
                        <td style="text-align:right" ><b>{{__('neutrale.total_ttc')}} </b></td>

                            @if($bc->remise_excep!=0)
                        <td class="value">

                            {{number_format($tothtax+$tva-$bc->remise_excep,0,"."," ")." ".$devis[0]->devise}}
                        </td>
                                @else
                                <td class="value">

                                    {{number_format($tothtax+$tva,0,"."," ")." ".$devis[0]->devise}}
                                </td>
                                @endif
                    </tr>
                </table>

                <table>
                    <tr>
                        <th style="text-align:left; border-right: none;">{{__('sortie_materiel.demandeur')}} :({{__('translation.nom')}}/{{__('translation.contact')}})</th>
                        <th style="text-align:center; border-left: none;">{{strtoupper($bc->libelle_service)}}</th>
                    </tr>
                    <tr>

                        <th colspan="2" style="text-align:left; border-bottom-color: white" >
                            SIGNATURE


                        </th>
                    </tr>
                    <tr><th colspan="2" style="padding-left: 100px"><img src="{{ asset("images/Signature_Sylvain.jpg") }}" width="225px" /></th> </tr>
                    <tr>
                        <th style="border-right: none;border-bottom-color: white "> {{__('neutrale.nom_signataire')}} : </th>
                        <th style="border-left: none;border-bottom-color: white" >SYLVAIN DECULTIEUX</th>
                    </tr>
                </table>
            </th>
        </tr>
        </tfoot>
    </table>
@endsection