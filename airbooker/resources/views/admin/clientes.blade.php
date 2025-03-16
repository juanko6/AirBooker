@extends('admin.layout')

@section('content')
    <h1>👥 Clientes</h1>
    <a href="#" class="btn btn-success mb-3">➕ Nuevo Cliente</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Teléfono</th>
                <th>DNI</th>
                <th>Pasaporte</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
            <tr>
                <td>{{ $cliente->nombre }}</td>
                <td>{{ $cliente->apellidos }}</td>
                <td>{{ $cliente->telefono }}</td>
                <td>{{ $cliente->dni }}</td>
                <td>{{ $cliente->pasaporte }}</td>
                <td>{{ $cliente->email }}</td>
                <td>
                    <button class="btn btn-sm btn-info">✏️ Editar</button>
                    <button class="btn btn-sm btn-danger">🗑️ Eliminar</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $clientes->links() }}
@endsection
