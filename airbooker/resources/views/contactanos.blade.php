@extends('layouts.app')
@section('title', 'Contacto')
@section('content') 

<!-- Imagen de atención al cliente -->
<div class="attention-container">
    <div class="attention-image-wrapper">
        <img src="{{ asset('images/paisaje.webp') }}" alt="Imagen de Contáctanos" class="attention-image">
        <div class="attention-overlay-text">ATENCIÓN AL CLIENTE</div>
    </div>
</div>

<div class="main-container">
    <!-- Sección de Contacto -->
    <div class="centered-contact-section">
        <div class="centered-contact-text">
            <h2>Contacta con AirBooker</h2>
            <p>Puedes enviarnos tus comentarios y propuestas, hacer consultas o reclamaciones y contarnos cualquier detalle.</p>
        </div>
    </div>

    <!-- Mensaje de éxito -->
    @if(session('success'))
        <div id="success-message" style="color: green; text-align:center; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulario -->
    <div class="contact-form">
        <div class="centered-contact-image">
            <img src="{{ asset('images/asistenta.png') }}" alt="Asistente de AirBooker">
        </div>

        <form action="{{ route('contactanos.enviar') }}" method="POST" id="contactForm">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <input type="text" name="nombre" placeholder="Nombre" required>
                </div>
                <div class="form-group">
                    <input type="text" name="apellidos" placeholder="Apellidos" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="tel" name="telefono" placeholder="Número teléfono">
                </div>
            </div>

            <div class="form-group">
                <input type="text" name="asunto" placeholder="Asunto" required>
            </div>

            <div class="form-group">
                <textarea name="mensaje" placeholder="Mensaje" required></textarea>
            </div>

            <button type="submit" class="submit-btn">Enviar</button>
        </form>
    </div>

    <div class="divider"></div>
</div>

<!-- Script para limpiar el formulario tras el envío -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const successMessage = document.getElementById('success-message');
        if (successMessage) {
            setTimeout(() => {
                document.getElementById('contactForm').reset();
            }, 300);
        }
    });
</script>

@endsection
@extends('layouts.app')
@section('title', 'Contacto')
@section('content') 

<!-- Imagen de atención al cliente -->
<div class="attention-container">
    <div class="attention-image-wrapper">
        <img src="{{ asset('images/paisaje.webp') }}" alt="Imagen de Contáctanos" class="attention-image">
        <div class="attention-overlay-text">ATENCIÓN AL CLIENTE</div>
    </div>
</div>

<div class="main-container">
    <!-- Sección de Contacto -->
    <div class="centered-contact-section">
        <div class="centered-contact-text">
            <h2>Contacta con AirBooker</h2>
            <p>Puedes enviarnos tus comentarios y propuestas, hacer consultas o reclamaciones y contarnos cualquier detalle.</p>
        </div>
    </div>

    <!-- Mensaje de éxito -->
    @if(session('success'))
        <div id="success-message" style="color: green; text-align:center; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulario -->
    <div class="contact-form">
        <div class="centered-contact-image">
            <img src="{{ asset('images/asistenta.png') }}" alt="Asistente de AirBooker">
        </div>

        <form action="{{ route('contactanos.enviar') }}" method="POST" id="contactForm">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <input type="text" name="nombre" placeholder="Nombre" required>
                </div>
                <div class="form-group">
                    <input type="text" name="apellidos" placeholder="Apellidos" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="tel" name="telefono" placeholder="Número teléfono">
                </div>
            </div>

            <div class="form-group">
                <input type="text" name="asunto" placeholder="Asunto" required>
            </div>

            <div class="form-group">
                <textarea name="mensaje" placeholder="Mensaje" required></textarea>
            </div>

            <button type="submit" class="submit-btn">Enviar</button>
        </form>
    </div>

    <div class="divider"></div>
</div>

<!-- Script para limpiar el formulario tras el envío -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const successMessage = document.getElementById('success-message');
        if (successMessage) {
            setTimeout(() => {
                document.getElementById('contactForm').reset();
            }, 300);
        }
    });
</script>

@endsection
