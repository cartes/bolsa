@extends("layout.app")

@section("content")
    <div class="container-fluid">
        @if(null!==session('message'))
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="alert alert-{{session('message')[0]}}" role="alert">
                        {{session('message')[1]}}
                    </div>
                </div>
            </div>
        @endif

        @include('partials.modals.loginHome')           {{-- Modals login usuario --}}
        @include('partials.modals.loginBusiness')       {{-- Modals login business --}}
        @include("partials.modals.register")            {{-- Modals registro usuario --}}
        @include('partials.modals.registerBusiness')    {{-- Modals registro business --}}

        @include('partials.offers.result')


        <div class="modal fade" id="postuleModal" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content py-3 px-4">
                    <div class="modal-header">
                        <h4>Deseas postular al aviso {{ $offers[0]->title ?? '' }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="far fa-times-circle"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 text-right">
                                <a href="#" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                                    Cancelar
                                </a>
                            </div>
                            <div class="col-md-6 text-left">
                                <a class="btn btn-primary" href="{{ route('offer.postulate', $offers[0]->slug) }}">Postular</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
