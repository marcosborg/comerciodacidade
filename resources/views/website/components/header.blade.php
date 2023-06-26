<!-- ======= Header ======= -->
<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">

        <div class="logo me-auto">
            <a href="/"><img src="/theme/assets/img/logo.png" alt="" class="img-fluid"></a>
        </div>

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a class="nav-link scrollto active"
                        href="{{ Route::currentRouteName('homepage') ? '' : '/' }}#hero">Início</a></li>
                <li><a class="nav-link scrollto"
                        href="{{ Route::currentRouteName('homepage') ? '' : '/' }}#about">Sobre</a></li>
                <li><a class="nav-link scrollto"
                        href="{{ Route::currentRouteName('homepage') ? '' : '/' }}#services">Serviços</a></li>
                <li><a class="nav-link" href="/registo">Registo</a></li>
                <li><a class="nav-link scrollto"
                        href="{{ Route::currentRouteName('homepage') ? '' : '/' }}#contact">Contactos</a></li>
                @if (auth()->check())
                <li><a href="/admin" class="nav-link">Área reservada</a></li>
                @else
                <li><a href="/login" class="nav-link">Login</a></li>
                @endif
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-cart-fill" viewBox="0 0 16 16">
                            <path
                                d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                        </svg>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="p-2 pb-0" id="inner_nav_cart"></li>
                    </ul>
                </li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->
    </div>
</header><!-- End Header -->
