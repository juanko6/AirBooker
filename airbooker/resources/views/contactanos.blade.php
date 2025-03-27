
@extends('layouts.app')
@section('title', 'Contacto')
@section('content')
    <style>
        /* Estilos base */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        .main-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            flex: 1;
        }
        
        /* Estilo para la sección de contacto centrada */
        .centered-contact-section {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .centered-contact-text {
            margin-bottom: 20px;
        }
        
        .centered-contact-image {
            width: 200px;
            margin: 0 auto;
        }
        
        .centered-contact-image img {
            width: 100%;
            height: auto;
        }
        
        /* Formulario (mantenemos tus estilos originales) */
        .contact-form {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            width: 100%;
        }
        
        .form-row {
            display: flex;
            margin-bottom: 20px;
            gap: 20px;
            flex-wrap: wrap;
        }
        
        .form-group {
            flex: 1;
            min-width: 250px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        
        .form-group textarea {
            height: 100px;
            resize: vertical;
        }
        
        .submit-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            max-width: 200px;
            display: block;
            margin: 0 auto;
        }
        
        .submit-btn:hover {
            background-color: #45a049;
        }
        
        /* Sección FAQ */
        .faq-section {
            margin-top: 50px;
            width: 100%;
        }
        
        .faq-title {
            font-size: 24px;
            margin-bottom: 20px;
            color: #2c3e50;
            text-align: center;
        }
        
        .faq-item {
            margin-bottom: 15px;
            padding-left: 20px;
            position: relative;
        }
        
        .faq-item:before {
            content: "•";
            color: #4CAF50;
            font-size: 20px;
            position: absolute;
            left: 0;
        }
        
        .faq-question {
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        /* Líneas divisorias */
        .divider {
            border-top: 1px dashed #ccc;
            margin: 30px auto;
            width: 80%;
        }

        /* Footer */
        .footer {
            width: 100%;
            margin-top: auto;
        }

        /* Imagen de atención al cliente (se mantiene igual) */
        .attention-container {
            width: 100%;
            text-align: center;
            padding: 0;
            margin: 0;
            background-color: #f0f0f0;
        }

        .attention-image-wrapper {
            position: relative;
            width: 100%;
            max-height: 220px;
            overflow: hidden;
            border-radius: 0;
            box-shadow: none;
        }

        .attention-image {
            display: block;
            width: 100%;
            height: 220px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .attention-overlay-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 1.8rem;
            font-weight: bold;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            background-color: rgba(0, 0, 0, 0.6);
            padding: 8px 16px;
            border-radius: 5px;
            text-transform: uppercase;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
                gap: 15px;
            }
            
            .form-group {
                min-width: 100%;
            }
            
            .attention-overlay-text {
                font-size: 1.4rem;
                padding: 6px 12px;
            }
        }
    </style>

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