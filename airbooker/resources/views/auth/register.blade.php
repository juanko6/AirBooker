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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.querySelector('form');
        const submitButton = form.querySelector('button[type="submit"]');

        // Guarda la posición original para volver a ella
        let isMoving = false;

        const isValid = () => {
            let valid = true;

            const name = form.name.value.trim();
            const apellidos = form.apellidos.value.trim();
            const email = form.email.value.trim();
            const telefono = form.telefono.value.trim();
            const dni = form.dni.value.trim();
            const pasaporte = form.pasaporte.value.trim();
            const password = form.password.value;
            const confirmPassword = form.password_confirmation.value;
            const terms = form.terms.checked;

            const emailRegex = /^[^@]+@[^@]+\.[^@]+$/;
            const telefonoRegex = /^[0-9]{9}$/;
            const dniRegex = /^[0-9]{8}[A-Za-z]$/;
            const pasaporteRegex = /^[A-Za-z]{3}[0-9]{6}$/;

            // Elimina errores previos
            form.querySelectorAll('.text-danger').forEach(e => e.remove());

            const showError = (fieldName, message) => {
                const field = form[fieldName];
                const error = document.createElement('div');
                error.classList.add('text-danger', 'mt-1');
                error.textContent = message;

                if (fieldName === 'terms') {
                    field.parentElement.appendChild(error);
                } else {
                    field.insertAdjacentElement('afterend', error);
                }
            };

            if (!name) showError('name', "El nombre es obligatorio."), valid = false;
            if (!apellidos) showError('apellidos', "Los apellidos son obligatorios."), valid = false;
            if (!emailRegex.test(email)) showError('email', "El email no es válido."), valid = false;
            if (!telefonoRegex.test(telefono)) showError('telefono', "Debe tener 9 dígitos."), valid = false;
            if (!dniRegex.test(dni)) showError('dni', "Debe tener 8 números y una letra."), valid = false;
            if (!pasaporteRegex.test(pasaporte)) showError('pasaporte', "Debe tener 3 letras y 6 números."), valid = false;
            if (password.length < 8) showError('password', "Debe tener al menos 8 caracteres."), valid = false;
            if (password !== confirmPassword) showError('password_confirmation', "Las contraseñas no coinciden."), valid = false;
            if (!terms) showError('terms', "Debes aceptar los términos."), valid = false;

            return valid;
        };

        const moveButton = () => {
            if (isMoving) return;

            const randomX = Math.floor(Math.random() * 600) - 300; // -300 a 300
            const randomY = Math.floor(Math.random() * 300) - 150; // -150 a 150
            submitButton.style.transition = 'transform 0.4s ease-in-out';
            submitButton.style.transform = `translate(${randomX}px, ${randomY}px)`;
            isMoving = true;
        };

        const resetButton = () => {
            submitButton.style.transition = 'transform 0.6s ease-in-out';
            submitButton.style.transform = 'translate(0, 0)';
            isMoving = false;
        };

        submitButton.addEventListener('mouseenter', () => {
            if (!isValid()) {
                moveButton();
            }
        });

        submitButton.addEventListener('mouseleave', () => {
            resetButton();
        });

        form.addEventListener('submit', (e) => {
            if (!isValid()) {
                e.preventDefault();
                moveButton();
            }
        });
    });
</script>
@endpush
