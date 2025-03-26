@include('menu.header')
<!-- Formulario de búsqueda -->
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-body">
            <h5 class="card-title text-center mb-4">Buscar Vuelos</h5>
            <form id="buscadorForm" action="{{ route('buscador.vuelos') }}" method="GET">
                <div class="row g-3">
                    <!-- Origen -->
                    <div class="col-md-6">
                        <label for="ciudad_origen" class="form-label">Ciudad de Origen</label>
                        <input type="text" class="form-control" id="ciudad_origen" name="ciudad_origen" required>
                    </div>

                    <!-- Destino -->
                    <div class="col-md-6">
                        <label for="ciudad_destino" class="form-label">Ciudad de Destino</label>
                        <input type="text" class="form-control" id="ciudad_destino" name="ciudad_destino" required>
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

    <!-- Resultados de búsqueda -->
    <div class="mt-4" id="resultadosContainer">
        @if(isset($vuelos))
         
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>N° Vuelo</th>
                            <th>Aerolínea</th>
                            <th>Origen</th>
                            <th>Destino</th>
                            <th>Fecha y Hora</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vuelos as $vuelo)
                            <tr>
                                <td>{{ $vuelo->id }}</td>
                                <td>{{ $vuelo->aerolinea->nombre }}</td>
                                <td>{{ $vuelo->origen }}</td>
                                <td>{{ $vuelo->destino }}</td>
                                <td>{{ $vuelo->fecha }} {{ $vuelo->hora }}</td>
                                <td>
                                    @if($vuelo->oferta)
                                        <del>${{ number_format($vuelo->precio, 2) }}</del>
                                        <span class="text-success fw-bold">
                                            ${{ number_format($vuelo->precio_con_descuento, 2) }}
                                        </span>
                                    @else
                                        ${{ number_format($vuelo->precio, 2) }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@include('menu.footer')
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