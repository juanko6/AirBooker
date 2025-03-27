<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airbooker - Reserva de Vuelos</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome para el icono de usuario -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">    
    <!-- Bootstrap 5 JS y Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('css/contactanos.css') }}"> <!-- CSS específico para la página de contacto -->
    

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('js/listas.js') }}"></script>
    <script src="{{ asset('js/header.js') }}"></script>
</head>
<body>   

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
                            <a class="nav-link" href="{{ url('/#ofertas') }}">OFERTA</a>
                        </li>
                        <li class="opciones-menu">
                            <a class="nav-link" href="{{ url('/#faq') }}">FAQ</a>
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
</body>
</html>