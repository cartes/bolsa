<h3 class="text-center">Crea tu cuenta</h3>
<form class="form-business">
    <div class="row">
        <div class="col-md-12 form-group">
            <h5><strong>Información del usuario</strong></h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 form-group">
            <label>Nombre</label>
            <input type="text" class="form-control {{$errors->has('firstname')}}" name="firstname"
                   value="{{old('firstname')}}"/>
            @if($errors->has('firstname'))
                <span class="invalid-feedback">{{$errors->first('firstname')}}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 form-group">
            <label>Apellido</label>
            <input type="text" class="form-control {{$errors->has('surname')}}" name="surname"
                   value="{{old('surname')}}"/>
            @if($errors->has('surname'))
                <span class="invalid-feedback">{{$errors->first('surname')}}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 form-group">
            <label>Email</label>
            <input type="email" class="form-control {{$errors->has('email')}}" name="email"
                   value="{{old('email')}}"/>
            @if($errors->has('email'))
                <span class="invalid-feedback">{{$errors->first('email')}}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 form-group">
            <label>Contraseña</label>
            <input type="password" class="form-control {{$errors->has('password')}}" name="password"
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
            <input type="text" class="form-control {{$errors->has('rut')}}" name="rut"
                   value="{{old('rut')}}"/>
            @if($errors->has('rut'))
                <span class="invalid-feedback">{{$errors->first('rut')}}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 form-group">
            <label>Rut Empresa</label>
            <input type="text" class="form-control {{$errors->has('rut')}}" name="rut"
                   value="{{old('rut')}}"/>
            @if($errors->has('rut'))
                <span class="invalid-feedback">{{$errors->first('rut')}}</span>
            @endif
        </div>
    </div>

</form>