@extends('user.layoutCliente')


@section('DashboardContent')

<div style="padding:15px;">
    <h1>💵 Mi Cartera</h1>

    <div class="bg-light" style="height:50vh;padding:15px;">
        <p style="height:20%;">
            Bienvenido a tu cartera de Airbooker. Todos los reembolos se que hayan solicitado aparecerán aquí. 
            Puedes usar este saldo para reservar otro vuelo o retirarlo. Puedes hacer clic 
            <a href="{{ url('/#faq-section') }}">aqui</a> para consular las preguntas frecuentes
        </p>
        <div class="text-center" style="height:70%;padding:20px;">
            <h1>💵 </h1>
            @if($usuario->creditos > 0)
                <p style="font-weight:bold;">
                    Tu saldo actual asciende a: {{$usuario->creditos}} $
                </p>
            @else
                <p style="font-weight:bold;">
                    Tu cartera está vacía
                </p>
            @endif
            <p>
                <a href="{{ url('/') }}">Reserva un vuelo</a>
            </p>
        </div>
        </p>
        <p style="height:10%;">
            Tienes alguna otra pregunta? <a href="{{ url('/contactanos') }}">Contacta con nosotros.</a> 
        </p>
    </div>

</div>




@endsection