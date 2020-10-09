<header id="header">
    <nav class="navbar navbar-expand">
        <div class="{{ config('quick.template.boxed') }}">
            <div class="navbar-nav-wrap">

                <div class="btn-menu"></div>

                <div class="navbar-brand-wrapper">
                    <a class="navbar-brand" href="#" aria-label="Front">
                        <img class="navbar-brand-logo" src="{{ config('quick.template.logo') }}" alt="Logo">
                    </a>
                </div>

                <div class="navbar-nav-wrap-content-right">
                    <ul class="navbar-nav align-items-center flex-row">
                        <li class="nav-item">
                            <div class="dropdown">
                                <a href="#" data-toggle="dropdown">
                                    <div class="avatar">
                                        <img class="avatar-img" src="https://i.ibb.co/WVtjJzF/img6.jpg" alt="Image Description">
                                        <span class="avatar-status avatar-sm-status avatar-status-success"></span>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right slideInUp">
                                    <div class="dropdown-item">
                                        <div class="media align-items-center account-user">
                                            <div class="avatar avatar-sm avatar-circle mr-2">
                                                <img src="https://i.ibb.co/WVtjJzF/img6.jpg" alt="Img">
                                            </div>
                                            <div class="media-body d-grid">
                                                <span class="title">Mark Williams</span>
                                                <span class="text">mark@example.com</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('quick.profile', Auth::id()) }}">
                                        <span class="text-truncate pr-2" title="Perfil">Perfil</span>
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <span class="text-truncate pr-2" title="Seguridad">Seguridad</span>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('quick.logout') }}">
                                        <span class="text-truncate pr-2" title="Seguridad">Cerrar sesión</span>
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>


            </div>
        </div>
    </nav>
</header>
