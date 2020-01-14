@extends('layout.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Regístrate</h2>
                <form class="form-login p-5 my-5" method="post" action="{{route('store')}}">
                    @csrf
                    <h3 class="text-center">Únete a {{config('app.name')}}</h3>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <input type="text" class="form-control {{$errors->has('firstName') ? 'is-invalid' : ''}}"
                                   id="firstName" name="firstName" value="{{old('firstName')}}"
                                   placeholder="Nombres"/>
                            @if($errors->has('firstName'))
                                <span class="invalid-feedback">{{$errors->first('firstName')}}</span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control {{$errors->has('lastName') ? 'is-invalid' : ''}}"
                                   id="lastName" name="lastName" value="{{old('lastName')}}"
                                   placeholder="Apellidos"/>
                            @if($errors->has('firstName'))
                                <span class="invalid-feedback">{{$errors->first('lastName')}}</span>
                            @endif

                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <input type="text" class="form-control {{$errors->has('rut') ? 'is-invalid' : ''}}" id="rut"
                                   name="rut" placeholder="Rut" value="{{old('rut')}}"/>
                            @if($errors->has('rut'))
                                <span class="invalid-feedback">{{$errors->first('rut')}}</span>
                            @endif

                        </div>
                        <div class="col-md-6">
                            <input type="email" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}"
                                   id="email" name="email" placeholder="Email" value="{{old('email')}}"/>
                            @if($errors->has('email'))
                                <span class="invalid-feedback">{{$errors->first('email')}}</span>
                            @endif

                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <input type="password" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}"
                                   id="password" name="password" value="{{old('password')}}"
                                   placeholder="Clave"/>
                            @if($errors->has('password'))
                                <span class="invalid-feedback">{{$errors->first('password')}}</span>
                            @endif

                        </div>
                        <div class="col-md-6">
                            <input type="checkbox" class="d-inline-block" id="password" name="password"/>
                            <p class="d-inline-block">Mostrar clave</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
