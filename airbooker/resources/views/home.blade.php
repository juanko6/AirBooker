<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <!-- Incluir CSS global -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    @include('menu.header')

    <main class="content">
        @php
            $messages = array_fill(0, 50, '<h3>BIENVENIDO A AIRBOOKER</h3>');
            echo implode('', $messages);                            
        @endphp
    </main>

    <footer class="footer">
        @include('menu.footer')
    </footer>    
</body>
</html>