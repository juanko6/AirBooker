@extends('admin.layout')

@section('content')
<h1>📅 Reservas</h1>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Estado</th>
            <th>Fecha</th>
            <th>Precio</th>
            <th>Cliente</th>
            <th>Vuelo</th>
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
            <td>{{ $reserva->cliente->nombre }} {{ $reserva->cliente->apellido }}</td>
            <td>{{ optional($reserva->vuelo)->origen }} → {{ optional($reserva->vuelo)->destino }}</td>
            <td>
                <button class="btn btn-sm btn-info">✏️ Editar</button>
                <button class="btn btn-sm btn-danger">🗑️ Eliminar</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $reservas->links() }}
@endsection
