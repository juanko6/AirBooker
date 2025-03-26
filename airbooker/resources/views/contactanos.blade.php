<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contáctanos - AirBooker</title>
    <style>
        /* Estilos base */
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
        }
        
        /* Sección de contacto */
        .contact-header {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .contact-text {
            flex: 1;
            padding-right: 40px;
        }
        
        .contact-image {
            width: 200px;
        }
        
        .contact-image img {
            width: 100%;
            height: auto;
        }
        
        /* Formulario */
        .contact-form {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .form-row {
            display: flex;
            margin-bottom: 20px;
            gap: 20px;
        }
        
        .form-group {
            flex: 1;
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
        }
        
        .submit-btn:hover {
            background-color: #45a049;
        }
        
        /* Sección FAQ */
        .faq-section {
            margin-top: 50px;
        }
        
        .faq-title {
            font-size: 24px;
            margin-bottom: 20px;
            color: #2c3e50;
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
            margin: 30px 0;
        }
    </style>
</head>
<body>
    <!-- Sección de Contacto -->
    <div class="contact-header">
        <div class="contact-text">
            <h2>Contacta con AirBooker</h2>
            <p>Puedes enviarnos tus comentarios y propuestas, hacer consultas o reclamaciones y contarnos cualquier detalle.</p>
        </div>
        <div class="contact-image">
            <!-- Reemplaza con tu imagen de la mujer -->
            <img src="https://i.imgur.com/Jf6o3yK.png" alt="Asistente de AirBooker">
        </div>
    </div>
    
    <div class="contact-form">
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
        <h2 class="faq-title">FAQ</h2>
        <p>Is this where I can include some frequently asked questions?</p>
        <p>Yes, exactly. Here you can provide immediate answers to a few common and pressing questions.</p>
        <p>This will not only reduce your support tickets, but it will also reassure users - and make them more likely to click your CTA.</p>
        
        <div class="faq-item">
            <div class="faq-question">This is a frequently asked question. <a href="#">psum dolor sit amet?</a></div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">This is a frequently asked question. <a href="#">psum dolor sit amet?</a></div>
        </div>
    </div>
</body>
</html>