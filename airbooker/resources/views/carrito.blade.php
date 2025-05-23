@extends('layouts.app')

@section('title', 'Carrito')

@section('content')
    <div class="container mt-5 pt-5">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mb-4" style="background: linear-gradient(to right, #003366 60%, #003366c9); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-family: 'Rubik Mono One', monospace;">
                    Carrito
                </h1>
                <!-- Mensajes de Error -->
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                <div class="card shadow">
                    <div class="card-header text-white" style="background: linear-gradient(to right, #003366 60%, #003366c9);">
                        <h5 class="mb-0">
                            <i class="fas fa-shopping-cart me-2"></i> Vuelos seleccionados
                        </h5>
                    </div>
                    <div class="card-body">
                        <!-- Tabla de vuelos en el carrito -->
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Vuelo</th> 
                                        <th>Fecha y Hora</th>
                                        <th>Aerolínea</th>
                                        <th>Precio</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($carrito && $carrito->items->isNotEmpty())
                                        @foreach ($carrito->items as $item)
                                            <tr> 
                                                <td>
                                                    <strong>{{ $item->vuelo->origen }}</strong>
                                                    <i class="fas fa-arrow-right mx-2"></i>
                                                    <strong>{{ $item->vuelo->destino }}</strong>
                                                </td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($item->vuelo->fecha)->format('d/m/Y') }}
                                                    <br>
                                                    <small class="text-muted">{{ \Carbon\Carbon::parse($item->vuelo->hora)->format('H:i') }}h</small>
                                                </td>
                                                
                                                <td>
                                                     <img src="{{ asset($item->vuelo->aerolinea->urlLogo) }}" lt="{{ $item->vuelo->aerolinea->nombre }}" class="img-fluid" style="height: 50px; width: 50px; object-fit: contain;"> 
                                                </td>

                                                <td>
                                                    <strong class="text-primary">{{ number_format($item->precio_unitario, 2) }} €</strong>
                                                    @if ($item->vuelo->oferta)
                                                        <br>
                                                        <small class="text-success">
                                                            <i class="fas fa-tag"></i> {{ $item->vuelo->oferta->ProcentajeDescuento }}% descuento
                                                        </small>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="{{ route('carrito.eliminar', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr id="empty-cart">
                                            <td colspan="7" class="text-center py-4">
                                                <div class="alert alert-info mb-0">
                                                    <i class="fas fa-info-circle me-2"></i> Tu carrito está vacío. ¡Busca vuelos para comenzar!
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Resumen del carrito -->
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i> Seguir buscando
                                </a>
                            </div>
                            <div class="col-md-6 text-end">
                                @if ($carrito && $carrito->items->isNotEmpty())
                                    <div class="mb-2">
                                        <span class="text-muted">Subtotal:</span>
                                        <strong class="ms-2">{{ number_format($carrito->items->sum(function ($item) {
                                            return  $item->precio_unitario;
                                        }), 2) }} €</strong>
                                    </div>
                                    <div class="mb-2">
                                        <span class="text-muted">Descuento:</span>
                                        <strong class="ms-2 text-success">{{ number_format($carrito->items->sum(function ($item) {
                                            return $item->vuelo->oferta ? ( $item->precio_unitario * $item->vuelo->oferta->ProcentajeDescuento / 100) : 0;
                                        }), 2) }} €</strong>
                                    </div>
                                    <div class="mb-3">
                                        <span class="text-muted h5">Total:</span>
                                        <strong class="ms-2 h5 text-primary">{{ number_format($carrito->items->sum(function ($item) {
                                            return  $item->precio_unitario * (1 - ($item->vuelo->oferta ? $item->vuelo->oferta->ProcentajeDescuento / 100 : 0));
                                        }), 2) }} €</strong>
                                    </div>
                                    <form action="{{ route('procesar.compra') }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-lg" id="btn-checkout" style="background: linear-gradient(to right, #003366 60%, #003366c9);" onmouseover="this.style.background='linear-gradient(to right, #003366c9 30%, #0033665c 100%)'" onmouseout="this.style.background='linear-gradient(to right, #003366 60%, #003366c9)'">
                                            <i class="fas fa-credit-card me-2"></i> Pagar ahora
                                        </button>
                                    </form>
                                @else
                                    <button class="btn btn-primary btn-lg disabled" id="btn-checkout">
                                        <i class="fas fa-credit-card me-2"></i> Pagar ahora
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection