<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h3>Candidatos para oferta {{ $offer->title }}</h3>
                        <small>Id: {{ $offer->id }}</small>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col"><p class="m-0 text-center">Nombre Postulante</p></th>
                                <th scope="col"><p class="m-0 text-center">Edad</p></th>
                                <th scope="col"><p class="m-0 text-center">Género</p></th>
                                <th scope="col"><p class="m-0 text-center">Estado Civil</p></th>
                                <th scope="col"><p class="m-0 text-center">Nacionalidad</p></th>
                                <th scope="col"><p class="m-0 text-center">Email</p></th>
                                <th scope="col"><p class="m-0 text-center">Teléfono</p></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($offer->candidates as $candidate)
                                <tr>
                                    <td>
                                        <p class="m-0">
                                            <a href="{{ route('user.file', $candidate->user->id) }}">
                                                {{ $candidate->user->name }} {{ $candidate->user->surname }}
                                            </a>
                                        </p>
                                    </td>
                                    <td><p class="m-0 text-center">{{ $candidate->user->age ?? '' }}</p></td>
                                    <td><p class="m-0 text-left">{{ $candidate->user->gender ?? '' }}</p></td>
                                    <td><p class="m-0 text-left">{{ $candidate->user->marital_status ?? '' }}</p></td>
                                    <td><p class="m-0 text-left">{{ $candidate->user->nacionality ?? '' }}</p></td>
                                    <td><p class="m-0 text-left">{{ $candidate->user->email ?? '' }}</p></td>
                                    <td><p class="m-0 text-right">{{ $candidate->user->userMeta->phone ?? '' }}</p></td>
                                    <td>
                                        <p>
                                            <a href="{{ route("user.file", ['id' => $candidate->user->id, 'offer' => $offer->id]) }}">
                                                <i style="font-size: 20px;" class="far fa-file-alt"></i>
                                            </a>
                                        </p>
                                    </td>
                                    <td>
                                        <p>
                                            <a href="{{ route("message.show", ['user' => $candidate->user->id, 'offer' => $offer->id ]) }}">
                                                <i style="font-size: 20px;" class="far fa-comment-alt"></i>
                                            </a>
                                        </p>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
