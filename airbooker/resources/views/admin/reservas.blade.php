@extends('admin.layout')

@section('content')
<h1>📅 Reservas</h1>
<table id="usersTable" class="table table-striped table-bordered">
<thead>
        <tr>
            <th onclick="sortTable(0)">ID</th>
            <th onclick="sortTable(1)">Estado</th>
            <th onclick="sortTable(2)">Fecha</th>
            <th onclick="sortTable(3)">Precio</th>
            <th onclick="sortTable(4)">Cliente</th>
            <th onclick="sortTable(5)">Vuelo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reservas as $reserva)
        <tr>
            <td>{{ $reserva->id }}</td>
            <td>
                <span class="badge {{ $reserva->estado == 'confirmada' ? 'bg-success' : 'bg-warning' }}">
                    {{ ucfirst($reserva->estado) }}
                </span>
            </td>
            <td>{{ $reserva->fecha }}</td>
            <td>${{ number_format($reserva->precio, 2) }}</td>
            <td>{{ $reserva->user_id }}</td>
            <td>{{ optional($reserva->vuelo)->origen }} → {{ optional($reserva->vuelo)->destino }}</td>
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
{{ $reservas->links('pagination::bootstrap-5') }}
</div>
@endsection
