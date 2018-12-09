<html>
<head>
    <title>Bon de commande</title>
</head>
<body style="font-size: 10px">
<table>
    <tr>
        <td> </td>
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
        <td align="center"> <div style="font-size:14px; border:solid; width: 80%">
                <p>  Toute facture Fournisseurs / Sous-Traitants doit être avec la dénomination : <b style="color: red">Eiffage Génie Civil – Côte d’Ivoire.</b></br>
                    Toute facture ne suivant pas ce principe sera refusée par le service comptable.</p>

            </div></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="2">
            <table style="border-top: #000000 1px solid;border-right: #000000 1px solid;border-left: #000000 1px solid;border-bottom: #000000 1px solid;">
                <tr >

                    <th>N°</th><th>DESIGNATION</th><th  td="" width="90">CODE ANALYTIQUE</th><th  td="" width="75">QUANTITE</th><th  td="" width="45">UNITE</th><th  td="" width="45">P.U HT</th><th  td="" width="45">REMISE %</th><th  td="" width="45">TOTAL HT</th>

                </tr>


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

                <tr><th rowspan="6" colspan="2">
                        <p align="center">Adresse de livraison
                        <table border="1px" align="center"  style="margin: 0px;" >
                            <tr><td>Chantier : PONT FELIX HOUPHOUET BOIGNY</td></tr>
                            <tr><td>'SITE INSTALATION DU CHANTIER, LAGUNE EBRIE RIVE SUD, TREICHVILLE, AVENUE CHRISTIANI</td></tr>
                        </table></p>
                        <p>date et modalité de livraisdon, {{$bc->date}}</p>




                    </th></tr>
                <tr><th colspan="5" style="text-align:right" >Total Hors Taxes en FCFA:</th> <th id="tot"><?=$tothtax?></th> </tr>
                <tr><th colspan="5" style="text-align:right" >TVA</th> <th id="tot"><?=$tva?></th> </tr>
                <tr><th colspan="5" style="text-align:right" >TOTAL TTC EN FCFA</th> <th id="tot"><?=$ttc?></th> </tr>
                <tr><th colspan="2" style="text-align:left">Demandeur :(Nom/Téléphone)</th> <th colspan="4" style="text-align:center"  id="tot">SERVICE MATERIEL</th> </tr>
                <tr><th colspan="6" style="text-align:right" ><table width="100%"><tr><td>signature</td></tr><tr><td>Nom du Signataire Habilité :</td><td>NICOLAS DESCAMPS</td></tr></table></th> </tr>

                <tr><td colspan="8" align="center">Siége Social : EIFFAGE GENIE CIVIL - Campus Pierre Berger - 3 à 7 Place de l'Europe 78140 VELIZY VILLACOUBLAY
                        SA au Capital de 29 388 795 € RCS Versailles 352 745 749 - NAF 4213 A - TVA FR 42 352 745 749
                        VOIR AU VERSO NOS CONDITIONS GENERALES D'ACHAT QUI FONT PARTIE DE LA COMMANDE</td>
                </tr>
            </table>
        </td>
    </tr>
</table>

</body>
</html>