<form class="form-business" method="post" action="{{route('post.register')}}">
    <h3 class="text-center mb-3">Crea tu cuenta</h3>
    @csrf
    @method("PUT")
    <div class="row">
        <div class="col-md-12 form-group">
            <h5><strong>Información del usuario</strong></h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 form-group">
            <label>Nombre</label>
            <input type="text" class="form-control {{$errors->has('firstname') ? 'is-invalid' : ''}}" name="firstname"
                   value="{{old('firstname')}}"/>
            @if($errors->has('firstname'))
                <span class="invalid-feedback">{{$errors->first('firstname')}}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 form-group">
            <label>Apellido</label>
            <input type="text" class="form-control {{$errors->has('surname') ? 'is-invalid' : ''}}" name="surname"
                   value="{{old('surname')}}"/>
            @if($errors->has('surname'))
                <span class="invalid-feedback">{{$errors->first('surname')}}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 form-group">
            <label>Email</label>
            <input type="email" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" name="email"
                   value="{{old('email')}}"/>
            @if($errors->has('email'))
                <span class="invalid-feedback">{{$errors->first('email')}}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 form-group">
            <label>Contraseña</label>
            <input type="password" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}" name="password"
                   value="{{old('password')}}"/>
            @if($errors->has('password'))
                <span class="invalid-feedback">{{$errors->first('password')}}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 form-group">
            <h5><strong>Información de la empresa</strong></h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 form-group">
            <label>Rut Empresa</label>
            <input type="text" class="form-control {{$errors->has('rut') ? 'is-invalid' : ''}}" name="rut"
                   value="{{old('rut')}}"/>
            @if($errors->has('rut'))
                <span class="invalid-feedback">{{$errors->first('rut')}}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 form-group">
            <label>Razón Social</label>
            <input type="text" class="form-control {{$errors->has('business_name') ? 'is-invalid' : ''}}" name="business_name"
                   value="{{old('business_name')}}"/>
            @if($errors->has('business_name'))
                <span class="invalid-feedback">{{$errors->first('business_name')}}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 form-group">
            <label>Teléfono</label>
            <input type="text" class="form-control {{$errors->has('phone') ? 'is-invalid' : ''}}" name="phone"
                   value="{{old('phone')}}"/>
            @if($errors->has('phone'))
                <span class="invalid-feedback">{{$errors->first('phone')}}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 form-group">
            <label>Industría</label>
            <input type="text" class="form-control {{$errors->has('activity') ? 'is-invalid' : ''}}" name="activity"
                   value="{{old('activity')}}"/>
            @if($errors->has('activity'))
                <span class="invalid-feedback">{{$errors->first('activity')}}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 form-group">
            <label>Cantidad de Empleados</label>
            <input type="text" class="form-control {{$errors->has('employees') ? 'is-invalid' : ''}}" name="employees"
                   value="{{old('employees')}}"/>
            @if($errors->has('employees'))
                <span class="invalid-feedback">{{$errors->first('employees')}}</span>
            @endif
        </div>
    </div>
    <button class="btn btn-primary" type="submit">Guardar Datos</button>
</form>
