
@extends('layouts.app')
@section('title', 'Contacto')
@section('content') 

<!-- Imagen de atención al cliente (se mantiene igual) -->
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
    
    <!-- Formulario -->
    <div class="contact-form">
        <div class="centered-contact-image">
            <img src="{{ asset('images/asistenta.png') }}" alt="Asistente de AirBooker">
        </div>

        <div class="form-row">
            <div class="form-group">
                <input type="text" placeholder="Nombre" required>
            </div>
            <div class="form-group">
                <input type="text" placeholder="Apellidos" required>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <input type="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="tel" placeholder="Número teléfono">
            </div>
        </div>
        
        <div class="form-group">
            <input type="text" placeholder="Asunto" required>
        </div>
        
        <div class="form-group">
            <textarea placeholder="Mensaje" required></textarea>
        </div>
        
        <button type="submit" class="submit-btn">Enviar</button>
    </div>
    
    <div class="divider"></div>
    
    <!-- Sección FAQ -->
    <div class="faq-section">
        <h2 class="faq-title">Preguntas Frecuentes</h2>
        <p>¿Es aquí donde puedo incluir algunas preguntas frecuentes?</p>
        <p>Sí, exactamente. Aquí puedes proporcionar respuestas inmediatas a algunas preguntas comunes y urgentes.</p>
        <p>Esto no solo reducirá tus tickets de soporte, sino que también tranquilizará a los usuarios y hará que sea más probable que hagan clic en tu llamado a la acción.</p>
        
        <div class="faq-item">
            <div class="faq-question">Esta es una pregunta frecuente. <a href="#">¿psum dolor sit amet?</a></div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">Esta es una pregunta frecuente. <a href="#">¿psum dolor sit amet?</a></div>
        </div>
    </div>
</div>

@endsection