
@extends('layouts.app')
@section('content')
    <div class="container_segundario">
        <div class="style-vuelos-disponibles">
            <div class=" ">
                <!-- Vista 1: Barra de búsqueda -->
                @include('VistasAuxVuelos.searchBar', ['filtros' => $filtros])

                <div class="row mt-4">
                    <!-- Vista 2: Filtros laterales -->
                    <div class="col-md-3">
                        @include('VistasAuxVuelos.filterSidebar', [
                            'aerolineas' => $aerolineas,
                            'filtros' => $filtros
                        ])
                    </div>
                </div>
                <!-- Vista 3: Listado de vuelos -->
                <div class="col-md-9">
                        @include('VistasAuxVuelos.flightList', ['vuelos' => $vuelos])
                    </div>
            </div>
        </div>
    </div>
@endsection