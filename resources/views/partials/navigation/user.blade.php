<div class="navbar-nav ml-auto">
    <div class="dropdown">
        <button class="btn dropdown-toggle ml-auto" type="button" id="dropDownUser"
                data-toggle="dropdown" aria-expanded="false"
                aria-haspopup="true">{{session()->get('name') ?? ''}}</button>
        <div class="dropdown-menu" aria-labelledby="dropDownUser">
            <li>
                <a class="nav-link" href="{{route('profile')}}">Mi perfil</a>
            </li>
            <li>
                <a class="nav-link" href="#">Ofertas Postuladas</a>
            </li>
            <li><a class="nav-link" href="{{route('logout')}}">Cerrar Sesión</a></li>
        </div>
    </div>
</div>
