<div class="styl-card-vuelos-disponibles">
    @if($vuelos->count() > 0)
        <div class="row g-4">
            @foreach($vuelos as $vuelo)
                <div class="col-12">
                    <div class="card h-100 border-0 shadow-sm flight-card">
                        <div class="card-header bg-primary text-white border-0">
                        <h5 class="card-title mb-0">{{ $vuelo->aerolinea->nombre }}</h5>
                        <img src="{{ asset('logo-v2.png') }}" alt="Logo" class="img-fluid" style="width: 35px;">
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="text-muted">
                                    <i class="fas fa-calendar-day me-2"></i>
                                    {{ $vuelo->fecha }}
                                </div>
                                <div class="text-muted">
                                    <i class="fas fa-clock me-2"></i>
                                    {{ $vuelo->hora }}
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3 flight-route">
                                <div>
                                    <i class="fas fa-plane-departure me-2 text-primary"></i>
                                    <span class="fw-bold">{{ $vuelo->origen }}</span>
                                </div>
                                <div class="plane-icon">
                                    <i class="fas fa-plane text-success"></i>
                                </div>
                                <div>
                                    <i class="fas fa-plane-arrival me-2 text-primary"></i>
                                    <span class="fw-bold">{{ $vuelo->destino }}</span>
                                </div>
                            </div>
                            <div class="text-end">
                                <h4 class="mb-0 {{ $vuelo->oferta_id ? 'text-success' : 'text-primary' }}">
                                    ${{ number_format($vuelo->precio_con_descuento, 2) }}
                                </h4>
                                @if($vuelo->oferta_id)
                                    <span class="badge bg-success rounded-pill px-2 py-1 mt-1">Oferta Especial</span>
                                @endif
                            </div>
                        </div>
                        <button class="card-footer bg-white border-0">
                            <a href="#" class="btn btn-primary w-100 fw-bold">Reservar Ahora</a>
                        </button>

                        
                    </div>
                </div>
            @endforeach
        </div>

        
    @else
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            No se encontraron vuelos con estos criterios
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Paginación -->
    <div class="Pagination">
        {{ $vuelos->links('pagination::bootstrap-4') }}
    </div>
</div> 