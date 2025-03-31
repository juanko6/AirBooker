<!-- Sección de Destinos Populares -->
@if(count($destinosPopulares) > 0)
<section id="popular-destinations-section">
    <h2>Destinos Populares</h2>
    <div class="destinations-grid">
        @foreach($destinosPopulares as $destino)
        <div class="destination-card">
            <div class="destination-content">
                <h3>{{ $destino->destino }}</h3>
                <p>{{ $destino->total }} vuelos disponibles</p>
                <a href="#">Explorar <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endif