<div class="row justify-content-center">
    @isset($search)
        <div class="col-md-10">
            <h4>Resultados para: {{$search}}</h4>
        </div>
    @endisset
    <div class="col-md-3 pr-md-0 mr-md-0 d-none d-md-block">
        @if ($featured != '[]')
            <div class="container-featured-offer mb-0 border">
                <div class="row p-2">
                </div>
            </div>
        @endif

        @if (!isset($search))
            @php($search = '')
        @endif

        @forelse($offers as $off)
            <div class="container-offer mb-0 border{{ $slug == $off->slug ? ' back-orange' : '' }}">
                <a href="{{ route("offer.show", ['slug' => $off->slug, 'search' => $search]) }}">
                    <div class="py-2 px-3">
                        <div class="row">
                            <div class="col-md-9">
                                <h5 class="text-capitalize text-left m-0 p-0">
                                    {{$off->title}}{{ $off->salary ? ' | ' . $off->salary : '' }}
                                    @if ($off->is_new)
                                        <span class="badge badge-success">
                                            {{'Nuevo'}}
                                        </span>
                                    @endif
                                </h5>
                            </div>
                            <div class="col-md-3">
                                <p class="date text-right">
                                    {{ $off->publication }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="py-2 px-3">
                        <p class="p-0 m-0">
                            {{\Illuminate\Support\Str::limit(strip_tags(html_entity_decode($off->description)), 50)}}
                        </p>
                    </div>
                </a>
            </div>
        @empty
            <div class="card">
                <div class="card-body">
                    <p>No hay ofertas de trabajo para mostrar!</p>
                </div>
            </div>
        @endforelse
    </div>
    <div id="container-offer-display" class="col-md-7 pl-0 border">
        <div class="row p-3 px-5">
            <div class="col-12">
                <small id="container-offer-title-created-at">{{ $offer->created_at->format('d \\d\\e F \\d\\e Y') }}</small>
            </div>
            <div class="col-12">
                <h2 id="container-offer-title"> {{ $offer->title }}{{ $offer->salary ? ' | ' . $offer->salary : '' }}</h2>
            </div>
            @if ($offer->businessMeta)
                <div class="col-12">

                    <p id="container-business-name" class="m-0 p-0">
                        <strong>{{ $offer->businessMeta->business_name }}</strong>
                        @if($offer->businessMeta->phone)
                            | Tel: {{ $offer->business->phone_user }} |
                            Contacto: {{ $offer->business->firstname }} {{ $offer->business->surname }}
                        @endif

                    </p>
                    <p id="container-business-comune" class="m-0 p-0">{{ $offer->businessMeta->comune }}</p>
                </div>
            @endif

            <div class="col-12 mt-2">
                <div id="container-offer-description">{!! $offer->description !!}</div>
            </div>
            <div class="col-12">
                <div id="container-offer-requirements">{{ $offer->requirements }}</div>
            </div>
            @if ( $offer->benefits )
                <div class="col-12">
                    <div id="container-offer-benefits">
                        @foreach( $offer->benefits as $benefit )
                            <div class='btn-benefit mr-3 mb-2 btn btn-secondary'>{{ $benefit->benefit }}</div>
                        @endforeach
                    </div>
                </div>
            @endif
            <div class="col-12 text-right">
                @if(session()->get('role') != 'business')
                    @if ($postuled)
                        <p>Ya postulaste a esta oferta</p>
                    @elseif(session()->get('id') && $academics != 0)
                        <a data-toggle="modal" data-target="#postuleModal" href="#" class="btn btn-primary">Postula
                            Acá</a>
                    @elseif(session()->get('id') && $academics == 0)
                        <p>No ha incluido su información académica.</p>
                        <a class="btn btn-primary" href="{{ route('profile') }}">
                            Edite su perfil
                        </a>
                    @else
                        <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#loginUserModal">Inicie
                            sesión para postular</a>
                    @endif
                @elseif (session()->get('id') == $offer->id_business)
                    <a class="btn btn-primary" href="{{ route('offer.detail', ['offer' => $offer->slug]) }}">
                        Edite su Oferta
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="row mt-4 justify-content-center">
    {{ $offers->links() }}
</div>
