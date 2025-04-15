@extends('layouts.app')

@section('content')

<div class="container-fluid py-5">
    <div class="text-center mb-4">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width: 100px;">
        <h5 class="mt-3">¡Date de alta en <strong>AirBooker</strong> y disfruta al momento de todas las ventajas!</h5>
    </div>

    <div class="mx-auto p-5 shadow rounded" style="max-width: 800px; background: linear-gradient(135deg, #00274d, #008ccf); color: white;">
        <div class="text-center mb-4">
            <img src="{{ asset('images/registrarse.png') }}" alt="Registro" style="width: 300px;">
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <input type="text" name="name" class="form-control" placeholder="Nombre" required value="{{ old('name') }}">
                </div>
                <div class="col-md-6">
                    <input type="text" name="apellidos" class="form-control" placeholder="Apellidos" required value="{{ old('apellidos') }}">
                </div>

                <div class="col-md-6">
                    <input type="email" name="email" class="form-control" placeholder="Email" required value="{{ old('email') }}">
                </div>
                <div class="col-md-6">
                    <input type="text" name="telefono" class="form-control" placeholder="Número teléfono" required value="{{ old('telefono') }}">
                </div>

                <div class="col-md-6">
                    <input type="text" name="dni" class="form-control" placeholder="DNI" required value="{{ old('dni') }}">
                </div>
                <div class="col-md-6">
                    <input type="text" name="pasaporte" class="form-control" placeholder="Pasaporte" required value="{{ old('pasaporte') }}">
                </div>

                <div class="col-md-6">
                    <input type="password" name="password" class="form-control" placeholder="*Contraseña" required>
                </div>
                <div class="col-md-6">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="*Repetir contraseña" required>
                </div>

                <div class="col-12">
                    <div class="form-check text-white">
                        <input type="checkbox" class="form-check-input" id="terms" required>
                        <label class="form-check-label" for="terms">
                            Acepto los <a href="#" class="text-warning text-decoration-none">términos y condiciones de AirBooker</a> y la <a href="#" class="text-warning text-decoration-none">Política de privacidad de AirBooker</a>.
                        </label>
                    </div>
                </div>

                <div class="col-12 text-center mt-3">
                    <button type="submit" class="btn btn-warning px-5 fw-bold">Registrar</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
