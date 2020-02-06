<ul class="navbar-nav ml-auto">
    <li class="nav-item">
        <button type="button" class="btn" data-toggle="modal" data-target="#loginUserModal">Ingresa</button>
    </li>
    <li class="nav-item">
        <a href="{{route('register')}}" class="nav-link">Regístrate</a>
    </li>
    <li>
        <div class="dropdown">
            <button class="btn dropdown-toggle" type="button" id="dropDownUser"
                    data-toggle="dropdown" aria-expanded="false"
                    aria-haspopup="true">{{session()->get('name') ?? ''}} Soy Empresa
            </button>
            <div class="dropdown-menu" aria-labelledby="dropDownUser">
                <a class="nav-link" href="{{ route('post.create') }}">Regístrate</a>
                <a href="{{route('post.create')}}" class="nav-link">Publica Gratis</a>
                <a class="nav-link" href="{{ route('business.index') }}">Ya tengo Cuenta</a>
            </div>
        </div>

        {{--<a href="{{ route('business.index') }}" class="nav-link">Soy Empresa</a>--}}
    </li>
</ul>
