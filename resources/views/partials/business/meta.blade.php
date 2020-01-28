<div class="row justify-content-center">
    <div class="col-md-8">
        <form class="form-business" method="post" action="{{ route('business.update') }}">
            @csrf
            @method("PUT")
            <h3 class="text-center mb-5">
                Edite su Perfil de empresa
            </h3>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label>Rut de la Empresa</label>
                    <input type="text" class="form-control {{$errors->has('rut_business') ? 'is-invalid' : ''}}"
                           name="rut_business"
                           value="{{old('rut_business') ?: $business->business_meta->rut_business}}"/>
                    @if($errors->has('rut_business'))
                        <span class="invalid-feedback">{{$errors->first('rut_business')}}</span>
                    @endif
                </div>
                <div class="col-md-6 form-group">
                    <label>Razón Social</label>
                    <input type="text" class="form-control {{$errors->has('businessName') ? 'is-invalid' : ''}}"
                           name="businessName"
                           value="{{old('businessName') ?: $business->business_meta->business_name}}"/>
                    @if($errors->has('business_name'))
                        <span class="invalid-feedback">{{$errors->first('business_name')}}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label>Nombre de Fantasía</label>
                    <input type="text" class="form-control {{$errors->has('fantasy_name') ? 'is-invalid' : ''}}"
                           name="fantasy_name"
                           value="{{old('fantasy_name') ?: $business->business_meta->fantasy_name}}"/>
                    @if($errors->has('fantasy_name'))
                        <span class="invalid-feedback">{{$errors->first('business_name')}}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label>Giro</label>
                    <input type="text" class="form-control {{$errors->has('activity') ? 'is-invalid' : ''}}"
                           name="activity"
                           value="{{old('activity') ?: $business->business_meta->activity}}"/>
                    @if($errors->has('activity'))
                        <span class="invalid-feedback">{{$errors->first('activity')}}</span>
                    @endif
                </div>
                <div class="col-md-6 form-group">
                    <label>Email</label>
                    <input type="text" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}"
                           name="email"
                           value="{{old('email') ?: $business->email}}"/>
                    @if($errors->has('email'))
                        <span class="invalid-feedback">{{$errors->first('email')}}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <label>Dirección</label>
                    <input type="text" class="form-control {{$errors->has('address') ? 'is-invalid' : ''}}"
                           name="address"
                           value="{{old('address') ?: $business->business_meta->address}}"/>
                    @if($errors->has('address'))
                        <span class="invalid-feedback">{{$errors->first('address')}}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label>Región</label>
                    <input type="text" class="form-control {{$errors->has('state') ? 'is-invalid' : ''}}"
                           name="state"
                           value="{{old('state') ?: $business->business_meta->state}}"/>
                    @if($errors->has('state'))
                        <span class="invalid-feedback">{{$errors->first('state')}}</span>
                    @endif
                </div>
                <div class="col-md-6 form-group">
                    <label>Ciudad</label>
                    <input type="text" class="form-control {{$errors->has('city') ? 'is-invalid' : ''}}"
                           name="city"
                           value="{{old('city') ?: $business->business_meta->city}}"/>
                    @if($errors->has('city'))
                        <span class="invalid-feedback">{{$errors->first('city')}}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label>Comuna</label>
                    <input type="text" class="form-control {{$errors->has('comune') ? 'is-invalid' : ''}}"
                           name="comune"
                           value="{{old('comune') ?: $business->business_meta->comune}}"/>
                    @if($errors->has('comune'))
                        <span class="invalid-feedback">{{$errors->first('comune')}}</span>
                    @endif
                </div>
                <div class="col-md-6 form-group">
                    <label>Teléfono</label>
                    <input type="text" class="form-control {{$errors->has('phone') ? 'is-invalid' : ''}}"
                           name="phone"
                           value="{{old('phone') ?: $business->business_meta->phone}}"/>
                    @if($errors->has('phone'))
                        <span class="invalid-feedback">{{$errors->first('phone')}}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label>Rubro</label>
                    <input type="text" class="form-control {{$errors->has('entry') ? 'is-invalid' : ''}}"
                           name="entry"
                           value="{{old('entry') ?: $business->business_meta->entry}}"/>
                    @if($errors->has('entry'))
                        <span class="invalid-feedback">{{$errors->first('entry')}}</span>
                    @endif
                </div>
                <div class="col-md-6 form-group">
                    <label>Cantidad de empleados</label>
                    <input type="text" class="form-control {{$errors->has('employees') ? 'is-invalid' : ''}}"
                           name="employees"
                           value="{{old('employees') ?: $business->business_meta->employees}}"/>
                    @if($errors->has('employees'))
                        <span class="invalid-feedback">{{$errors->first('employees')}}</span>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h4>Perfil de usuario</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label>Nombres</label>
                    <input type="text" class="form-control {{$errors->has('userName') ? 'is-invalid' : ''}}"
                           name="userName" value="{{old('userName') ?: $business->firstname}}"/>
                    @if($errors->has('userName'))
                        <span class="invalid-feedback">{{$errors->first('userName')}}</span>
                    @endif

                </div>
                <div class="col-md-6 form-group">
                    <label>Apellidos</label>
                    <input type="text" class="form-control {{$errors->has('userSurname') ? 'is-invalid' : ''}}"
                           name="userSurname" value="{{old('userSurname') ?: $business->surname}}"/>
                    @if($errors->has('userSurname'))
                        <span class="invalid-feedback">{{$errors->first('userSurname')}}</span>
                    @endif

                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label>Rut Usuario</label>
                    <input type="text" class="form-control {{$errors->has('userRut') ? 'is-invalid' : ''}}"
                           name="userRut" value="{{old('rut_user') ?: $business->rut_user}}"/>
                    @if($errors->has('userRut'))
                        <span class="invalid-feedback">{{$errors->first('userRut')}}</span>
                    @endif

                </div>
                <div class="col-md-6 form-group">
                    <label>Email</label>
                    <input type="text" class="form-control {{$errors->has('userEmail') ? 'is-invalid' : ''}}"
                           name="userEmail" value="{{old('userEmail') ?: $business->email}}"/>
                    @if($errors->has('userEmail'))
                        <span class="invalid-feedback">{{$errors->first('userEmail')}}</span>
                    @endif

                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label>Teléfono</label>
                    <input type="text" class="form-control {{$errors->has('userPhone') ? 'is-invalid' : ''}}"
                           name="userPhone" value="{{old('userPhone') ?: $business->phone}}"/>
                    @if($errors->has('userPhone'))
                        <span class="invalid-feedback">{{$errors->first('userPhone')}}</span>
                    @endif

                </div>
                <div class="col-md-6 form-group">
                    <label>Cargo</label>
                    <input type="text" class="form-control {{$errors->has('userPosition') ? 'is-invalid' : ''}}"
                           name="userPosition" value="{{old('userPosition') ?: $business->position}}"/>
                    @if($errors->has('userPosition'))
                        <span class="invalid-feedback">{{$errors->first('userPosition')}}</span>
                    @endif

                </div>
            </div>

            <button type="submit" class="btn btn-primary">Guardar los datos</button>

        </form>
    </div>
</div>
