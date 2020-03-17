@extends('layout.home')

@section('content')

    <div class="container">
        @if(null!==session('message'))
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="alert alert-{{session('message')[0]}}" role="alert">
                        {{session('message')[1]}}
                    </div>
                </div>
            </div>
        @endif

        @include('partials.modals.loginHome')
        @include('partials.modals.loginBusiness')
        @include("partials.modals.register")
        @include('partials.modals.registerBusiness')
        @include('partials.modals.loginBusinessToPost')
    </div>

    <div class="position-absolute w-100">
        <div class="container">
            <div class="row">
                <div class="col-md-6 form-search">
                    <div class="row ">
                        <div class="col-12">
                            <form method="post" action="{{ route('search') }}">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="query"
                                               placeholder="Busca tu nuevo trabajo"/>
                                        <span class="input-group-btn input-group-append">
                                            <button class="btn" type="submit">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <a href="{{ route('offer.list') }}" class="btn btn-control d-inline-block">Todas las
                                Ofertas</a>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            @if (session()->get('id'))
                                <a href="{{ route('profile') }}" class="w-100 btn btn-control" type="submit">Crea tu
                                    currículum</a>
                            @else
                                <button type="button" class="w-100 btn btn-control" data-toggle="modal" data-target="#loginUserModal">Crea
                                    tu currículum
                                </button>
                            @endif
                        </div>
                        <div class="col-6">
                            @if (session()->get('role') == 'business')
                                <a href="{{ route('post.create') }}" class="w-100 btn-control btn">
                                    Publica una oferta
                                </a>
                            @else
                                <button type="button" class="w-100 btn btn-control" data-toggle="modal" data-target="#loginBusinessToPost">
                                    Publica una oferta
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--@include('partials.offers.result')--}}
@endsection

@push('scripts')
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            })
        }, 2000)
    </script>
@endpush
