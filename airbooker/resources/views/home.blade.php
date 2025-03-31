@extends('layouts.app')

@section('title', 'AIrbooker')

@section('content')
<!-- Hero Section -->
@include('VistasAuxVuelos.buscadorVuelo')

<!-- Sección de Ofertas Destacadas -->
@include('VistasAuxVuelos.OfertasDestacadas')

<!-- Sección de Destinos Populares -->
@include('VistasAuxVuelos.DestinosPopulares')

<!-- Sección de Vuelos con Ofertas -->
@include('VistasAuxVuelos.VuelosconOfertas')

<!-- Sección de Ventajas -->
@include('VistasAuxVuelos.VentajasAirbooker')

<!-- Sección de preguntas frecuentes -->
@include('VistasAuxVuelos.miniFaq')
     
@endsection
