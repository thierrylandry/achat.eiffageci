$(function(){
 Notification.requestPermission();
    function spawnNotification(body, icon, title) {
        var options = {
            body: body,
            icon: icon
        };
        var n = new Notification(title, options);
    }

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
    function les_notification() {
        $tab_role= Array();



        setTimeout(function () {
            $.get("mettre_ajour/",
                function (data){
                    $.each(data['roles'],function(index,value){
                        $tab_role.push(value.name);
                    });
                    /*
                     $data[]=$daencours;
                     $data[]=$das;
                     $data[]=$Boncommandeencours;
                     $data[]=$Boncommandes;
                     $data[]=$montant_bc;
                     $data[]=$montant_bct;*/


/*

                    if ($.inArray("Gestionnaire_DA", $tab_role)) {

                        if($('#da1').val()<data[0]) {

                            spawnNotification("Une demande d'approvisionnement en attente de validation", data['icon'], 'PROCACHAT');
                        }
                    }
                    if ($.inArray("Valideur_DA", $tab_role)) {
                        if($('#da1').val()<data[0]) {
                            spawnNotification("Une demande d'approvisionnement en attente de validation", data['icon'], 'PROCACHAT');
                        }
                    }
                    if ($.inArray("Gestionnaire_BC", $tab_role)) {
                        if($('#bc1').val()<data[0]) {
                            spawnNotification("Un bon de commande en attente de confirmation", data['icon'], 'PROCACHAT');
                        }

                    }
                    if ($.inArray("Valideur_BC", $tab_role)) {
                        if($('#bc1').val()<data[0]) {
                            spawnNotification("Un bon de commande en attente de confirmation", data['icon'], 'PROCACHAT');
                        }
                    }
*/
                    $('#daencours').empty();
                    $('#daencours').append(data[0]+"/"+data[1]);
                    $('#Boncommandeencours').empty();
                    $('#Boncommandeencours').append(data[2]+"/"+data[3]);
                    $('#montant_bc').empty();
                    $('#montant_bc').append(lisibilite_nombre(data[4])+" Fr CFA");
                    $('#montant_bct').empty();
                    $('#montant_bct').append(lisibilite_nombre(data[5])+" Fr CFA");

                    $('#da').empty();
                    $('#da').append(data[0]);
                    $('#da1').empty();
                    $('#da1').val(data[0]);

                    $('#bc').empty();
                    $('#bc').append(data[2]);

                    $('#bc1').empty();
                    $('#bc1').val(data[2]);


                }
            );
        }, 15000);
      //  les_notification();
    }
   // les_notification();

});