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

@include('menu.header')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

{{--@section('content')--}}
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
            </div>
            
        </form>
        </div>
    </div>

    
    {{--@endsection--}}

@include('menu.footer')