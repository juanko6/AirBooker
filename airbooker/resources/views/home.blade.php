@extends('layouts.app')

@section('title', 'AIrbooker')

@section('content')
<!-- Hero Section -->
<div  >
    @include('VistasAuxVuelos.buscadorVuelo')
</div> 

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

<!-- Sección de Ventajas -->
<section id="advantages-section">
    <h2>¿Por qué elegirnos?</h2>
    <div class="advantages-grid">
        <div class="advantage-card">
            <div class="icon"><i class="fas fa-tag"></i></div>
            <h3>Mejores precios</h3>
            <p>Garantizamos los mejores precios del mercado en todos nuestros vuelos.</p>
        </div>
        <div class="advantage-card">
            <div class="icon"><i class="fas fa-headset"></i></div>
            <h3>Soporte 24/7</h3>
            <p>Nuestro equipo de soporte está disponible todos los días a cualquier hora.</p>
        </div>
        <div class="advantage-card">
            <div class="icon"><i class="fas fa-shield-alt"></i></div>
            <h3>Reservas seguras</h3>
            <p>Tu información y pagos están protegidos con la última tecnología en seguridad.</p>
        </div>
         
    </div>
</section>



<!-- Sección de FAQ -->
 <div class="styl-faq-custome" id="faq-section">
    
    <div class="container">
        <h1>FAQ</h1>
        <p class="text-center">Encuentra respuestas a las preguntas más comunes sobre nuestros servicios.</p>
        <div class="faq-section">
        <div class="faq-item">
            <div class="faq-question">¿Cómo puedo reservar un vuelo con Airbooker?</div>
            <div class="faq-answer">
            Para reservar un vuelo, simplemente ingresa a nuestra plataforma, selecciona tu destino, fechas y sigue los pasos del proceso de compra. ¡Es rápido y seguro!
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question">¿Qué métodos de pago aceptan?</div>
            <div class="faq-answer">
            Aceptamos tarjetas de crédito/débito (Visa, Mastercard, American Express), PayPal y transferencias bancarias. Todos los pagos están protegidos.
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question">¿Puedo cancelar o modificar mi reserva?</div>
            <div class="faq-answer">
            Sí, puedes cancelar o modificar tu reserva hasta 24 horas antes de la salida. Revisa nuestros términos y condiciones para más detalles.
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question">¿Ofrecen vuelos internacionales?</div>
            <div class="faq-answer">
            ¡Claro! En Airbooker ofrecemos una amplia variedad de destinos internacionales. Encuentra el tuyo y comienza tu aventura hoy.
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question">¿Qué pasa si mi vuelo se retrasa o cancela?</div>
            <div class="faq-answer">
            Si tu vuelo se retrasa o cancela, te notificaremos de inmediato y trabajaremos para ofrecerte alternativas o reembolsos según corresponda.
            </div>
        </div>
        </div>
        </div>
</div>

    <script>
    document.querySelectorAll('.faq-question').forEach(item => {
      item.addEventListener('click', () => {
        const parent = item.parentElement;
        parent.classList.toggle('active');
      });
    });
  </script>
@endsection
