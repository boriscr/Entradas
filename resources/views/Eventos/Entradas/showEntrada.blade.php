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
                    @if ($entradas->cantidad > 0)
                        <button id="btn-comprar">COMPRAR AHORA</button>

                        <div class="container-pago" id="container-pago">
                            <div class="containerElementos">
                                <form action="#" method="POST" class="order-form">
                                    @csrf
                                    <div class="form-group">
                                        <label for="tipo_de_entrada">Tipo de Entrada</label>
                                        <input type="text" id="tipo_de_entrada" name="tipo_de_entrada"
                                            value="{{ $entradas->tipo_de_entrada }}" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label for="descripcion">Descripción</label>
                                        <textarea id="descripcion" name="descripcion" readonly>{{ $entradas->descripcion }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="precio">Precio</label>
                                        <input type="text" id="precio" name="precio"
                                            value="{{ $entradas->precio }}" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label for="cantidad">Cantidad de entradas</label>
                                        <div class="cantidad-box">
                                            <button type="button" id="btn-cantidad-menos">-</button>
                                            <input type="text" id="cantidad" name="cantidad" min="1"
                                                max="{{ $entradas->cantidad }}" value="1" required />
                                            <button type="button" id="btn-cantidad-mas">+</button>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" id="nombre" name="nombre" value="{{@Auth::user()->name}}" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="apellido">Apellido</label>
                                        <input type="text" id="apellido" name="apellido" value="{{@Auth::user()->surname}}" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" value="{{@Auth::user()->email}}" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="telefono">Teléfono</label>
                                        <input type="tel" id="telefono" name="telefono" required />
                                    </div>
                                    <div class="box-btn-cancelar-y-compar">
                                        <button class="btn-cancelar" id="btn-cancelar" type="button">Cancelar</button>
                                        <button class="btn-submit" id="checkout-btn" type="button">Pagar</button>
                                    </div>
                                    @if ($entradas->cantidad <= 0)
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                Swal.fire({
                                                    title: 'Error!',
                                                    text: 'Entradas agotadas.',
                                                    icon: 'error',
                                                    confirmButtonText: 'Aceptar'
                                                });
                                                return;
                                            });
                                        </script>
                                    @endif
                                </form>
                            </div>
                        </div>

                        <script src="https://sdk.mercadopago.com/js/v2"></script>
                        <script>
                            const mp = new MercadoPago("{{ env('MERCADO_PAGO_PUBLIC_KEY') }}");

                            document.getElementById('checkout-btn').addEventListener('click', function() {
                                const cantidad = parseInt(document.getElementById('cantidad').value, 10);
                                const nombre = document.getElementById('nombre').value;
                                const apellido = document.getElementById('apellido').value;
                                const email = document.getElementById('email').value;
                                const telefono = document.getElementById('telefono').value;

                                if (!cantidad || !nombre || !apellido || !email || !telefono) {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Por favor, completa todos los campos del formulario.',
                                        icon: 'error',
                                        confirmButtonText: 'Aceptar'
                                    });
                                    return;
                                }

                                const orderData = {
                                    product: [{
                                        id: "{{ $entradas->id }}", // ID de la entrada
                                        title: "{{ $entradas->tipo_de_entrada }}", // Tipo de entrada
                                        description: "{{ $entradas->descripcion }}", // Descripción de la entrada
                                        currency_id: "ARS", // Moneda (ajusta según tu país)
                                        quantity: cantidad, // Cantidad de entradas
                                        unit_price: parseFloat("{{ $entradas->precio }}"), // Precio por entrada
                                    }],
                                    name: nombre,
                                    surname: apellido, // Si tienes un campo de apellido, añádelo aquí
                                    email: email,
                                    phone: telefono,
                                    external_reference: "{{ $entradas->id }}", // Pasa el ID de la entrada como referencia externa
                                    quantity: cantidad, // Pasa la cantidad de entradas compradas
                                };

                                console.log('Datos del pedido:', orderData);

                                fetch('/create-preference', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                                        },
                                        body: JSON.stringify(orderData)
                                    })
                                    .then(response => {
                                        if (!response.ok) {
                                            throw new Error('Error en la respuesta del servidor');
                                        }
                                        return response.json();
                                    })
                                    .then(preference => {
                                        if (preference.error) {
                                            throw new Error(preference.error);
                                        }
                                        mp.checkout({
                                            preference: {
                                                id: preference.id // Asegúrate de que esta línea sea correcta
                                            },
                                            autoOpen: true
                                        });
                                        console.log('Respuesta de la preferencia:', preference);
                                    })
                                    .catch(error => console.error('Error al crear la preferencia:', error));
                            });
                        </script>
                    @else
                        <span>Entrada agotada</span>
                    @endif
                </div>
                <br>
            </div>
        </div>
    @endif




</x-body.body>
