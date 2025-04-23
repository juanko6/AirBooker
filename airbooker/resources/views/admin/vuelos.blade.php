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
<h1>✈️ Vuelos</h1>
<!-- Botón para abrir el modal -->
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createVueloModal">
    Crear Vuelo
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


<!-- Modal Crear Vuelo -->
<div class="modal fade" id="createVueloModal" tabindex="-1" aria-labelledby="createVueloModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('vuelos.store') }}" method="POST" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title">Crear Nuevo Vuelo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <!-- Formulario -->
        <div class="mb-3">
          <label>Aerolínea</label>
          <select name="aerolinea_id" class="form-control">
            @foreach($aerolineas as $aerolinea)
              <option value="{{ $aerolinea->id }}">{{ $aerolinea->nombre }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-3"><label>Fecha</label><input type="date" name="fecha" class="form-control"></div>
        <div class="mb-3"><label>Hora</label><input type="time" name="hora" class="form-control"></div>
        <div class="mb-3"><label>Origen</label><input type="text" name="origen" class="form-control"></div>
        <div class="mb-3"><label>Destino</label><input type="text" name="destino" class="form-control"></div>
        <div class="mb-3"><label>Precio</label><input type="number" step="0.01" name="precio" class="form-control"></div>
        <div class="mb-3">
          <label>Oferta</label>
          <select name="oferta_id" class="form-control">
            <option value="">Sin oferta</option>
            @foreach($ofertas as $oferta)
              <option value="{{ $oferta->id }}">{{ $oferta->ProcentajeDescuento }}%</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Guardar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Editar Vuelo -->

<div class="modal fade" id="editVueloModal" tabindex="-1">
  <div class="modal-dialog">
    <form id="editVueloForm" method="POST" class="modal-content">
      @csrf
      @method('PUT')
      <div class="modal-header">
        <h5 class="modal-title">Editar Vuelo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="vuelo_id" id="vuelo_id">
        <div class="mb-3">
          <label>Aerolínea</label>
          <select name="aerolinea_id" id="edit_aerolinea_id" class="form-control">
            @foreach($aerolineas as $aerolinea)
              <option value="{{ $aerolinea->id }}">{{ $aerolinea->nombre }}</option>
            @endforeach
          </select>
          
        <div class="mb-3"><label>Fecha</label><input type="date" name="fecha" id="edit_fecha" class="form-control"></div>
        <div class="mb-3"><label>Hora</label><input type="time" name="hora" id="edit_hora" class="form-control"></div>
        <div class="mb-3"><label>Origen</label><input type="text" name="origen" id="edit_origen" class="form-control"></div>
        <div class="mb-3"><label>Destino</label><input type="text" name="destino" id="edit_destino" class="form-control"></div>
        <div class="mb-3"><label>Precio</label><input type="number" step="0.01" name="precio" id="edit_precio" class="form-control"></div>

        </div>
        <div class="mb-3">
          <label>Oferta</label>
          <select name="oferta_id" id="edit_oferta_id" class="form-control">
            <option value="">Sin oferta</option>
            @foreach($ofertas as $oferta)
              <option value="{{ $oferta->id }}">{{ $oferta->ProcentajeDescuento }}%</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Actualizar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </form>
  </div>
</div>




<table id="adminTable" class="table table-striped table-bordered">
<thead>
        <tr>
            <th>ID</th>
            <th>Aerolinea</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Origen</th>
            <th>Destino</th>
            <th>Precio</th>
            <th>Oferta</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($vuelos as $vuelo)
        <tr>
            <td>{{ $loop->iteration + ($vuelos->currentPage() - 1) * $vuelos->perPage() }}</td>
            <td>{{ $vuelo->aerolinea->nombre }}</td>
            <td>{{ \Carbon\Carbon::parse($vuelo->fecha)->format('Y/m/d') }}</td>
            <td>{{ \Carbon\Carbon::parse($vuelo->hora)->format('H:i') }}</td>
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
        <button class="btn btn-sm btn-info" onclick="openEditModal({{ $vuelo->id }})">✏️ Editar</button>
        <form action="{{ route('vuelos.destroy', $vuelo->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este vuelo?')">🗑️ Eliminar</button>
</form>

        </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Paginación -->
<div class="d-flex justify-content-center mt-4">
{{ $vuelos->links('pagination::bootstrap-5') }}
</div>

<script>


function openEditModal(vueloId) {
  fetch(`/admin/vuelos/${vueloId}/edit`)
    .then(response => response.json())
    .then(data => {
        // Convertir fecha a formato YYYY-MM-DD
        const fecha = new Date(data.fecha).toISOString().split('T')[0];

        // Asegurar que la hora sea HH:MM
        const hora = data.hora.length > 5 ? data.hora.substring(0, 5) : data.hora;

        // Asignar los valores al formulario
        document.getElementById('vuelo_id').value = data.id;
        document.getElementById('edit_fecha').value = fecha;
        document.getElementById('edit_hora').value = hora;
        document.getElementById('edit_origen').value = data.origen;
        document.getElementById('edit_destino').value = data.destino;
        document.getElementById('edit_precio').value = data.precio;
        document.getElementById('edit_aerolinea_id').value = data.aerolinea_id;
        document.getElementById('edit_oferta_id').value = data.oferta_id;

        // Establecer la acción del formulario
        document.getElementById('editVueloForm').action = `/admin/vuelos/${data.id}`;

        // Mostrar el modal de edición
        let modal = new bootstrap.Modal(document.getElementById('editVueloModal'));
        modal.show();
    })
    .catch(error => console.error('Error:', error));
}

document.querySelector('#createVueloModal form').addEventListener('submit', function (e) {
    const origen = this.querySelector('[name="origen"]').value.trim();
    const destino = this.querySelector('[name="destino"]').value.trim();
    const fecha = this.querySelector('[name="fecha"]').value;
    const hora = this.querySelector('[name="hora"]').value;
    const precio = this.querySelector('[name="precio"]').value;
    const aerolinea_id = this.querySelector('[name="aerolinea_id"]').value;
    const soloLetras = /^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]+$/;
    const hoy = new Date().toISOString().split('T')[0];

    let errores = [];

    if (!origen) errores.push('El campo "Origen" es obligatorio.');
    else if (!soloLetras.test(origen)) errores.push('El campo "Origen" solo debe contener letras.');

    if (!destino) errores.push('El campo "Destino" es obligatorio.');
    else if (!soloLetras.test(destino)) errores.push('El campo "Destino" solo debe contener letras.');

    if (origen.toLowerCase() === destino.toLowerCase()) errores.push('El origen y el destino no pueden ser iguales.');

    if (!fecha) errores.push('El campo "Fecha" es obligatorio.');
    else if (fecha < hoy) errores.push('El campo "Fecha" debe ser una fecha posterior o igual a hoy.');

    if (!hora) errores.push('El campo "Hora" es obligatorio.');
    if (!precio || isNaN(precio) || parseFloat(precio) <= 0) errores.push('El campo "Precio" debe ser un número positivo.');
    if (!aerolinea_id) errores.push('Debe seleccionar una aerolínea.');

    if (errores.length > 0) {
        e.preventDefault();
        let errorContainer = document.createElement('div');
        errorContainer.classList.add('alert', 'alert-danger');
        errorContainer.innerHTML = errores.map(e => `<p>${e}</p>`).join('');
        this.querySelectorAll('.alert-danger').forEach(a => a.remove());
        this.querySelector('.modal-body').prepend(errorContainer);
    }
});


