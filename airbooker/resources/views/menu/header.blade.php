

<!-- Navbar -->
<div class="header-container"> 
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('logo-v2.png') }}" alt="Airbooker Logo">
            </a>

            <!-- Botón toggle para móviles -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menú principal -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
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
                    <li class="opciones-menu">
                        <a class="nav-link" href="{{ url('/admin') }}">DASHBOARD</a>
                    </li>

                </ul>
                <!-- Botón Acceder -->
                <a href="{{ url('auth/login') }}" class="btn btn-access ms-3">
                    <i class="fas fa-user me-2"></i> ACCEDER
                </a>
            </div>
        </div>
    </nav>        
</div>