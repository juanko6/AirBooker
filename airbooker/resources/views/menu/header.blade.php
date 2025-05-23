<div class="header-container">    

    <!-- Navbar --> 
    <div class="top-bar bg-dark text-white py-2">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="top-bar-left">
                <div class="ocultar-informacion-telef-email-top-bar">
                    <span><i class="fas fa-phone-alt me-2" id="telefono-top-bar"></i> +34 *** *** ***</span>
                    <span class="ms-4"><i class="fas fa-envelope me-2" id="email-top-bar"></i> support@airbooker.com</span>
                </div>
            </div>
            <div class="top-bar-right">
                @auth
                        @if(Auth::user()->rol === 'Cliente')
                            <li class="opciones-menu d-flex align-items-center">
                                <a class="nav-link d-flex align-items-center" href="{{ url('/user/cartera') }}">
                                    <i class="fas fa-coins me-2" style="color: #FFC107; font-size: 1.2rem;"></i>
                                    <span class="fw-bold text-warning">{{Auth::user()->getCreditos()}}</span>
                                </a>
                            </li>
                        @endif
                    @endauth                 
            </div>
        </div>
    </div>
    <!-- Navbar -->

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/logo-v2.png') }}" alt="Airbooker Logo">
            </a>

            <!-- Botón toggle para móviles -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menú principal -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                     <!-- Links comunes -->
                    <li class="opciones-menu">
                        <a class="nav-link" href="{{ url('/') }}">INICIO</a>
                    </li>
                    <li class="opciones-menu">
                        <a class="nav-link" href="{{ url('/#offers-section') }}">OFERTA</a>
                    </li>
                    <li class="opciones-menu">
                        <a class="nav-link" href="{{ url('/#faq-section') }}">FAQ</a>
                    </li>
                    <li class="opciones-menu">
                        <a class="nav-link" href="{{ url('/contactanos') }}">CONTACTO</a>
                    </li>
                    @auth
                        @if(Auth::user()->rol === 'Cliente')
                            <li class="opciones-menu">
                                <a class="nav-link" href="{{ url('/carrito') }}">
                                    <i class="fas fa-shopping-cart"></i> CARRITO
                                </a>
                            </li>
                            <li class="opciones-menu">
                                <a class="nav-link" href="{{ url('/user/perfil') }}"><i class="fas fa-user me-2"></i> PERFIL</a>
                            </li>
                        @elseif(Auth::user()->rol === 'Administrador')
                            <li class="opciones-menu">
                                <a class="nav-link" href="{{ url('/admin') }}"><i class="fas fa-user me-2"></i> DASHBOARD</a>
                            </li>
                        @endif
                        <li class="opciones-menu">
                            <form method="POST" action="{{ route('logout.post') }}">
                                @csrf
                                <button type="submit" class="btn btn-access ms-3 pulse">
                                    <i class="fas fa-sign-out-alt me-2"></i> Log out
                                </button>
                            </form>
                        </li>
                    @endauth
                </ul>

                <!-- Botón Acceder -->
                @guest
                    <a href="{{ url('auth/login') }}" class="btn btn-access ms-3 pulse">
                        <i class="fas fa-user me-2"></i> ACCEDER
                    </a>
                @endguest
            </div>
        </div>
    </nav>
</div>