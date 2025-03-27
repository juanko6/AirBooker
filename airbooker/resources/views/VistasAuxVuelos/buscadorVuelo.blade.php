
<!-- Formulario de búsqueda -->
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-body">
            <h5 class="card-title text-center mb-4">Buscar Vuelos</h5>
            <form id="buscadorForm" action="{{ route('vuelos.disponibles') }}" method="GET">
                <div class="row g-3">
                    <!-- Origen -->
                    <div class="col-md-6">
                        <label for="ciudad_origen" class="form-label">Ciudad de Origen</label>
                        <input type="text" class="form-control" id="ciudad_origen" name="ciudad_origen" value ="París" required>
                    </div>

                    <!-- Destino -->
                    <div class="col-md-6">
                        <label for="ciudad_destino" class="form-label">Ciudad de Destino</label>
                        <input type="text" class="form-control" id="ciudad_destino" name="ciudad_destino" value ="Roma" required>
                    </div>

                    <!-- Fecha de salida -->
                    <div class="col-md-6">
                        <label for="fecha_salida" class="form-label">Fecha de Salida</label>
                        <input type="date" class="form-control" id="fecha_salida" name="fecha_salida" required>
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

<script>
    // Validación básica en tiempo real
    document.getElementById('buscadorForm').addEventListener('submit', function(e) {
        const origen = document.getElementById('ciudad_origen').value.trim();
        const destino = document.getElementById('ciudad_destino').value.trim();
        const fecha = document.getElementById('fecha_salida').value;

        if (!origen || !destino || !fecha) {
            e.preventDefault();
            alert('Todos los campos son obligatorios');
        }
    });
</script>