document.querySelector('#editVueloForm').addEventListener('submit', function (e) {
    const origen = document.getElementById('edit_origen').value.trim();
    const destino = document.getElementById('edit_destino').value.trim();
    const fecha = document.getElementById('edit_fecha').value;
    const hora = document.getElementById('edit_hora').value;
    const precio = document.getElementById('edit_precio').value;
    const aerolinea_id = document.getElementById('edit_aerolinea_id').value;
    const soloLetras = /^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]+$/;
    const hoy = new Date().toISOString().split('T')[0];

    let errores = [];

    if (!origen) errores.push('El campo "Origen" es obligatorio.');
    else if (!soloLetras.test(origen)) errores.push('El campo "Origen" solo debe contener letras.');

    if (!destino) errores.push('El campo "Destino" es obligatorio.');
    else if (!soloLetras.test(destino)) errores.push('El campo "Destino" solo debe contener letras.');

    if (origen.toLowerCase() === destino.toLowerCase()) errores.push('El origen y el destino no pueden ser iguales.');

    if (!fecha) errores.push('El campo "Fecha" es obligatorio.');
    else if (fecha < hoy) errores.push('El campo "Fecha" debe ser una fecha posterior o igual a hoy.');

    if (!hora) errores.push('El campo "Hora" es obligatorio.');
    if (!precio || isNaN(precio) || parseFloat(precio) <= 0) errores.push('El campo "Precio" debe ser un número positivo.');
    if (!aerolinea_id) errores.push('Debe seleccionar una aerolínea.');

    if (errores.length > 0) {
        e.preventDefault();
        let errorContainer = document.createElement('div');
        errorContainer.classList.add('alert', 'alert-danger');
        errorContainer.innerHTML = errores.map(e => `<p>${e}</p>`).join('');
        this.querySelectorAll('.alert-danger').forEach(a => a.remove());
        this.querySelector('.modal-body').prepend(errorContainer);
    }
});




</script>

@endsection