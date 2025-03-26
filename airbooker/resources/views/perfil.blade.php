<head>
    .cuadroOpciones {
        display:grid;
        grid-template-columns: 20% 20%;
    }
    .elemDerecho {
        display:inline-block;
        text-align:right;
    }
</head>


{{--@section('content')--}}
    <h1>Perfil de usuario</h1>
    <div >
        <div class="cuadroOpciones">
        Nombre: {{ $cliente->nombre }}
            <div class="elemDerecho">
                <form>
                    @csrf
                    <input id=nombre type=text name=nombre>
                    <button type=submit>Actualizar</button>
                </form>
            </div>           
        </div>

        <div class="cuadroOpciones">
        Apellidos: {{ $cliente->apellidos }}
            <div class="elemDerecho">
                <form>
                    @csrf
                    <input id=apellidos type=text name=apellidos></input>
                    <button type=submit>Actualizar</button>
                </form>
            </div>           
        </div>

        <div class="cuadroOpciones">
        Tef.: {{ $cliente->telefono }}
            <div class="elemDerecho">
                <form>
                    @csrf
                    <input id=telefono type=tel name=telefono></input>
                    <button type=submit>Actualizar</button>
                </form>
            </div>           
        </div>

        <div class="cuadroOpciones">
        DNI: {{ $cliente->dni}}
            <div class="elemDerecho">
                <form>
                    @csrf
                    <input id=dni type=text name=dni></input>
                    <button type=submit>Actualizar</button>
                </form>
            </div>           
        </div>

        <div class="cuadroOpciones">
        Núm. Pasaporte: {{ $cliente->pasaporte }}
            <div class="elemDerecho">
                <form>
                    @csrf
                    <input id=pasaporte type=text name=pasaporte></input>
                    <button type=submit>Actualizar</button>
                </form>
            </div>           
        </div>

        <div class="cuadroOpciones">
        Email: {{ $cliente->email }}
            <div class="elemDerecho">
                <form>
                    @csrf
                    <input id=email type=email name=email></input>
                    <button type=submit>Actualizar</button>
                </form>
            </div>           
        </div>

    </div>
    
    {{--@endsection--}}

