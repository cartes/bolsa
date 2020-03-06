<div class="modal fade" id="registerModal" role="dialog" aria-labelledby="registerModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content py-3 px-4">
            @if(!session()->has('id'))
                <div class="modal-header">
                    <h4 class="modal-title">Crea tu Perfil y únete a <strong>{{config('app.name')}}</strong></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('store')}}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>Nombres(*)</label>
                                <input type="text"
                                       class="form-control {{$errors->has('firstName') ? 'is-invalid' : ''}}"
                                       id="firstName" name="firstName" value="{{old('firstName')}}"/>
                                @if($errors->has('firstName'))
                                    <span class="invalid-feedback">{{$errors->first('firstName')}}</span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label>Apellidos(*)</label>
                                <input type="text" class="form-control {{$errors->has('lastName') ? 'is-invalid' : ''}}"
                                       id="lastName" name="lastName" value="{{old('lastName')}}"/>
                                @if($errors->has('firstName'))
                                    <span class="invalid-feedback">{{$errors->first('lastName')}}</span>
                                @endif

                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>Email(*)</label>
                                <input type="email" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}"
                                       id="email" name="email" value="{{old('email')}}"/>
                                @if($errors->has('email'))
                                    <span class="invalid-feedback">{{$errors->first('email')}}</span>
                                @endif

                            </div>
                            <div class="col-md-6">
                                <label>Teléfono(*)</label>
                                <input type="text" class="form-control {{$errors->has('phone') ? 'is-invalid' : ''}}"
                                       id="phone" name="phone" value="{{old('phone')}}"/>
                                @if($errors->has('phone'))
                                    <span class="invalid-feedback">{{$errors->first('phone')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>Rut(*)</label>
                                <input type="text" class="form-control {{$errors->has('rut') ? 'is-invalid' : ''}}"
                                       id="rut"
                                       name="rut" value="{{old('rut')}}"/>
                                @if($errors->has('rut'))
                                    <span class="invalid-feedback">{{$errors->first('rut')}}</span>
                                @endif

                            </div>
                            <div class="col-md-6">
                                <label>Contraseña(*)</label>
                                <input type="password"
                                       class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}"
                                       id="password" name="password" value="{{old('password')}}"/>
                                @if($errors->has('password'))
                                    <span class="invalid-feedback">{{$errors->first('password')}}</span>
                                @endif

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <small>
                                    Al hacer clic en CREAR CUENTA, aceptas las Condiciones de uso y la Política de
                                    privacidad de Empleos Aqua
                                </small>
                            </div>
                            <div class="col-md-12">
                                <p style="color: #212529;">
                                <input type="checkbox" class="d-inline-block mr-1" name="newsletter" id="newsletter"
                                       checked/>
                                    Acepto recibir newsletters con novedades, promociones y actualizaciones.
                                </p>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6 text-right">
                                <button type="button" class="w-50 btn btn-secondary" data-dismiss="modal"
                                        aria-label="Close">Cancelar
                                </button>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">CREAR CUENTA</button>
                            </div>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>

@if (!empty($errors->hasAny(['firstName', 'lastName', 'email', 'phone', 'rut', 'password'])))
    <script>
        jQuery(document).ready(function ($) {
            $('#registerModal').modal('show');
        })
    </script>
@endif
