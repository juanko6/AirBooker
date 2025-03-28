  <div class="styl-card-vuelos-disponibles">
    
    <div class="mb-4">
        <form method="GET" action="{{ route('vuelos.disponibles') }}" id="filter-form">
            <!-- Mantener parámetros de búsqueda originales -->
            <input type="hidden" name="origen" value="{{ $filtros['origen'] }}">
            <input type="hidden" name="destino" value="{{ $filtros['destino'] }}">
            <input type="hidden" name="fecha" value="{{ $filtros['fecha'] }}">
            <input type="hidden" name="aerolinea" value="{{ implode(',', $filtros['aerolinea'] ?? []) }}">
            <input type="hidden" name="precio_min" value="{{ $filtros['precio_min'] }}">
            <input type="hidden" name="precio_max" value="{{ $filtros['precio_max'] }}">

            <div class="d-flex justify-content-between align-items-center">
                <!-- Filtros de vuelos ordenados por oferta-->
                <div>
                    <label>
                        <strong>Mostrar Ofertas</strong>
                    </label>
                    <label class="switch" for="mostrar_ofertas">
                        <input type="checkbox" id="mostrar_ofertas" name="mostrar_ofertas" 
                            onchange="document.getElementById('filter-form').submit()"
                            {{ $filtros['mostrar_ofertas'] ? 'checked' : '' }}>
                        <span class="slider"></span>
                    </label>
                </div>

                <!-- Filtros de vuelos ordenados por precio -->
                <div class="d-flex align-items-center">                    
                    <select class="form-select" name="ordenar_por_precio" id="ordenar_por_precio" onchange="document.getElementById('filter-form').submit()">
                        
                        <option value="barato" {{ ($filtros['ordenar_por_precio'] ?? '') == 'barato' ? 'selected' : '' }}>Más barato primero</option>
                        <option value="caro" {{ ($filtros['ordenar_por_precio'] ?? '') == 'caro' ? 'selected' : '' }}>Más caro primero</option>
                    </select>
                </div>
            </div>  </form>
    </div>
 
    @if($vuelos->count() > 0)
        <div class="row g-4">
            @foreach($vuelos as $vuelo)
                <div class="col-12">
                    <div class="card h-100 border-0 shadow-sm flight-card">
                        <!-- Cabecera con efecto degradado -->
                        <div class="card-header bg-gradient-primary text-white border-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">{{ $vuelo->aerolinea->nombre }}</h5>
                                <img src="{{ asset('logo-v2.png') }}" alt="Logo" class="img-fluid" style="width: 35px;">
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <!-- Detalles del vuelo -->
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <i class="fas fa-calendar-day me-2"></i> {{ $vuelo->fecha }}
                                </div>
                                <div>
                                    <i class="fas fa-clock me-2"></i> {{ $vuelo->hora }}
                                </div>
                            </div>

                            <!-- Ruta con animación -->
                            <div class="flight-route mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="departure">
                                        <i class="fas fa-plane-departure text-primary me-2"></i>
                                        <span class="fw-bold">{{ $vuelo->origen }}</span>
                                    </div>
                                    
                                    <!-- Icono de avión dorado -->
                                    <div class="plane-icon">                                                                       
                                        <i class="fas fa-plane text-warning"></i>
                                    </div>

                                    <div class="route-line mx-3"></div>
                                    <div class="arrival">
                                        <i class="fas fa-plane-arrival text-primary me-2"></i>
                                        <span class="fw-bold">{{ $vuelo->destino }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Precio con efecto hover -->
                            <div class="price-section text-end">
                                <h4 class="mb-0 {{ $vuelo->oferta_id ? 'text-success' : 'text-primary' }}">
                                    ${{ number_format($vuelo->precio_con_descuento, 2) }}
                                    @if($vuelo->oferta_id)
                                        <span class="badge bg-success ms-2">OFERTA</span>
                                    @endif
                                </h4>
                            </div>
                        </div>

                        <!-- Botón de reserva con efecto -->
                        <div class="card-footer bg-white border-0">
                            <a href="#" class="btn btn-primary w-100 fw-bold btn-reserva">
                                Reservar Ahora 
                                <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Paginación mejorada -->
        <div class="pagination-container mt-4">
            {{ $vuelos->links('pagination::bootstrap-5') }}
        </div>
    @else
        <!-- Alerta de sin resultados -->
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            No se encontraron vuelos con estos criterios
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
</div>
 