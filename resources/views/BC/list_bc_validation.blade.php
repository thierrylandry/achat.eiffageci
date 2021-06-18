<style>
    .container {
        width: 600px;
        margin: 100px auto; 
    }
    .progressbar {
        counter-reset: step;
    }
    .progressbar li {
        list-style-type: none;
        float: left;
        font-size: 12px;
        position: relative;
        text-align: center;
        text-transform: uppercase;
        color: #7d7d7d;
    }
    .progressbar li:before {
        width: 30px;
        height: 30px;
        content: counter(step);
        counter-increment: step;
        line-height: 30px;
        border: 2px solid #7d7d7d;
        display: block;
        text-align: center;
        margin: 0 auto 10px auto;
        border-radius: 50%;
        background-color: white;
    }
    .progressbar li:after {
        width: 100%;
        height: 2px;
        content: '';
        position: absolute;
        background-color: #7d7d7d;
        top: 15px;
        left: -50%;
        z-index: -1;
    }
    .progressbar li:first-child:after {
        content: none;
    }
    .progressbar li.active {
        color: chartreuse;
        border-color: chartreuse;
        font-weight: bold;
       
    }
    .progressbar li.active:before {
        border-color: chartreuse;
        background-color: chartreuse;
        color: black;
        font-stretch:stretch;
    }
    .progressbar li.active + li:after {
        background-color: chartreuse;
    }</style>
<div class="alert alert-warning ">
    <span class="alert-icon"><i class="fa fa-bell-o"></i></span>
    <div class="notification-info">
        <ul class="clearfix notification-meta">
            <li class="pull-left notification-sender">{{ __('cotation.vous_avez') }}  <b style="font-size: 24px">{{sizeof($bcs_en_attentes)}}</b>  {{ __('cotation.bon_commande_attente_signature') }}</li>

        </ul>
        <p>
            ...
        </p>
    </div>
</div>

