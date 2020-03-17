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

        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h4 class="text-uppercase text-center">{{$business->business_meta->business_name}}</h4>
                                <a class="btn btn-outline-primary" href="{{ route('business.profile') }}">Editar perfil</a>
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-12">
                                <h5>Información de contacto</h5>
                                <p class="py-0 my-0">Nombre: {{ $business->firstname }} {{ $business->surname }}</p>
                                <p class="py-0 my-0">Email: {{ $business->email }}</p>
                                <p class="pt-0 my-0">Teléfono: {{ $business->phone }}</p>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <h5>Información de contacto empresa</h5>
                                <p class="py-0 my-0">Email: {{ $business->business_meta->email }}</p>
                                <p class="pt-0 my-0">Teléfono: {{ $business->business_meta->phone }}</p>
                                <p class="pt-0 my-0">Teléfono: {{ $business->business_meta->activity }}</p>
                                <p class="pt-0 my-0">Rubro: {{ $business->business_meta->activity }}</p>
                                <p class="pt-0 my-0">Dirección: {{ $business->business_meta->address }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                @include('partials.business.offer')
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <script>
        jQuery(document).ready(function ($) {
            $(document).ready(function () {
                tinymce.init({
                    selector: '#contents',
                    schema: 'html5',
                    themes: 'modern',
                    language: 'es_ES',
                    menubar: false,
                    plugins: "lists",
                    skin: 'oxide',
                    statusbar: false,
                    toolbar: [
                        'bold italic underline numlist bullist',
                        'code'
                    ],
                });
            });
        });
    </script>
    <script>
        jQuery(document).ready(function ($) {
            $('#addBenefit').click(function (e) {
                e.preventDefault();
                var container = $("input[name='benefit']");
                var benefit = container.val();
                if ($('.btn-benefit').length) {
                    var lastid = $('.btn-benefit:last').attr('id');
                }
                var split_id = lastid.split("_");
                var nextdiv = Number(split_id[1]) + 1;

                if (benefit == '') {
                    container.addClass('is-invalid');
                } else {
                    $("#listBenefits").addClass("my-3").append(
                        "<div id='div_" + nextdiv + "' class='btn-benefit mr-3 mb-2 btn btn-secondary'>" + benefit +
                        "<input name='benefits[]' type='hidden' value='" + benefit + "' />" +
                        "</div>"
                    );
                    container.val('');
                }
            });

            $('#listBenefits').on("click", ".btn-benefit", function (e) {
                var id = $(this).attr('id');
                $("#" + id).remove();
            })
        });

    </script>
@endpush
