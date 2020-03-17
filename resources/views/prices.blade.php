@extends("layout.app")

@section("content")
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

    <div class="container">
        <div class="mt-3 mt-md-5 prices-table row justify-content-center">
            <div class="col-md-3">
                <div class="row">
                    <div class="col-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <td class="border-0">&nbsp;</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">Avisos básico
                                </th>
                            </tr>
                            <tr>
                                <th class="back-orange" scope="row">Avisos destacados (*)
                                </th>
                            </tr>
                            <tr>
                                <td>Actualizaciones</td>
                            </tr>
                            <tr>
                                <td>Descargar CV</td>
                            </tr>
                            <tr>
                                <td>Cuentas corporativas</td>
                            </tr>
                            <tr>
                                <td>Dashboard de administración</td>
                            </tr>
                            <tr>
                                <td>Reportes</td>
                            </tr>
                            <tr>
                                <td>Ejecutivo asignado</td>
                            </tr>
                            <tr>
                                <td>Filtro de candidatos</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <p>
                            (*) aviso en los primeros lugares de la búsqueda, mail potenciales candidatos, logo empresa,
                            primero en las búsquedas.
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <p>
                            (**) Valor cuota mensual, plan anual.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-3 col-gratis">
                        <div class="row">
                            <div class="col-12">
                                <table class="table text-center table-gratis table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="row" class="border-0">Gratis</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                    </tr>
                                    <tr>
                                        <th class="back-orange" scope="row">–</th>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-times-circle"></i></td>
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-times-circle"></i></td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-times-circle"></i></td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-times-circle"></i></td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-times-circle"></i></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <p class="py-2 bg-custom">Sin costo</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-basico">
                        <div class="row">
                            <div class="col-12">
                                <table class="table text-center table-basico table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="row" class="border-0">Básico</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">–</th>
                                    </tr>
                                    <tr>
                                        <th class="back-orange" scope="row">2</th>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-check-circle"></i></td>
                                    </tr>
                                    <tr>
                                        <td>30</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-check-circle"></i></td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-check-circle"></i></td>
                                    </tr>
                                    <tr>
                                        <td>–</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-times-circle"></i></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <p class="py-2 bg-custom">$39.990</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <a target="_blank" href="https://www.editec.cl/comercio/tienda/sin-categoria/bolsa-empleo-aviso-basico/" class="btn btn-primary w-100 py-3 text-white">CONTRATAR</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-premium">
                        <div class="row">
                            <div class="col-12">
                                <table class="table text-center table-premium table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="row" class="border-0">Premium</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">–</th>
                                    </tr>
                                    <tr>
                                        <th class="back-orange" scope="row">3</th>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-check-circle"></i></td>
                                    </tr>
                                    <tr>
                                        <td>40</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-check-circle"></i></td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-check-circle"></i></td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-check-circle"></i></td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-check-circle"></i></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <p class="py-2 bg-custom">$79.990</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <a target="_blank" href="https://www.editec.cl/comercio/tienda/sin-categoria/bolsa-empleo-aviso-premium/" class="btn btn-primary w-100 py-3 text-white">CONTRATAR</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-corporativo">
                        <div class="row">
                            <div class="col-12">
                                <table class="table text-center table-corporativo table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="row" class="border-0">Corporativo</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">–</th>
                                    </tr>
                                    <tr>
                                        <th class="back-orange" scope="row">20</th>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-check-circle"></i></td>
                                    </tr>
                                    <tr>
                                        <td>Ilimitada</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-check-circle"></i></td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-check-circle"></i></td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-check-circle"></i></td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-check-circle"></i></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <p class="py-2 bg-custom">$169.990 (**)</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <a target="_blank" href="https://www.editec.cl/comercio/tienda/sin-categoria/bolsa-empleo-aviso-corporativo/" class="btn btn-primary w-100 py-3 text-white">CONTRATAR</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push("styles")
    <style>
        .col-gratis .table thead, .col-gratis .bg-custom {
            background-color: #D88F32;
            color: #fff;
        }
        .col-basico .table thead, .col-basico .bg-custom {
            background-color: #78acd8;
            color: #fff;
        }
        .col-premium .table thead, .col-premium .bg-custom  {
            background-color: #223278;
            color: #fff;
        }
        .col-corporativo .table thead, .col-corporativo .bg-custom {
            background-color: #070d39;
            color: #fff;
        }
        .table thead {
            text-transform: uppercase;
        }
        .back-orange {
            background-color: #D88F32;
            color: #fff;
        }
        .fas {
            font-size: 17px;
        }
        .fa-check-circle {
            color: #168507;
        }
        .fa-times-circle {
            color: #dd3f4d;
        }
    </style>
@endpush

