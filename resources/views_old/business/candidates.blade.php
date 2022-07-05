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

        @include('partials.business.candidatedetail')

        @include('partials.modals.message')
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
            $('.alert').stop();
            $('.submitSendMessage').click(function (e) {
                e.preventDefault();
                var user = $(this).parent().find("input[name='user']").val();
                var offer = $(this).parent().find("input[name='offer']").val();

                console.log(user);

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
                        $("#messages_log").empty();
                        let messages = resp.messages;
                        for (var i = 0; i < messages.length; i++) {
                            let tag;
                            if (resp.messages[i].sender_id == resp.reader) {
                                tag = "<li class='clearfix'><p class='message message-send float-left alert-success d-block'>";
                            } else {
                                tag = "<li class='clearfix'><p class='message message-reply float-right alert-secondary'>";
                            }
                            var html = tag + messages[i].content + "<small class='message-time'>" + messages[i].created_at + "</small>" + "</p></div>";
                            $("#messages_log").append(html);
                        }
                    },
                    error: function (resp) {
                        console.error(resp)
                    }
                })
            });
        })
    </script>
@endpush
