<div class="card mb-4">
    <div class="card-header">Filtros</div>
    <div class="card-body">
        <!-- Filtro por aerolínea -->
        <div class="mb-3">
            <label>Aerolínea</label>
            <select name="aerolinea" class="form-select" 
                    onchange="this.form.submit()">
                <option value="">Todas</option>
                @foreach($aerolineas as $a)
                    <option value="{{ $a->nombre }}" 
                        {{ $filtros['aerolinea'] == $a->nombre ? 'selected' : '' }}>
                        {{ $a->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Filtro por precio -->
        <div class="mb-3">
            <label>Rango de precio</label>
            <div class="input-group">
                <input type="number" name="precio_min" class="form-control"
                       placeholder="Mín" value="{{ $filtros['precioMin'] ?? '' }}">
                <input type="number" name="precio_max" class="form-control"
                       placeholder="Máx" value="{{ $filtros['precioMax'] ?? '' }}">
            </div>
        </div>
        
        <button type="submit" class="btn btn-secondary w-100">Aplicar</button>
    </div>
</form>