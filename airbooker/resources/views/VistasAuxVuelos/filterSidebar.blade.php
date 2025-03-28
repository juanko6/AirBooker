<div >
    <form method="GET" action="{{ route('vuelos.disponibles') }}">
        <!-- Campos Ocultos -->
        <input type="hidden" name="origen" value="{{ $filtros['origen'] }}">
        <input type="hidden" name="destino" value="{{ $filtros['destino'] }}">
        <input type="hidden" name="fecha" value="{{ $filtros['fecha'] }}">

        <!-- Panel de Filtros -->
        <div class="card mb-4">
            <div class="card-header">Filtros</div>
            <div class="card-body p-3">
                <!-- Filtro por Aerolíneas -->
                <div class="mb-3">
                    <label class="d-block mb-2">Aerolíneas</label>
                    <div class="form-check mb-1">
                        <input type="checkbox" id="seleccionar-todas" onclick="toggleAllAirlines(this)" class="form-check-input">
                        <label for="seleccionar-todas" class="form-check-label small">
                            Seleccionar todas
                        </label>
                    </div>

                    <div class="aerolineas-container" style="max-height: 150px; overflow-y: auto;">
                        @foreach($aerolineas as $aerolinea)
                            <div class="form-check mb-1">
                                <input type="checkbox" name="aerolinea[]" id="aerolinea_{{ $aerolinea->id }}" value="{{ $aerolinea->nombre }}" class="form-check-input" {{ in_array($aerolinea->nombre, $filtros['aerolinea'] ?? []) ? 'checked' : '' }}>
                                <label for="aerolinea_{{ $aerolinea->id }}" class="form-check-label small">
                                    {{ $aerolinea->nombre }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Botón para Deseleccionar Todo -->
                <div class="mb-3">
                    <a href="#" onclick="deseleccionarTodasAirlines()" class="text-decoration-none text-primary small">
                        Deseleccionar todo
                    </a>
                </div>

                <!-- Filtro por Precio -->
                <div class="mb-3">
                    <label class="d-block mb-2">Rango de precio</label>
                    <div class="input-group input-group-sm">
                        <input type="number" name="precio_min" class="form-control" placeholder="Mín" value="{{ $filtros['precio_min'] ?? '' }}">
                        <input type="number" name="precio_max" class="form-control" placeholder="Máx" value="{{ $filtros['precio_max'] ?? '' }}">
                    </div>
                </div>

                <!-- Botón Aplicar -->
                <button type="submit" class="btn btn-secondary btn-sm w-100">Aplicar</button>
            </div>
        </div>
    </form>

    <!-- Scripts para la funcionalidad de selección/deselección -->
    <script>
        function toggleAllAirlines(checkbox) {
            const checkboxes = document.querySelectorAll('input[name="aerolinea[]"]');
            checkboxes.forEach((cb) => {
                cb.checked = checkbox.checked;
            });
        }

        function deseleccionarTodasAirlines() {
            const checkboxes = document.querySelectorAll('input[name="aerolinea[]"]');
            checkboxes.forEach((cb) => {
                cb.checked = false;
            });
        }
    </script>

    <!-- Estilos Personalizados -->
    <style>
        .aerolineas-container::-webkit-scrollbar {
            width: 8px;
        }

        .aerolineas-container::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .aerolineas-container::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        .aerolineas-container::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style> 
    