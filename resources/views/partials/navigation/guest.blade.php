<ul class="navbar-nav ml-auto">
    <li class="nav-item">
       <a class="nav-link" href="{{ route("prices") }}">Nuestros Precios</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Contacto</a>
    </li>
    <li>
        <div class="dropdown">
            <button class="btn dropdown-toggle border-0 py-2" type="button" id="dropDownUser"
                    data-toggle="dropdown" aria-expanded="false"
                    aria-haspopup="true">{{session()->get('name') ?? ''}} Iniciar sesión
            </button>
            <div class="dropdown-menu" aria-labelledby="dropDownUser">
                <button type="button" class="btn" data-toggle="modal" data-target="#loginUserModal"><i class="fas fa-user"></i> Personas</button>
                <button type="button" class="btn" data-toggle="modal" data-target="#loginBusiness"><i class="fas fa-building"></i> Empresas</button>
            </div>
        </div>
    </li>
</ul>
