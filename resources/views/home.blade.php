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
                            <a href="{{ route('offer.list') }}" class="btn btn-control d-inline-block">Todas las Ofertas</a>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <form method="get" action="{{ route('register') }}">
                                <button class="w-100 btn btn-control" type="submit">Crea tu currículum</button>
                            </form>
                        </div>
                        <div class="col-6">
                            <form method="get" action="{{ route('business.index') }}">
                                <button class="w-100 btn btn-control" type="submit">Publica una oferta</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--@include('partials.offers.result')--}}
@endsection
