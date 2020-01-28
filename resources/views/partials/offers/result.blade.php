<div class="row justify-content-center my-3">
    @isset($search)
        <div class="col-md-4">
            <h4>Resultados para: {{$search}}</h4>
        </div>
    @endisset
    <div class="col-md-8">
        @isset($offers)
            @forelse($offers as $offer)
                <div class="card mb-3">
                    <div class="card-header py-2 px-3">
                        <div class="row">
                            <div class="col-sm-9">
                                <h3 class="text-capitalize text-left m-0 p-0">
                                    <a href="{{ route("offer.show", $offer->slug) }}">{{$offer->title}}</a>
                                    - <span class="small">{{$offer->comune ?? $offer->city}}
                                        @if($offer->created_at->diffInHours() < 20)
                                            <span class="badge badge-success">
                                            {{'Nuevo'}}
                                        </span>
                                        @endif
                                    </span>
                                </h3>
                            </div>
                            <div class="col-sm-3">
                                <p class="date text-right">
                                    {{$offer->publication}}
                                </p>
                            </div>
                        </div>

                    </div>
                    <div class="card-body py-2 px-3">
                        <p class="p-0 m-0">
                            {{\Illuminate\Support\Str::limit(strip_tags(html_entity_decode($offer->description)), 300)}}
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
        @endisset
    </div>
</div>
<div class="row justify-content-center">
    {{ $offers->links() }}
</div>