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
<h1>📅 Ofertas</h1>

<!-- Botón para Crear Oferta -->
<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createOfertaModal">
Crear Oferta
</button>

<!-- Modal de Crear Oferta -->
<div class="modal fade" id="createOfertaModal" tabindex="-1" aria-labelledby="createOfertaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('ofertas.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createOfertaLabel">Crear Oferta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="fechaInicio">Fecha Inicio:</label>
                    <input type="date" class="form-control" name="fechaInicio" id="fechaInicio" required>

                    <label for="fechaFin">Fecha Fin:</label>
                    <input type="date" class="form-control" name="fechaFin" id="fechaFin" required>

                    <label for="porcentajeDescuento">Porcentaje Descuento:</label>
                    <input type="number" class="form-control" name="porcentajeDescuento" required step="0.01">

                    <label for="estado">Estado:</label>
                    <select class="form-control" name="estado" required>
                        <option value="Activa">Activa</option>
                        <option value="Vencida">Vencida</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Guardar Oferta</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal para Editar Oferta -->
<div class="modal fade" id="editOfertaModal" tabindex="-1" aria-labelledby="editOfertaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editOfertaForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editOfertaLabel">Editar Oferta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="edit_FechaInicio">Fecha Inicio:</label>
                    <input type="date" class="form-control" name="FechaInicio" id="edit_FechaInicio" required>

                    <label for="edit_FechaFin">Fecha Fin:</label>
                    <input type="date" class="form-control" name="FechaFin" id="edit_FechaFin" required>

                    <label for="edit_porcentajeDescuento">Porcentaje Descuento:</label>
                    <input type="number" class="form-control" name="ProcentajeDescuento" id="edit_procentajeDescuento" required step="0.01">

                    <label for="edit_estado">Estado:</label>
                    <select class="form-control" name="estado" id="edit_estado" required>
                        <option value="Activa">Activa</option>
                        <option value="Vencida">Vencida</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Tabla de Ofertas -->
<table id="adminTable" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Fecha Inicio</th>
            <th>Fecha Fin</th>
            <th>Descuento (%)</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($ofertas as $oferta)
        <tr>
            <td>{{ $loop->iteration + ($ofertas->currentPage() - 1) * $ofertas->perPage() }}</td>
            <td>{{ \Carbon\Carbon::parse($oferta->FechaInicio)->format('Y/m/d') }}</td>
            <td>{{ \Carbon\Carbon::parse($oferta->FechaFin)->format('Y/m/d') }}</td>
            <td>{{ $oferta->ProcentajeDescuento }}%</td>
            <td>
                <span class="badge {{ $oferta->estado == 'Activa' ? 'bg-success' : 'bg-warning' }}">
                    {{ ucfirst($oferta->estado) }}
                </span>
            </td>
            <td>
                <button class="btn btn-info btn-sm" onclick="editOferta({{ $oferta->id }})">✏️ Editar</button>
                <form action="{{ route('ofertas.destroy', $oferta->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta aerolínea?')">🗑️ Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Paginación -->
<div class="d-flex justify-content-center mt-4">
    {{ $ofertas->links('pagination::bootstrap-5') }}
</div>

<script>

    document.querySelector('#createOfertaModal form').addEventListener('submit', function (e) {
        const fechaInicio = new Date(document.getElementById('fechaInicio').value);
        const fechaFin = new Date(document.getElementById('fechaFin').value);

        // Quitar alertas previas si existen
        document.querySelectorAll('.alert-danger.fecha-error').forEach(el => el.remove());

        if (fechaInicio >= fechaFin) {
            e.preventDefault(); // Evita el envío del formulario

            const alerta = document.createElement('div');
            alerta.classList.add('alert', 'alert-danger', 'fecha-error');
            alerta.innerHTML = '⚠️ La fecha de inicio debe ser anterior a la fecha de fin.';
            document.querySelector('#createOfertaModal .modal-body').prepend(alerta);
        }
    });


    document.querySelector('#editOfertaModal form').addEventListener('submit', function (e) {
    const fechaInicio = new Date(document.getElementById('edit_FechaInicio').value);
    const fechaFin = new Date(document.getElementById('edit_FechaFin').value);

    document.querySelectorAll('.alert-danger.fecha-error').forEach(el => el.remove());

    if (fechaInicio >= fechaFin) {
        e.preventDefault();
        const alerta = document.createElement('div');
        alerta.classList.add('alert', 'alert-danger', 'fecha-error');
        alerta.innerHTML = '⚠️ La fecha de inicio debe ser anterior a la fecha de fin.';
        document.querySelector('#editOfertaModal .modal-body').prepend(alerta);
    }
});





    // Función para abrir el modal de edición y cargar los datos de la oferta en los campos
    function editOferta(id) {
        fetch(`/admin/ofertas/${id}/edit`)  // Llamada al backend para obtener los datos de la oferta
            .then(response => response.json())
            .then(data => {
                const oferta = data.oferta;  // Obtiene los datos de la oferta

                // Cargar los datos en el modal de edición
                document.getElementById('edit_FechaInicio').value = oferta.FechaInicio.split('T')[0]; // Formato 'YYYY-MM-DD'
                document.getElementById('edit_FechaFin').value = oferta.FechaFin.split('T')[0]; // Formato 'YYYY-MM-DD'
                document.getElementById('edit_procentajeDescuento').value = oferta.ProcentajeDescuento;
                document.getElementById('edit_estado').value = oferta.estado;

                // Cambiar la acción del formulario de edición para que apunte a la ruta correcta
                document.getElementById('editOfertaForm').action = `/admin/ofertas/${oferta.id}`;

                // Mostrar el modal de edición
                const editModal = new bootstrap.Modal(document.getElementById('editOfertaModal'));
                editModal.show();
            })
            .catch(error => console.error('Error:', error));  // Manejo de errores
    }
</script>


@endsection
