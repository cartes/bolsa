@extends('layout.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h4>
                                    Empresa {{ $business->business_meta->fantasy_name }}
                                </h4>
                            </div>
                            <div class="col-6">
                                <p>Esta empresa tiene {{ $business->offers_count }} ofertas publicadas</p>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-6">
                                <p>Dirección: {{ $business->business_meta->address }}</p>
                                <p>Comuna: {{ $business->business_meta->comune }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection