<form method="GET" action="{{ route('vuelos.disponibles') }}" class="row g-3">
    <div class="col-md-4">
        <input type="text" name="origen" class="form-control" 
               placeholder="Origen" value="{{ $filtros['origen'] ?? '' }}" required>
    </div>
    <div class="col-md-4">
        <input type="text" name="destino" class="form-control" 
               placeholder="Destino" value="{{ $filtros['destino'] ?? '' }}" required>
    </div>
    <div class="col-md-3">
        <input type="date" name="fecha" class="form-control" 
               value="{{ $filtros['fecha'] ?? '' }}" min="{{ date('Y-m-d') }}" required>
    </div>
    <div class="col-md-1">
        <button type="submit" class="btn btn-primary w-100">
            <i class="fas fa-search"></i>
        </button>
    </div>
</form>