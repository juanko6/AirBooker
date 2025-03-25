@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@extends('admin.layout')

@section('content')
    <h1>👥 Usuarios</h1>
    <!-- Botón para abrir el modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">
    Crear Usuario
    </button>

    <!-- Modal -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="createUserModalLabel">Crear Nuevo Usuario</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <!-- Formulario para crear un usuario -->
            <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" required>
            </div>
            <div class="mb-3">
                <label for="dni" class="form-label">DNI</label>
                <input type="text" class="form-control" id="dni" name="dni" required>
            </div>
            <div class="mb-3">
                <label for="pasaporte" class="form-label">Pasaporte</label>
                <input type="text" class="form-control" id="pasaporte" name="pasaporte" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" required>
            </div>
            <div class="mb-3">
                <label for="rol" class="form-label">Rol</label>
                <select class="form-control" id="rol" name="rol" required>
                <option value="Administrador">Administrador</option>
                <option value="Cliente">Cliente</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>
            <button type="submit" class="btn btn-success">Crear Usuario</button>
            </form>
        </div>
        </div>
    </div>
    </div>



        <table id="usersTable" class="table table-striped table-bordered">
    <thead>
        <tr>
        <th onclick="sortTable(0)">ID</th>
        <th onclick="sortTable(1)">Rol</th>
        <th onclick="sortTable(2)">Nombre</th>
        <th onclick="sortTable(3)">Apellidos</th>
        <th onclick="sortTable(4)">Correo</th>
        <th onclick="sortTable(5)">DNI</th>
        <th onclick="sortTable(6)">Pasaporte</th>
        <th onclick="sortTable(7)">Telefono</th>
        
        
        <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->rol }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->apellidos }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->dni }}</td>
        <td>{{ $user->pasaporte }}</td>
        <td>{{ $user->telefono }}</td>
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
    {{ $users->links('pagination::bootstrap-5') }}
</div>

@endsection

    <script>
    $(document).ready(function() {
        $('#usersTable').DataTable({
        "paging": true,
        "searching": true,
        "ordering": true
        });
    });

        function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("usersTable");
    switching = true;
    dir = "asc"; // Establecer la dirección como ascendente inicialmente
    
    while (switching) {
        switching = false;
        rows = table.rows;
        
        for (i = 1; i < (rows.length - 1); i++) {
        shouldSwitch = false;
        x = rows[i].getElementsByTagName("TD")[n];
        y = rows[i + 1].getElementsByTagName("TD")[n];
        
        if (dir == "asc") {
            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
            shouldSwitch = true;
            break;
            }
        } else if (dir == "desc") {
            if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
            shouldSwitch = true;
            break;
            }
        }
        }
        if (shouldSwitch) {
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
        switchcount++;
        } else {
        if (switchcount == 0 && dir == "asc") {
            dir = "desc";
            switching = true;
        }
        }
    }
    }

    </script>