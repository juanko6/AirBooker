<!-- Formulario de búsqueda -->
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-body">
            <h5 class="card-title text-center mb-4">Buscar Vuelos</h5>
            <form id="buscadorForm" action="{{ route('vuelos.disponibles') }}" method="GET">
                <div class="row g-3">
                    <!-- Origen -->
                    <div class="col-md-6">
                        <label for="origen" class="form-label">Ciudad de Origen</label>
                        <input type="text" class="form-control" id="origen" name="origen" placeholder="Ej. Madrid" required>
                    </div>

                    <!-- Destino -->
                    <div class="col-md-6">
                        <label for="destino" class="form-label">Ciudad de Destino</label>
                        <input type="text" class="form-control" id="destino" name="destino" placeholder="Ej. Barcelona" required>
                    </div>

                    <!-- Fecha de salida -->
                    <div class="col-md-6">
                        <label for="fecha" class="form-label">Fecha de Salida</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" min="{{ date('Y-m-d') }}" required>
                    </div>

                    <!-- Botón de búsqueda -->
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-warning text-white">
                            <i class="fas fa-search"></i> Buscar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>