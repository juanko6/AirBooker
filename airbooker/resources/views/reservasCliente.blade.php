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
        <div class="card-header {{ $reserva->estado == 'confirmada' ? 'bg-success' : ($reserva->estado == 'pendiente' ? 'bg-warning' : 'bg-danger') }}">
            Estado: {{ ucfirst($reserva->estado) }}
        </div>
        <div class="card-body bg-white">
            <h5 class="card-title">{{ optional($reserva->vuelo)->origen }} → {{ optional($reserva->vuelo)->destino }}</h5>
            <p class="card-text"> Fecha: {{ $reserva->fecha }} </p>
        </div>
        <div class="card-footer bg-light">
            @if($reserva->estado == 'confirmada')
                <form id="cancelarReserva" action="/admin/reservas/{{$reserva->id}}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="user_id" id="editUserSelect" value="{{$reserva->user_id}}"></input>
                    <input type="hidden" name="vuelo_id" id="editFlightSelect" value="{{$reserva->vuelo_id}}"></input>
                    <input type="hidden" name="fecha" id="editFecha" value="{{$reserva->fecha}}">
                    <input type="hidden" name="precio" id="editPrecio" value="{{$reserva->precio}}">
                    <input type="hidden" name="estado" id="editEstado" value="cancelada">
                    <button type="submit" class="btn btn-sm btn-info">❌ Cancelar</button>
                </form>
            @else
            <div style="height:31px"></div>
            @endif
        </div>
    </div>
    @endforeach

</div>

<!-- Paginación -->
<div class="d-flex justify-content-center mt-4">
{{ $reservas->links('pagination::bootstrap-5') }}
</div>


@endsection