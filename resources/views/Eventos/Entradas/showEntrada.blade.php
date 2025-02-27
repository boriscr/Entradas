<x-body.body>
    <x-nav.nav />
    <?php
    switch ($entradas->tipo_de_entrada) {
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
    @if (isset($entradas))
        <div class="contenedor-general">
            <div class="contenedor-secundario-entrada {{ $boxTipoDeentrada }}" id="contenedor-secundario-entrada">
                <div class="nombre-de-entrada">
                    <h1>{{ $entradas->nombre }}</h1>
                </div>
                <div class="tipo-de-entrada">
                    <h2>{{ $entradas->tipo_de_entrada }}</h2>
                </div>
                <div class="section-col">
                    <div class="column">
                        <h5 class="titulo-H5">Detalle</h5>
                        <hr>
                        <p>{{ $entradas->descripcion }}</p>
                        <hr>
                        <b class="valor-card">
                            @if ($entradas->cupon == true)
                                @if ($entradas->porcentaje_de_descuento == true)
                                    <?php
                                    if (floor($entradas->porcentaje_de_descuento) !== $entradas->porcentaje_de_descuento) {
                                        $descuentoNum = floor($entradas->porcentaje_de_descuento);
                                    } else {
                                        $descuentoNum = $entradas->porcentaje_de_descuento;
                                    }
                                    ?>
                                    <p class="cuponDescuento">Descuento del {{ $descuentoNum }}% con
                                        <b>CUPÓN</b>.
                                    </p>
                                    <p>Precio: ${{ $entradas->precio }}</p>
                                @endif
                            @elseif ($entradas->cupon == false)
                            @if ($entradas->porcentaje_de_descuento == true)
                                <p>Precio: ${{ $entradas->precio_final }}</p>
                            @else
                                <p>Precio: ${{ $entradas->precio }}</p>
                            @endif
                        @endif
                        </b>
                        <p><b>Tipo de entrada: </b>{{ $entradas->tipo_de_entrada }}</p>
                        <p><b>entradas disponibles: </b>{{ $entradas->cantidad }}</p>
                        </b>
                        <p><b>Lugar: </b>{{ $entradas->lugar }}</p>
                        <p><b>¿Es apto para todo público?:
                            </b>{{ $entradas->apt_todo_publico == true ? 'Si' : 'No. Edad mínima: ' . $entradas->edad_minima . '. Edad máxima: ' . $entradas->edad_maxima }}
                        </p>

                    </div>
                    <div class="column">
                        <h5 class="titulo-H5 centrar">Inicio del entrada</h5>
                        <p><b>Fecha: </b> {{ \Carbon\Carbon::parse($entradas->fecha_de_inicio)->format('Y-m-d') }}
                        </p>
                        <p><b>Hora: </b>{{ $entradas->hora_de_inicio }}</p>
                        <h5 class="titulo-H5 centrar">Finalizacion</h5>
                        <p><b>Fecha: </b> {{ \Carbon\Carbon::parse($entradas->fecha_a_finalizar)->format('Y-m-d') }}
                        </p>
                        <p><b>Hora: </b>{{ $entradas->hora_a_finalizar }}</p>
                        <hr>
                        <p>Por la compra de 1 (una) entrada {{ $entradas->tipo_de_entrada }} obtiene: 1(una) entrada
                            para 1(una) persona.</p>
                    </div>
                    <div class="column">
                        @if ($entradas->cupon == true)
                            <h5 class="titulo-H5 centrar">CUPÓN DE DESCUENTO</h5>
                            <P>¡Esta entrada tiene descuentos disponibles! Utiliza un cupón para obtener increíbles
                                descuentos en tu
                                compra.</P>
                        @endif
                    </div>
                </div>
                <br>
                
                <div class="btn-comprar">
                    <!--
                    <button id="btn-comprar-ahora">COMPRAR AHORA</button>
                    -->
                    <button id="btn-comprar-ahora" id="checkout-btn">COMPRAR AHORA</button>
                </div>
                <br>
            </div>
        </div>
    @endif

    <div class="container" id="container-pago">
        <div class="containerElementos">

            <h2 class="title-comprar">Comprar Ahora</h2>
            <form action="{{ route('crear-preferencia') }}" method="POST">
                @csrf
                <label for="Nombres">Nombres</label>
                <input type="text" name="nombres" id="nombres" placeholder="Ejemplo: Juan Luis...">
                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" id="apellido" placeholder="Ejemplo: Perez">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Ejemplo: email@email.com">
                <label for="cantidad">Cantidad de entradas</label>
                <input type="number" name="cantidad" id="cantidad" value="1">
                @if($entradas->cupon == true)
                    <label for="cupon">Cupon</label>
                    <input type="text" name="cupon" id="cupon" placeholder="¿Tienes un cupón? Ingrésalo aquí">
                @endif
            
                <div class="box-btn-cancelar-y-compar">
                    <button class="btn-cancelar" id="btn-cancelar" type="button">Cancelar</button>
                    <button class="btn-pagar" id="checkout-btn" type="submit">Pagar</button>
                </div>
            </form>
            <div class="tipo-de-entrada">
                <p>{{ $entradas->tipo_de_entrada }}</p>
            </div>
        </div>
    </div>
 

</x-body.body>
