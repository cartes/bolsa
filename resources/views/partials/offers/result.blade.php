<div class="row justify-content-center my-3">
    @isset($search)
        <div class="col-md-10">
            <h4>Resultados para: {{$search}}</h4>
        </div>
    @endisset
    <div class="col-md-3 pr-0 mr-0">
        @if ($featured != '[]' && $featured)
            <div class="container-featured-offer mb-0 border">
                <div class="row py-2 px-2">
                    {{ $featured }}
                </div>
            </div>
        @endif
        @if (!isset($search))
            @php($search = '')
        @endif
        @php( $i = 0)
        @forelse($offers as $offer)
            <div class="container-offer mb-0 border{{ $i == 0 ? ' back-orange' : '' }}">
                <a href="{{ route('offer.show', ['slug' => $offer->slug, 'search' => $search] )}}">
                    <div class="py-2 px-3">
                        <div class="row">
                            <div class="col-md-9">
                                <h5 class="text-capitalize text-left m-0 p-0">
                                    {{$offer->title}}{{ $offer->salary ? ' | ' . $offer->salary : '' }}
                                    <span class="small">
                                    @if ( $offer->is_new )
                                            <span class="badge badge-success">
                                            {{'Nuevo'}}
                                        </span>
                                        @endif
                                </span>
                                </h5>
                            </div>
                            <div class="col-md-3">
                                <p class="date text-right">
                                    {{$offer->publication}}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="py-2 px-3">
                        <p class="p-0 m-0">
                            {{\Illuminate\Support\Str::limit(strip_tags(html_entity_decode($offer->description)), 50)}}
                        </p>
                    </div>
                </a>
            </div>
            @php($i++)
        @empty
            <div class="card">
                <div class="card-body">
                    <p>No hay ofertas de trabajo para mostrar!</p>
                </div>
            </div>
        @endforelse
    </div>
    @if ($offers->total() > 0)
        <div id="container-offer-display" class="col-md-7 pl-0 border">
            <div class="row p-3 px-5">
                <div class="col-12">
                    <small id="container-offer-title-created-at">{{ $offers[0]->created_at }}</small>
                </div>
                <div class="col-12">
                    <h2 id="container-offer-title"> {{ $offers[0]->title }}{{ $offers[0]->salary ? ' | ' . $offers[0]->salary : '' }}</h2>
                </div>
                <div class="col-12">
                    <p id="container-business-name" class="m-0 p-0">
                        <strong>{{ $offers[0]->businessMeta->business_name }}</strong></p>
                    <p id="container-business-comune" class="m-0 p-0">{{ $offers[0]->businessMeta->comune }}</p>
                </div>
                <div class="col-12 mt-2">
                    <div id="container-offer-description">{!! $offers[0]->description !!}</div>
                </div>
                <div class="col-12">
                    <div id="container-offer-requirements">{{ $offers[0]->requirements }}</div>
                </div>
                @if ( $offers[0]->benefits )
                    <div class="col-12">
                        <div id="container-offer-benefits">
                            @foreach( $offers[0]->benefits as $benefit )
                                <div class='btn-benefit mr-3 mb-2 btn btn-secondary'>{{ $benefit->benefit }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif
                <div class="col-12 text-right">
                    @if (isset($postuled) && $postuled)
                        <p>Ya postulaste a esta oferta</p>
                    @elseif (session()->get("id"))
                        <a data-toggle="modal" data-target="#postuleModal" href="#" class="btn btn-primary">Postula Acá</a>
                    @else
                        <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#loginUserModal">Inicie sesión para postular</a>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>
<div class="row justify-content-center">
    {{ $offers->links() }}
</div>
