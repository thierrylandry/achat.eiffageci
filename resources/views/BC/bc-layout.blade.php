<!DOCTYPE html>
<html>
<head>
</head>
<style>
    p, div{padding: 2px; margin: 0;}
    table{background-color:#fff;border-spacing:0;border-collapse:collapse}
    td,th{padding:8px;}
    table{width:100%;max-width:100%;margin-bottom:20px;}
    h4, h3{font-size:18px;}
    h4,h5,h6{margin-top:10px;margin-bottom:10px;}
    table.payload, table.payload th, table.payload td{
        font-size: 9pt;
    }
    table.payload tfoot p {
        font-size: inherit;
        font-weight: normal;
    }
    table.payload thead tr.head th {
        font-size: 7pt;
        font-weight: bold;
        text-align: center;
    }
    table.payload td, table.payload th{
        border: 0.3pt solid #000000
    }
    table.payload tbody td {
        font-size: 9pt;
        font-weight: normal;
        color: #333;
    }
    table.payload .ssfacture, table.payload .ssfacture th, table.payload .ssfacture td{
        margin: 0;
        padding: 0 4px 4px 0;
    }
    table.payload .ssfacture td.value{
        text-align: center;
        font-weight: bold;
        border-left: 0.3pt solid #000000;
    }
    table.payload .ssfacture td{
        border-bottom: 0.3pt solid #000000;
    }
    body{
        font-size: 9pt;
    }
    td.fournisseur {
        font-size: 32pt;
        text-align: center;
    }
    table.preambule, table.preambule td{
        font-size: 7pt;
        padding: 2px;
        margin: 0;
        border: 0.3pt solid #000000;
    }
    table.preambule p{
        margin: 0;
        padding: 0;
    }
    footer{
        font-size: 7pt;
        position: absolute;
        width: 100%;
        bottom: -1cm;
    }
    footer p {
        padding: 2px;
        margin: 0;
        text-align: center;
    }
    .page{
        page-break-after: auto;
    }
    div.rubrique{
        margin: 0 auto;
        width: 85%;
    }
    div.rubrique p{
        padding: 5px 3px;
        border: 0.3pt solid #000000;
        font-size: 8pt;
        text-align: center;
    }
    table.numero tr, table.numero tr td{
        margin: 3px;
    }
    .lignesEspacees
    {
        border-collapse : separate;
        border-spacing : 10px;
    }
</style>
<body style=" margin-top: -0.5cm; margin-left: 0cm; width: 19cm; border: 1px solid #ffffff;">
<div class="entete">
    <table style="margin: 0; padding: 0;">
        <tr>
            <td width="50%" valign="center" align="left">
                <img src="{{ asset("images/Eiffage_2400_01_colour_RGB.jpg") }}">
                <p style="font-size: 8pt; padding: 0;">{{$bc->projet->denomination}}</p>
                <p style="font-size: 8pt; padding: 0;">N° RCCM : {{$bc->projet->n_rccm}} / N° CC : {{$bc->projet->n_cc}}</p>
            </td>
            <td width="50%">
                <table class="numero lignesEspacees">
                    <tr >
                        <td  width="50%" valign="center" align="right">{{__('neutrale.numero_bc_sans_abreviation')}} </td>
                        <td style="border: 0.3pt solid #000000;" width="50%" valign="center" align="center"> {{$bc->numBonCommande}} </td>
                    </tr>
                    <tr>
                        <td width="50%" valign="center" align="right" >Date</td>
                        <td valign="center" align="center" style="border: 0.3pt solid #000000;" >{{ \Illuminate\Support\Carbon::createFromFormat('Y-m-d',explode(' ',$bc->created_at)[0])->formatLocalized('%d/%m/%Y') }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table style="margin: 0; padding: 0;">
        <tr>
            <td width="50%">
                <table class="preambule">
                    <tr>
                        <td width="30%"><b>{{__('neutrale.merci_libelle_facture')}}</b></td>
                        <td width="70%"><b>{{strtoupper($bc->projet->denomination_courte)}}</b>
                            </br>{{$bc->projet->adresseGeographique}}
                            {{$bc->projet->adressePostale}}</td>
                    </tr>
                    <tr>
                        <td width="30%"><b>{{__('neutrale.merci_envoyer_facture')}}</b></td>
                        <td width="70%"><b>{{strtoupper($bc->projet->denomination_longue)}}</b>
                            <br/>{{$bc->projet->adresseReceptionFacture}}
                        </td>
                    </tr>
                    <tr>
                        <td width="30%"><b>{{__('neutrale.chantier')}}:</b></td>
                        <td  width="70%">{{$bc->projet->chantier}}</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            {{html_entity_decode(__('neutrale.detail'))}}

                        </td>
                    </tr>
                </table>
            </td>
            <td width="50%" class="fournisseur" valign="center" align="center">
                {{$bc->fournisseur->libelle}}
            </td>
        </tr>
    </table>
    <table style="border: 0.3pt solid #000000;">
        <tr style="padding: 0; margin: 0;">
            <td style="font-size: 7pt; text-align: center; padding: 2px; margin: 0;">{{__('neutrale.All_Suppliers_Subcontractors_invoice_must_be_with_the_name')}} <b style="color: #761c19;">{{$bc->projet->denomination_longue}}</b>. <br/>{{__('neutrale.Toute_facture_ne_suivant_pas_ce_principe_sera_refusee_par_le_service_comptable')}}</td>
        </tr>
    </table>
</div>
<main class="page">
    @yield('content')
    <footer>
        <p>{{$bc->projet->siege_social}}</p>
    </footer>
</main>


<main class="page" style="font-size:6.9pt;page-break-inside: avoid;page-break-before: always; text-align: justify">
    @include('BC.charte')
</main>
</body>
</html>
