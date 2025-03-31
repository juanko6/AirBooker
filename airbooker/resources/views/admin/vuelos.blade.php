@extends('admin.layout')

@section('tablas')
<h1>✈️ Vuelos</h1>
<table id="adminTable" class="table table-striped table-bordered">
<thead>
        <tr>
            <th>ID</th>
            <th>Aerolinea</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Origen</th>
            <th>Destino</th>
            <th>Precio</th>
            <th>Oferta</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($vuelos as $vuelo)
        <tr>
            <td>{{ $vuelo->id }}</td>
            <td>{{ $vuelo->aerolinea->nombre }}</td>
            <td>{{ $vuelo->fecha }}</td>
            <td>{{ $vuelo->hora }}</td>
            <td>{{ $vuelo->origen }}</td>
            <td>{{ $vuelo->destino }}</td>
            <td>${{ number_format($vuelo->precio, 2) }}</td>
            <td>
                @if(optional($vuelo->oferta)->ProcentajeDescuento)
                    {{ optional($vuelo->oferta)->ProcentajeDescuento }}%
                @else
                    Sin oferta
                @endif
            </td>
            <td>
                <button class="btn btn-sm btn-info">✏️ Editar</button>
                <button class="btn btn-sm btn-danger">🗑️ Eliminar</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Paginación -->
<div class="d-flex justify-content-center mt-4">
{{ $vuelos->links('pagination::bootstrap-5') }}
</div>

@endsection
