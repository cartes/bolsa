@extends('layout.app')

@section('content')

    <div class="container">
        @isset($code)
            <div class="row justify-content-center">
                <div class="col-md-5">
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

        <div class="row justify-content-center my-3">
            <div class="col-md-8">
                @forelse($offers as $offer)
                    <div class="card mb-3">
                        <div class="card-header py-2 px-3">
                            <h3 class="text-capitalize text-left m-0 p-0">
                                {{$offer->title}} - <span class="small">{{$offer->comune ?? $offer->city}}
                                    @if($offer->created_at->diffInHours() < 20)
                                        <span class="badge badge-success">
                                            {{'Nuevo'}}
                                        </span>
                                    @endif
                                    </span>
                            </h3>
                        </div>
                        <div class="card-body py-2 px-3">
                            <p class="p-0 m-0">
                                {{\Illuminate\Support\Str::limit(strip_tags($offer->description), 300)}}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="card">
                        <div class="card-body">
                            <p>No hay ofertas de trabajo para mostrar!</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection