
@extends('layouts.app')
@section('content')
    <h2>{{strtoupper(__('menu.mon_profile'))}} / {{isset($utilisateur)? strtoupper(__('neutrale.modifier_utilisateur')):''}}</h2><br/><br/><br/>

    <div class="row">
            <form role="form" id="FormRegister" class="bucket-form" method="post" action="{{route('modifier_profile')}}">

                        <div class="col-sm-4">
                            @csrf
                            <div class="form-group">
                                <b><label for="nom" class="control-label">{{__('translation.nom')}}</label></b>
                                <input type="text" class="form-control" id="nom" name="nom" placeholder="{{__('translation.nom')}}" value="{{isset($utilisateur)? $utilisateur->nom:''}}" required>
                            </div>

                            <div class="form-group">
                                <label for="prenoms">{{__('translation.prenoms')}}</label>
                                <input type="text" class="form-control" id="prenoms" name="prenoms" placeholder="{{__('translation.prenoms')}}" value="{{isset($utilisateur)? $utilisateur->prenoms:''}}">
                            </div>

                            <div class="form-group">
                                <label for="email">{{__('translation.email')}}</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{isset($utilisateur)? $utilisateur->email:''}}" readonly>
                            </div>

                            <input type="hidden" class="form-control" id="slug" name="slug" placeholder="" value="{{isset($utilisateur)? $utilisateur->slug:''}}"/>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="responsable">{{__('translation.password')}}</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="{{__('translation.password')}}" value="{{isset($utilisateur)? $utilisateur->password:''}}">
                            </div>

                            <div class="form-group">
                                <label for="domaine">{{__('translation.abreviation')}}</label>
                                <input type="text" class="form-control" id="abréviation" name="abréviation" placeholder="{{__('translation.abreviation')}}"  value="{{isset($utilisateur)? $utilisateur->abréviation:''}}">
                            </div>

                            <div class="form-group">
                                <label for="contact">{{__('translation.contact')}}</label>
                                <input type="text" class="form-control" id="contact" name="contact" placeholder="{{__('translation.contact')}}" value="{{isset($utilisateur)? $utilisateur->contact:''}}">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <fieldset><title></title>

                                <div class="form-group">
                                    <label for="domaine">{{__('translation.fonction')}}</label>
                                    <input type="text" class="form-control" id="function" name="function" placeholder="{{__('translation.fonction')}}" value="{{isset($utilisateur)? $utilisateur->function:''}}">
                                </div>

                                <div class="form-group">
                                    <b><label for="service">{{__('translation.service')}}</label></b>
                                    <ul>
                                        @foreach($services as $service)
                                            @if(isset($utilisateur) and $utilisateur->service==$service->id)
                                                <li>{{$service->libelle}}</li>

                                            @endif

                                        @endforeach
                                    </ul>
                                </div>

                                <div class="form-group">
                                    <label for="domaine">{{__('translation.les_roles')}}</label>
                                    <ul>
                                    @foreach($roles as $role)
                                        @if(isset($utilisateur) and $utilisateur->hasRole($role->name))
                                                <li>{{$role->description}}</li>

                                        @endif

                                    @endforeach
                                    </ul>


                                </div>
                                <div class="form-group">
                                    <label for="domaine">{{__('neutrale.projet')}}</label>
                                    <ul>
                                    @foreach($utilisateur->projets()->get() as $projet)

                                                <li>{{$projet->libelle}}</li>



                                    @endforeach
                                    </ul>


                                </div>

                                <br><div class="form-group" >
                                    <button type="submit" class="btn btn-success form-control " style="width: 200px;margin-right: 10px">{{isset($utilisateur)? strtoupper(__('neutrale.modifier_utilisateur')):''}}</button>
                                </div>

                            </fieldset>
                        </div>
            </form>
        </div>
                    </br>
                    </br>
                    </br>
                    <!-- Script pour générer l'adresse e-mail à partir du nom et prénoms saisi -->
                    <script type="application/javascript">

                        var txtnom = document.getElementById('nom');
                        var txtprenoms = document.getElementById('prenoms');

                        function génère_mail()
                        {
                            var mail = txtprenoms.value +'.'+ txtnom.value + '@eiffage.com';
                            document.getElementById('email').value = mail;
                        }

                        txtprenoms.addEventListener('keydown', function (e) {génère_mail()});
                        txtprenoms.addEventListener('change', function (e) {génère_mail()});
                        txtnom.addEventListener('change', function (e) {génère_mail()});
                        txtnom.addEventListener('keydown', function (e) {génère_mail()});

                        $(document).ready(function (e) {
                            //  génère_mail();
                        });

                        var table= $('#fournisseurs').DataTable({
                            language: {
                                url: "js/French.json"
                            },
                            "ordering":true,
                            "responsive": true,
                            "createdRow": function( row, data, dataIndex){

                            },
                            columnDefs: [
                                { responsivePriority: 5, targets: 0 },
                                { responsivePriority: 4, targets: -1 }
                            ]
                        }).column(0).visible(false);
                        //table.DataTable().draw();


                    </script>
@endsection
