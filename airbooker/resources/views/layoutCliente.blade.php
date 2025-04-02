@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

<div class="d-flex flex-column vh-100">
    <!-- Barra superior -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
        <a class="navbar-brand" href="#">Airbooker</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                {{--Aqui se ha puesto el id 12 como prueba, mas adelante usará el id devuelto por autentificación--}}
                <li class="nav-item"><a href="#" class="nav-link" onclick="loadContent('perfil/12'); return false;">👤 Perfil</a></li>
                <li class="nav-item"><a href="#" class="nav-link">🔔 Notificaciones</a></li>
                <li class="nav-item"><a href="#" class="nav-link">⚙️ Configuración</a></li>
            </ul>
        </div>
    </nav>

    <div class="d-flex flex-grow-1">
        <!-- Barra lateral fija -->
        <nav class="sidebar bg-light p-3 vh-100">
            <ul class="nav flex-column">
                <li class="nav-item"><a href="#" class="nav-link" onclick="loadContent('reservas'); return false;">📅 Mis Reservas</a></li>
                <li class="nav-item"><a href="#" class="nav-link" onclick="loadContent('cartera'); return false;">💵 Mi Cartera</a></li>
                <li class="nav-item"><a href="{{ url('/') }}" class="nav-link" >🔎 Buscar Vuelos ✈️</a></li>
                
            </ul>
        </nav>

        <!-- Contenido dinámico -->
        <main class="container-fluid p-4 flex-grow-1">
            <div id="content">
                @yield('DashboardContent') {{-- Aquí se cargarán dinámicamente las vistas --}}
            </div>
        </main>
    </div>
</div>

<script>
function loadContent(view) {
    $.ajax({
        url: "/" + view,
        type: "GET",
        dataType: "html",
        success: function (data) {
            if (!data.includes("<html")) { // ✅ Verifica que no esté cargando todo el layout
                $("#content").html(data);
            } else {
                window.location.href = "/" + view; // ✅ Si recarga el layout, redirige a la URL completa
            }
        },
        error: function () {
            alert("Error al cargar la vista.");
        }
    });
}

</script>

@stack('scripts')
