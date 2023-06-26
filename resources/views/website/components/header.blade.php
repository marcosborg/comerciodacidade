<!-- ======= Header ======= -->
<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">

        <div class="logo me-auto">
            <a href="/"><img src="/theme/assets/img/logo.png" alt="" class="img-fluid"></a>
        </div>

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a class="nav-link scrollto active" href="{{ Route::currentRouteName('homepage') ? '' : '/' }}#hero">Início</a></li>
                <li><a class="nav-link scrollto" href="{{ Route::currentRouteName('homepage') ? '' : '/' }}#about">Sobre</a></li>
                <li><a class="nav-link scrollto" href="{{ Route::currentRouteName('homepage') ? '' : '/' }}#services">Serviços</a></li>
                <li><a class="nav-link" href="/registo">Registo</a></li>
                <li><a class="nav-link" href="/lojas/produto/300/rufel-mala-mariana-machado">Lojas</a></li>
                <li><a class="nav-link scrollto" href="{{ Route::currentRouteName('homepage') ? '' : '/' }}#contact">Contactos</a></li>
                @if (auth()->check())
                <li><a href="/admin" class="nav-link">Área reservada</a></li>
                @else
                <li><a href="/login" class="nav-link">Login</a></li>
                @endif
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->