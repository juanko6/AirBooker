@extends('admin.layout')

@section('content')
    <h1>👥 Usuarios</h1>
    <a href="#" class="btn btn-success mb-3">➕ Nuevouser</a>

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
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->apellidos }}</td>
                <td>{{ $user->dni }}</td>
                <td>{{ $user->pasaporte }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->telefono }}</td>
                <td>{{ $user->rol }}</td>
                <td>
                    <button class="btn btn-sm btn-info">✏️ Editar</button>
                    <button class="btn btn-sm btn-danger">🗑️ Eliminar</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }}
@endsection
