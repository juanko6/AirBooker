<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel de Administración')</title>
    
    <!-- CSS Bootstrap y estilos personalizados -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('styles')
</head>
<body>

<div class="d-flex flex-column vh-100">
    <!-- Barra superior -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
        <a class="navbar-brand" href="#">Airbooker</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a href="#" class="nav-link" onclick="loadContent('perfil'); return false;">👤 Perfil</a></li>
                <li class="nav-item"><a href="#" class="nav-link">🔔 Notificaciones</a></li>
                <li class="nav-item"><a href="#" class="nav-link">⚙️ Configuración</a></li>
            </ul>
        </div>
    </nav>

    <div class="d-flex flex-grow-1">
        <!-- Barra lateral fija -->
        <nav class="sidebar bg-light p-3 vh-100">
            <ul class="nav flex-column">
                <li class="nav-item"><a href="#" class="nav-link" onclick="loadContent('dashboard'); return false;">📊 Dashboard</a></li>
                <li class="nav-item"><a href="#" class="nav-link" onclick="loadContent('users'); return false;">👥 Clientes</a></li>
                <li class="nav-item"><a href="#" class="nav-link" onclick="loadContent('reservas'); return false;">📅 Reservas</a></li>
                <li class="nav-item"><a href="#" class="nav-link" onclick="loadContent('vuelos'); return false;">✈️ Vuelos</a></li>
            </ul>
        </nav>

        <!-- Contenido dinámico -->
        <main class="container-fluid p-4 flex-grow-1">
            <div id="content">
                @yield('content') {{-- Aquí se cargarán dinámicamente las vistas --}}
            </div>
        </main>
    </div>
</div>

<script>
function loadContent(view) {
    $.ajax({
        url: "/admin/" + view,
        type: "GET",
        dataType: "html",
        success: function (data) {
            if (!data.includes("<html")) { // ✅ Verifica que no esté cargando todo el layout
                $("#content").html(data);
            } else {
                window.location.href = "/admin/" + view; // ✅ Si recarga el layout, redirige a la URL completa
            }
        },
        error: function () {
            alert("Error al cargar la vista.");
        }
    });
}

</script>

@stack('scripts')
</body>
</html>
