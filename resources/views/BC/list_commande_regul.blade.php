
<div class="alert alert-warning ">
    <span class="alert-icon"><i class="fa fa-bell-o"></i></span>
    <div class="notification-info">
        <ul class="clearfix notification-meta">
            <li class="pull-left notification-sender">{{__('cotation.vous_avez')}}  <b style="font-size: 24px">{{sizeof($receptions)}}</b>  {{__('menu.regularisation_bc')}} {{__('menu.attente_regularisation')}}</li>

        </ul>
        <p>
            ...
        </p>
    </div>
</div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                   {{__('translation.liste')}}
                </div>
                <div  class="table-responsive" STYLE="overflow-x:scroll;">
                    <table class="table table-striped b-t b-light" id="reception_commande">
                        <thead>
                        <tr>
                            <th class="dt-head-center">id</th>
                            <th class="dt-head-center">{{__('menu.fournisseurs')}}</th>
                            <th class="dt-head-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>



                        @foreach($receptions as $recep)
                            <tr>
                                <td>{{$recep->id}}</td>
                                <td>{{$recep->libelle}} ({{$recep->devise}})</td>
                                <td><a href="{{route('detail_regularisation',['locale'=>app()->getLocale(),'id'=>$recep->id,'devise'=>$recep->devise])}}" class="btn btn-info"><i class="fa fa-pencil"></i> {{__('menu.regulariser')}}</a></td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
<br>


<script src="{{ URL::asset('js/jstree.min.js') }}"></script>
<script src="{{ URL::asset('js/jstree.checkbox.js') }}"></script>
<script>
    $(".btn_supp").click(function (){
        var data = table.row($(this).parents('tr')).data();
        var id_bc= $("#id_bc").val();
        $.get("../supprimer_def_da_to_bc/"+data[0]+"/"+id_bc, function(data, status){
            console.log(data);
            window.location.reload()
        });



    });
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
    var table= $('#reception_commande').DataTable({
        language: {
            @if(App()->getLocale()=='fr')
            url: "../public/js/French.json"
            @elseif(App()->getLocale()=='en')
            url: "../public/js/English.json"
            @endif
        },
        "ordering":false,
        "responsive": false,
        "createdRow": function( row, data, dataIndex){

        }
    }).column(0).visible(false);

</script>
