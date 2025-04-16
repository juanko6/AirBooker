
<div class="footer-container">
    <!-- Footer bar -->
    <footer class="footer-section">
        <div class="container">
            <div class="footer-cta pt-5 pb-5">
                <div class="row">
                    <div class="col-xl-4 col-md-4 mb-30">
                        <div class="single-cta">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="cta-text">
                                <h4>Ubicacion</h4>
                                <span>Alicante, España</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 mb-30">
                        <div class="single-cta">
                            <i class="fas fa-phone"></i>
                            <div class="cta-text">
                                <h4>Telefono</h4>
                                <span>+34 *********</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 mb-30">
                        <div class="single-cta">
                            <i class="far fa-envelope-open"></i>
                            <div class="cta-text">
                                <h4>Email</h4>
                                <span>info@airbooker.com</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-content pt-5 pb-5">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 mb-50">
                        <div class="footer-widget">
                            <div class="footer-logo">
                                <a href="/"><img src="{{ asset('images/logo-v2.png') }}"  class="img-fluid" alt="logo"></a>
                            </div>
                            <div class="footer-text">
                                <p>Viajar con AirBooker con los mejores precios a donde sea que deseas.</p>
                            </div>
                            <div class="footer-social-icon">
                                <span>Síguenos</span>
                                <a href="#"><i class="fab fa-facebook-f facebook-bg"></i></a>
                                <a href="#"><i class="fab fa-twitter twitter-bg"></i></a>
                                <a href="#"><i class="fab fa-google-plus-g google-bg"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                        <div class="footer-widget">
                            <div class="footer-widget-heading">
                                <h3>Enlaces rápidos</h3>
                            </div>
                            <ul>
                                <li><a href="/">HOME</a></li>
                                <li><a href="{{ url('/#offers-section') }}">OFERTAS</a></li>
                                <li><a href="/auth/login">LOGIN</a></li>
                                <li><a href="/auth/signup">SIGNUP</a></li>
                                <li><a href="/contactanos">CONTACTO</a></li>                                    
                                <li><a href="{{ url('/#faq-section') }}">FAQ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-50">
                        <div class="footer-widget">
                            <div class="footer-widget-heading">
                                <h3>¿Quieres recibir más ofertas?</h3>
                            </div>
                            <div class="footer-text mb-25">
                                <p></p>
                            </div>
                            <div class="subscribe-form">
                                <div class="subscribe-form">
                                    <form id="subscribe-form">
                                        @csrf
                                        <input type="email" name="email" id="email" placeholder="Email Address" required>
                                        <button type="submit" style="background: linear-gradient(to right, #003366 60%, #003366c9);">
                                            <i class="fab fa-telegram-plane"></i>
                                        </button>
                                    </form>
                                    <div id="subscribe-message" class="mt-3"></div> <!-- Contenedor para el mensaje -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Escuchar el evento de envío del formulario
            document.getElementById('subscribe-form').addEventListener('submit', function (e) {
                e.preventDefault(); // Evitar el envío tradicional del formulario

                // Obtener el valor del email
                const email = document.getElementById('email').value;

                // Enviar la solicitud AJAX
                fetch('{{ route("subscribe") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}', // Incluir el token CSRF
                    },
                    body: JSON.stringify({ email: email }),
                })
                .then(response => response.json()) // Parsear la respuesta como JSON
                .then(data => {
                    if (data.success) {
                        // Mostrar el mensaje de éxito
                        document.getElementById('subscribe-message').innerHTML = `
                            <div class="alert alert-success">${data.message}</div>
                        `;
                    } else {
                        // Mostrar un mensaje de error si es necesario
                        document.getElementById('subscribe-message').innerHTML = `
                            <div class="alert alert-danger">Ocurrió un error. Por favor, intenta nuevamente.</div>
                        `;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('subscribe-message').innerHTML = `
                        <div class="alert alert-danger">Ocurrió un error inesperado. Por favor, intenta más tarde.</div>
                    `;
                });
            });
        </script>

        <div class="copyright-area">
            <div class="container">
                <div class="row">
                    <div class="text-center ">
                        <div class="copyright-text text-center">
                            <p>Copyright &copy; 2025, <a href="http://localhost:8000/">AIRBOOKER</a></p>
                        </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </footer>
</div>