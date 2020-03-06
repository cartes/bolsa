@extends('layout.app')

@section('title', 'Perfil de Usuario')

@section('content')

    <div class="container">
        @if(session()->has('message'))
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="alert alert-{{session('message')[0]}}" role="alert">
                        {{session('message')[1]}}
                    </div>
                </div>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-9">
                @include('partials.profile.personal')
                @include('partials.profile.experience')
                @include('partials.profile.education')
                @include('partials.profile.skills')
                @include('partials.profile.references')
                @include('partials.profile.resume')
                {{--@include('partials.profile.contact')--}}
            </div>
            <div class="col-md-3 py-3">
                <h3>Perfil</h3>
            </div>
        </div>
        {{--@include('partials.profile.languages')--}}

    </div>

@endsection