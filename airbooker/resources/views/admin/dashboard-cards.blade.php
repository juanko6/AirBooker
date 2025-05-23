<div class="row g-3">
    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
        <div class="card text-white bg-primary h-100">
            <div class="card-body">
                <h5 class="card-title">Clientes</h5>
                <p class="card-text">{{ $totalUsers }} registrados</p>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
        <div class="card text-white bg-success h-100">
            <div class="card-body">
                <h5 class="card-title">Reservas</h5>
                <p class="card-text">{{ $totalReservas }} activas</p>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
        <div class="card text-white bg-warning h-100">
            <div class="card-body">
                <h5 class="card-title">Vuelos</h5>
                <p class="card-text">{{ $totalVuelos }} programados</p>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
        <div class="card text-white bg-info h-100">
            <div class="card-body">
                <h5 class="card-title">Aerolineas</h5>
                <p class="card-text">{{ $totalAerolineas }} en uso</p>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
        <div class="card text-white bg-secondary h-100">
            <div class="card-body">
                <h5 class="card-title">Ofertas</h5>
                <p class="card-text">{{ $totalOfertas }} creadas</p>
            </div>
        </div>
    </div>
</div>
