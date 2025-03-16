<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilos personalizados para ajustar el espacio */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* Asegura que el cuerpo ocupe al menos el 100% de la altura de la ventana */
            margin: 0;
            padding: 20px; /* Espacio alrededor del contenido */
            background-color: #f8f9fa; /* Fondo claro para mejor contraste */
        }
        .card {
            width: 100%;
            max-width: 400px; /* Limita el ancho máximo del formulario */
            margin: auto; /* Centra el formulario */
        }
    </style>
</head>
<body>
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
</body>
</html>