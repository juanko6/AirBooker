<!-- Sección de Ofertas Destacadas -->
@if(count($ofertas) > 0)
<section id="offers-section">
    <h2>Ofertas Exclusivas</h2>
    <div class="offers-grid">
        @foreach($ofertas as $oferta)
        <div class="offer-card">
            <div class="offer-header">
                <h3>{{ $oferta->ProcentajeDescuento }}% de descuento</h3>
            </div>
            <div class="offer-body">
                <p>Válido desde {{ \Carbon\Carbon::parse($oferta->FechaInicio)->format('d/m/Y') }} hasta {{ \Carbon\Carbon::parse($oferta->FechaFin)->format('d/m/Y') }}</p>
                <a href="#">Ver destinos <i class="fas fa-chevron-right"></i></a>
            </div>
            
        </div>
        @endforeach
    </div>
</section>
@endif