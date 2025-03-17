<?php
switch ($value->tipo_de_entrada) {
    case 'VIP':
        $boxTipoDeentrada = 'entrada-contenedor-vip';
        break;
    case 'Preferencial':
        $boxTipoDeentrada = 'entrada-contenedor-preferencial';
        break;
    case 'Primera fila':
        $boxTipoDeentrada = 'entrada-contenedor-primera-fila';
        break;
    case 'Platea baja':
        $boxTipoDeentrada = 'entrada-contenedor-platea-baja';
        break;
    case 'Platea alta':
        $boxTipoDeentrada = 'entrada-contenedor-platea-alta';
        break;
    case 'Anticipadas':
        $boxTipoDeentrada = 'entrada-contenedor-anticipadas';
        break;
    case 'Especial':
        $boxTipoDeentrada = 'entrada-contenedor-especial';
        break;
    case 'Tribuna':
        $boxTipoDeentrada = 'entrada-contenedor-tribuna';
        break;
    case 'Asiento y ubicacion':
        $boxTipoDeentrada = 'entrada-contenedor-asiento-ubicacion';
        break;
    case 'Ubicacion':
        $boxTipoDeentrada = 'entrada-contenedor-ubicacion';
        break;
    case 'Asiento':
        $boxTipoDeentrada = 'entrada-contenedor-asiento';
        break;
    case 'General':
        $boxTipoDeentrada = 'entrada-contenedor-general';
        break;
    default:
        $boxTipoDeentrada = 'entrada-contenedor-otro';
        break;
}
?>

<div class="container-pago-no-loggin container-pago" id="container-pago">
    <div class="btn-login-registro">
        <p>Inicie sesion para continuar.</p>
        <a href="{{ route('login') }}">Iniciar sesion</a>
        <a href="{{ route('register') }}">Crear cuenta</a>
    </div>
    <div class="btn-cancelar" id="btn-cancelar">Cancelar</div>
</div>

<div class="div-contenedor-general-admin">
    <div class="{{ $boxTipoDeentrada }} style-contenedor-general">
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
            <h5 class="titulo-card">Información</h5>
            <p><b>Disponible: </b>{{ $value->cantidad }} entradas {{ $value->tipo_de_entrada }}</p>
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
            <div class="box-comprar">
                @if (auth()->check())
                    <a class="link-comprar" id="link-comprar" href="{{ route('entrada.show', $value->id) }}">COMPRAR
                        AHORA</a>
                @else
                <a class="link-comprar no-loggin" href="#">COMPRAR AHORA</a>
                @endif

            </div>
        </div>
    </div>
    @role('Admin')
        <div class="box-btn-edit-del">
            <a href="{{ route('entrada.edit', $value->id) }}" class="btn-editar btn"><i class="bi bi-pencil-fill"></i></a>
            <a href="#" class="btn-finalizar btn"
                onclick="return(confirm('¿Desea finalizar este entrada? Esto implica: \n1. No será visible para los visitantes.\n2. Los visitantes no tendrán acceso ni podrán adquirirlo.\n3. Los administradores podrán ver los datos.\n4. Finalizar el entrada NO elimina los datos de la base de datos.\n5. Esta acción es reversible.'))"><i
                    class="bi bi-x-lg"></i></a>
            <form action="{{ route('entrada.destroy', $value->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit"
                    onclick="return confirm('¿Desea eliminar este entrada de la base de datos? Esto implica la pérdida total de toda la información relacionada.')"><i
                        class="bi bi-trash-fill"></i></button>
            </form>
        </div>
    @endrole
    <hr>
    <br>
</div>
