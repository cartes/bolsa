@extends('layout.app')

@section('content')

    <div class="container">
        @if(session()->has('message'))
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="alert alert-{{session('message')[0]}}" role="alert">
                        {{session('message')[1]}}
                    </div>
                </div>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-left">
                            {{ $offer->title }}
                        </h3>
                        <h5>
                            <a href="{{ route('business.file', $offer->business->id) }}">
                                {{ $offer->businessMeta->fantasy_name }}
                            </a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <p>Lugar de trabajo: <strong>{{$offer->comune}}, {{$offer->city}}</strong></p>
                        <p>Publicado: <strong>{{ $offer->publication }}</strong></p>
                        <p>Salario: <strong>{{ $offer->salary ? $offer->salary : 'No especificado' }}</strong></p>
                        <p>Área: <strong>{{ $offer->area }}</strong></p>
                        <hr/>
                        {!! $offer->description !!}
                        <hr/>
                        <form id="postulation-form" method="get" action="{{ route('offer.postulate', $offer->slug) }}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <p><strong>Sueldo Bruto pretendido</strong></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-group col-sm-6">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">$</span>
                                    </div>
                                    <input class="form-control" type="text" placeholder="Salario"/>
                                </div>
                                <div class="form-group col-sm-6 m-0">
                                    @if( session()->get('id') && session()->get('role') !== 'business' )
                                        @if($postulate)
                                            <p class="btn m-0">Ya postulaste a esta
                                                oferta {{ $postulate->postulated }}</p>
                                        @else
                                            <button type="submit" class="btn btn-primary">Postularme</button>
                                        @endif
                                    @elseif(session()->get('role') == 'business' && session()->get('id') == $offer->id_business)
                                        <a href="{{ route('offer.detail', $offer->slug) }}" class="btn btn-primary">Editar</a>
                                    @elseif(!session()->get('id'))
                                        <a href="{{ route('home') }}" class="btn btn-primary">Iniciar sesión</a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection