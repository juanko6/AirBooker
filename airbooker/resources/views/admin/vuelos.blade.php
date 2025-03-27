@extends('admin.layout')

@section('tablas')
<h1>✈️ Vuelos</h1>
<table id="usersTable" class="table table-striped table-bordered">
<thead>
        <tr>
            <th onclick="sortTable(0)">ID</th>
            <th onclick="sortTable(1)">Aerolinea</th>
            <th onclick="sortTable(2)">Fecha</th>
            <th onclick="sortTable(3)">Hora</th>
            <th onclick="sortTable(4)">Origen</th>
            <th onclick="sortTable(5)">Destino</th>
            <th onclick="sortTable(6)">Precio</th>
            <th onclick="sortTable(7)">Oferta</th>
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
