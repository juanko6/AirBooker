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
<h1>📅 Reservas</h1>

<!-- Botón para Crear Reserva -->
<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createReservaModal">
Crear Reserva
</button>

<!-- Modal de Crear Reserva -->
<div class="modal fade" id="createReservaModal" tabindex="-1" aria-labelledby="createReservaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('reservas.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createReservaLabel">Crear Reserva</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Búsqueda de Usuario -->
                    <label>Buscar Usuario:</label>
                    <input type="text" class="form-control mb-2" id="searchUser" placeholder="Buscar por nombre o apellidos">
                    <select class="form-control" name="user_id" id="userSelect">
                        <option value="" disabled selected>Seleccione un usuario...</option>
                    </select>

                    <!-- Búsqueda de Vuelo -->
                    <label>Filtrar Vuelos por Fecha:</label>
                    <input type="date" class="form-control mb-2" id="searchFlightDate">
                    <select class="form-control" name="vuelo_id" id="flightSelect">
                        <option value="" disabled selected>Seleccione un vuelo...</option>
                    </select>

                    <!-- Mensaje si no hay vuelos -->
                    <div id="noFlightsMessage" class="alert alert-warning" style="display: none;">
                        No hay vuelos para este día.
                    </div>

                    <!-- Campos adicionales -->
                    <label>Fecha de Reserva:</label>
                    <input type="datetime-local" class="form-control" name="fecha" required>
                    <label>Precio:</label>
                    <input type="number" class="form-control" name="precio" step="0.01" required>
                    <label>Estado:</label>
                    <select class="form-control" name="estado" required>
                        <option value="confirmada">Confirmada</option>
                        <option value="pendiente">Pendiente</option>
                        <option value="cancelada">Cancelada</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para Editar Reserva -->
<div class="modal fade" id="editReservaModal" tabindex="-1" aria-labelledby="editReservaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editReservaForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editReservaLabel">Editar Reserva</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label>Usuario:</label>
                    <select class="form-control" name="user_id" id="editUserSelect"></select>

                    <label>Fecha:</label>
                    <input type="datetime-local" class="form-control" name="fecha" id="editFecha" required>

                    <label>Vuelo:</label>
                    <select class="form-control" name="vuelo_id" id="editFlightSelect"></select>

                    <label>Precio:</label>
                    <input type="number" class="form-control" name="precio" id="editPrecio" step="0.01" required>

                    <label>Estado:</label>
                    <select class="form-control" name="estado" id="editEstado" required>
                        <option value="confirmada">Confirmada</option>
                        <option value="pendiente">Pendiente</option>
                        <option value="cancelada">Cancelada</option>
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


<table id="adminTable" class="table table-striped table-bordered">
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
            <td>{{ $loop->iteration + ($reservas->currentPage() - 1) * $reservas->perPage() }}</td>
            <td>
                <span class="badge {{ $reserva->estado == 'confirmada' ? 'bg-success' : ($reserva->estado == 'pendiente' ? 'bg-warning' : 'bg-danger') }}">
                    {{ ucfirst($reserva->estado) }}
                </span>
            </td>
            <td>{{ \Carbon\Carbon::parse($reserva->fecha)->format('Y/m/d') }}</td>
            <td>${{ number_format($reserva->precio, 2) }}</td>
            <td>{{ $reserva->user->name ?? 'Sin asignar' }} {{ $reserva->user->apellidos ?? '' }}</td>
            <td>{{ optional($reserva->vuelo)->origen }} → {{ optional($reserva->vuelo)->destino }}</td>
            <td>
    <button class="btn btn-info btn-sm" onclick="editReserva({{ $reserva->id }})">✏️ Editar</button>
    <form action="{{ route('reservas.destroy', $reserva->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger btn-sm" onclick="deleteReserva({{ $reserva->id }})">🗑️ Eliminar</button>

    </form>
</td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Paginación -->
<div class="d-flex justify-content-center mt-4">
{{ $reservas->links('pagination::bootstrap-5') }}
</div>

