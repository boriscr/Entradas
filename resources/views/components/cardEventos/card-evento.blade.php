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
<div class="div-contenedor-general-admin">
    <div class="{{ $boxTipoDeEntrada }} style-contenedor-general">
        <div class="nombre-de-entrada">
            <p>{{ $value->nombre }}</p>
        </div>
        <div class="tipo-de-entrada">
            <p>{{ $value->tipo_de_entrada }}</p>
        </div>
        <div class="descripcion-card">
            <p>{{ Str::limit($value->descripcion_corta, 70) }}</p>
        </div>
        <div class="inicio-card">
            <h5 class="titulo-card">Inicio del Evento</h5>
            <p><b>Fecha: </b> {{ \Carbon\Carbon::parse($value->fecha_de_inicio)->format('Y-m-d') }}</p>
            <p><b>Hora: </b>{{ $value->hora_de_inicio }}</p>
            <p><b>Lugar: </b>{{ $value->lugar }}</p>
            <p><b>Apto para todo público: </b>{{ $value->apt_todo_publico ? 'Si' : 'No' }}</p>
            <p><b>Entradas disponibles: </b>{{ $value->cantidad }}</p>
        </div>
        <b class="valor-card">
            @if ($value->cupon == true)
                @if ($value->porcentaje_de_descuento == true)
                    <?php
                    if (floor($value->porcentaje_de_descuento) !== $value->porcentaje_de_descuento) {
                        $descuentoNum = floor($value->porcentaje_de_descuento);
                    } else {
                        $descuentoNum = $value->porcentaje_de_descuento;
                    }
                    ?>
                    <p class="cuponDescuento">-{{ $descuentoNum }}% con <b>CUPÓN</b>.</p>
                    <p class="precioConCupon">${{ $value->precio }}</p>
                @endif
            @elseif ($value->cupon == false)
                @if ($value->porcentaje_de_descuento == true)
                    <p class="precioTachado">${{ $value->precio }}</p>
                    <p class="precioDescuento">${{ $value->precio_final }}</p>
                @else
                    <p>${{ $value->precio }}</p>
                @endif
            @endif
        </b>
        <div class="box-info-comprar">
            <div class="box-info">
                <a class="link-info" href="{{ route('indexEntradas', ['id' => $value->id]) }}"><i
                        class="bi bi-eye"></i></a>
            </div>
            <div class="box-comprar">
                <a class="link-comprar" href="#">COMPRAR AHORA</a>
            </div>
        </div>
    </div>
    <div class="box-btn-edit-del">
        <a href="{{ route('edit', ['id' => $value->id]) }}" class="btn-editar btn"><i
                class="bi bi-pencil-fill"></i></a>
        <a href="#" class="btn-finalizar btn"
            onclick="return(confirm('¿Desea finalizar este evento? Esto implica: \n1. No será visible para los visitantes.\n2. Los visitantes no tendrán acceso ni podrán adquirirlo.\n3. Los administradores podrán ver los datos.\n4. Finalizar el evento NO elimina los datos de la base de datos.\n5. Esta acción es reversible.'))"><i
                class="bi bi-x-lg"></i></a>
        <form action="{{ route('delete', ['id' => $value->id]) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit"
                onclick="return confirm('¿Desea eliminar este evento de la base de datos? Esto implica la pérdida total de toda la información relacionada.')"><i
                    class="bi bi-trash-fill"></i></button>
        </form>
    </div>
    <hr>
    <br>
</div>
