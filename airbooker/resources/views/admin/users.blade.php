@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <script>
        // Desaparecer y eliminar el mensaje después de 3 segundos
        setTimeout(function() {
            var alertElement = document.getElementById('success-alert');
            if (alertElement) {
                alertElement.classList.remove('show');
                alertElement.classList.add('fade');
                // Esperar a que termine la animación y eliminar el elemento
                setTimeout(function() {
                    alertElement.remove();
                }, 500); // 500ms para asegurar el tiempo de la animación
            }
        }, 3000); // Desaparece después de 3 segundos
    </script>
@endif

@extends('admin.layout')

@section('tablas')
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
            <div id="createUserErrors" class="alert alert-danger d-none">
                <ul id="errorList" class="mb-0"></ul>
            </div>

            <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                </div>
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" required>
            </div>
            <div class="mb-3">
                <label for="dni" class="form-label">DNI</label>
                <input type="text" name="dni" id="dni" class="form-control" maxlength="10" value="{{ old('dni') }}" required>
                </div>
            <div class="mb-3">
                <label for="pasaporte" class="form-label">Pasaporte</label>
                <input type="text" class="form-control" id="pasaporte" name="pasaporte" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
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
                <label for="creditos" class="form-label">Créditos</label>
                <input type="number" class="form-control" name="creditos" id="creditos" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" required>
                </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                </div>
            <button type="submit" class="btn btn-success">Crear Usuario</button>
            </form>
        </div>
        </div>
    </div>
    </div>

    <!-- Modal de edición -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Editar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario de edición -->
                    <form id="editUserForm" action="{{ route('users.update', ['user' => 1]) }}" method="POST">
                    @csrf
                        @method('PUT')
                        
                        <input type="hidden" name="user_id" id="user_id">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="apellidos" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="edit_apellidos" name="apellidos" required>
                        </div>
                        <div class="mb-3">
                            <label for="dni" class="form-label">DNI</label>
                            <input type="text" class="form-control" id="edit_dni" name="dni" required>
                        </div>
                        <div class="mb-3">
                            <label for="pasaporte" class="form-label">Pasaporte</label>
                            <input type="text" class="form-control" id="edit_pasaporte" name="pasaporte" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="edit_email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="edit_telefono" name="telefono" required>
                        </div>
                        <div class="mb-3">
                            <label for="rol" class="form-label">Rol</label>
                            <select class="form-control" id="edit_rol" name="rol" required>
                                <option value="Administrador">Administrador</option>
                                <option value="Cliente">Cliente</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña (opcional)</label>
                            <input type="password" class="form-control" id="edit_password" name="password">
                            <small class="text-muted">Dejar en blanco para mantener la contraseña actual</small>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                            <input type="password" class="form-control" id="edit_password_confirmation" name="password_confirmation">
                        </div>
                        <button type="submit" class="btn btn-success">Actualizar Usuario</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


        <table id="adminTable" class="table table-striped table-bordered">
    <thead>
        <tr>
        <th>ID</th>
        <th>Rol</th>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Creditos</th>
        <th>Correo</th>
        <th>DNI</th>
        <th>Pasaporte</th>
        <th>Telefono</th>
        
        
        <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
        <td>{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
        <td>{{ $user->rol }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->apellidos }}</td>
        <td>{{ $user->creditos }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->dni }}</td>
        <td>{{ $user->pasaporte }}</td>
        <td>{{ $user->telefono }}</td>
        <td>
        <button class="btn btn-sm btn-info" onclick="openEditModal({{ $user->id }})">✏️ Editar</button>
        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">🗑️ Eliminar</button>
</form>

        </td>
        </tr>
        @endforeach
    </tbody>
    </table>

<!-- Paginación -->
<div class="d-flex justify-content-center mt-4">
    {{ $users->links('pagination::bootstrap-5') }}
</div>

@if ($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = new bootstrap.Modal(document.getElementById('createUserModal'));
        modal.show();
    });
</script>
@endif

@endsection

    <script>

        // Función para abrir el modal de edición y cargar los datos del usuario en los campos
        function openEditModal(userId) {
    fetch(`/admin/users/${userId}/edit`)
        .then(response => response.json())
        .then(data => {
            // Rellenar el formulario con los datos del usuario
            document.getElementById('user_id').value = data.id;
            document.getElementById('edit_name').value = data.name;
            document.getElementById('edit_apellidos').value = data.apellidos;
            document.getElementById('edit_dni').value = data.dni;
            document.getElementById('edit_pasaporte').value = data.pasaporte;
            document.getElementById('edit_email').value = data.email;
            document.getElementById('edit_telefono').value = data.telefono;
            document.getElementById('edit_rol').value = data.rol;

            // Cambiar la ruta del formulario con el ID del usuario
            document.getElementById('editUserForm').action = `/admin/users/${data.id}`;
            
            // Mostrar el modal de edición
            var myModal = new bootstrap.Modal(document.getElementById('editUserModal'));
            myModal.show();
        })
        .catch(error => console.error('Error:', error));
}

document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('#createUserModal form');
    const errorBox = document.getElementById('createUserErrors');
    const errorList = document.getElementById('errorList');

    form.addEventListener('submit', function (e) {
        e.preventDefault(); // Prevenir envío

        // Limpiar errores anteriores
        errorList.innerHTML = '';
        errorBox.classList.add('d-none');

        // Obtener campos
        const name = form.name.value.trim();
        const email = form.email.value.trim();
        const dni = form.dni.value.trim();
        const pasaporte = form.pasaporte.value.trim();
        const password = form.password.value;
        const confirmPassword = form.password_confirmation.value;

        const errores = [];

        const dniPattern = /^\d{8}[A-Za-z]$/;
        const pasaportePattern = /^[A-Za-z]{2}\d{6}$/;

        // Validaciones
        if (!name) errores.push('El nombre es obligatorio.');
        if (!email || !/^\S+@\S+\.\S+$/.test(email)) errores.push('El correo electrónico no es válido.');
        if (!dniPattern.test(dni)) {
            errores.push('El DNI debe tener 8 números seguidos de una letra (Ej: 12345678A).');
            }
        if (!pasaportePattern.test(pasaporte)) {
            errores.push('El pasaporte debe tener 2 letras seguidas de 6 dígitos (Ej: AB123456).');
            }
        if (password.length < 6) errores.push('La contraseña debe tener al menos 6 caracteres.');
        if (password !== confirmPassword) errores.push('Las contraseñas no coinciden.');

        if (errores.length > 0) {
            errores.forEach(error => {
                const li = document.createElement('li');
                li.textContent = error;
                errorList.appendChild(li);
            });
            errorBox.classList.remove('d-none');
        } else {
            errorBox.classList.add('d-none');
            form.submit(); // Enviar si todo es válido
        }
    });
});

    </script>