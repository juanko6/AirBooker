<head>
    <style>
        .column {
            padding:10px;
            float:left;
            width: 30%;
        }
        .row:after{
            content:"";
            display:table;
            clear:both;
        }
    </style>
</head>

@extends('layoutCliente')


@section('DashboardContent')

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

    <div style="padding:15px;">
        <h1>📝 Perfil de usuario</h1>
    
        <div class="row">

        <form id="actualizarUsuarioForm" action="{{ route('users.update', ['user' => $usuario->id]) }}" method="POST">
        @csrf
        @method('PUT')
            <input type="hidden" name="rol" id="formRol" value="{{ $usuario->rol }}">
            <div class="column">
                <div class="mb-3">
                    <label for="formNombre" class="form-label">Nombre</label>
                    
                    <input id="formNombre" class="form-control" type="text" name="name" value="{{ $usuario->name }}" required>
                    
                </div>
                <div class="mb-3">
                    <label for="formApellidos" class="form-label">Apellidos</label>
                    
                    <input id="formApellidos" class="form-control" type="text" name="apellidos" value="{{ $usuario->apellidos }}"required>

                </div>
                <div class="mb-3">
                    <label for="formTelefono" class="form-label">Telefono</label>

                    <input id="formTelefono" class="form-control" type="tel" name="telefono" value="{{ $usuario->telefono }}" required>

                </div>
                <div class="mb-3">
                    <label for="formPassword" class="form-label">Nueva Contraseña</label>

                    <input id="formPassword" class="form-control" type="password" name="password">

                </div> 
                <button type="submit" class="btn btn-success">Actualizar Datos</button>
            </div>
            <div class="column">
                <div class="mb-3">
                    <label for="formDNI" class="form-label">DNI</label>

                    <input id="formDNI" class="form-control" type="text" name="dni" value="{{ $usuario->dni}}" required>

                </div>
                <div class="mb-3">
                    <label for="formPasaporte" class="form-label">Núm. Pasaporte</label>

                    <input id="formPasaporte" class="form-control" type="text" name="pasaporte" value="{{ $usuario->pasaporte }}"required>

                </div>
                <div class="mb-3">
                    <label for="formCorreo" class="form-label">Email</label>

                    <input id="formCorreo" class="form-control" type="email" name="email" value="{{ $usuario->email }}" required>

                </div> 
                <div class="mb-3">
                    <label for="formPassConfirm" class="form-label">Confirmar Contraseña</label>

                    <input id="formPassConfirm" class="form-control" type="password" name="password_confirmation">

                </div> 
            </div>
            
        </form>
        </div>
    </div>

    
@endsection
