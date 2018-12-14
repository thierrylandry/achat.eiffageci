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
                <p style="font-size: 8pt; padding: 0;">EIFFAGE Génie Civil - Succursale de Côte d'Ivoire</p>
                <p style="font-size: 8pt; padding: 0;">N° RCCM : CI-ABJ-2017-B-22961 / N° CC : 1739936Z</p>
            </td>
            <td width="50%">
                <table class="numero lignesEspacees">
                    <tr >
                        <td  width="50%" valign="center" align="right">Bon de commande N°</td>
                        <td style="border: 0.3pt solid #000000;" width="50%" valign="center" align="center"> 645654FFFFHG </td>
                    </tr>
                    <tr>
                        <td width="50%" valign="center" align="right" >Date</td>
                        <td valign="center" align="center" style="border: 0.3pt solid #000000;" >{{ \Illuminate\Support\Carbon::now()->formatLocalized('%d %B %Y') }}</td>
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
                        <td width="30%"><b>Merci de libeller votre facture</b></td>
                        <td width="70%"><b>EIFFAGE GENIE CIVIL COTE D'IVOIRE</b>
                            </br>Tour Biao 8ème étage – Le plateau  Avenue Lamblin
                            01 ABIDJAN - BP 5552 ABIDJAN</td>
                    </tr>
                    <tr>
                        <td width="30%"><b>Merci d'envoyer votre facture à</b></td>
                        <td width="70%"><b>EIFFAGE GENIE CIVIL COTE D'IVOIRE</b>
                            <br/>3 éme étage Immeuble SIMO / FIDECA
                            Bd Mamadou Konate - A coté de Foire de Chine
                            01 BP 154 ABIDJAN 01
                        </td>
                    </tr>
                    <tr>
                        <td width="30%"><b>Chantier ou projet :</b></td>
                        <td  width="70%">Réhabilitation du Pont Houphouet Boigny</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>Toute facture doit mentionner impérativement le numéro du Bon de Commande
                            et les numéros IBAN et BIC du compte bancaire du Fournisseur. Toute facture doit être accompagnée des documents suivants :</p>
                            <p>- copie du Bon de Commande dûment signé,</p>
                            <p>- tout document justificatif pour le paiement conformément à la commande</p>
                        </td>
                    </tr>
                </table>
            </td>
            <td width="50%" class="fournisseur" valign="center" align="center">
                SOGELUX
            </td>
        </tr>
    </table>
    <table style="border: 0.3pt solid #000000;">
        <tr style="padding: 0; margin: 0;">
            <td style="font-size: 7pt; text-align: center; padding: 2px; margin: 0;">Toute facture Fournisseurs / Sous-Traitants doit être avec la dénomination : <b style="color: #761c19;">Eiffage Génie Civil - Côte d'Ivoire</b>. <br/>Toute facture ne suivant pas ce principe sera refusée par le service comptable</td>
        </tr>
    </table>
</div>
<main class="page">
    @yield('content')
    @yield('charte')

</main>
<footer>
    <p>Siége Social : EIFFAGE GENIE CIVIL - Campus Pierre Berger - 3 à 7 Place de l'Europe 78140 VELIZY VILLACOUBLAY <br/>
        SA au Capital de 29 388 795 € RCS Versailles 352 745 749 - NAF 4213 A - TVA FR 42 352 745 749<br/>
        VOIR AU VERSO NOS CONDITIONS GENERALES D'ACHAT QUI FONT PARTIE DE LA COMMANDE</p>
</footer>

<main class="" style="font-size:7pt;page-break-inside: avoid;page-break-before: always;">
    @include('BC.charte')
</main>
</body>
</html>