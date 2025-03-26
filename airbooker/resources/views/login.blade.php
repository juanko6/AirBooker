<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>    
    <style>
        /* Estilos personalizados para ajustar el espacio */        
        .card {
            width: 100%;
            max-width: 400px; /* Limita el ancho máximo del formulario */
            margin: 150px auto; /* Añade margen vertical de 50px y centra horizontalmente */
            padding: 25px 0; /* Añade padding arriba y abajo de 25px */
        }
    </style>
</head>
<body>
    @include('menu.header')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Iniciar Sesión</h3>
                    </div>
                    <div class="card-body">
                        <!-- Formulario de inicio de sesión -->
                        <form action="{{ route('login') }}" method="POST">
                            @csrf <!-- Token CSRF para protección -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                            </div>
                        </form>
                        <!-- Enlace para registrarse -->
                        <div class="mt-3 text-center">
                            <p>¿No tienes una cuenta? <a href="{{ route('signup') }}">Regístrate aquí</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('menu.footer')
    
</body>
</html>