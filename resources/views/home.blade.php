@extends('layout.app')

@section('content')

    <div class="container">
        @isset($code)
            <div class="row justify-content-center">
                <div class="col-md-6">
                    @if($code == "200")
                        <div class="alert alert-success" role="alert">
                            {{$message}}
                        </div>
                    @else
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                    @endif
                </div>
            </div>
        @endisset

        <div class="row justify-content-center">

            <div class="col-md-6">
                <h1 class="text-center">Bienvenido</h1>
                <h2 class="text-center">Ingresar a {{config('app.name')}}</h2>
                @if(!session()->has('id'))
                <form class="form-login p-5 my-5" method="post" action="{{route('login')}}">
                    @csrf
                    <div class="form-group">
                        <input class="form-control" type="text" id="email" name="email" placeholder="Email"/>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" id="password" name="password"
                               placeholder="Password"/>
                    </div>

                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
                @endif
            </div>
        </div>
    </div>
@endsection