@extends('layout.app')

@section('content')
    <div class="container">
        @if(session()->has('message'))
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="alert alert-{{session('message')[0]}}" role="alert">
                        {{session('message')[1]}}
                    </div>
                </div>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-10 offers-file card card-body">
                @if(session()->get('id'))
                    @if($offers)
                        <h3 class="text-center">Administrador de ofertas</h3>
                        <table class="table my-4">
                            <thead>
                            <tr>
                                <th scope="col"><p class="m-0 text-center">Id</p></th>
                                <th scope="col"><p class="m-0 text-center">Fecha Publicacion</p></th>
                                <th scope="col"><p class="m-0 text-center">Nombre de la oferta</p></th>
                                <th scope="col"><p class="m-0 text-center">Postulaciones</p></th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($offers as $offer)
                                <tr>
                                    <td scope="row"><p class="m-0 text-right">{{$offer->id}}</p></td>
                                    <td><p class="m-0 text-center">{{$offer->date}}</p></td>
                                    <td><p class="m-0 text-left"><a
                                                    href="{{ route('offer.detail', $offer->slug) }}">{{$offer->title}}</a>
                                        </p></td>
                                    <td>
                                        @if($offer->candidates_count >= 1)
                                        <a href="{{ route('offer.candidates', $offer->slug) }}">
                                            <p class="m-0 text-right">{{$offer->candidates_count}}</p>
                                        </a>
                                            @else
                                        <p class="m-0 text-right">
                                            Sin candidatos
                                        </p>
                                        @endif
                                    </td>
                                    <td>
                                        <form method="post" action="{{ route('offer.delete', $offer->slug) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                @else
                    <h2>Debe tener iniciada una sesión</h2>
                @endif
            </div>
        </div>
    </div>
@endsection