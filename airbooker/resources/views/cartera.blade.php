@extends('layoutCliente')


@section('content')

<div style="padding:15px;">
    <h1>💵 Mi Cartera</h1>

    <div class="bg-light" style="height:50vh;padding:15px;">
        <p style="height:20%;">
            Bienvenido a tu cartera de Airbooker. Todos los reembolos se que hayan solicitado aparecerán aquí. 
            Puedes usar este saldo para reservar otro vuelo o retirarlo. Puedes hacer clic 
            <a href="#" onclick="loadContent('faq'); return false;">aqui</a> para consular las preguntas frecuentes
        </p>
        <div class="text-center" style="height:70%;padding:20px;">
            <h1>💵 </h1>
            <p style="font-weight:bold;">
                Tu cartera está vacía
            </p>
            <p>
                <a href="#" class="" onclick="loadContent('vuelos'); return false;">Reserva un vuelo</a>
            </p>
        </div>
        </p>
        <p style="height:10%;">
            Tienes alguna otra pregunta? <a href="#" class="" onclick="loadContent('vuelos'); return false;">Contacta con nosotros.</a> 
        </p>
    </div>

</div>




@endsection