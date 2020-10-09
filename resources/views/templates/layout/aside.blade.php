<aside id="aside">

    <div class="aside-container">

        <header>
            <hr class="line d-none d-md-block">
            <div class="info">
                <p class="text">Hola, {{ get_greeting() }}</p>
                <h2 class="name">{{ Auth::user()->names }}</h2>
            </div>
            <hr class="line d-md-none">
        </header>

        <ul class="menu">

            <li>
                <a href="#">
                    <i data-feather="home"></i>
                    <span class="text-truncate">Dashboards</span>
                </a>
                <ul>
                    <li>
                        <span class="text-truncate">Dashboards</span>
                    </li>
                </ul>
            </li>

            <li>
                <a href="{{ route('users.index') }}">
                    <i data-feather="users"></i>
                    <span>Usuarios</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <i data-feather="layers"></i>
                    <span class="text-truncate">Root</span>
                </a>
                <ul>

                    @can('value.index')
                        <li>
                            <a href="{{ route('value.index') }}">
                                <span class="text-truncate">Parámetros</span>
                            </a>
                        </li>
                    @endcan

                    @can('role.index')
                        <li>
                            <a href="{{ route('role.index') }}">
                                <span class="text-truncate">Roles</span>
                            </a>
                        </li>
                    @endcan

                    @can('permission.index')
                        <li>
                            <a href="{{ route('permission.index') }}">
                                <span class="text-truncate">Permisos</span>
                            </a>
                        </li>
                    @endcan
                </ul>

        </ul>
    </div>
</aside>