<div class="panel-group" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color: #f0bcb4!important;">
            <h4 class="panel-title" style="font-size: 32px; color:white" data-toggle="collapse" data-parent="#accordion" href="#collapse1">

                <a > {{ __('neutrale.bc_en_attente_de_validation') }}</a>
            </h4>
        </div>
        <div id="collapse1" class="panel-collapse collapse in">
            <div class="panel-body">
                <table name ="bonCommandes" id="bonCommandes" class='table table-bordered table-striped  no-wrap '>

                    <thead>

                    <tr>
                        <th class="dt-head-center">id</th>
                        <th class="">{{ __('neutrale.statut') }}</th>
                        <th class="">{{__('neutrale.numero_bc')}}</th>
                        <th class="">{{__('menu.fournisseurs')}}</th>
                        <th class="">{{__('reception.date_livraison')}}</th>
                        <th class="">{{__('gestion_stock.auteur')}}</th>
                        <th class="">{{__('neutrale.expediteur')}}</th>
                        <th class="">{{__('gestion_stock.action')}}</th>

                    </tr>
                    </thead>
                    <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">
                    @foreach($bcs_en_attentes as $bc )
                        <tr>
                            <td>{{$bc->id}}</td>
                            <td>                               @if($bc->etat==1)
                                <i class="fa fa-circle "  style="color:  orange"><p style="visibility: hidden">1</p></i>

                            @elseif($bc->etat==2)
                                <i class="fa fa-circle" style="color: yellow"><p style="visibility: hidden">2</p></i>
                            @elseif($bc->etat==3)
                                <i class="fa fa-circle" style="color: chartreuse"><p style="visibility: hidden">3</p></i>
                            @elseif($bc->etat==4)
                                <a href="" data-toggle="modal" class="">
                                    <i class="fa fa-circle" style="color: green"><p style="visibility: hidden">4</p></i>
                                </a>
                            @elseif($bc->etat==11)
                                <a href="" data-toggle="modal" class="">
                                    <i class="fa fa-circle" style="color: black"><p style="visibility: hidden">11</p></i>
                                </a>

                            @elseif($bc->etat==0)
                                <i class="fa fa-circle" style="color: red"><p style="visibility: hidden">0</p></i>
                            @endif
                            <ul class="progressbar">
                                <?php $i=0; ?>
                               @foreach($validation_flows as $validation_flow)
                        
                               <li @if($bc->validation_step>=$validation_flow->position) class="active" @endif>{{$validation_flow->valideur->abréviation}}</br></li>
                               <?php $i++;?>
                               @endforeach 
                        </ul>
                            </td>
                            <td>{{$bc->numBonCommande}}</td>
                            <td>
                                {{$bc->fournisseur->libelle}} ({{$bc->devise->libelle}})</td>
                            <td>
                                {{$bc->date	}}
                            </td>
                            <td> {{$bc->auteur->nom}} {{$bc->auteur->prenoms}}</td>
                            <td>@if($bc->devise_bc =="XOF") @if($bc->total_ttc!=0){{number_format($bc->total_ttc, 0, ',', ' ')}} @endif  @elseif($bc->devise_bc =="EUR") @if($bc->total_ttc_euro!=0){{number_format($bc->total_ttc_euro, 0, ',', ' ')}}@endif @elseif($bc->devise_bc =="USD") @if($bc->total_ttc_usd!=0){{number_format($bc->total_ttc_usd, 0, ',', ' ')}}@endif  @endif  {{$bc->devise->libelle}}
                            </td>
                            <td>
                                @if($bc->etat==1)


                                    <a href="{{route('lister_commande',['locale'=>app()->getLocale(),'slug'=>$bc->id])}}" data-toggle="modal" class="">
                                        <i class=" fa fa-list "></i> {{__('neutrale.plus_dinfo')}}
                                    </a>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info">{{__('gestion_stock.action')}}</button>
                                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu">

                                            <a href="{{route('valider_commande',['locale'=>app()->getLocale(),'id'=>$bc->slug])}}" data-toggle="modal" class="validercom">
                                                <i class=" fa fa-check-square-o"></i> {{__('neutrale.valider_bon')}}
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a href="{{route('refuser_commande',['locale'=>app()->getLocale(),'id'=>$bc->slug])}}" data-toggle="modal" class="reject">
                                                <i class="fa fa-ban"></i> {{__('neutrale.rejeter_bon')}}
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a href="{{route('supprimer_bc',['locale'=>app()->getLocale(),'slug'=>$bc->slug])}}" data-toggle="modal" class="sup">
                                                <i class=" fa fa-trash"></i>{{__('neutrale.supprimer_bon')}}
                                            </a>
                                            <div class="dropdown-divider"></div>

                                        </div>
                                    </div>

                                @elseif($bc->etat==2)
                                    <a href="{{route('annuler_commande',['locale'=>app()->getLocale(),'id'=>$bc->slug])}}" data-toggle="modal" class="btn btn-default ">
                                        <i class="fa fa-ban"></i> {{__('neutrale.Annuler')}}
                                    </a>
                                    <a href="{{route('bon_commande_file',['locale'=>app()->getLocale(),'id'=>$bc->slug])}}" data-toggle="modal" class="btn btn-default">
                                        <i class="fa fa-file-pdf-o"></i>
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#list_devis" class="btn btn-default preciser_livraison">
                                        <i class="fa fa-list"></i><i class="fa fa-calendar-check-o"></i>
                                    </a>
                                    @if(Auth::user() != null && Auth::user()->hasAnyRole(['Gestionnaire_BC']))
                                        <a href="" data-toggle="modal" data-target="#confirm_email" class="btn btn-default" id="envoie_fourniseur">
                                            <i class="fa fa-file-pdf-o"></i><i class="fa fa-paper-plane-o"></i> envoyer au fournisseur
                                        </a>
                                        <a href="{{route('traite_finalise',['locale'=>app()->getLocale(),'id'=>$bc->slug])}}" data-toggle="modal" class="">
                                            <i class="fa fa-hourglass-end"></i> {{__('neutrale.traiter_finaliser')}}
                                        </a>ou
                                        <a href="{{route('traite_retourne',['locale'=>app()->getLocale(),'id'=>$bc->slug])}}" data-toggle="modal" class="">
                                            <i class="fa fa-arrow-circle-right"></i> {{__('neutrale.traiter_retourner')}}
                                        </a>
                                    @endif

                                @elseif($bc->etat==0)
                                    <a href="{{route('lister_commande',['locale'=>app()->getLocale(),'slug'=>$bc->id])}}" data-toggle="modal" class="">
                                        <i class=" fa fa-list "></i> {{__('neutrale.plus_dinfo')}}
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#list_devis" class="btn btn-default preciser_livraison">
                                        <i class="fa fa-list"></i><i class="fa fa-calendar-check-o"></i>
                                    </a>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info">{{__('gestion_stock.action')}}</button>
                                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu">

                                            <a href="{{route('valider_commande',['locale'=>app()->getLocale(),'id'=>$bc->slug])}}" data-toggle="modal" class="validercom">
                                                <i class=" fa fa-check-square-o"></i> {{__('neutrale.valider_bon')}}
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a href="{{route('supprimer_bc',['locale'=>app()->getLocale(),'slug'=>$bc->slug])}}" data-toggle="modal" class="sup">
                                                <i class=" fa fa-trash"></i>{{__('neutrale.supprimer')}}
                                            </a>
                                            <div class="dropdown-divider"></div>

                                        </div>
                                    </div>
                                    <a href="{{route('annuler_commande',['locale'=>app()->getLocale(),'id'=>$bc->slug])}}" data-toggle="modal" class="btn btn-default ">
                                        <i class="fa fa-ban"></i> {{__('neutrale.annuler')}}
                                    </a>
                                @elseif($bc->etat==3)

                                    <a href="{{route('traite_finalise',['locale'=>app()->getLocale(),'id'=>$bc->slug])}}" data-toggle="modal" class="">
                                        <i class="fa fa-hourglass-end"></i> {{__('neutrale.traiter_finaliser')}}
                                    </a>ou
                                    <a href="{{route('traite_retourne',['locale'=>app()->getLocale(),'id'=>$bc->slug])}}" data-toggle="modal" class="">
                                        <i class="fa fa-arrow-circle-right"></i> {{__('neutrale.traiter_retourner')}}
                                    </a>
                                    <a href="{{route('bon_commande_file',['locale'=>app()->getLocale(),'id'=>$bc->slug])}}" data-toggle="modal" class="btn btn-default">
                                        <i class="fa fa-file-pdf-o"></i>
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#list_devis" class="btn btn-default preciser_livraison">
                                        <i class="fa fa-list"></i><i class="fa fa-calendar-check-o"></i>
                                    </a>
                                    <a href="{{route('annuler_commande',['locale'=>app()->getLocale(),'id'=>$bc->slug])}}" data-toggle="modal" class="btn btn-default ">
                                        <i class="fa fa-ban"></i> {{__('neutrale.annuler')}}
                                    </a>
                                @elseif($bc->etat==4)
                                    <a href="{{route('bon_commande_file',['locale'=>app()->getLocale(),'id'=>$bc->slug])}}" data-toggle="modal" class="btn btn-default">
                                        <i class="fa fa-file-pdf-o"></i>
                                    </a>
                                    <a href="{{route('annuler_commande',['locale'=>app()->getLocale(),'id'=>$bc->slug])}}" data-toggle="modal" class="btn btn-default ">
                                        <i class="fa fa-ban"></i> {{__('neutrale.annuler')}}
                                    </a>
                                    </br>
                                    @if($bc->date_livraison!=null) date de livraison éffective :  {{\Carbon\Carbon::parse($bc->date_livraison)->format('d-m-Y')}} @endif
                                @elseif($bc->etat==11)
                                    <a href="{{route('bon_commande_file',['locale'=>app()->getLocale(),'id'=>$bc->slug])}}" data-toggle="modal" class="btn btn-default">
                                        <i class="fa fa-file-pdf-o"></i>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="{{route('supprimer_bc',['locale'=>app()->getLocale(),'slug'=>$bc->slug])}}" data-toggle="modal" class="sup">
                                        <i class=" fa fa-trash"></i>{{__('neutrale.supprimer')}}
                                    </a>
                                @endif

                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <button class="btn btn-success" id="valider_selectionner"> {{__('cotation.valider_transmettre_la_signature')}}</button>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color: #f0bcb4!important;">
            <h4 class="panel-title" style="font-size: 32px; color:white" data-toggle="collapse" data-parent="#accordion" href="#collapse3">

                <a > {{ __('menu.mes_validation') }}</a>
            </h4>
        </div>
        <div id="collapse3" class="panel-collapse collapse" >
            <div class="panel-body" >
                <table name ="bonCommandes" id="bonCommandes2" class='table table-bordered table-striped  no-wrap '>

                    <thead>

                    <tr>
                        <th class="dt-head-center">id</th>
                        <th class="">{{ __('neutrale.statut') }}</th>
                        <th class="">{{__('neutrale.numero_bc')}}</th>
                        <th class="">{{__('menu.fournisseurs')}}</th>
                        <th class="">{{__('reception.date_livraison')}}</th>
                        <th class="">{{__('gestion_stock.auteur')}}</th>
                        <th class="">{{__('neutrale.expediteur')}}</th>
                        <th class="">{{__('gestion_stock.action')}}</th>

                    </tr>
                    </thead>
                    <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">
                    @foreach($bc_valider_en_attentes as $bc )
                        <tr>
                            <td>{{$bc->id}}</td>
                            <td>                               @if($bc->etat==1)
                                <i class="fa fa-circle "  style="color:  orange"><p style="visibility: hidden">1</p></i>

                            @elseif($bc->etat==2)
                                <i class="fa fa-circle" style="color: yellow"><p style="visibility: hidden">2</p></i>
                            @elseif($bc->etat==3)
                                <i class="fa fa-circle" style="color: chartreuse"><p style="visibility: hidden">3</p></i>
                            @elseif($bc->etat==4)
                                <a href="" data-toggle="modal" class="">
                                    <i class="fa fa-circle" style="color: green"><p style="visibility: hidden">4</p></i>
                                </a>
                            @elseif($bc->etat==11)
                                <a href="" data-toggle="modal" class="">
                                    <i class="fa fa-circle" style="color: black"><p style="visibility: hidden">11</p></i>
                                </a>

                            @elseif($bc->etat==0)
                                <i class="fa fa-circle" style="color: red"><p style="visibility: hidden">0</p></i>
                            @endif
                            <ul class="progressbar">
                                <?php $i=0; ?>
                               @foreach($validation_flows as $validation_flow)
                        
                               <li @if($bc->validation_step>=$validation_flow->position) class="active" @endif>{{$validation_flow->valideur->abréviation}}</br></li>
                               <?php $i++;?>
                               @endforeach 
                        </ul>
                            </td>
                            <td>{{$bc->numBonCommande}}</td>
                            <td>
                                {{$bc->fournisseur->libelle}} ({{$bc->devise->libelle}})</td>
                            <td>
                                {{$bc->date	}}
                            </td>
                            <td> {{$bc->auteur->nom}} {{$bc->auteur->prenoms}}</td>
                            <td>@if($bc->devise_bc =="XOF") @if($bc->total_ttc!=0){{number_format($bc->total_ttc, 0, ',', ' ')}} @endif  @elseif($bc->devise_bc =="EUR") @if($bc->total_ttc_euro!=0){{number_format($bc->total_ttc_euro, 0, ',', ' ')}}@endif @elseif($bc->devise_bc =="USD") @if($bc->total_ttc_usd!=0){{number_format($bc->total_ttc_usd, 0, ',', ' ')}}@endif  @endif  {{$bc->devise->libelle}}
                            </td>
                            <td>
                               
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color: #f0bcb4!important;">
            <h4 class="panel-title" style="font-size: 32px; color:white" data-toggle="collapse" data-parent="#accordion" href="#collapse2">

                <a > {{ __('menu.historique') }}</a>
            </h4>
        </div>
        <div id="collapse2" class="panel-collapse collapse" >
            <div class="panel-body" >
                <table name ="bonCommandes1" id="bonCommandes1" class='table table-bordered table-striped  no-wrap '>

                    <thead>

                    <tr>
                        <th class="dt-head-center">id</th>
                        <th class="">{{ __('neutrale.statut') }}</th>
                        <th class="">{{__('neutrale.numero_bc')}}</th>
                        <th class="">{{__('menu.fournisseurs')}}</th>
                        <th class="">{{__('reception.date_livraison')}}</th>
                        <th class="">{{__('gestion_stock.auteur')}}</th>
                        <th class="">{{__('gestion_stock.action')}}</th>
                    </tr>
                    </thead>
                    <tbody name ="contenu_tableau_entite" id="contenu_tableau_entite">
                    @foreach($bcs as $bc )
                        <tr>
                            <td>{{$bc->id}}</td>
                            <td>                               @if($bc->etat==1)
                                <i class="fa fa-circle "  style="color:  orange"><p style="visibility: hidden">1</p></i>

                            @elseif($bc->etat==2)
                                <i class="fa fa-circle" style="color: yellow"><p style="visibility: hidden">2</p></i>
                            @elseif($bc->etat==3)
                                <i class="fa fa-circle" style="color: chartreuse"><p style="visibility: hidden">3</p></i>
                            @elseif($bc->etat==4)
                                <a href="" data-toggle="modal" class="">
                                    <i class="fa fa-circle" style="color: green"><p style="visibility: hidden">4</p></i>
                                </a>
                            @elseif($bc->etat==11)
                                <a href="" data-toggle="modal" class="">
                                    <i class="fa fa-circle" style="color: black"><p style="visibility: hidden">11</p></i>
                                </a>

                            @elseif($bc->etat==0)
                                <i class="fa fa-circle" style="color: red"><p style="visibility: hidden">0</p></i>
                            @endif

                            </td>
                            <td>{{$bc->numBonCommande}}</td>
                            <td>
                                {{$bc->fournisseur->libelle}} ({{$bc->devise->libelle}})</td>
                            <td>
                                {{$bc->date	}}
                            </td>
                            <td> {{$bc->auteur->nom}} {{$bc->auteur->prenoms}}</td>
                            <td>
                                @if($bc->etat==1)


                                    <a href="{{route('lister_commande',['locale'=>app()->getLocale(),'slug'=>$bc->id])}}" data-toggle="modal" class="">
                                        <i class=" fa fa-list "></i> {{__('neutrale.plus_dinfo')}}
                                    </a>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info">{{__('gest_stock.action')}}</button>
                                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu">

                                            <a href="{{route('valider_commande',['locale'=>app()->getLocale(),'id'=>$bc->slug])}}" data-toggle="modal" class="validercom">
                                                <i class=" fa fa-check-square-o"></i> {{__('neutrale.valider_bon')}}
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a href="{{route('refuser_commande',['locale'=>app()->getLocale(),'id'=>$bc->slug])}}" data-toggle="modal" class="reject">
                                                <i class="fa fa-ban"></i> {{__('neutrale.rejeter_bon')}}
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a href="{{route('supprimer_bc',['locale'=>app()->getLocale(),'slug'=>$bc->slug])}}" data-toggle="modal" class="sup">
                                                <i class=" fa fa-trash"></i>{{__('neutrale.supprimer_bon')}}
                                            </a>
                                            <div class="dropdown-divider"></div>

                                        </div>
                                    </div>

                                @elseif($bc->etat==2)
                                    <a href="{{route('annuler_commande',['locale'=>app()->getLocale(),'id'=>$bc->slug])}}" data-toggle="modal" class="btn btn-default ">
                                        <i class="fa fa-ban"></i> {{__('neutrale.Annuler')}}
                                    </a>
                                    <a href="{{route('bon_commande_file',['locale'=>app()->getLocale(),'id'=>$bc->slug])}}" data-toggle="modal" class="btn btn-default">
                                        <i class="fa fa-file-pdf-o"></i>
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#list_devis" class="btn btn-default preciser_livraison">
                                        <i class="fa fa-list"></i><i class="fa fa-calendar-check-o"></i>
                                    </a>
                                    @if(Auth::user() != null && Auth::user()->hasAnyRole(['Gestionnaire_BC']))
                                        <a href="" data-toggle="modal" data-target="#confirm_email" class="btn btn-default" id="envoie_fourniseur">
                                            <i class="fa fa-file-pdf-o"></i><i class="fa fa-paper-plane-o"></i> envoyer au fournisseur
                                        </a>
                                        <a href="{{route('traite_finalise',['locale'=>app()->getLocale(),'id'=>$bc->slug])}}" data-toggle="modal" class="">
                                            <i class="fa fa-hourglass-end"></i> {{__('neutrale.traiter_finaliser')}}
                                        </a>ou
                                        <a href="{{route('traite_retourne',['locale'=>app()->getLocale(),'id'=>$bc->slug])}}" data-toggle="modal" class="">
                                            <i class="fa fa-arrow-circle-right"></i> {{__('neutrale.traiter_retourner')}}
                                        </a>
                                    @endif

                                @elseif($bc->etat==0)
                                    <a href="{{route('lister_commande',['locale'=>app()->getLocale(),'slug'=>$bc->id])}}" data-toggle="modal" class="">
                                        <i class=" fa fa-list "></i> {{__('neutrale.plus_dinfo')}}
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#list_devis" class="btn btn-default preciser_livraison">
                                        <i class="fa fa-list"></i><i class="fa fa-calendar-check-o"></i>
                                    </a>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info">{{__('gestion_stock.action')}}</button>
                                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu">

                                            <a href="{{route('valider_commande',['locale'=>app()->getLocale(),'id'=>$bc->slug])}}" data-toggle="modal" class="validercom">
                                                <i class=" fa fa-check-square-o"></i> {{__('neutrale.valider_bon')}}
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a href="{{route('supprimer_bc',['locale'=>app()->getLocale(),'slug'=>$bc->slug])}}" data-toggle="modal" class="sup">
                                                <i class=" fa fa-trash"></i>{{__('neutrale.supprimer')}}
                                            </a>
                                            <div class="dropdown-divider"></div>

                                        </div>
                                    </div>
                                    <a href="{{route('annuler_commande',['locale'=>app()->getLocale(),'id'=>$bc->slug])}}" data-toggle="modal" class="btn btn-default ">
                                        <i class="fa fa-ban"></i> {{__('neutrale.annuler')}}
                                    </a>
                                @elseif($bc->etat==3)

                                    <a href="{{route('traite_finalise',['locale'=>app()->getLocale(),'id'=>$bc->slug])}}" data-toggle="modal" class="">
                                        <i class="fa fa-hourglass-end"></i> {{__('neutrale.traiter_finaliser')}}
                                    </a>ou
                                    <a href="{{route('traite_retourne',['locale'=>app()->getLocale(),'id'=>$bc->slug])}}" data-toggle="modal" class="">
                                        <i class="fa fa-arrow-circle-right"></i> {{__('neutrale.traiter_retourner')}}
                                    </a>
                                    <a href="{{route('bon_commande_file',['locale'=>app()->getLocale(),'id'=>$bc->slug])}}" data-toggle="modal" class="btn btn-default">
                                        <i class="fa fa-file-pdf-o"></i>
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#list_devis" class="btn btn-default preciser_livraison">
                                        <i class="fa fa-list"></i><i class="fa fa-calendar-check-o"></i>
                                    </a>
                                    <a href="{{route('annuler_commande',['locale'=>app()->getLocale(),'id'=>$bc->slug])}}" data-toggle="modal" class="btn btn-default ">
                                        <i class="fa fa-ban"></i> {{__('neutrale.annuler')}}
                                    </a>
                                @elseif($bc->etat==4)
                                    <a href="{{route('bon_commande_file',['locale'=>app()->getLocale(),'id'=>$bc->slug])}}" data-toggle="modal" class="btn btn-default">
                                        <i class="fa fa-file-pdf-o"></i>
                                    </a>
                                    <a href="{{route('annuler_commande',['locale'=>app()->getLocale(),'id'=>$bc->slug])}}" data-toggle="modal" class="btn btn-default ">
                                        <i class="fa fa-ban"></i> {{__('neutrale.annuler')}}
                                    </a>
                                    </br>
                                    @if($bc->date_livraison!=null) date de livraison éffective :  {{\Carbon\Carbon::parse($bc->date_livraison)->format('d-m-Y')}} @endif
                                @elseif($bc->etat==11)
                                    <a href="{{route('bon_commande_file',['locale'=>app()->getLocale(),'id'=>$bc->slug])}}" data-toggle="modal" class="btn btn-default">
                                        <i class="fa fa-file-pdf-o"></i>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="{{route('supprimer_bc',['locale'=>app()->getLocale(),'slug'=>$bc->slug])}}" data-toggle="modal" class="sup">
                                        <i class=" fa fa-trash"></i>{{__('neutrale.supprimer')}}
                                    </a>
                                @endif


                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<br>

