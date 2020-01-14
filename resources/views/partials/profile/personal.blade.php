<div class="row justify-content-center">
    <div class="col-md-8">
        <form class="form" action="{{route('profile.update')}}" method="post">
            <h3 class="text-center">Datos Personales</h3>
            @method('PUT')
            @csrf
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Nombres</label>
                    <input class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}"
                           name="name" value="{{$user->name}}"/>
                    @if($errors->has('name'))
                        <span class="invalid-feedback">{{$errors->first('name')}}</span>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label>Apellidos</label>
                    <input class="form-control {{$errors->has('surname') ? 'is-invalid' : ''}}"
                           name="surname" value="{{$user->surname}}">
                    @if($errors->has('surname'))
                        <span class="invalid-feedback">{{$errors->first('surname')}}</span>
                    @endif

                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Fecha de Nacimiento</label>
                    <input class="form-control datepicker {{$errors->has('birthday') ? 'is-invalid' : ''}}"
                           name="birthday" value="{{old('birthday') ?: $user->birthday}}">
                    @if($errors->has('birthday'))
                        <span class="invalid-feedback">{{$errors->first('birthday')}}</span>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label>Género</label>
                    <select class="form-control {{$errors->has('gender') ? 'is-invalid' : ''}}" name="gender">
                        <option value="" {{old('gender') == null || $user->gender == null ? "selected" : ""}}>
                            Seleccionar
                        </option>
                        <option value="1" {{old('gender') == "1" || $user->gender == "1" ? "selected" : ""}}>Masculino
                        </option>
                        <option value="2" {{old('gender') == "2" || $user->gender == "2" ? "selected" : ""}}>Femenino
                        </option>
                        <option value="3" {{old('gender') == "3" || $user->gender == "3" ? "selected" : ""}}>Otro
                        </option>
                    </select>
                    @if($errors->has('gender'))
                        <span class="invalid-feedback">{{$errors->first('gender')}}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Nacionalidad</label>
                    <input class="form-control {{$errors->has('nacionality') ? 'is-invalid' : ''}}"
                           name="nacionality" value="{{$user->nacionality}}">
                    @if($errors->has('nacionality'))
                        <span class="invalid-feedback">{{$errors->first('nacionality')}}</span>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label>Estado Civil</label>
                    <select class="form-control {{$errors->has('marital_status') ? 'is-invalid' : ''}}"
                            name="marital_status">
                        <option value="" {{old('marital_status') == null || $user->marital_status == null ? "selected" : ""}}>
                            Seleccionar
                        </option>
                        <option value="1" {{old('marital_status') == "1" || $user->marital_status == "1" ? "selected" : ""}}>
                            Soltero/a
                        </option>
                        <option value="2" {{old('marital_status') == "2" || $user->marital_status == "2" ? "selected" : ""}}>
                            Casado/a
                        </option>
                        <option value="3" {{old('marital_status') == "3" || $user->marital_status == "3" ? "selected" : ""}}>
                            Unión Libre
                        </option>
                        <option value="4" {{old('marital_status') == "4" || $user->marital_status == "4" ? "selected" : ""}}>
                            Divorciado/a
                        </option>
                        <option value="5" {{old('marital_status') == "5" || $user->marital_status == "5" ? "selected" : ""}}>
                            Pareja de Hecho
                        </option>
                        <option value="6" {{old('marital_status') == "6" || $user->marital_status == "6" ? "selected" : ""}}>
                            Viudo/a
                        </option>
                    </select>
                    @if($errors->has('marital_status'))
                        <span class="invalid-feedback">{{$errors->first('marital_status')}}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label>Rut</label>
                    <input type="text"
                           class="form-control {{$errors->has('rut_user') ? 'is-invalid' : ''}}"
                           name="rut_user" value="{{$user->rut_user}}">
                    @if($errors->has('rut_user'))
                        <span class="invalid-feedback">{{$errors->first('rut_user')}}</span>
                    @endif

                </div>
            </div>
            <button type="submit" class="btn btn-primary">Guardar los Datos</button>
        </form>
    </div>

    <div class="file col-md-8 my-2">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">{{$user->name}} {{$user->surname}}</h3>
                <h5 class="text-center">{{$user->age}}</h5>
            </div>
        </div>
        <div class="row mt-4 py-4">
            <div class="col-md-4">
                <h6 class="text-center my-0">Nacionalidad</h6>
                <h5 class="text-center my-0"><strong>{{$user->nacionality}}</strong></h5>
            </div>
            <div class="col-md-4">
                <h6 class="text-center my-0">Estado Civil</h6>
                <h5 class="text-center my-0"><strong>{{$user->marital_status}}</strong></h5>
            </div>
            <div class="col-md-4">
                <h6 class="text-center my-0">Documento</h6>
                <h5 class="text-center my-0"><strong>{{$user->rut_user}}</strong></h5>
            </div>
        </div>
    </div>
</div>