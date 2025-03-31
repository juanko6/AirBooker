<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Airbooker')</title>    
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome para el icono de usuario -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">    
    
    <!-- Bootstrap 5 JS y Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vuelos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contactanos.css') }}"> <!-- CSS específico para la página de contacto -->
    
    <!-- Scripts personalizados -->
    <script src="{{ asset('js/listas.js') }}"></script>
    <script src="{{ asset('js/header.js') }}"></script>

    @stack('styles') <!-- Para estilos específicos de la vista -->
</head>
<body>
    <!-- Header común -->
    <header>
       @include('menu.header') <!-- Incluye el menú de navegación -->
    </header>

    <!-- Contenido principal -->
    <main class="container">
        @yield('content') <!-- Aquí se inyecta el contenido de la vista hija -->
    </main>

    <!-- Footer común -->
    
    @include('menu.footer') <!-- Incluye el pie de página -->
    

    <!-- Scripts globales -->
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts') <!-- Para scripts específicos de la vista -->
</body>
</html>