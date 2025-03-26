
@extends('layouts.app')
@section('title', 'Buscar Vuelos') <!-- Título personalizado -->

@section('content')
    <!-- Buscador visible en la nueva página -->
    <div class="container mt-4">
        @include('buscadorVuelo')
    </div>

    <!-- Resultados de búsqueda -->
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Vuelos disponibles</h5>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>N° Vuelo</th>
                                <th>Aerolínea</th>
                                <th>Origen</th>
                                <th>Destino</th>
                                <th>Fecha y Hora</th>
                                <th>Precio</th>
                                <th></th> <!-- Columna para el botón -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vuelos as $vuelo)
                                <tr>
                                    <td>{{ $vuelo->id }}</td>
                                    <td>{{ $vuelo->aerolinea->nombre }}</td>
                                    <td>{{ $vuelo->origen }}</td>
                                    <td>{{ $vuelo->destino }}</td>
                                    <td>{{ $vuelo->fecha }} {{ $vuelo->hora }}</td>                                    
                                    <td>
                                    @if($vuelo->oferta && $vuelo->oferta->estado === 'Activa')
                                        <del>${{ number_format($vuelo->precio, 2) }}</del>
                                        <span class="text-success fw-bold">
                                            ${{ number_format($vuelo->precio_con_descuento, 2) }}
                                        </span>
                                    @else
                                        ${{ number_format($vuelo->precio, 2) }}
                                    @endif
                                </td>
                                    <td>
                                        <a href="#" 
                                           class="btn btn-primary btn-sm">
                                            Pagar
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Paginación -->
                {{ $vuelos->appends($busqueda)->links() }}
            </div>
        </div>
    </div>
 

@endsection

@section('scripts')
    <script>
        // Script específico para esta vista
    </script>
@endsection