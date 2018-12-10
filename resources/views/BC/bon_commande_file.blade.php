<html>
<head>
    <title>Bon de commande</title>
    <style>
        .table1, .th1, .td1 {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body style="font-size: 12px">
<table class="table1">
    <tr>
        <td><img src="http://localhost:8080/achat.eiffageci/public/images/Eiffage_2400_01_colour_RGB.png1" width="100px" /> </td>
        <td><label for="email" >Bon de commande N°:</label>
            <input type="text" class="form-control" value="{{$bc->numBonCommande}}"/></td>

    </tr>
    <tr>
        <td>EIFFAGE Génie Civil - Succursale de Côte d'Ivoire</br>N° RCCM : CI-ABJ-2017-B-22961 / N° CC : 1739936Z</td>
        <td>
            <label for="email">Date :</label>

            <input type="date" class="form-control" value="{{$bc->date}}"/>
        </td>

    </tr>
    <tr>
        <td>

            <table border="1">
                <tr>
                    <td>Merci de libeller votre facture</td>
                    <td>EIFFAGE GENIE CIVIL COTE D'IVOIRE</br>
                        Tour Biao 8ème étage – Le plateau  Avenue Lamblin</br>
                        01 ABIDJAN - BP 5552 ABIDJAN</td>
                </tr>
                <tr>
                    <td>Merci d'envoyer votre facture à</td>
                    <td>EIFFAGE GENIE CIVIL COTE D'IVOIRE</br>
                        3 éme étage Immeuble SIMO / FIDECA</br>
                        Bd Mamadou Konate - A coté de Foire de Chine</br>
                        01 BP 154 ABIDJAN 01
                    </td>
                </tr>
            </table>
            Toute facture doit mentionner impérativement le numéro du Bon de Commande
            </br>et les numéros IBAN et BIC du compte bancaire du Fournisseur.</br>
            Toute facture doit être accompagnée des documents suivants :</br>
            - copie du Bon de Commande dûment signé,</br>
            - tout document justificatif pour le paiement conformément à la commande
        </td>
        <td style="border: #2a2727">
            <div class="" style=" font-size: 80px; atext-align: center; border: solid">
                {{$bc->libelle}}
            </div>
        </td>
    </tr>
    <tr>
        <td></td>
        <td > <div style="font-size:14px; border:1px ;">
                <p>  Toute facture Fournisseurs / Sous-Traitants doit être avec la dénomination : <b style="color: red">Eiffage Génie Civil – Côte d’Ivoire.</b></br>
                    Toute facture ne suivant pas ce principe sera refusée par le service comptable.</p>

            </div></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="2">
            <table border="1" style="border-collapse: collapse;">
                <thead>
                <tr >

                    <th class="th1">N°</th><th class="th1">DESIGNATION</th><th  td=""  class="th1">CODE ANALYTIQUE</th><th  td=""  class="th1">QUANTITE</th><th  td="" class="th1">UNITE</th><th  td=""  class="th1">P.U HT</th><th  td=""  class="th1">REMISE %</th><th  td=""  class="th1">TOTAL HT</th>

                </tr>
                </thead>
                <tbody>
                <?php

                $i=1;
                $tothtax=0;
                $tva=0;
                $ttc=0;
                foreach($ligne_bcs as $ligne_bc):
                    $tothtax=$tothtax+ intval(str_replace(" ","",$ligne_bc->prix_tot));
                    echo "<tr><td>$i</td><td>$ligne_bc->titre_ext</td><td>".$ligne_bc->codeRubrique."</td><td>".$ligne_bc->quantite_ligne_bc."</td><td>".$ligne_bc->unite_ligne_bc."</td><td>".$ligne_bc->prix_unitaire_ligne_bc."</td><td>".$ligne_bc->remise_ligne_bc."</td><td>".$ligne_bc->prix_tot."</td></tr>";
                    $i++;
                endforeach;
                $tva=($tothtax*18)/100;
                $ttc=$tothtax-$tva;
                ?>
                </tbody>
                <tfoot>
                <tr><th colspan="2">
                        <p align="center">Adresse de livraison
                        <table>
                            <tr><td>Chantier : PONT FELIX HOUPHOUET BOIGNY</td></tr>
                            <tr><td>'SITE INSTALATION DU CHANTIER, LAGUNE EBRIE RIVE SUD, TREICHVILLE, AVENUE CHRISTIANI</td></tr>
                        </table></p>
                        <p>date et modalité de livraisdon, {{$bc->date}}</p>





                    </th>
                    <th colspan="6">
                        <table  border="1" width="400px"><tr><th  style="text-align:right">Total Hors Taxes en FCFA:</th> <th id="tot" colspan="2"><?=$tothtax?></th> </tr>
                            <tr><th  style="text-align:right" >TVA</th> <th id="tot" colspan="4"><?=$tva?></th> </tr>
                            <tr><th  style="text-align:right" >TOTAL TTC EN FCFA</th> <th id="tot" colspan="4"><?=$ttc?></th> </tr>
                            <tr><th  style="text-align:left">Demandeur :(Nom/Téléphone)</th> <th colspan="4" style="text-align:center"  id="tot">SERVICE MATERIEL</th> </tr>
                            <tr><th  style="text-align:right"  height="200px" ><table><tr><td>signature</td></tr><tr><td>Nom du Signataire Habilité :</td><td>NICOLAS DESCAMPS</td></tr></table></th> </tr></table>


                    </th></tr>

                </tfoot>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="8" align="center">Siége Social : EIFFAGE GENIE CIVIL - Campus Pierre Berger - 3 à 7 Place de l'Europe 78140 VELIZY VILLACOUBLAY
            SA au Capital de 29 388 795 € RCS Versailles 352 745 749 - NAF 4213 A - TVA FR 42 352 745 749
            VOIR AU VERSO NOS CONDITIONS GENERALES D'ACHAT QUI FONT PARTIE DE LA COMMANDE</td>
    </tr>
</table>

</body>
</html>