@extends('layout.app')

@section('content')
    <div class="container-fluid">
        @if(session()->has('message'))
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="alert alert-{{session('message')[0]}}" role="alert">
                        {{session('message')[1]}}
                    </div>
                </div>
            </div>
        @endif

        @include('partials.business.candidates')

        <div id="messageModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"
             aria-labelledby="messageModal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="titleModal" class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="sendMessageForm" class="form" method="post" action="{{ route("message.send") }}">
                            @csrf
                            <input id="user_id_input" type="hidden" name="user_id">
                            <input id="offer_id_input" type="hidden" name="offer_id">
                            <div class="row form-group">
                                <label>Mensajes</label>
                                <textarea id="messages_log" class="form-control w-100"></textarea>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label>Mensaje: </label>
                                </div>
                                <input class="form-control col-md-8" type="text" id="message_content"
                                       name="content"/>
                                <div class="col-md-2">
                                    <button class="btn btn-primary" type="submit">
                                        Enviar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push("styles")
    <style media="all">
        textarea#messages_log {
            overflow-y: scroll;
            height: 350px;
            resize: none;
        }
    </style>
@endpush

@push('scripts')
    <script>
        jQuery(document).ready(function ($) {
            $('.submitSendMessage').click(function (e) {
                e.preventDefault();
                var user = $("input[name='user']").val();
                var offer = $("input[name='offer']").val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'post',
                    url: '{{ route('message.show') }}',
                    data: {
                        'user': user,
                        'offer': offer
                    },
                    success: function (resp) {
                        var titleModal = "Mensaje a " + resp.user.name + " " + resp.user.surname;
                        $("#titleModal").empty().append(titleModal);
                        $("#messageModal").modal("show");
                        $("#user_id_input").val(user);
                        $("#offer_id_input").val(offer);
                    },
                    error: function (resp) {
                        console.error(resp)
                    }
                })
            });
        })
    </script>
@endpush
