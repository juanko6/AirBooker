<!-- Sección de Vuelos con Ofertas -->
@if(count($vuelosConOfertas) > 0)
<section id="discounted-flights-section">
    <h2>Vuelos con Descuento</h2>
    <div class="flights-grid">
        @foreach($vuelosConOfertas as $vuelo)
        <div class="flight-card">
            <div class="flight-info">
                <h3>{{ $vuelo->origen }} → {{ $vuelo->destino }}</h3>
                <p>{{ $vuelo->aerolinea->nombre }}</p>
            </div>
            <div class="flight-pricing">
                <p class="old-price">{{ number_format($vuelo->precio, 2) }} €</p>
                <p class="new-price">{{ number_format($vuelo->getPrecioConDescuento(), 2) }} €</p>
            </div>
            <div class="flight-details">
                <span><i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($vuelo->fecha)->format('d/m/Y') }}</span>
                <span><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($vuelo->hora)->format('H:i') }}</span>
                <a href="#">Reservar</a>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endif