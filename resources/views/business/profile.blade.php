@extends('layout.app')

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

        @include('partials.business.meta')
        @include('partials.modals.businessRegistered')
    </div>
@endsection

@if ($business->offers_count == 0 && $business->business_meta)
    @push('scripts')
        <script>
            jQuery(document).ready(function ($) {
                $('#registeredBusinessModal').modal('show');
            })
        </script>
    @endpush
@endif
