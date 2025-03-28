 
 
<div class="styl-card-vuelos-disponibles">
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

<style>
/* Estilos personalizados para la tarjeta */
.bg-gradient-primary {
    background: linear-gradient(45deg, #007bff, #00c6ff);
}

.flight-card:hover {
    transform: translateY(-5px);
    transition: transform 0.3s ease;
}

.route-line {
    flex-grow: 1;
    height: 2px;
    background: #ddd;
    position: relative;
}

.route-line::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 3px;
    background: #007bff;
    animation: routeAnimation 2s linear infinite;
}

@keyframes routeAnimation {
    0% { background-position: 0% 50% }
    100% { background-position: 100% 50% }
}

.btn-reserva:hover {
    background-color: #0056b3 !important;
    transition: background-color 0.3s ease;
}
</style>