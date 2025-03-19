
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel de Administración')</title>
    
    <!-- CSS Bootstrap y estilos personalizados -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('styles')
</head>

{{--@section('content')--}}
    <h1>Perfil de usuario</h1>
    <div >
        <div style="display:grid;grid-template-columns: 20% 20%;">
        Nombre: {{ $cliente->nombre }}
            <div style="display:inline-block;text-align:right">
                <form>
                    @csrf
                    <input id=nombre type=text name=nombre>
                    <button type=submit>Actualizar</button>
                </form>
            </div>           
        </div>

        <div style="display:grid;grid-template-columns: 20% 20%;">
        Apellidos: {{ $cliente->apellidos }}
            <div style="display:inline-block;text-align:right">
                <form>
                    @csrf
                    <input id=apellidos type=text name=apellidos></input>
                    <button type=submit>Actualizar</button>
                </form>
            </div>           
        </div>

        <div style="display:grid;grid-template-columns: 20% 20%;">
        Tef.: {{ $cliente->telefono }}
            <div style="display:inline-block;text-align:right">
                <form>
                    @csrf
                    <input id=telefono type=tel name=telefono></input>
                    <button type=submit>Actualizar</button>
                </form>
            </div>           
        </div>

        <div style="display:grid;grid-template-columns: 20% 20%;">
        DNI: {{ $cliente->dni}}
            <div style="display:inline-block;text-align:right">
                <form>
                    @csrf
                    <input id=dni type=text name=dni></input>
                    <button type=submit>Actualizar</button>
                </form>
            </div>           
        </div>

        <div style="display:grid;grid-template-columns: 20% 20%;">
        Núm. Pasaporte: {{ $cliente->pasaporte }}
            <div style="display:inline-block;text-align:right">
                <form>
                    @csrf
                    <input id=pasaporte type=text name=pasaporte></input>
                    <button type=submit>Actualizar</button>
                </form>
            </div>           
        </div>

        <div style="display:grid;grid-template-columns: 20% 20%;">
        Email: {{ $cliente->email }}
            <div style="display:inline-block;text-align:right">
                <form>
                    @csrf
                    <input id=email type=email name=email></input>
                    <button type=submit>Actualizar</button>
                </form>
            </div>           
        </div>

    </div>
    
    {{--@endsection--}}

