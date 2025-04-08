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
                                    <!-- Si el carrito está vacío mostrar mensaje -->
                                    <tr id="empty-cart">
                                        <td colspan="7" class="text-center py-4">
                                            <div class="alert alert-info mb-0">
                                                <i class="fas fa-info-circle me-2"></i> Tu carrito está vacío. ¡Busca vuelos para comenzar!
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Ejemplo de un vuelo en el carrito (oculto inicialmente) -->
                                    <tr id="cart-item-example" style="display: none;">
                                        <td>
                                            <span class="badge bg-primary">AB-1234</span>
                                        </td>
                                        <td>
                                            <strong>Madrid</strong>
                                            <i class="fas fa-arrow-right mx-2"></i>
                                            <strong>Barcelona</strong>
                                        </td>
                                        <td>
                                            10/05/2025
                                            <br>
                                            <small class="text-muted">15:30h</small>
                                        </td>
                                        <td>
                                            <img src="{{ asset('images/aerolinias/Iberia.png') }}" alt="Iberia" height="30">
                                        </td>
                                        <td>
                                            <div class="input-group input-group-sm" style="width: 100px;">
                                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-minus"></i></button>
                                                <input type="text" class="form-control text-center" value="1">
                                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-plus"></i></button>
                                            </div>
                                        </td>
                                        <td>
                                            <strong class="text-primary">120,50 €</strong>
                                            <br>
                                            <small class="text-success"><i class="fas fa-tag"></i> 10% descuento</small>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
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
                                <div class="mb-2">
                                    <span class="text-muted">Subtotal:</span>
                                    <strong class="ms-2">0,00 €</strong>
                                </div>
                                <div class="mb-2">
                                    <span class="text-muted">Descuento:</span>
                                    <strong class="ms-2 text-success">0,00 €</strong>
                                </div>
                                <div class="mb-3">
                                    <span class="text-muted h5">Total:</span>
                                    <strong class="ms-2 h5 text-primary">0,00 €</strong>
                                </div>
                                <button class="btn btn-primary btn-lg disabled" id="btn-checkout">
                                    <i class="fas fa-credit-card me-2"></i> Proceder al pago
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>
        </div>
    </div>
@endsection

 
