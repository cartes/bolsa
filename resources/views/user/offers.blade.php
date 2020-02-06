@extends('layout.app')

@section('content')
    <div class="container">
        @if($user->name)
            <div class="row justify-content-center">
                <div class="col-sm-10">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h3 class="text-center">
                                        {{ $user->name }}, estas son tus postulaciones
                                    </h3>
                                </div>
                            </div>
                            <hr/>
                            <table class="table my-4">
                                <thead>
                                <tr>
                                    <th scope="col"><p class="m-0 text-center">Id</p></th>
                                    <th scope="col"><p class="m-0 text-center">Oferta</p></th>
                                    <th scope="col"><p class="m-0 text-center">F. Postulación</p></th>
                                    <th scope="col"><p class="m-0 text-center">Empresa</p></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($candidates as $candidate)
                                    <tr>
                                        <td><p class="m-0 text-right">{{$candidate->offers->id}}</p></td>
                                        <td>
                                            <p class="m-0 text-left">
                                                <a href="{{ route('offer.show', $candidate->offers->slug) }}">
                                                    {{$candidate->offers->title}}
                                                </a>
                                            </p>
                                        </td>
                                        <td><p class="m-0 text-center">{{$candidate->offers->date}}</p></td>
                                        <td>
                                            <p class="m-0 text-left">
                                                <a href="{{ route('business.file', $candidate->offers->businessMeta->id_business) }}">
                                                {{ $candidate->offers->businessMeta->fantasy_name }}
                                                </a>
                                            </p>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>No has postulado a ninguna oferta</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            <div class="row justify-content-center">
                                    {{ $candidates->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection