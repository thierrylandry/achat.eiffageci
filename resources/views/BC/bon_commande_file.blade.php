<html>

<head>
    <title>Bon de commande</title>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/dataTables.bootstrap4.min.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-select.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}" >
</head>
<body>
<div class="row">
<div class="col-sm-3"></div>
    <div class="col-sm-6">

        <div class="row">
            <div class="col-sm-4">
                <img src="{{ URL::asset('images
            /Eiffage_2400_01_colour_RGB.png') }}" width="100" />
            </div>
            <div class="form-group col-sm-4 col-sm-push-3">
                <label for="email" >Bon de commande N°:</label>
                <input type="text" class="form-control" value="{{$bc->numBonCommande}}"/>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                EIFFAGE Génie Civil - Succursale de Côte d'Ivoire </br>N° RCCM : CI-ABJ-2017-B-22961 / N° CC : 1739936Z
            </div>
            <div class="col-sm-4 col-sm-push-3">
                <div class="form-group">
                    <label for="email">Date :</label>

                    <input type="date" class="form-control" value="{{$bc->date}}"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-5">
                <table border="solid">
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
                <div class="row">
                    <div class="col-sm-10">Toute facture doit mentionner impérativement le numéro du Bon de Commande
                        et les numéros IBAN et BIC du compte bancaire du Fournisseur.</br>
                        Toute facture doit être accompagnée des documents suivants :</br>
                        - copie du Bon de Commande dûment signé,</br>
                        - tout document justificatif pour le paiement conformément à la commande
                    </div>
                </div>
            </div>
            <div class="col-sm-6 " style=" font-size: 80px; atext-align: center; border: solid">
                {{$bc->libelle}}
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12" style="font-size:14px; border:solid; text-align: center">
                <p>  Toute facture Fournisseurs / Sous-Traitants doit être avec la dénomination : <p style="color: red">Eiffage Génie Civil – Côte d’Ivoire.</p>
                Toute facture ne suivant pas ce principe sera refusée par le service comptable.</p>

            </div>
        </div>
        <fieldset class="Votre commande">
            <legend>Votre commande</legend>


            <title> Tableau de commande </title>


            <table border="1" id="TableID" style="width: 350pxpx; ">
                <tr>

                    <th bgcolor="grey" td="" width="15">N°</th><th bgcolor="grey" td="" width="90">DESIGNATION</th><th bgcolor="grey" td="" width="90">CODE ANALYTIQUE</th><th bgcolor="grey" td="" width="75">QUANTITE</th><th bgcolor="grey" td="" width="45">UNITE</th><th bgcolor="grey" td="" width="45">P.U HT</th><th bgcolor="grey" td="" width="45">REMISE %</th><th bgcolor="grey" td="" width="45">TOTAL HT</th>

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
<tfoot>
<tfooter>
    <tr><th colspan="7" style="text-align:right" >Total Hors Taxes en FCFA:</th> <th id="tot"><?=$tothtax?></th> </tr>
    <tr><th colspan="7" style="text-align:right" >TVA</th> <th id="tot"><?=$tva?></th> </tr>
    <tr><th colspan="7" style="text-align:right" >TOTAL TTC EN FCFA</th> <th id="tot"><?=$ttc?></th> </tr>
</tfooter>
</tfoot>
            </table>

        </fieldset>
        <div class="col-sm-6">

            <div class="col-sm-3" style="border: 1px"></div><p align="center">Adresse de livraison<table border="1px" align="center" ><tr><td>Chantier : PONT FELIX HOUPHOUET BOIGNY</td></tr><tr><td>'SITE INSTALATION DU CHANTIER, LAGUNE EBRIE RIVE SUD, TREICHVILLE, AVENUE CHRISTIANI</td></tr></table></p>
            <div class="col-sm-3" style="border: 1px"></div><p align="center"></p>

        </div>
        <div class="col-sm-6">

            <div class="col-sm-8" style="border: solid"><p align="center">Demander(nom/tel):SERVICE ACHAT </br>signature</p></div>
        </div>



    </div>
