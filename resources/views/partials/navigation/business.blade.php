<div class="navbar-nav ml-auto">
    <a class="btn" href="{{ route('post.create') }}" type="button">Agregar Aviso</a>
    <div class="dropdown">
        <button class="btn dropdown-toggle" type="button" id="dropDownUser"
                data-toggle="dropdown" aria-expanded="false"
                aria-haspopup="true">{{session()->get('name') ?? ''}} | Business
        </button>
        <div class="dropdown-menu" aria-labelledby="dropDownUser">
            <a class="nav-link" href="#">Perfil Empresa</a>
            <a class="nav-link" href="#">Administrar Ofertas</a>
            <div class="dropdown-divider"></div>
            <a class="nav-link" href="{{ route('logout') }}">Cerrar Sesión</a>
        </div>
    </div>
</div>
