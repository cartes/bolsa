<div class="container">
    <div class="row justify-content-center my-3">
        @isset($search)
            <div class="col-md-10">
                <h4>Resultados para: {{$search}}</h4>
            </div>
        @endisset
        <div class="col-md-3 pr-md-0 mr-md-0 d-none d-md-block">
            @if (!isset($search))
                @php($search = '')
            @endif

            @forelse($offers as $off)
                <div class="container-offer mb-1{{ $off->featured  ? ' back-orange' : '' }}">
                    <a href="{{ route("offer.show", ['slug' => $off->slug, 'search' => $search, 'featured' => $featured]) }}">
                        <div class="py-2 px-3">
                            <div class="row">
                                <div class="col-md-9">
                                    <h5 class="text-capitalize text-left m-0 p-0">
                                        {{$off->title}}
                                        @if ($off->is_new)
                                            <span class="badge bg-success">
                                            {{'Nuevo'}}
                                        </span>
                                        @endif
                                        @if ( $off->featured )
                                            <span class="badge bg-success" style="background-color: #d88f32;">
                                            {{'Destacada'}}
                                        </span>
                                        @endif

                                    </h5>
                                </div>
                            </div>
                            @if(!is_null($off->businessMeta))
                                <div class="row">
                                    <div class="col-12">
                                        @if($off->businessMeta->comune != '')
                                            <h6>{{$off->businessMeta->comune}}</h6>
                                        @endif
                                    </div>
                                </div>
                            @endif
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
        <div id="container-offer-display" class="col-md-8 pl-0">
            <div class="row p-3 px-5">
                @if(!is_null($offer))
                    <div class="col-12">
                        <div class="breadcrumb d-block d-sm-none px-0">
                            <ul class="breadcrumb-container">
                                <li class="breadcrumb-item">
                                    <a href="{{route('/')}}">
                                        Home
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{route('offer.list')}}">
                                        Ofertas
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                    {{$offer->title}}
                                </li>
                            </ul>
                        </div>


                        <small
                            id="container-offer-title-created-at">{{ $offer->created_at->format('d \\d\\e F \\d\\e Y') }}</small>
                    </div>
                    <div class="col-12">
                        <h2 id="container-offer-title font-weight-bold"><strong style="color: #d88f32">{{ $offer->title }}</strong></h2>

                    </div>
                @endif

                @if (is_object($offer->businessMeta))
                
                    <div class="col-12">

                        <p id="container-business-name" class="m-0 p-0">
                            <strong>Prestigiosa empresa</strong>
                        </p>
                        <p id="container-business-comune"
                           class="m-0 p-0 mb-5" style="color: #999;">
                            {{$offer->businessMeta->comune}}
                        </p>
                    </div>
                @endif

                <div class="col-12 mt-2">
                    <h3 class="mb-3" style="font-size: 1.25rem; border-bottom: 1px solid #d88f32;display: inline-block; padding-right: 20px;">Funciones del Cargo</h3>

                    <div id="container-offer-description">{!! preg_replace("/[\w-]+@([\w-]+\.)+[\w-]+/", "[Email Bloqueado]", $offer->description); !!}</div>
                </div>
                <div class="col-12">
                    <h3 class="mb-3" style="font-size: 1.25rem; border-bottom: 1px solid #d88f32;display: inline-block; padding-right: 20px;">Requerimientos del cargo</h3>

                    <div id="container-offer-requirements">{{ $offer->requirements }}</div>
                </div>

                <!-- Datos de la oferta -->
                <div class="col-12">
                    <h3 class="mb-3" style="font-size: 1.25rem; border-bottom: 1px solid #d88f32;display: inline-block; padding-right: 20px;">Datos de la oferta</h3>
                    <div>
                        <strong>SALARIO:</strong><br>
                        {{$offer->salary}}
                    </div>
                <!-- {{$offer->position}} -->
                    <div style="margin-top: 20px">
                        <strong>JORNADA LABORAL:</strong><br>
                        {{$offer->position}}
                    </div>
                    <div style="margin-top: 20px">
                        <strong>TIPO DE CONTRATO:</strong><br>
                        {{$offer->experience}}
                    </div>
                </div>


                @if ( $offer->benefits )
                    <div class="col-12">
                        <h3 class="mb-3" style="font-size: 1.25rem; border-bottom: 1px solid #d88f32;display: inline-block; padding-right: 20px;">Beneficios</h3>

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
                        @elseif(session()->get('id'))
                            <a data-toggle="modal" data-target="#postuleModal" href="#" class="btn btn-primary">Postula
                                Acá</a>
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
</div>
