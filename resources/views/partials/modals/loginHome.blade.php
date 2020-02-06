<div class="modal fade" id="loginUserModal" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            @if(!session()->has('id'))
                <div class="modal-header">
                    <h4 class="modal-title">Ingresar a {{config('app.name')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="my-3" method="post" action="{{route('login')}}">
                        @csrf
                        <div class="form-group">
                            <input class="form-control" type="text" id="email" name="email"
                                   placeholder="Email"/>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="password" id="password" name="password"
                                   placeholder="Password"/>
                        </div>

                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
