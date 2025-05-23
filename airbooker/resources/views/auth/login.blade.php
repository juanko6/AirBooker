@extends('layouts.app')

@section('content')
<div class="container-fluid d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="row shadow rounded" style="background: #fff; overflow: hidden; width: 90%; max-width: 1200px; height: 80vh;">

        {{-- Columna Izquierda --}}
        <div class="col-md-6 d-flex flex-column justify-content-center align-items-center p-4">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Avión" style="max-width: 120px;">
            <p class="mt-4 text-center">
                Inicie sesión en su cuenta mediante el formulario a la derecha.<br>
                Si tiene algún problema para acceder a su cuenta, no dude en contactarnos lo antes posible.
            </p>
        </div>

        {{-- Columna Derecha (Formulario) --}}
        <div class="col-md-6 d-flex flex-column justify-content-center p-5" style="background: linear-gradient(135deg, #00274d, #005c97); color: #fff;">
            <div class="text-center mb-4 mt-3">
                <img src="{{ asset('images/iniciarsesion.png') }}" alt="Login Icon" style="width: 200px;">
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <span class="invalid-feedback d-block text-warning">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <input id="password" type="password" placeholder="Contraseña" class="form-control @error('password') is-invalid @enderror" name="password" required>
                    @error('password')
                        <span class="invalid-feedback d-block text-warning">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 text-center">
                    <button type="submit" class="btn btn-warning btn-sm text-dark fw-bold px-4 py-2" style="width: 150px;">Acceder</button>
                </div>

                <div class="text-center">
                    <a href="{{ route('register') }}" class="text-decoration-none text-warning">¿Aún no te unes? Hazlo ahora</a>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