</div>
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">

            CONDITIONS GENERALES D'ACHAT EIFFAGE GENIE CIVIL
            Les présentes Conditions Générales d'Achat s'appliquent à tout achat de matériels, matériaux et fournitures ainsi qu'à l'exécution de toutes prestations s'y rapportant. Les conditions particulières mentionnées sur la commande prévalent sur les conditions générales d'Achat et s'y substituent. Les parties auxquelles ces conditions sont remises peuvent, en cas de contradiction avec leurs propres CGV, demander l'accord d'EIFFAGE GENIE CIVIL sur des dispositions particulières. Tout début d'exécution des commandes passées par EIFFAGE GENIE CIVIL vaut acceptation des Conditions d'Achat, sauf si des dispositions différentes ont fait à ce moment l'objet d'un accord. En aucun cas les dispositions contraires de Conditions Générales de Vente ou de Prestations de Services ne sauraient prévaloir sur les Conditions d'Achat ou se substituer à elles sans accord exprès et préalable d'EIFFAGE GENIE CIVIL







            1/. OBJET DE LA COMMANDE
            La commande précise les conditions techniques, commerciales et administratives exigées du Fournisseur. Aucune modification de ces conditions ne peut être prise en considération si elle n'a fait l'objet préalablement d'un avenant.

            2/. DELAIS
            Sauf indications contraires mentionnées dans la commande, les délais de livraison sont impératifs et s'entendent matériels, matériaux et fournitures rendus à l'adresse de livraison portée sur la commande.

            3/. DOCUMENTS - PLANS - NOTICES
            Le Fournisseur s'engage à  faire parvenir à l'Acheteur dans les délais prévus dans la commande et en tout état de cause avant la livraison des matériels, matériaux et fournitures : les plans, notices d'entretien, manuels d'opération, catalogues de pièces de rechange nécessaires à l'étude, au montage, à la mise en route et à l'entretien des fournitures;


            4/. PRIX
            Sauf indications contraires mentionnées dans la commande, les prix s'entendent pour des matériels, matériaux et fournitures assurés rendus à l'adresse de livraison portée sur la commande, franco de port et d'emballage, nets de tous droits. Sauf clauses contraires stipulées sur la commande, les prix sont fermes et définitifs et ni actualisables ni révisables. Au cas où la commande comporterait une clause de d'actualisation ou de révision des prix, celle-ci serait déterminée dans la limite des délais contractuels de livraison, conformément à la législation sur les prix et aux dispositions réglementaires en vigueur lors de la livraison. En outre, si des avances ou des acomptes sont versés, les prix seront bloqués définitivement pour la part que ces avances ou ces acomptes concernent.




            5/. SOUS-TRAITANCE PAR LE FOURNISSEUR
            Sous peine de résiliation de plein droit, le Fournisseur ne peut céder ni sous-traiter tout ou partie de la commande sans l'accord exprès et préalable de l'Acheteur, un tel accord n'exonérant pas le Fournisseur de son entière responsabilité. Dans le cas d'une commande portant à la fois sur une marchandise et son transport, l'opération de transport s'effectue sous la responsabilité exclusive du fournisseur. Celui-ci reste, en particulier, garant contre tout recours du transporteur auquel il peut recourir, ou des sous-traitants éventuels de ce transporteur.



            6/. TRANSPORT - LIVRAISON
            Les opérations d'emballage, de chargement et d'arrimage relèvent en tout état de cause de la responsabilité du Fournisseur. Les fournitures voyagent aux frais et risques du Fournisseur, lorsque celui-ci effectue la livraison rendue sur le site réceptionnaire convenu, et, dans les autres cas, lorsqu'une faute de conditionnement, de chargement ou d'arrimage lui est imputable. Toute livraison doit être effectuée aux heures d'ouverture du site réceptionnaire indiqué dans la commande en respectant les règles d'hygiène et de sécurité. Toute livraison pourra être refusée si elle n'est pas accompagnée d'un bon de livraison à l'en-tête du fournisseur rappelant le numéro de la commande, la désignation et la quantité des matériels, matériaux et fournitures livrés ou des prestations réalisées. Il sera établi un bon de livraison distinct pour chaque commande.





            7/. ACCEPTATION
            Le transfert de propriété et le transfert des risques s'effectuent à la livraison de la marchandise, matérialisée par la signature du bon de livraison en ce qui concerne les marchandises acceptées sans réserve. Seules les quantités sont vérifiables à la livraison, le bon signé par le destinataire ne peut engager l'Acheteur sur la conformité de la fourniture livrée. Toute marchandise refusée sera reprise par le Fournisseur, ou lui sera retournée, sur sa demande à ses frais. Le magasinage éventuel sera aux frais, risques et périls du Fournisseur.



            8/. RETOUR - GARANTIE
            L'Acheteur se réserve le droit de retourner au Fournisseur, à ses frais et risques, les matériels, matériaux et fournitures excédentaires par rapport à la commande, même acceptés sur le site réceptionnaire. Sous réserves des dispositions particulières mentionnées dans  la commande, le Fournisseur garantit les matériels, matériaux et fournitures contre tout vice, défectuosité ou non-conformité pouvant affecter tout ou partie de ceux-ci pendant une période de 12 mois commençant à courir à compter de l'acceptation. Pendant la période de garantie, le Fournisseur est tenu de remplacer, à première demande, tout ou partie des matériels, matériaux et fournitures défectueux et d'exécuter toute modification, mise au point ou réparation nécessaire pour que ceux-ci satisfassent aux conditions contractuelles de la commande. Le Fournisseur supportera tous les frais de réparation et de remplacement ainsi que les frais de transport et de déplacement en découlant. Tout élément remplacé ou réparé bénéficiera d'une nouvelle garantie de 12 mois.






            9/. OBLIGATION DE CONSEIL ET DE RESULTAT
            Le Fournisseur, en sa qualité d'homme de l'art, a envers l'Acheteur une obligation de conseil et de résultat. En conséquence, il est tenu de requérir de l'Acheteur toute information utile et nécessaire telle que la destination finale de la fourniture, les conditions éventuellement particulières de stockage, d'utilisation ou d'environnement, les fonctions à assurer, etc, afin de livrer des biens répondant aux besoins de celui-ci et d'émettre en temps utile et par écrit toute réserve en cas d'erreur, d'omission ou d'incompatibilité entre les caractéristiques et/ou les performances de ceux-ci et les lois, règlements, directives, normes ou usages en vigueur et/ou les besoins de l'Acheteur.




            10/. FACTURES
            Les factures doivent être adressées à l'Acheteur à l'adresse figurant sur le bon de commande, en triple exemplaire,et rappeler obligatoirement le numéro de la commande, le numéro de chantier (le cas échéant), la date et le numéro des bons de livraison, la désignation, la quantité et le prix unitaire de chaque produit facturé, son numéro IBAN et le nom de sa banque. Les prix indiqués sont exprimés hors taxes. La TVA devra apparaître séparément. Il sera établi une facture distincte par numéro de commande.


            11/. PENALITES DE RETARD
            Il sera appliqué sur le règlement de toute livraison en retard de plus de 48 heures par rapport au délai prévu dans la commande une pénalité égale à 5 pour mille de la valeur hors taxes de la commande, ou partie de la commande non livrée, par jour, à compter du premier jour de retard, jusqu'au jour de la livraison effective.

            12/. ASSURANCES
            Le Fournisseur devra souscrire auprès de compagnies notoirement solvables, toutes assurances nécessaires pour couvrir sa responsabilité.
            13/. RESILIATION
            Dans l'éventualité où le Fournisseur refuserait ou serait incapable de remplir ses obligations contractuelles conformément aux conditions de la commande, notamment en cas de retard de plus de 72 heures, l'Acheteur se réserve la faculté de résilier de plein droit, par lettre recommandée avec accusé de réception, tout ou partie de ladite commande. La mise en œuvre de la résiliation ne préjudicie pas des pénalités, remboursements et/ou dommages-intérêts que l'Acheteur serait fondé à réclamer notamment du fait de la non-exécution de la commande.



            14/. PROPRIETE INDUSTRIELLE / INTELLECTUELLE
            Aucune clause de réserve de propriété ne saurait être opposée par le Fournisseur si elle n'est pas acceptée par un représentant habilité de l'Acheteur. Le Fournisseur garantit également l'Acheteur contre toute revendication des tiers en matière de propriété industrielle et/ou intellectuelle pour les matériaux, matériels ou fournitures livrés et s'engage à ce que ceux-ci ne soient grevés d'aucune réserve de propriété à l'égard de tout tiers. Le Fournisseur se substituera à l'Acheteur en cas de contestation faite à ce titre.



            15/. CONFIDENTIALITE
            Le Fournisseur s'engage à garder strictement confidentielles les informations de toute nature reçues pas lui dans le cadre de l'exécution de la commande.
            16/. QUALITE - SECURITE - ENVIRONNEMENT - LOIS SOCIALES
            Le Fournisseur s'engage à communiquer à l'Acheteur toute fiche technique ou prescription réglementaire (prescriptions de mise en œuvre, qualifications NF ou CE, fiches données sécurité, fiche données environnement) nécessaires à la bonne utilisation du produit. Dans le cas où le Fournisseur possède un système de management de la qualité (SMQ) ou environnemental (SME), ce dernier tiendra à la disposition de l'acheteur les preuves de conformité du produit (contrôles internes, contrôles externes,…).Dans l'exécution directe ou indirecte des prestations qui lui sont confiées, le Fournisseur s'engage à respecter la réglementation liée à la responsabilité sociale, notamment dans le domaine du travail des enfants ou du travail clandestin.




            17/. CONTESTATION - ATTRIBUTION DE COMPETENCE - LOI APPLICABLE
            En cas de contestation relative à la présente commande, les litiges seront de la compétence exclusive du Tribunal de Commerce du lieu du siège social de l'Acheteur comme indiqué dans la commande. La loi applicable est la loi française.


      </div>
    </div>
<script>
    function lisibilite_nombre(nbr)

    {

        var nombre = ''+nbr;

        var retour = '';

        var count=0;

        for(var i=nombre.length-1 ; i>=0 ; i--)

        {

            if(count!=0 && count % 3 == 0)

                retour = nombre[i]+' '+retour ;

            else

                retour = nombre[i]+retour ;

            count++;

        }

        //          alert('nb : '+nbr+' => '+retour);

        return retour;

    }

    function ilisibilite_nombre(valeur){

        for(var i=valeur.length-1; i>=0; i-- ){valeur=valeur.toString().replace(' ','');

        }

        return valeur;

    }
</script>
</body>
</html>

