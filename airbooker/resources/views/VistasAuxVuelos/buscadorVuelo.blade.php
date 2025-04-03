<!-- Formulario de búsqueda -->
<div class="container_estirado" style="position: relative; overflow: hidden;">
    <!-- Video de fondo -->
    <video autoplay muted loop style="position: absolute; top: 50%; left: 50%; width: 100%; height: 100%; object-fit: cover; transform: translate(-50%, -50%); z-index: -2;">
        <source src="{{ asset('videos/compressed_publicidad.mp4') }}" type="video/mp4">
        Tu navegador no soporta videos HTML5.
    </video>

    <!-- Capa de color y efecto blur -->
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 68, 203, 0.4); backdrop-filter: blur(5px); z-index: -1;"></div>

    <!-- Contenido encima del video -->
    <div style="position: relative; z-index: 1;">
        <h2 class="text-center text-uppercase mb-4" style="padding: 0px 5% 0px 5% !important; color: white; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); font-size: clamp(24px, 5vw, 48px); font-family: 'Rubik Mono One', monospace; font-weight: 400; font-style: normal;">
            ¡Descubre el mundo con AirBooker a precios increíbles!
        </h2>
        <div class="container_buscador">
            <div class="sombreado">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="text-secondary" style="border-bottom: 3px solid #1C49A9; font-family: 'Open Sans', sans-serif; padding: 0px 0px 10px 0px;">
                            <i class="fas fa-plane-departure" style="color: #1C49A9;"></i> 
                            Busca, Reserva y Viaja
                        </h3>
                        <form id="buscadorForm" action="{{ route('vuelos.disponibles') }}" method="GET">
                            <div class="row g-3">
                                <!-- Origen -->
                                <div class="col-md-6">
                                    <label for="origen" class="form-label" style="font-family: 'Open Sans', sans-serif;">Ciudad de Origen</label>
                                    <input type="text" class="form-control" id="origen" name="origen" placeholder="Ej. Madrid" required>
                                </div>

                                <!-- Destino -->
                                <div class="col-md-6">
                                    <label for="destino" class="form-label" style="font-family: 'Open Sans', sans-serif;">Ciudad de Destino</label>
                                    <input type="text" class="form-control" id="destino" name="destino" placeholder="Ej. Barcelona" required>
                                </div>

                                <!-- Fecha de salida -->
                                <div class="col-md-6">
                                    <label for="fecha" class="form-label" style="font-family: 'Open Sans', sans-serif;">Fecha de Salida</label>
                                    <input type="date" class="form-control" id="fecha" name="fecha" min="{{ date('Y-m-d') }}" required>
                                </div>

                                <!-- Botón de búsqueda -->
                                <div class="col-12 text-center">
                                    <button type="submit" class="styl-btn-buscador-vuelos" style="font-family: 'Open Sans', sans-serif;">
                                        <span><i class="fas fa-search"></i> Buscar</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>