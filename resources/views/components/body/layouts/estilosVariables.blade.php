<?php
switch ($value->tipo_de_entrada) {
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