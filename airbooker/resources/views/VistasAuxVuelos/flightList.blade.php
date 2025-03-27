@if($vuelos->count() > 0)
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach($vuelos as $vuelo)
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $vuelo->aerolinea_nombre }}</h5>
                        <p class="card-text">
                            <i class="fas fa-plane-departure"></i> {{ $vuelo->origen }} → 
                            <i class="fas fa-plane-arrival"></i> {{ $vuelo->destino }}
                        </p>
                        <p class="card-text">
                            <i class="fas fa-calendar-day"></i> {{ $vuelo->fecha }} <br>
                            <i class="fas fa-clock"></i> {{ $vuelo->hora }}
                        </p>
                        <h4 class="text-primary">
                            ${{ $vuelo->precio_final }}
                            @if($vuelo->oferta_id)
                                <span class="badge bg-success">OFERTA</span>
                            @endif
                        </h4>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="btn btn-primary w-100">Reservar</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="alert alert-warning">
        No se encontraron vuelos con estos criterios
    </div>
@endif