<script src="{{ URL::asset('js/jstree.min.js') }}"></script>
<script src="{{ URL::asset('js/jstree.checkbox.js') }}"></script>
<script>
    $('#valider_selectionner').click(function (e) {
        var rows_selected = table.column(0).checkboxes.selected();
        console.log(rows_selected);
        var mavariable="";
        $.each(rows_selected, function(index, rowId){
            // Create a hidden element
            console.log(rowId);
            mavariable=mavariable+','+rowId;

        });
if(mavariable==""){
    alert("{{__('translation.selectionner_element')}}");
}else{
        $.get('validation_bc_collective/'+mavariable,function (data) {
                if(data=="success"){
                    location.reload(true);
                }else{
                    alert("Echec de validation");
                }
        })
}
    });
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
        if(confirm('{{__('neutrale.question_valider_bc')}}')){}else{e.preventDefault(); e.returnValue = false; return false; }
    } );
    $('.reject').click( function (e) {
        //   table.row('.selected').remove().draw( false );
        if(confirm('{{__('neutrale.question_rejeter_bc')}}')){}else{e.preventDefault(); e.returnValue = false; return false; }
    } );

    $('.sup').click( function (e) {
        //   table.row('.selected').remove().draw( false );
        if(confirm('{{__('neutrale.question_supprimer_bc')}}')){}else{e.preventDefault(); e.returnValue = false; return false; }
    } );
    var table= $('#bonCommandes').DataTable({
        "columnDefs": [
            {
                'targets': 0,
                'checkboxes': {
                    'selectRow': true
                }
            }
        ],
        "select": {
            'style': 'multi'
        },
        'order': [[0, 'desc']],
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
    });
    var table1= $('#bonCommandes1').DataTable({
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
    
    var table2= $('#bonCommandes2').DataTable({
        "columnDefs": [
            {
                'targets': 0,
                'checkboxes': {
                    'selectRow': true
                }
            }
        ],
        "select": {
            'style': 'multi'
        },
        'order': [[0, 'desc']],
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
    });
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
