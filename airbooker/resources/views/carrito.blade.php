@extends('layouts.app')

@section('title', 'Carrito')

@section('content')
    <div class="container mt-5 pt-5">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mb-4" style="color: #1C49A9; font-family: 'Rubik Mono One', monospace;">
                    Carrito
                </h1>
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
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
                                        <th>Origen - Destino</th>
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
                                                    <span class="badge bg-primary">{{ $item->vuelo->id }}</span>
                                                </td>
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
                                                    <img src="{{ asset('images/aerolinias/' . $item->vuelo->aerolinea->nombre . '.png') }}" 
                                                         alt="{{ $item->vuelo->aerolinea->nombre }}" height="30">
                                                </td>
                                                <td>
                                                    <div class="input-group input-group-sm" style="width: 100px;">
                                                        <button class="btn btn-outline-secondary" type="button"><i class="fas fa-minus"></i></button>
                                                        <input type="text" class="form-control text-center" value="{{ $item->cantidad }}">
                                                        <button class="btn btn-outline-secondary" type="button"><i class="fas fa-plus"></i></button>
                                                    </div>
                                                    <br>
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
                                <a href="{{ url('/') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i> Seguir buscando
                                </a>
                            </div>
                            <div class="col-md-6 text-end">
                                @if ($carrito && $carrito->items->isNotEmpty())
                                    <div class="mb-2">
                                        <span class="text-muted">Subtotal:</span>
                                        <strong class="ms-2">{{ number_format($carrito->items->sum(function ($item) {
                                            return $item->cantidad * $item->precio_unitario;
                                        }), 2) }} €</strong>
                                    </div>
                                    <div class="mb-2">
                                        <span class="text-muted">Descuento:</span>
                                        <strong class="ms-2 text-success">{{ number_format($carrito->items->sum(function ($item) {
                                            return $item->vuelo->oferta ? ($item->cantidad * $item->precio_unitario * $item->vuelo->oferta->ProcentajeDescuento / 100) : 0;
                                        }), 2) }} €</strong>
                                    </div>
                                    <div class="mb-3">
                                        <span class="text-muted h5">Total:</span>
                                        <strong class="ms-2 h5 text-primary">{{ number_format($carrito->items->sum(function ($item) {
                                            return $item->cantidad * $item->precio_unitario * (1 - ($item->vuelo->oferta ? $item->vuelo->oferta->ProcentajeDescuento / 100 : 0));
                                        }), 2) }} €</strong>
                                    </div>
                                    <button class="btn btn-primary btn-lg" id="btn-checkout">
                                        <i class="fas fa-credit-card me-2"></i> Proceder al pago
                                    </button>
                                @else
                                    <button class="btn btn-primary btn-lg disabled" id="btn-checkout">
                                        <i class="fas fa-credit-card me-2"></i> Proceder al pago
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