<!-- Scripts de búsqueda dinámica -->
<script>
    document.getElementById('searchUser').addEventListener('input', function() {
        const query = this.value;
        fetch(`/api/usuarios?query=${query}`)
            .then(response => response.json())
            .then(data => {
                const userSelect = document.getElementById('userSelect');
                userSelect.innerHTML = '';
                data.forEach(user => {
                    const option = document.createElement('option');
                    option.value = user.id;
                    option.textContent = `${user.name} ${user.apellidos}`;
                    userSelect.appendChild(option);
                });
            });
    });

    document.getElementById('searchFlightDate').addEventListener('change', function() {
    const date = this.value;
    fetch(`/api/vuelos?fecha=${date}`)
        .then(response => {
            if (!response.ok) throw new Error('Error al obtener vuelos');
            return response.json(); // Se espera una respuesta en formato JSON
        })
        .then(data => {
            const flightSelect = document.getElementById('flightSelect');
            flightSelect.innerHTML = ''; // Limpiar las opciones actuales

            // Mostrar el mensaje de "No hay vuelos" si no hay vuelos
            const noFlightsMessage = document.getElementById('noFlightsMessage');
            if (data.no_vuelos) {
                noFlightsMessage.style.display = 'block'; // Mostrar mensaje
            } else {
                noFlightsMessage.style.display = 'none'; // Ocultar mensaje
                // Si hay vuelos, agregar opciones al select
                data.vuelos.forEach(vuelo => {
                    const option = document.createElement('option');
                    option.value = vuelo.id; // Asegúrate de que el valor es el ID correcto
                    option.textContent = `${vuelo.origen} → ${vuelo.destino}`; // Muestra la información adecuada
                    flightSelect.appendChild(option);
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al filtrar los vuelos');
        });
});





function editReserva(id) {
    // Obtener los datos de la reserva
    fetch(`/admin/reservas/${id}/edit`)
        .then(response => response.json())
        .then(data => {
            const reserva = data.reserva;
            const usuarios = data.usuarios; // Lista de usuarios, pero solo uno se debe mostrar
            const vuelos = data.vuelos;

            // Cargar solo el usuario asociado a la reserva
            const userSelect = document.getElementById('editUserSelect');
            userSelect.innerHTML = ''; // Limpiar las opciones actuales

            // Crear la opción para el usuario asociado a la reserva
            const option = document.createElement('option');
            option.value = reserva.user_id;  // Usamos el ID del usuario asociado
            option.textContent = `${reserva.user.name} ${reserva.user.apellidos}`;
            option.selected = true; // Seleccionar el usuario correcto
            userSelect.appendChild(option);

            // Cargar el vuelo de la reserva seleccionada
            const flightSelect = document.getElementById('editFlightSelect');
            flightSelect.innerHTML = ''; // Limpiar las opciones actuales

            const selectedFlight = vuelos.find(vuelo => vuelo.id === reserva.vuelo_id);
            const flightOption = document.createElement('option');
            flightOption.value = selectedFlight.id;
            flightOption.textContent = `${selectedFlight.origen} → ${selectedFlight.destino}`;
            flightOption.selected = true; // Seleccionar el vuelo correcto
            flightSelect.appendChild(flightOption);

            // Cargar otros datos

            let fecha = reserva.fecha;
            fecha = fecha.split('T')[0] + 'T' + fecha.split('T')[1].split('.')[0];

            document.getElementById('editFecha').value = fecha;
            document.getElementById('editPrecio').value = reserva.precio;
            document.getElementById('editEstado').value = reserva.estado;

            // Configurar la acción del formulario
            const editForm = document.getElementById('editReservaForm');
            editForm.action = `/admin/reservas/${id}`;

            // Mostrar el modal
            const editModal = new bootstrap.Modal(document.getElementById('editReservaModal'));
            editModal.show();
        })
        .catch(error => console.error('Error al cargar la reserva:', error));
}

// Filtrar vuelos por fecha
document.getElementById('editFecha').addEventListener('change', function() {
    const date = this.value;  // Fecha con hora: YYYY-MM-DDTHH:MM

    // Extraer solo la fecha (YYYY-MM-DD)
    const dateOnly = date.split('T')[0];  // Esto obtiene solo la parte de la fecha

    fetch(`/api/vuelos?fecha=${dateOnly}`)  // Ahora solo se pasa la fecha
        .then(response => {
            if (!response.ok) throw new Error('Error al obtener vuelos');
            return response.json(); // Se espera una respuesta en formato JSON
        })
        .then(data => {
            const flightSelect = document.getElementById('editFlightSelect');
            flightSelect.innerHTML = ''; // Limpiar las opciones actuales

            // Mostrar el mensaje de "No hay vuelos" si no hay vuelos
            const noFlightsMessage = document.getElementById('noFlightsMessage');
            if (data.no_vuelos || !data.vuelos || data.vuelos.length === 0) {
                noFlightsMessage.style.display = 'block'; // Mostrar mensaje
            } else {
                noFlightsMessage.style.display = 'none'; // Ocultar mensaje
                // Si hay vuelos, agregar opciones al select
                data.vuelos.forEach(vuelo => {
                    const option = document.createElement('option');
                    option.value = vuelo.id;
                    option.textContent = `${vuelo.origen} → ${vuelo.destino}`;
                    flightSelect.appendChild(option);
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al filtrar los vuelos');
        });
});





function deleteReserva(id) {
    if (confirm("¿Estás seguro de que deseas eliminar esta reserva?")) {
        fetch(`/admin/reservas/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Reserva eliminada con éxito');
                location.reload();
            } else {
                alert('Error al eliminar la reserva');
            }
        })
        .catch(error => console.error('Error al eliminar la reserva:', error));
    }
}
</script>
@endsection
