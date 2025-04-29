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
    <h1>✈️ Aerolíneas</h1>
    <!-- Botón para abrir el modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createAirlineModal">
        Crear Aerolínea
    </button>

    <!-- Modal para crear nueva aerolínea -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="modal fade" id="createAirlineModal" tabindex="-1" aria-labelledby="createAirlineModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createAirlineModalLabel">Crear Nueva Aerolínea</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="create-errors" class="alert alert-danger d-none">
                        <ul class="mb-0" id="create-error-list"></ul>
                    </div>
                    <!-- Formulario para crear una aerolínea -->
                    <form action="{{ route('aerolineas.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre">
                        </div>
                        <div class="mb-3">
                            <label for="urlLogo" class="form-label">Logo</label>
                            <input type="file" class="form-control" id="urlLogo" name="urlLogo" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="paisOrigen" class="form-label">País de Origen</label>
                            <input type="text" class="form-control" id="paisOrigen" name="paisOrigen">
                        </div>
                        <div class="mb-3">
                            <label for="contacto" class="form-label">Contacto</label>
                            <input type="text" class="form-control" id="contacto" name="contacto">
                        </div>
                        <div class="mb-3">
                            <label for="sitio_web" class="form-label">Sitio Web</label>
                            <input type="text" class="form-control" id="sitio_web" name="sitio_web">
                        </div>
                        <button type="submit" class="btn btn-success">Crear Aerolínea</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para editar aerolínea -->
    <div class="modal fade" id="editAirlineModal" tabindex="-1" aria-labelledby="editAirlineModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAirlineModalLabel">Editar Aerolínea</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario de edición -->
                    <div id="edit-errors" class="alert alert-danger d-none">
                        <ul class="mb-0" id="edit-error-list"></ul>
                    </div>

                    <form id="editAirlineForm" action="{{ route('aerolineas.update', ['aerolinea' => 1]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="aerolinea_id" id="aerolinea_id">
                        <div class="mb-3">
                            <label for="edit_nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="edit_nombre" name="nombre" required>
                        </div>
                        <div class="mb-3 text-center">
                            <label class="form-label">Logo actual</label><br>
                            <img id="preview_logo" src="" alt="Logo actual" style="height: 40px; border-radius: 8px;">
                        </div>
                        <div class="mb-3">
                            <label for="edit_urlLogo" class="form-label">Logo</label>
                            <input type="file" class="form-control" id="edit_urlLogo" name="urlLogo" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="edit_paisOrigen" class="form-label">País de Origen</label>
                            <input type="text" class="form-control" id="edit_paisOrigen" name="paisOrigen">
                        </div>
                        <div class="mb-3">
                            <label for="edit_contacto" class="form-label">Contacto</label>
                            <input type="text" class="form-control" id="edit_contacto" name="contacto">
                        </div>
                        <div class="mb-3">
                            <label for="edit_sitio_web" class="form-label">Sitio Web</label>
                            <input type="text" class="form-control" id="edit_sitio_web" name="sitio_web">
                        </div>
                        <button type="submit" class="btn btn-success">Actualizar Aerolínea</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de aerolíneas -->
    <table id="adminTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>País Origen</th>
                <th>Contacto</th>
                <th>Sitio Web</th>
                <th>Logo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($aerolineas as $aerolinea)
                <tr>
                    <td>{{ $loop->iteration + ($aerolineas->currentPage() - 1) * $aerolineas->perPage() }}</td>
                    <td>{{ $aerolinea->nombre }}</td>
                    <td>{{ $aerolinea->paisOrigen }}</td>
                    <td>{{ $aerolinea->contacto }}</td>
                    <td>{{ $aerolinea->sitio_web }}</td>
                    <td>
                    @if($aerolinea->urlLogo)
                        <img src="{{ $aerolinea->urlLogo }}" alt="Logo" style="height: 50px;">
                        @else
                        <span>Sin logo</span>
                    @endif
                    </td>
                    <td>
                        <button class="btn btn-sm btn-info" onclick="openEditModal({{ $aerolinea->id }})">✏️ Editar</button>
                        <form action="{{ route('aerolineas.destroy', $aerolinea->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta aerolínea?')">🗑️ Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Paginación -->
    <div class="d-flex justify-content-center mt-4">
        {{ $aerolineas->links('pagination::bootstrap-5') }}
    </div>



<script>
    // Función para abrir el modal de edición y cargar los datos de la aerolínea en los campos
    function openEditModal(aerolineaId) {
    fetch(`/admin/aerolineas/${aerolineaId}/edit`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('aerolinea_id').value = data.id;
            document.getElementById('edit_nombre').value = data.nombre;
            document.getElementById('edit_paisOrigen').value = data.paisOrigen;
            document.getElementById('edit_contacto').value = data.contacto;
            document.getElementById('edit_sitio_web').value = data.sitio_web;

            // Actualizar el logo en la vista
            document.getElementById('preview_logo').src = data.urlLogo ?? '/images/default-logo.png';

            document.getElementById('editAirlineForm').action = `/admin/aerolineas/${data.id}`;

            const myModal = new bootstrap.Modal(document.getElementById('editAirlineModal'));
            myModal.show();
        })
        .catch(error => console.error('Error:', error));
}

document.querySelector('#createAirlineModal form').addEventListener('submit', function(e) {
    const form = this;
    const errorContainer = document.getElementById('create-errors');
    const errorList = document.getElementById('create-error-list');
    errorList.innerHTML = '';
    errorContainer.classList.add('d-none');

    let errors = [];

    // Validaciones básicas
    if (!form.nombre.value.trim()) errors.push("El nombre es obligatorio.");
    if (!form.paisOrigen.value.trim()) errors.push("El país de origen es obligatorio.");
    if (!form.contacto.value.trim()) errors.push("El contacto es obligatorio.");
    if (!form.sitio_web.value.trim()) errors.push("El sitio web es obligatorio.");

    // Validación opcional del logo (tipo de archivo)
    const file = form.urlLogo.files[0];
    if (file && !file.type.match('image.*')) {
        errors.push("El archivo del logo debe ser una imagen.");
    }

    if (errors.length > 0) {
        e.preventDefault();
        errors.forEach(err => {
            const li = document.createElement('li');
            li.textContent = err;
            errorList.appendChild(li);
        });
        errorContainer.classList.remove('d-none');
    }
});

document.querySelector('#editAirlineForm').addEventListener('submit', function(e) {
    const form = this;
    const errorContainer = document.getElementById('edit-errors');
    const errorList = document.getElementById('edit-error-list');
    errorList.innerHTML = '';
    errorContainer.classList.add('d-none');

    let errors = [];

    if (!form.nombre.value.trim()) errors.push("El nombre es obligatorio.");
    if (!form.paisOrigen.value.trim()) errors.push("El país de origen es obligatorio.");
    if (!form.contacto.value.trim()) errors.push("El contacto es obligatorio.");
    if (!form.sitio_web.value.trim()) errors.push("El sitio web es obligatorio.");

    const file = form.urlLogo.files[0];
    if (file && !file.type.match('image.*')) {
        errors.push("El archivo del logo debe ser una imagen.");
    }

    if (errors.length > 0) {
        e.preventDefault();
        errors.forEach(err => {
            const li = document.createElement('li');
            li.textContent = err;
            errorList.appendChild(li);
        });
        errorContainer.classList.remove('d-none');
    }
});



</script>


@endsection
