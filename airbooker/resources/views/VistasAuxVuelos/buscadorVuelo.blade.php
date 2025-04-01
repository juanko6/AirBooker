<!-- Formulario de búsqueda -->

<div class="container_estirado"  style="background-image: linear-gradient(rgba(0, 58, 174, 0.77), rgba(0, 58, 174, 0.4)), url('https://sotupa.pe/wp-content/uploads/2022/09/destacado-viajar-avion.jpg'); 
background-size: cover; 
background-position: center;">
    <h2 class="text-center text-uppercase mb-4" style="padding: 0px  5% 0px  5%  !important; color: white; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); font-size: clamp(24px, 5vw, 48px); font-family: 'Rubik Mono One', monospace; font-weight: 400; font-style: normal;">
        ¡Descubre el mundo con AirBooker a precios increíbles!
    </h2>
    <div class ="container_buscador">
        <div class="sombreado">
            <div class="card shadow ">
                <div class="card-body">                
                    <h3 class="text-secondary" style="border-bottom: 3px solid white; font-family: 'Open Sans', sans-serif;">
                        <i class="fas fa-plane-departure text-white"></i> 
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