<!-- Sección de Ofertas Destacadas -->
<div class="container_segundario">     
    @if(count($vuelosConOfertas) > 0)
    <section id="offers-section">
        <h3 class="titulo-h3-seccsion">Ofertas Exclusivas</h3>
        <div class="offers-grid">            
            @foreach($vuelosConOfertas as $vuelo)
            <div class="styl-card-offers-vuelo">
                <div class="offer-card">
                    <div class="row">
                        <div class="col-6">
                            <div class="date-range">{{ \Carbon\Carbon::parse($vuelo->fecha)->format('d M') }}</div>
                        </div>
                        <div class="col-6 text-end">
                            <i class="fas fa-fire ms-2" style="font-size: 45px; color: #FFC107;"></i>
                        </div>
                    </div>
                    <div class="destination">{{ $vuelo->destino }}</div>
                    <div class="image-container">
                        <img src="{{ $vuelo->urlImgDestino }}" alt="{{ $vuelo->destino }}">
                    </div>

                    <!-- Precio con efecto hover -->                            
                    <div class="prices"> 
                        <span class="old-price">{{ number_format($vuelo->precio, 2) }}€</span>
                         
                        <div class="price-column">
                            <div class="price-row">
                                <span class="new-price">{{ number_format($vuelo->getPrecioConDescuento(), 2) }}€</span>
                            </div>
                            <div >
                                <div class="text-end">
                                    <span>por persona</span>
                                </div>
                            </div>
                        </div>                                                
                    </div>                     
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif
</div>