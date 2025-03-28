@extends('admin.layout')

@section('tablas')
    <h1>📊 Dashboard</h1>
    <div class="row">
        @include('admin.dashboard-cards')
    </div>

    @include('admin.reservas-grafica', ['reservasPorMes' => $reservasPorMes])
@endsection
