<div class="container">
    <div class="row justify-content-center my-3">
        @isset($search)
            <div class="col-md-10">
                <h4>Resultados para: {{$search}}</h4>
            </div>
        @endisset
        <div class="col-md-3 pr-md-0 mr-md-0">
            @if (!isset($search))
                @php($search = '')
            @endif
            @php( $i = 0)
            @forelse($offers as $offer)
                <div class="container-offer mb-1{{ $offer->featured ? ' back-orange' : '' }}">
                    @if ($featured)
                        @php ($array = ['slug' => $offer->slug, 'search' => $search, 'featured' => true])
                    @else
                        @php ($array = ['slug' => $offer->slug, 'search' => $search, 'featured' => false])
                    @endif
                    <a href="{{ route('offer.show', $array )}}">
                        <div class="py-2 px-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="text-capitalize text-left m-0 p-0" style="font-size: 1.15rem;">
                                        {{$offer->title}}
                                        <span class="small">
                                            @if ( $offer->is_new )
                                                <span class="badge bg-success">
                                                {{'Nuevo'}}
                                            </span>
                                            @endif
                                            @if ( $offer->featured )
                                                <span class="badge bg-success" style="background-color: #d88f32;">
                                                {{'Destacada'}}
                                            </span>
                                            @endif
                                        </span>
                                    </h4>
                                </div>
                            </div>
                            @if(!is_null($offer->businessMeta))
                                <div class="row">
                                    <div class="col-12">
                                        @if($offer->businessMeta->comune != '')
                                            <h6>{{$offer->businessMeta->comune}}</h6>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="py-2 px-3">
                            <p class="p-0 m-0">
                                {{\Illuminate\Support\Str::limit(strip_tags(html_entity_decode($offer->description)), 50)}}
                            </p>
                        </div>
                    </a>
                </div>
                @if ($i == 5 )
                    <div class = "banner-result-aside my-1">
                        <!-- /18588809/EACIZ_N -->
                        <div id='div-gpt-ad-1633611877658-0' style='min-width: 330px; min-height: 100px;'>
                            <script>
                                googletag.cmd.push(function() { googletag.display('div-gpt-ad-1633611877658-0'); });
                            </script>
                        </div>
                    </div>
                @endif
                @php($i++)
            @empty
                <div class="card">
                    <div class="card-body">
                        <p>No hay ofertas de trabajo para mostrar!</p>
                    </div>
                </div>
            @endforelse
        </div>
        @if (!is_null($offers[0]))
            <div id="container-offer-display" class="col-md-8 pl-0 d-none d-md-block">
                <div class="row p-3 px-5">
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
                            id="container-offer-title-created-at">{{ $offers[0]->created_at->format("d \\d\\e F \\d\\e Y") }}</small>
                    </div>
                    <div class="col-12">
                        <h2 id="container-offer-title font-weight-bold"><strong style="color: #d88f32">{{ $offers[0]->title }}</strong></h2>
                    </div>
                    @if($offers[0]->businessMeta)
                        <div class="col-12">
                            <p id="container-business-name" class="m-0 p-0">
                                <strong style="color: #999;">Prestigiosa empresa</strong></p>
                            <p id="container-business-comune"
                               class="m-0 p-0 mb-5" style="color: #999;">
                                {{$offers[0]->businessMeta->comune}}
                            </p>
                        </div>
                    @endif
                    <div class="col-12 mt-2">
                        <h3 class="mb-3" style="font-size: 1.25rem; border-bottom: 1px solid #d88f32;display: inline-block; padding-right: 20px;">Funciones del Cargo</h3>

                        <div id="container-offer-description">{!! preg_replace("/[\w-]+@([\w-]+\.)+[\w-]+/", "[Email Bloqueado]", $offer->description); !!}</div>
                    </div>
                    <div class="col-12">
                        <h3 class="mb-3" style="font-size: 1.25rem; border-bottom: 1px solid #d88f32;display: inline-block; padding-right: 20px;">Requerimientos del cargo</h3>
                        <div id="container-offer-requirements">{{ $offers[0]->requirements }}</div>
                    </div>

                    <!-- Datos de la oferta -->
                <!-- {{$offers[0]->position}} -->

                    <div class="col-12">
                        <h3 class="mb-3" style="font-size: 1.25rem; border-bottom: 1px solid #d88f32;display: inline-block; padding-right: 20px;">Datos de la oferta</h3>
                        <div>
                            <strong>SALARIO:</strong><br>
                            {{$offers[0]->salary}}
                            <br>
                        </div>
                        <div style="margin-top: 20px">
                            <strong>JORNADA LABORAL:</strong><br>
                            {{$offers[0]->position}}
                            <br>
                        </div>
                        <div style="margin-top: 20px">
                            <strong>TIPO DE CONTRATO:</strong><br>
                            {{$offers[0]->experience}}
                            <br>
                        </div>
                    </div>

                    @if ( $offers[0]->benefits )
                        <div class="col-12">
                            <h3 class="mb-3" style="font-size: 1.25rem; border-bottom: 1px solid #d88f32;display: inline-block; padding-right: 20px;">Beneficios</h3>

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
                            <a data-toggle="modal" data-target="#postuleModal" href="#" class="btn btn-primary">Postula
                                Acá</a>
                        @else
                            <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#loginUserModal">Inicie
                                sesión para postular</a> 
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="row justify-content-center">
        {{ $offers->links() }}
    </div>
</div>

@push('scripts')
    <script async src="https://securepubads.g.doubleclick.net/tag/js/gpt.js"></script>
    <script>
        window.googletag = window.googletag || {cmd: []};
        googletag.cmd.push(function() {
            googletag.defineSlot('/18588809/EACIZ_N', [330, 100], 'div-gpt-ad-1633611877658-0').addService(googletag.pubads());
            googletag.pubads().enableSingleRequest();
            googletag.enableServices();
        });
    </script>
@endpush
