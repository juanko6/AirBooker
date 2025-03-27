@extends('admin.layout')

@section('tablas')
    <h1>📊 Dashboard</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Clientes</h5>
                    <p class="card-text">{{ $totalUsers }} registrados</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Reservas</h5>
                    <p class="card-text">{{ $totalReservas }} activas</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Vuelos</h5>
                    <p class="card-text">{{ $totalVuelos }} programados</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Aerolineas</h5>
                    <p class="card-text">{{ $totalAerolineas }} en uso</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Ofertas</h5>
                    <p class="card-text">{{ $totalOfertas }} creadas</p>
                </div>
            </div>
        </div>
    </div>
@endsection
