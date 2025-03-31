<!-- Sección de FAQ -->
<div class="styl-faq-custome" id="faq-section">
    
    <div class="container">
        <h1>FAQ</h1>
        <p class="text-center">Encuentra respuestas a las preguntas más comunes sobre nuestros servicios.</p>
        <div class="faq-section">
        <div class="faq-item">
            <div class="faq-question">¿Cómo puedo reservar un vuelo con Airbooker?</div>
            <div class="faq-answer">
            Para reservar un vuelo, simplemente ingresa a nuestra plataforma, selecciona tu destino, fechas y sigue los pasos del proceso de compra. ¡Es rápido y seguro!
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question">¿Qué métodos de pago aceptan?</div>
            <div class="faq-answer">
            Aceptamos tarjetas de crédito/débito (Visa, Mastercard, American Express), PayPal y transferencias bancarias. Todos los pagos están protegidos.
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question">¿Puedo cancelar o modificar mi reserva?</div>
            <div class="faq-answer">
            Sí, puedes cancelar o modificar tu reserva hasta 24 horas antes de la salida. Revisa nuestros términos y condiciones para más detalles.
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question">¿Ofrecen vuelos internacionales?</div>
            <div class="faq-answer">
            ¡Claro! En Airbooker ofrecemos una amplia variedad de destinos internacionales. Encuentra el tuyo y comienza tu aventura hoy.
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question">¿Qué pasa si mi vuelo se retrasa o cancela?</div>
            <div class="faq-answer">
            Si tu vuelo se retrasa o cancela, te notificaremos de inmediato y trabajaremos para ofrecerte alternativas o reembolsos según corresponda.
            </div>
        </div>
        </div>
        </div>
</div>

<script>
    document.querySelectorAll('.faq-question').forEach(item => {
      item.addEventListener('click', () => {
        const parent = item.parentElement;
        parent.classList.toggle('active');
      });
    });
  </script>