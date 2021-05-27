
@extends('layouts.app')
@section('content')
    <h2>{{strtoupper(__('menu.mon_profile'))}} / {{isset($utilisateur)? strtoupper(__('neutrale.modifier_utilisateur')):''}}</h2><br/><br/><br/>

    <div class="row">
            <form role="form" id="FormRegister" class="bucket-form" enctype="multipart/form-data" method="post" action="{{route('modifier_profile')}}">

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
                            <div class="form-group">
                                {{__('menu.signature')}}
                                    <img src="{{asset('storage/app/images/users/'.$utilisateur->signature)}}" id="blah" width="225px" />
                                <br>

                            </div>

                            <input type="hidden" class="form-control" id="slug" name="slug" placeholder="" value="{{isset($utilisateur)? $utilisateur->slug:''}}"/>
                            <input type="hidden" class="form-control" id="locale" name="locale" placeholder="" value="{{App()->getLocale()}}"/>
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
                            <div class="form-group">
                                <label for="signature2">{{__('menu.signature')}}</label>
                                <input type="file" class="form-control" id="signature2" name="signature" >
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

                    <script type="application/javascript">

                        signature2.onchange = evt => {
                            const [file] = signature2.files
                            if (file) {
                              blah.src = URL.createObjectURL(file)
                            }
                          }

                    </script>
@endsection
