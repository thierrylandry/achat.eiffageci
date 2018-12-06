


<table name ="bonCommandes" id="bonCommandes" class='table table-bordered table-striped  no-wrap '>

    <thead>

    <tr>
        <th class="dt-head-center">id</th>
        <th class="">status</th>
        <th class="">N°B.C</th>
        <th class="">Date</th>
        <th class="">Auteur</th>
        <th class="">Action</th>

    </tr>
    </thead>
    <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">
    @foreach($bcs as $bc )
        <tr>
            <td>{{$bc->id}}</td>
            <td>                        @if($bc->etat==1)
                    <i class="fa fa-circle "  style="color: #f0ad4e"><p style="visibility: hidden">1</p></i>

                @elseif($bc->etat==2)
                    <i class="fa fa-circle" style="color: mediumspringgreen"><p style="visibility: hidden">2</p></i>
                @elseif($bc->etat==3)
                    <i class="fa fa-circle" style="color: black"><p style="visibility: hidden">3</p></i>
                @elseif($bc->etat==0)
                    <i class="fa fa-circle" style="color: red"><p style="visibility: hidden">0</p></i>
                @endif

            </td>
            <td>{{$bc->numBonCommande}}</td>
            <td>
                {{$bc->date	}}
   </td>
            <td>@foreach($utilisateurs as $utilisateur)
                 @if($utilisateur->id==$bc->id_user)
                    {{$utilisateur->name}}
                @endif
            @endforeach</td>
            <td>
               @if($bc->etat==1)
                <a href="{{route('valider_commande',['id'=>$bc->slug])}}" data-toggle="modal" class="">
                    <i class=" fa fa-check-square-o"></i> Valider le bon
                </a>
                   @elseif($bc->etat==2)
                    <a href="{{route('annuler_commande',['id'=>$bc->slug])}}" data-toggle="modal" class="btn btn-default ">
                        <i class="fa fa-ban"></i> Annuler
                    </a>
                    <a href="{{route('bon_commande_file',['id'=>$bc->slug])}}" data-toggle="modal" class="btn btn-default">
                        <i class="fa fa-file-pdf-o"></i>
                    </a>
                    <a href="{{route('send_it',['id'=>$bc->slug])}}" data-toggle="modal" class="btn btn-default">
                        <i class="fa fa-file-pdf-o"></i><i class="fa fa-paper-plane-o"></i> envoyer au fournisseur
                    </a>
                   @elseif($bc->etat==0)
                    <a href="{{route('valider_commande',['id'=>$bc->slug])}}" data-toggle="modal" class="">
                        <i class=" fa fa-check-square-o"></i> Valider le bon
                    </a>
                    <div class="btn-group">
                        <button type="button" class="btn btn-info">Action</button>
                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                            <a href="{{route('ajouter_ligne_bc',['slug'=>$bc->slug])}}" data-toggle="modal" class=" ">
                                <i class=" fa fa-plus-circle"></i>Ajouter une ligne
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{route('lister_commande',['slug'=>$bc->id])}}" data-toggle="modal" class="">
                                <i class=" fa fa-list "></i>Liste les commandes
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{route('voir_bc',['slug'=>$bc->slug])}}" data-toggle="modal" class=" ">
                                <i class=" fa fa-pencil"></i>Modifier
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{route('supprimer_bc',['slug'=>$bc->slug])}}" data-toggle="modal" class="">
                                <i class=" fa fa-trash"></i>Supprimer
                            </a>
                            <div class="dropdown-divider"></div>

                        </div>
                    </div>
                @elseif($bc->etat==3)
                    <a href="" data-toggle="modal" class="">
                        <i class="fa fa-hourglass-end"></i> Terminer
                    </a>
                    <a href="{{route('bon_commande_file',['id'=>$bc->slug])}}" data-toggle="modal" class="btn btn-default">
                        <i class="fa fa-file-pdf-o"></i>
                    </a>
                @endif
                   @if($bc->etat==1)
                <div class="btn-group">
                    <button type="button" class="btn btn-info">Action</button>
                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu">
                        <a href="{{route('ajouter_ligne_bc',['slug'=>$bc->slug])}}" data-toggle="modal" class=" ">
                            <i class=" fa fa-plus-circle"></i>Ajouter une ligne
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{route('lister_commande',['slug'=>$bc->id])}}" data-toggle="modal" class="">
                            <i class=" fa fa-list "></i>Liste les commandes
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{route('voir_bc',['slug'=>$bc->slug])}}" data-toggle="modal" class=" ">
                            <i class=" fa fa-pencil"></i>Modifier
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{route('supprimer_bc',['slug'=>$bc->slug])}}" data-toggle="modal" class="">
                            <i class=" fa fa-trash"></i>Supprimer
                        </a>
                        <div class="dropdown-divider"></div>

                    </div>
                </div>
                       <a href="{{route('refuser_commande',['id'=>$bc->slug])}}" data-toggle="modal" class="">
                           <i class="fa fa-ban"></i> Rejeter le bon
                       </a>
                       @endif
            </td>

        </tr>
    @endforeach
    </tbody>
</table>

<script>

    var table= $('#bonCommandes').DataTable({
        language: {
            url: "js/French.json"
        },
        "ordering":true,
        "responsive": true,
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