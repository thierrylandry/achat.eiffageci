(function($) {
$('#btnconfirmerda').confirm({

    title: 'Confirmation!',
    content:'Vous êtes sur le point de confirmer la demande',
    buttons: {
        oui: function (e) {
            $lien=window.location.href;
            alert($lien);

            window.location.href=$lien;

        },
        non: function () {
            $.alert('Retour!');
        }

    }
});
    $('#btnconfirmerda1').confirm({

        title: 'Confirmation!',
        content:'Vous êtes sur le point revoquer la demande',
        buttons: {
            oui: function (e) {
                $lien=window.location.href;
                alert($lien);

                window.location.href=$lien;

            },
            non: function () {
                $.alert('Retour!');
            }

        }
    });
})(jQuery);