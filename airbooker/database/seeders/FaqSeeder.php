<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    public function run()
    {
        $faqs = [
            [
                'pregunta' => '¿Cómo puedo reservar un vuelo con Airbooker?',
                'respuesta' => 'Para reservar un vuelo, simplemente ingresa a nuestra plataforma, selecciona tu destino, fechas y sigue los pasos del proceso de compra. ¡Es rápido y seguro!',
            ],
            [
                'pregunta' => '¿Qué métodos de pago aceptan?',
                'respuesta' => 'Aceptamos tarjetas de crédito/débito (Visa, Mastercard, American Express), PayPal y transferencias bancarias. Todos los pagos están protegidos.',
            ],
            [
                'pregunta' => '¿Puedo cancelar o modificar mi reserva?',
                'respuesta' => 'Sí, puedes cancelar o modificar tu reserva hasta 24 horas antes de la salida. Revisa nuestros términos y condiciones para más detalles.',
            ],
            [
                'pregunta' => '¿Ofrecen vuelos internacionales?',
                'respuesta' => '¡Claro! En Airbooker ofrecemos una amplia variedad de destinos internacionales. Encuentra el tuyo y comienza tu aventura hoy.',
            ],
            [
                'pregunta' => '¿Qué pasa si mi vuelo se retrasa o cancela?',
                'respuesta' => 'Si tu vuelo se retrasa o cancela, te notificaremos de inmediato y trabajaremos para ofrecerte alternativas o reembolsos según corresponda.',
            ],
        ];

        foreach ($faqs as $faqData) {
            Faq::create($faqData);
        }
    }
}