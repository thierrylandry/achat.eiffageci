
<div class="alert alert-warning ">
    <span class="alert-icon"><i class="fa fa-bell-o"></i></span>
    <div class="notification-info">
        <ul class="clearfix notification-meta">
            <li class="pull-left notification-sender">Vous avez  <b style="font-size: 24px">{{sizeof($fournisseurs)}}</b>  Bon de commande(s)en attente de création</li>

        </ul>
        <p>
            ...
        </p>
    </div>
</div>
<br>
<table name ="bonCommandes" id="bonCommandes" class='table table-bordered table-striped  no-wrap '>

    <thead>

    <tr>
        <th class="dt-head-center">id</th>
        <th class="">status</th>
        <th class="">N°B.C</th>
        <th class="">Fournisseur</th>
        <th class="">Date Livraison</th>
        <th class="">Auteur</th>
        <th class="">Action</th>

    </tr>
    </thead>
    <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">
    @foreach($bcs as $bc )
        <tr>
            <td>{{$bc->id}}</td>
            <td>                        @if($bc->etat==1)
                    <i class="fa fa-circle "  style="color:  red"><p style="visibility: hidden">1</p></i>

                @elseif($bc->etat==2)
                    <i class="fa fa-circle" style="color: mediumspringgreen"><p style="visibility: hidden">2</p></i>
                @elseif($bc->etat==3)
                    <i class="fa fa-circle" style="color: #f0ad4e"><p style="visibility: hidden">3</p></i>
                @elseif($bc->etat==4)
                 <a href="" data-toggle="modal" class="">
                     <i class="fa fa-circle" style="color: #00ffff"><p style="visibility: hidden">4</p></i>
                    </a>
                @elseif($bc->etat==11)
                    <a href="" data-toggle="modal" class="">
                        <i class="fa fa-circle" style="color: violet"><p style="visibility: hidden">11</p></i>
                    </a>

                @elseif($bc->etat==0)
                    <i class="fa fa-circle" style="color: black"><p style="visibility: hidden">0</p></i>
                @endif

            </td>
            <td>{{$bc->numBonCommande}}</td>
            <td>
                @foreach($fournisseurs as $fournisseur)
                    @if($fournisseur->id==$bc->id_fournisseur)
                        {{$fournisseur->libelle}}
                    @endif

            @endforeach</td>
            <td>
                {{$bc->date	}}
   </td>
            <td>@foreach($utilisateurs as $utilisateur)
                 @if($utilisateur->id==$bc->id_user)
                    {{$utilisateur->nom}}
                @endif
            @endforeach</td>
            <td>
               @if($bc->etat==1)


                    <a href="{{route('lister_commande',['slug'=>$bc->id])}}" data-toggle="modal" class="">
                        <i class=" fa fa-list "></i> plus d'info
                    </a>
                        <div class="btn-group">
                            <button type="button" class="btn btn-info">Action</button>
                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">

                                <a href="{{route('valider_commande',['id'=>$bc->slug])}}" data-toggle="modal" class="validercom">
                                    <i class=" fa fa-check-square-o"></i> Valider le bon
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="{{route('refuser_commande',['id'=>$bc->slug])}}" data-toggle="modal" class="reject">
                                    <i class="fa fa-ban"></i> Rejeter le bon
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="{{route('supprimer_bc',['slug'=>$bc->slug])}}" data-toggle="modal" class="sup">
                                    <i class=" fa fa-trash"></i>Supprimer
                                </a>
                                <div class="dropdown-divider"></div>

                            </div>
                        </div>

                   @elseif($bc->etat==2)
                    <a href="{{route('annuler_commande',['id'=>$bc->slug])}}" data-toggle="modal" class="btn btn-default ">
                        <i class="fa fa-ban"></i> Annuler
                    </a>
                    <a href="{{route('bon_commande_file',['id'=>$bc->slug])}}" data-toggle="modal" class="btn btn-default">
                        <i class="fa fa-file-pdf-o"></i>
                    </a>
                    <a href="" data-toggle="modal" data-target="#confirm_email" class="btn btn-default" id="envoie_fourniseur">
                        <i class="fa fa-file-pdf-o"></i><i class="fa fa-paper-plane-o"></i> envoyer au fournisseur
                    </a>
                   @elseif($bc->etat==0)
                    <a href="{{route('lister_commande',['slug'=>$bc->id])}}" data-toggle="modal" class="">
                        <i class=" fa fa-list "></i> plus d'info
                    </a>
                    <div class="btn-group">
                        <button type="button" class="btn btn-info">Action</button>
                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">

                            <a href="{{route('valider_commande',['id'=>$bc->slug])}}" data-toggle="modal" class="validercom">
                                <i class=" fa fa-check-square-o"></i> Valider le bon
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{route('supprimer_bc',['slug'=>$bc->slug])}}" data-toggle="modal" class="sup">
                                <i class=" fa fa-trash"></i>Supprimer
                            </a>
                            <div class="dropdown-divider"></div>

                        </div>
                    </div>
                @elseif($bc->etat==3)
                    <a href="{{route('traite_finalise',['id'=>$bc->slug])}}" data-toggle="modal" class="">
                        <i class="fa fa-hourglass-end"></i> traité et finalisé?
                    </a>ou
                    <a href="{{route('traite_retourne',['id'=>$bc->slug])}}" data-toggle="modal" class="">
                        <i class="fa fa-arrow-circle-right"></i> traité et retourné?
                    </a>
                    <a href="{{route('bon_commande_file',['id'=>$bc->slug])}}" data-toggle="modal" class="btn btn-default">
                        <i class="fa fa-file-pdf-o"></i>
                    </a>
                @elseif($bc->etat==4)
                    <a href="{{route('bon_commande_file',['id'=>$bc->slug])}}" data-toggle="modal" class="btn btn-default">
                        <i class="fa fa-file-pdf-o"></i>
                    </a>
                @elseif($bc->etat==11)
                    <a href="{{route('bon_commande_file',['id'=>$bc->slug])}}" data-toggle="modal" class="btn btn-default">
                        <i class="fa fa-file-pdf-o"></i>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{route('supprimer_bc',['slug'=>$bc->slug])}}" data-toggle="modal" class="sup">
                        <i class=" fa fa-trash"></i>Supprimer
                    </a>
                @endif

            </td>

        </tr>
    @endforeach
    </tbody>
