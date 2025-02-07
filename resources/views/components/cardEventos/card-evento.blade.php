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
@include('components.body.layouts.estilosVariables', ['value' => $value])
<div class="div-contenedor-general-admin">
    <div class="{{ $boxTipoDeEntrada }} style-contenedor-general">
        <div class="nombre-de-entrada">
            <p>{{ $value->nombre }}</p>
        </div>
        <div class="tipo-de-entrada">
            <p>{{ $value->tipo_de_entrada }}</p>
        </div>
        <div class="descripcion-card">
            <p>{{ Str::limit($value->descripcion, 70) }}</p>
        </div>
        <div class="inicio-card">
            <h5 class="titulo-card">Inicio del Evento</h5>
            <p><b>Fecha: </b> {{ \Carbon\Carbon::parse($value->fecha_de_inicio)->format('Y-m-d') }}</p>
            <p><b>Hora: </b>{{ $value->hora_de_inicio }}</p>
            <p><b>Lugar: </b>{{ $value->lugar }}</p>
            <p><b>Apto para todo público: </b>{{ $value->apt_todo_publico ? 'Si' : 'No' }}</p>
            <p><b>Entradas disponibles: </b>{{ $value->cantidad }}</p>
        </div>
        <b class="valor-card">${{ $value->precio }}</b>
        <div class="box-info-comprar">
            <div class="box-link-info">
                <a class="btn-link link-info" href="{{ route('indexEntradas', ['id' => $value->id]) }}"><i
                        class="bi bi-eye"></i></a>
            </div>
            <div class="box-link-comprar">
                <a class="btn-link link-comprar" href="#">COMPRAR AHORA</a>
            </div>
        </div>
    </div>
    <div class="box-btn-edit-del">
        <a href="{{ route('edit', ['id' => $value->id]) }}"><i class="bi bi-pencil-fill"></i></a>
        <form action="{{ route('delete', ['id' => $value->id]) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit"
                onclick="return confirm('¿Desea eliminar de la base de datos éste evento? Ésto implica la pérdida absoluta de toda información de este evento.')"><i
                    class="bi bi-trash-fill"></i></button>
        </form>
        <!--Preferencial entradas-->
    </div>
</div>