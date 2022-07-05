@extends('layout.home')

@section('content')
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

        <table id="tabla-ajax">
            <thead>
            <tr>
                <th>Id</th>
                <th>Rut</th>
                <th>Rut Negocio</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Empresa</th>
                <th>Email</th>
                <th>Fecha</th>
                <th></th>
            </tr>
            </thead>
        </table>

    </div>

    <script>
        var table = $('#tabla-ajax').DataTable({
            ordering: true,
            bProcessing: true,
            bServerSide: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('members.roles') }}",
            columns: [
                {data: 'id', name: 'id', title: 'id'},
                {data: 'rut_user', name: 'rut_user', title: 'Rut'},
                {data: 'rut_business', name: 'rut_business', title: 'Rut Negocio'},
                {data: 'firstname', name: 'firstname', title: 'Nombre'},
                {data: 'surname', name: 'surname', title: 'Apellido'},
                {data: 'business_name', name: 'business_name', title: 'Empresa'},
                {data: 'email_user', name: 'email_user', title: 'Email'},
                {data: 'updated_at', name: 'updated_at', title: 'Fecha'},
                {data: 'action', name:'action', title: 'Acción', orderable: false, searcheable: false}
            ]
        });
    </script>
@endsection
