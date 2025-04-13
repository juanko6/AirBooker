<!-- Sección de FAQ -->
<div class="container_segundario"> 
    <div class="styl-faq-custome" id="faq-section">    
        <div class="container">
            <h13 class="titulo-h3-seccsion">FAQ</h13>
            <p>Encuentra respuestas a las preguntas más comunes sobre nuestros servicios.</p>
            <div class="faq-section">
                @foreach ($faqs as $faq)
                    <div class="faq-item">
                        <div class="faq-question">{{ $faq->pregunta }}</div>
                        <div class="faq-answer">{{ $faq->respuesta }}</div>
                    </div>
                @endforeach
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