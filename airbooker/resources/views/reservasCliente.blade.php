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

<h1>📅 Mis Reservas</h1>

<div class="card-deck row">

    @foreach($reservas as $reserva)
    <div class="card mb-3 column" style="max-width: 18rem;">
        <div class="card-header {{ $reserva->estado == 'confirmada' ? 'bg-success' : 'bg-warning' }}">
            Estado: {{ ucfirst($reserva->estado) }}
        </div>
        <div class="card-body bg-white">
            <h5 class="card-title">{{ optional($reserva->vuelo)->origen }} → {{ optional($reserva->vuelo)->destino }}</h5>
            <p class="card-text"> Fecha: {{ $reserva->fecha }} </p>
        </div>
        <div class="card-footer bg-light">
            <button class="btn btn-sm btn-info">❌ Cancelar</button>
        </div>
    </div>
    @endforeach

</div>

<!-- Paginación -->
<div class="d-flex justify-content-center mt-4">
{{ $reservas->links('pagination::bootstrap-5') }}
</div>


@endsection