</table>

<script src="{{ URL::asset('js/jstree.min.js') }}"></script>
<script src="{{ URL::asset('js/jstree.checkbox.js') }}"></script>
<script>
    selection= Array();
    $('#jstree').jstree({
        "core" : {
            "themes" : {
                "variant" : "large"
            }
        },
        "checkbox" : {
            "keep_selected_style" : false
        },
        "plugins" : [ "wholerow", "checkbox" ]
    });
    $('#jstree').on("changed.jstree", function (e,data){

        selection=$('#jstree').jstree(true).get_bottom_selected(true);

        valeur="";
        $.each(selection,function (index, value) {
            if (value != null)
                valeur=valeur+ ','+value.id;
        });
        $('#fournisseur').val(valeur);

        console.log(selection);

    })

</script>
<script>
    $('.validercom').click( function (e) {
        //   table.row('.selected').remove().draw( false );
        if(confirm('Voulez vous valide le Bon de commande ?')){}else{e.preventDefault(); e.returnValue = false; return false; }
    } );
    $('.reject').click( function (e) {
        //   table.row('.selected').remove().draw( false );
        if(confirm('Voulez vous rejeter Bon de commande ?')){}else{e.preventDefault(); e.returnValue = false; return false; }
    } );

    $('.sup').click( function (e) {
        //   table.row('.selected').remove().draw( false );
        if(confirm('Voulez vous supprimer Bon de commande ?')){}else{e.preventDefault(); e.returnValue = false; return false; }
    } );
    var table= $('#bonCommandes').DataTable({
        language: {
            url: "js/French.json"
        },
        "ordering":false,
        "responsive": false,
        "createdRow": function( row, data, dataIndex){

        }
    }).column(0).visible(false);
    //table.DataTable().draw();
    function addRow(tableID) {

        var table = document.getElementById(tableID);

        var rowCount = table.rows.length;
        var row = table.insertRow(rowCount);

        var colCount = table.rows[0].cells.length;

        for(var i=0; i<colCount; i++) {

            var newcell = row.insertCell(i);

            newcell.innerHTML = table.rows[1].cells[i].innerHTML;
            //alert(newcell.childNodes);
            switch(newcell.childNodes[0].type) {
                case "text":
                    newcell.childNodes[0].value = "";
                    break;
                case "checkbox":
                    newcell.childNodes[0].checked = false;
                    break;
                case "select-one":
                    newcell.childNodes[0].selectedIndex = 0;
                    break;
            }
        }
    }

    function deleteRow(tableID) {
        try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;

            for(var i=0; i<rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if(null != chkbox && true == chkbox.checked) {
                    if(rowCount <= 2) {
                        addRow(tableID);
                        // alert("Attention la 1ère ligne n'est pas supprimable. La quantité est initialisée à 0");
                        //  break;
                    }
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }


            }
        }catch(e) {
            alert(e);
        }
    }

    function testValue(selection) {
        if (selection.value == "Dawn") {
            // do something
        }
        else if (selection.value == "Noon") {
            // do something
        }
        else if (selection.value == "Dusk") {
            // do something
        }
        else {
            // do something
        }
    }

</script>