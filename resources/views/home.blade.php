@extends('layout.app')

@section('content')

    <div class="container">
        @if(null!==session('message'))
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="alert alert-{{session('message')[0]}}" role="alert">
                        {{session('message')[1]}}
                    </div>
                </div>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-5">
                @if(!session()->has('id'))
                    <form class="form-login p-5 my-5" method="post" action="{{route('login')}}">
                        <h1 class="text-center">Bienvenido</h1>
                        <h2 class="text-center">Ingresar a {{config('app.name')}}</h2>
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

        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="post" class="form-search" action="{{ route('search') }}">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Busqueda: </label>
                        <div class="col-sm-10">
                            <div class="input-group">
                            <input type="text" class="form-control" name="query" />
                                <span class="input-group-btn input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @include('partials.offers.result')
    </div>
@endsection