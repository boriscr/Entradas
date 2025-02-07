<x-body.body>
    <x-nav.nav />
    <?php
    switch ($eventos->tipo_de_entrada) {
        case 'VIP':
            $boxTipoDeEntrada = 'evento-contenedor-vip';
            break;
            case 'Preferencial':
            $boxTipoDeEntrada = 'evento-contenedor-preferencial';
            break;
        case 'Primera fila':
            $boxTipoDeEntrada = 'evento-contenedor-primera-fila';
            break;
        case 'Platea baja':
            $boxTipoDeEntrada = 'evento-contenedor-platea-baja';
            break;
        case 'Platea alta':
            $boxTipoDeEntrada = 'evento-contenedor-platea-alta';
            break;
        case 'Anticipadas':
            $boxTipoDeEntrada = 'evento-contenedor-anticipadas';
            break;
        case 'Especial':
            $boxTipoDeEntrada = 'evento-contenedor-especial';
            break;
        case 'Tribuna':
            $boxTipoDeEntrada = 'evento-contenedor-tribuna';
            break;
        case 'Asiento y ubicacion':
            $boxTipoDeEntrada = 'evento-contenedor-asiento-ubicacion';
            break;
        case 'Ubicacion':
            $boxTipoDeEntrada = 'evento-contenedor-ubicacion';
            break;
        case 'Asiento':
            $boxTipoDeEntrada = 'evento-contenedor-asiento';
            break;
        case 'General':
            $boxTipoDeEntrada = 'evento-contenedor-general';
            break;
        default:
            $boxTipoDeEntrada = 'evento-contenedor-otro';
            break;
    }
    ?>


    @if (isset($eventos))
        <div class="contenedor-general">
            <div class="contenedor-secundario-entrada {{$boxTipoDeEntrada}}" id="contenedor-secundario-entrada">
                <div class="nombre-de-entrada">
                    <p>{{ $eventos->nombre }}</p>
                </div>
                <div class="tipo-de-entrada">
                    <p>{{ $eventos->tipo_de_entrada }}</p>
                </div>
                <div class="section-col">
                    <div class="column">
                            <h5 class="titulo-H5">Detalle</h5>
                            <hr>
                            <p>{{ $eventos->descripcion }}</p>
                            <hr>
                            <p><b>Tipo de entrada: </b>{{ $eventos->tipo_de_entrada }}</p>
                            <p><b>Entradas disponibles: </b>{{ $eventos->cantidad }}</p>
                            <b class="valor-card">Valor de la entrada: ${{ $eventos->precio }} por entrada c/u.</b>
                    </div>
                    <div class="column">
                            <h5 class="titulo-H5 centrar">Inicio del evento</h5>
                            <hr>
                            <p><b>Fecha: </b> {{ \Carbon\Carbon::parse($eventos->fecha_de_inicio)->format('Y-m-d') }}
                            </p>
                            <p><b>Hora: </b>{{ $eventos->hora_de_inicio }}</p>
                            <p><b>Lugar: </b>{{ $eventos->lugar }}</p>
                    </div>
                    <div class="column">
                            <h5 class="titulo-H5 centrar">Finalizacion</h5>
                            <hr>
                            <p><b>Fecha: </b> {{ \Carbon\Carbon::parse($eventos->fecha_a_finalizar)->format('Y-m-d') }}
                            </p>
                            <p><b>Hora: </b>{{ $eventos->hora_a_finalizar }}</p>
                            <hr>
                            <p>Por la compra de 1 (una) entrada {{ $eventos->tipo_de_entrada }} obtiene: 1(una) entrada para 1(una) persona.</p>
                        </div>
                </div>
                <br>
                <div class="box-link-comprar">
                    <a class="btn-link centrar" href="#">COMPRAR AHORA</a>
                </div>
                <br>
            </div>
        </div>
    @endif
</x-body.body>
