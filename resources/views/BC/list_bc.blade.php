


<table name ="bonCommandes" id="bonCommandes" class='table table-bordered table-striped  no-wrap '>

    <thead>

    <tr>
        <th class="dt-head-center">id</th>
        <th class="dt-head-center">N°B.C</th>
        <th class="dt-head-center">Date</th>
        <th class="dt-head-center">Action</th>

    </tr>
    </thead>
    <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">
    @foreach($bcs as $bc )
        <tr>
            <td>{{$bc->id}}</td>
            <td>{{$bc->numBonCommande}}</td>
            <td>
                {{$bc->created_at	}}
   </td>
            <td> <a href="{{route('voir_produit',['slug'=>$bc->slug])}}" data-toggle="modal" class="btn btn-info col-sm-4 pull-right">
                    <i class=" fa fa-pencil"></i>
                </a>
                <a href="{{route('supprimer_produit',['slug'=>$bc->slug])}}" data-toggle="modal" class="btn btn-danger col-sm-4 pull-right">
                    <i class=" fa fa-trash"></i>
                </a>
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

        alert(tableID);
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