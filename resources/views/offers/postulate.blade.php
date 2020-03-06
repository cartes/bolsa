@extends('layout.app')

@section('title', ' | ' . $offer->title)

@section('content')

    <div class="container">
        @if(session()->has('message'))
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="alert alert-{{session('message')[0]}}" role="alert">
                        {{session('message')[1]}}
                    </div>
                </div>
            </div>
        @endif

        @include("partials.modals.loginHome")

        @include("partials.offers.postulate")

    </div>

@endsection