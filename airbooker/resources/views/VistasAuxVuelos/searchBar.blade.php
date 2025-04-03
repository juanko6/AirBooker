    <form method="GET" action="{{ route('buscar.vuelos') }}" class="row g-3 p-3 border rounded shadow" style="background-color: white;">
    <!-- Mantener parámetros de búsqueda originales -->

    <input type="hidden" name="mostrar_ofertas" value="{{ $filtros['mostrar_ofertas'] }}"> 
    <input type="hidden" name="ordenar_por_precio" value="{{ $filtros['ordenar_por_precio'] }}">  
    
    <input type="hidden" name="precio_min" value="{{ $filtros['precio_min'] }}">
    <input type="hidden" name="precio_max" value="{{ $filtros['precio_max'] }}">

    

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