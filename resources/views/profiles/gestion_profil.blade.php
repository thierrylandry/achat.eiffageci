
@extends('layouts.app')
@section('profils')
    class='active'
@endsection
@section('parent_fournisseurs')
    class='active'
@endsection
@section('content')
    <h2>LES PROFILS - {{isset($profil)? 'Modifier  profil':'Ajouter profil'}}</h2>
    <div class="row">
                <div class="col-sm-4" >
@if(isset($profil))

                            <form  role="form" id="FormRegister" class="bucket-form" method="post" action="{{route('modifier_profil')}}">
    @else
                                    <form role="form" id="FormRegister" class="bucket-form" method="post" action="{{route('Validprofils')}}">
    @endif
                                        <div style="overflow-y:scroll; max-height: 400px; min-height: 400px">
                                        <div class="form-group">
                                            <label> LIBELLE DU PROFIL</label>
                                <input  placeholder="LIBELLE DU PROFIL" class="form-control col-sm-4" id="libelleProfil" name="libelleProfil" value="{{isset($profil)? $profil->libelleProfil:''}}"/>
                                            <input type="hidden" name="description" id="description" value="{{isset($profil)? $profil->descriptionProfil:''}}" />
                                            @csrf
                                            </div>
                                        <div id="jstree" >
                                            <ul>
                                                <li id="8000">LA GESTION DES PROFILES
                                                    <ul>
                                                        <li id="8000C">CREATION</li>
                                                        <li id="8000T"><a href="#">CONSULTATION</a></li>
                                                        <li  id="8000M"><a href="#">MODIFICATION</a></li>
                                                        <li  id="8000S"><a href="#">SUPPRESSION</a></li>
                                                    </ul>
                                                </li>
                                                <li id="1000">LA GESTION DES UTILISATEURS
                                                    <ul>
                                                        <li id="1000C">CREATION</li>
                                                        <li id="1000T"><a href="#">CONSULTATION</a></li>
                                                        <li  id="1000M"><a href="#">MODIFICATION</a></li>
                                                        <li  id="1000S"><a href="#">SUPPRESSION</a></li>
                                                    </ul>
                                                </li>
                                                <li id="2000">GESTION DES FOURNISSEURS
                                                    <ul>
                                                        <li id="2000C">CREATION</li>
                                                        <li id="2000T"><a href="#">CONSULTATION</a></li>
                                                        <li  id="2000M"><a href="#">MODIFICATION</a></li>
                                                        <li  id="2000S"><a href="#">SUPPRESSION</a></li>
                                                    </ul>
                                                </li>
                                                <li id="3000">GESTION DES PRODUITS ET SERVICES
                                                    <ul>
                                                        <li id="3000C">CREATION</li>
                                                        <li id="3000T"><a href="#">CONSULTATION</a></li>
                                                        <li  id="3000M"><a href="#">MODIFICATION</a></li>
                                                        <li  id="3000S"><a href="#">SUPPRESSION</a></li>
                                                    </ul>
                                                </li>
                                                <li  id="4000">GESTION DES NATURES DES PRODUITS
                                                    <ul>
                                                        <li id="4000C">CREATION</li>
                                                        <li id="4000T"><a href="#">CONSULTATION</a></li>
                                                        <li  id="4000M"><a href="#">MODIFICATION</a></li>
                                                        <li  id="4000S"><a href="#">SUPPRESSION</a></li>
                                                    </ul>
                                                </li>
                                                <li id="5000">GESTION DES DEMANDES ACHAT
                                                    <ul>
                                                        <li id="5000C">CREATION</li>
                                                        <li id="5000T"><a href="#">CONSULTATION</a></li>
                                                        <li  id="5000M"><a href="#">MODIFICATION</a></li>
                                                        <li  id="5000S"><a href="#">SUPPRESSION</a></li>
                                                    </ul>
                                                </li>
                                                <li id="6000">GESTION DES BONS DE COMMANDES
                                                    <ul>
                                                        <li id="6000C">CREATION</li>
                                                        <li id="6000T"><a href="#">CONSULTATION</a></li>
                                                        <li  id="6000M"><a href="#">MODIFICATION</a></li>
                                                        <li  id="6000S"><a href="#">SUPPRESSION</a></li>
                                                    </ul>
                                                </li>
                                                <li id="7000">GESTION DES PROFORMAS
                                                    <ul>
                                                        <li id="7000C">CREATION</li>
                                                        <li id="7000T"><a href="#">CONSULTATION</a></li>
                                                        <li  id="7000M"><a href="#">MODIFICATION</a></li>
                                                        <li  id="7000S"><a href="#">SUPPRESSION</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                        </div>
                                        <input type="hidden" class="form-control" id="slug" name="slug" placeholder="" value="{{isset($profil)? $profil->slug:''}}">
                                        <br>
                                        <div class="form-group" >
                                            <button type="submit" class="btn btn-success form-control">{{isset($profil)? 'Modifier':'Ajouter'}}</button>
                                            @if(isset($profil))
                                                <a href="{{route('gestion_profil')}}">Ajouter un profil</a>
                                            @endif
                                        </div>

                    </form>
                </div>
                <div class="col-sm-8">
                    @include('profiles/list_profil')
                </div>

    </div>
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
    selection=$('#jstree').jstree(true).get_top_selected(true);

    valeur="";
        $.each(selection,function (index, value) {
            if (value != null)
                valeur=valeur+ ','+value.id;
        });
        $('#description').val(valeur.substr(1));



})

    </script>

        <script>

           var choix=$("#description").val();
           var resultat=choix.split(',');
           for(var p=0;p<=24;p++){
               console.log("valeur de "+p);
               $('#jstree').jstree(true).select_node(resultat[p],false,true);
           }

           $('#description').change(function (e){
               $('#sjtree').jstree('close_all', -1);
           });

        </script>

@endsection