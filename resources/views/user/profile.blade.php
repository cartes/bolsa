@extends('layout.app')

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

        @include('partials.profile.personal')

        @include('partials.profile.salary')

        @include('partials.profile.contact')

        @include('partials.profile.experience')

        @include('partials.profile.education')

        @include('partials.profile.objectives')

        @include('partials.profile.languages')

        @include('partials.profile.skills')
    </div>

@endsection