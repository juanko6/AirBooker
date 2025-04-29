@extends('layouts.app')

@section('title', 'Compra Exitosa')

@section('content')
<div class="container mt-5 pt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow text-center">
                <div class="card-body">
                    <h1 class="text-success"><i class="fas fa-check-circle me-2"></i> ¡GRACIAS POR SU COMPRA!</h1>
                    <p class="lead">Su compra ha sido procesada exitosamente.</p>
                    <a href="{{ route('home') }}" class="btn btn-primary">
                        <i class="fas fa-home me-2"></i> Volver al Inicio
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection