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
                                    <th scope="col"><p class="m-0 text-center">Oferta</p></th>
                                    <th scope="col"><p class="m-0 text-center">F. Postulación</p></th>
                                    <th></th>
                                    <th scope="col"><p class="m-0 text-center">Estado de la publicación</p></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($candidates as $candidate)
                                    <tr>

                                        <td>
                                            <p class="m-0 text-left">
                                                {{$candidate->title}}
                                            </p>
                                            <p class="m-0 text-left">
                                                {{ $candidate->fantasy_name }}
                                            </p>
                                            <p class="m-0 text-left">
                                                {{ $candidate->comune }}
                                            </p>
                                        </td>
                                        <td class="align-middle">
                                            <p class="m-0 text-center">
                                                {{ \Carbon\Carbon::parse($candidate->created_at)->format("d \\d\\e F \\d\\e Y") }}
                                            </p>
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ route('offer.show', $candidate->slug) }}">
                                                Ver oferta
                                            </a>
                                        </td>
                                        <td class="align-middle">
                                            <p class="m-0 text-center">
                                                {{ $candidate->status['text'] }}
                                            </p>
                                        </td>
                                        <td class="align-middle">
                                            <i class="fas fa-comment-alt"></i>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>No has postulado a ninguna oferta</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection
