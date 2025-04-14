<!-- Navbar -->
<div class="header-container">
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

                    <!-- Links condicionales -->
                    @auth
                        @if(Auth::user()->rol === 'Cliente')
                            <li class="opciones-menu">
                                <a class="nav-link" href="{{ url('/carrito') }}">
                                    <i class="fas fa-shopping-cart"></i> CARRITO
                                </a>
                            </li>

                            <li class="opciones-menu">
                                <a class="nav-link"  href="{{ url('/perfil') }}"><i class="fas fa-user me-2"></i> PERFIL</a>
                            </li>
                        @elseif(Auth::user()->rol === 'Administrador')
                            <li class="opciones-menu">
                                <a  class="nav-link"  href="{{ url('/admin') }}"><i class="fas fa-user me-2"></i> DASHBOARD</a>
                            </li>
                            
                        @endif
                        <li class="opciones-menu">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-access ms-3 pulse">
                                    <i class="fas fa-user me-2"></i> Log out
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