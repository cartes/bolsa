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

        @include('partials.modals.republishOffer')

        <div class="row justify-content-center mb-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5 text-center">
                                <h4 class="text-uppercase">{{ $business->business_meta->business_name }}</h4>
                                <a class="btn btn-outline-primary" href="{{ route('business.profile') }}">Actualizar mi perfil</a>
                            </div>
                            <div class="border-left col-md-7">
                                <div class="row mb-2">
                                    <div class="col-12">
                                        <h5>Información de contacto</h5>
                                        <p class="py-0 my-0">
                                            Nombre: {{ $business->firstname }} {{ $business->surname }}</p>
                                        <p class="py-0 my-0">Email: {{ $business->email }}</p>
                                        <p class="pt-0 my-0">Teléfono: {{ $business->phone }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h5>Información de contacto empresa</h5>
                                        <p class="py-0 my-0">Email: {{ $business->business_meta->email }}</p>
                                        <p class="pt-0 my-0">Teléfono: {{ $business->business_meta->phone }}</p>
                                        <p class="pt-0 my-0">Teléfono: {{ $business->business_meta->activity }}</p>
                                        <p class="pt-0 my-0">Rubro: {{ $business->business_meta->activity }}</p>
                                        <p class="pt-0 my-0">Dirección: {{ $business->business_meta->address }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">

            </div>
        </div>

        <div class="row justify-content-between mb-0">
            <div class="col-4 m-0">
                <h6 class="p-0 m-0"><strong>Ofertas activas</strong></h6>
            </div>
            <div class="col-3 text-right">
                <a href="{{ route('post.create') }}" class="btn btn-primary"><i class="far fa-plus-square"></i> Publicar
                    Oferta</a>
            </div>
        </div>

        <div class="row justify-content-end">
            <div class="col-md-12 offers-file mt-0">
                @if(session()->get('id'))
                    @if($offers)
                        <table class="table-offers table-striped table my-4">
                            <thead>
                            <tr>
                                <th scope="col"><p class="m-0 text-left">Nombre de la oferta</p></th>
                                <th scope="col"><p class="m-0 text-right"><i class="h4 p-0 m-0 far fa-eye"></i></p></th>
                                <th scope="col"><p class="m-0 text-right"><i class="h4 p-0 m-0 fas fa-file-alt"></i></p>
                                </th>
                                <th scope="col"><p class="m-0 text-center">Estatus de la oferta</p></th>
                                <th scope="col"><p class="m-0 text-center">Fecha inicio</p></th>
                                <th scope="col"><p class="m-0 text-center">Fecha termino</p></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($offers as $offer)
                                <tr>
                                    <td>
                                        <p class="m-0 text-left">
                                            <a href="{{ route('offer.detail', $offer->slug) }}">
                                                {{$offer->title}}
                                            </a>
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-right">{{ $offer->views }}</p>
                                    </td>
                                    <td>
                                        @if($offer->candidates_count > 0)
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
                                        <p class="m-0 text-center">{!! $offer->status !!}</p>
                                    </td>
                                    <td>
                                        <p class="m-0 text-center">{{$offer->date}}</p>
                                    </td>
                                    <td>
                                        <p class="m-0 text-center">{{$offer->expiration_date}}</p>
                                    </td>
                                    <td>
                                        <p>
                                            <a href="{{ route('offer.candidates', $offer->slug) }}">
                                                <i class="fas fa-briefcase"></i>
                                            </a>
                                        </p>
                                    </td>
                                    <td>
                                        <p>
                                            <a href="{{ route('offer.detail', $offer->slug) }}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        </p>
                                    </td>
                                    <td>
                                        <form method="post" action="{{ route('offer.delete', $offer->slug) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn-sm btn btn-danger" type="submit">Eliminar</button>
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

        @if ($expired)
            <div class="row justify-content-between mb-0">
                <div class="col-4 m-0">
                    <h6 class="m-0 p-0"><strong>Ofertas cerradas</strong></h6>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-12 offers-file mt-0">
                    <table class="table-offers table-striped table my-4">
                        <thead>
                        <tr>
                            <th scope="col"><p class="m-0 text-left">Nombre de la oferta</p></th>
                            <th scope="col"><p class="m-0 text-right"><i class="h4 p-0 m-0 far fa-eye"></i></p></th>
                            <th scope="col"><p class="m-0 text-right"><i class="h4 p-0 m-0 fas fa-file-alt"></i></p>
                            </th>
                            <th scope="col"><p class="m-0 text-center">Estatus de la oferta</p></th>
                            <th scope="col"><p class="m-0 text-center">Fecha inicio</p></th>
                            <th scope="col"><p class="m-0 text-center">Fecha termino</p></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($expired as $exp)
                            <tr>
                                <td>
                                    {{ $exp->title }}
                                </td>
                                <td>
                                    <p>{{ $exp->views }}</p>
                                </td>
                                <td>
                                    @if($exp->candidates_count > 0)
                                        <a href="{{ route('offer.candidates', $exp->slug) }}">
                                            <p class="m-0 text-right">{{$exp->candidates_count}}</p>
                                        </a>
                                    @else
                                        <p class="m-0 text-right">
                                            Sin candidatos
                                        </p>
                                    @endif

                                </td>
                                <td>
                                    <p class="text-center m-0">{!! $exp->status  !!}</p>
                                </td>
                                <td>
                                    <p class="m-0 text-center">{{ $exp->date }}</p>
                                </td>
                                <td>
                                    <p class="m-0 text-center">{{ $exp->expiration_date }}</p>
                                </td>
                                <td>
                                    <p>
                                        <a class="btn-republish" data-link="{{ route('offer.republish', $exp->slug) }}" href="#">
                                            <i class="text-success fas fa-history"></i>
                                        </a>
                                    </p>
                                </td>
                                <td>
                                    <p>
                                        <a href="{{ route('offer.candidates', $exp->slug) }}">
                                            <i class="fas fa-briefcase"></i>
                                        </a>
                                    </p>
                                </td>
                                <td>
                                    <p>
                                        <a href="{{ route('offer.detail', $exp->slug) }}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                    </p>
                                </td>
                                <td>
                                    <form method="post" action="{{ route('offer.delete', $exp->slug) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-sm btn btn-danger" type="submit">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection


@push('scripts')
    <script>
        jQuery(document).ready(function ($) {
            $('[data-toggle="popover"]').popover();

            $('.btn-republish').click(function (e) {
                e.preventDefault();
                var url = $(this).data('link');
                $('#republishOffer').modal('show');
                $('#republish-link').attr('action', url);
            })
        });
    </script>
@endpush
