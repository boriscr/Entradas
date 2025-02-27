<x-body.body :title="'Entradas'">
    <x-nav.nav />

    @if (session('good'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire(@json(session('good')))
            })
        </script>
    @elseif(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire(@json(session('error')))
            })
        </script>
    @endif


    <div class="containerEventoInfo">
        <div class="row-contenedor">
            <div class="column-img">
                @if ($evento->portadaImg)
                    <img src="{{ asset('storage/eventosImg/' . $evento->portadaImg) }}" alt="PortadaImg">
                @endif
            </div>
            <div class="info">
                <h1>{{ $evento->nombre }}</h1>
                <p>{{ $evento->descripcion }}</p>
                <p><i class="bi bi-geo-alt-fill"></i>{{ $evento->lugar }}</p>
                @if ($evento->fecha_a_finalizar == $evento->fecha_de_inicio)
                    <p><i class="bi bi-calendar2-check-fill"></i> Fecha:
                        {{ \Carbon\Carbon::parse($evento->fecha_de_inicio)->format('d-m-Y') }}</p>
                @else
                    <p><i class="bi bi-calendar2-check-fill"></i> Desde:
                        {{ \Carbon\Carbon::parse($evento->fecha_de_inicio)->format('d-m-Y') }}</p>
                    <p><i class="bi bi-calendar-x-fill"></i> Hasta:
                        {{ \Carbon\Carbon::parse($evento->fecha_a_finalizar)->format('d-m-Y') }}</p>
                @endif
                @if ($evento->hora_de_inicio == $evento->hora_a_finalizar)
                    <p><i class="bi bi-alarm"></i> Inicio a {{ $evento->hora_de_inicio }} hs</p>
                @else
                    <p><i class="bi bi-alarm"></i> Desde {{ $evento->hora_de_inicio }} hs hasta
                        {{ $evento->hora_a_finalizar }} hs</p>
                @endif
                @if ($evento->apt_todo_publico)
                    <p><i class="bi bi-cake2"></i> Evento apto para todo público</p>
                @elseif($evento->edad_minima == 18 && $evento->edad_maxima == null)
                    <p><i class="bi bi-cake2"></i> +{{ $evento->edad_minima }}</p>
                @else
                    <p><i class="bi bi-cake2"></i> De {{ $evento->edad_minima }} a {{ $evento->edad_maxima }} años</p>
                @endif
                <p></p>
            </div>
        </div>
    </div>

    @role('Admin')
        <div class="box-btn-new-entrada">
            <a href="{{ route('entrada.create', $evento->id) }}"><i class="bi bi-plus-lg"></i></a>
        </div>
    @endrole

    <hr>

    @if (isset($entradasRelacionadas) && !$entradasRelacionadas->isEmpty())
        <?php
        $tipos = ['VIP', 'Preferencial', 'Primera fila', 'Platea baja', 'Platea alta', 'Anticipadas', 'Especial', 'Tribuna', 'Asiento y ubicacion', 'Ubicacion', 'Asiento', 'General', 'Otro'];
        ?>
        <div class="box-contenedor">
            @foreach ($tipos as $tipo)
                @foreach ($entradasRelacionadas as $value)
                    @if ($value->tipo_de_entrada == $tipo)
                        <x-card.card-entrada :value="$value" />
                        @if (Route::has('login'))
                            @auth
                                <div class="container-pago" id="container-pago">
                                    <div class="containerElementos">
                                        <h2 class="title-comprar">Comprar Ahora</h2>
                                        <form action="{{route('crear-preferencia')}}" method="post">
                                            @csrf
                                            {{ $value->tipo_de_entrada }}
                                            <br>
                                            {{ $value->descripcion }}
                                            {{ $value->tipo_de_entrada }}
                                            <label for="Nombres">Nombres</label>
                                            <input type="text" name="nombres" id="nombres"
                                                placeholder="Ejemplo: Juan Luis..." value="{{ auth()->user()->name }}">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="email"
                                                placeholder="Ejemplo: email@email.com" value="{{ auth()->user()->email }}">
                                            <label for="cantidad">Cantidad de entradas</label>
                                            <input type="number" name="cantidad" id="cantidad" value="1">
                                            @if ($value->cupon == true)
                                                <label for="cupon">Cupon</label>
                                                <input type="text" name="cupon" id="cupon"
                                                    placeholder="¿Tienes un cupón? Ingrésalo aquí">
                                            @endif

                                            <div class="box-btn-cancelar-y-compar">
                                                <button class="btn-cancelar" id="btn-cancelar"
                                                    type="button">Cancelar</button>
                                                <button class="btn-pagar" id="checkout-btn" type="submit">Pagar</button>
                                            </div>
                                        </form>
                                        <div class="tipo-de-entrada">
                                            <p>{{ $value->tipo_de_entrada }}</p>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    // Configura el SDK de Mercado Pago con tu Public Key
                                    const mp = new MercadoPago('APP_USR-5236e862-5902-496c-a440-d7754b2b2c5d', {
                                        locale: 'es-AR' // Configura el idioma
                                    });
                                
                                    // Maneja el clic en el botón de pago
                                    document.getElementById('checkout-btn').addEventListener('click', async () => {
                                        try {
                                            // Llama a tu backend para crear la preferencia de pago
                                            const response = await fetch('/crear-preferencia', {
                                                method: 'POST',
                                                headers: {
                                                    'Content-Type': 'application/json',
                                                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Protección CSRF de Laravel
                                                }
                                            });
                                
                                            const preference = await response.json();
                                
                                            // Abre el checkout de Mercado Pago con la preferencia creada
                                            mp.checkout({
                                                preference: {
                                                    id: preference.id // ID de la preferencia
                                                },
                                                autoOpen: true, // Abre el checkout automáticamente
                                            });
                                        } catch (error) {
                                            console.error('Error al crear la preferencia:', error);
                                        }
                                    });
                                </script>
                            @endauth
                            <div class="container-pago-no-loggin container-pago" id="container-pago">
                                <span class="btn-login-registro">
                                    <p>Inicie session para continuar.</p>
                                    <a href="{{ route('login') }}">Iniciar sesion</a>
                                    <a href="{{ route('register') }}">Crear cuenta</a>
                                </span>
                                <div class="btn-cancelar" id="btn-cancelar">Cancelar</div>
                            </div>
                        @endif
                    @endif
                @endforeach
            @endforeach
        </div>
    @else
        <div class="box-sin-entradas">
            <img src="https://68.media.tumblr.com/2bcd5f1584814fb90fb001cf5519a27f/tumblr_oqqshj6MUC1vjxr9zo1_500.gif"
                alt="gif de espera">
            <p>¡Ups! No hay entradas disponibles en este momento.</p>
            <p>Por favor, vuelva más tarde. ¡Gracias por su paciencia!</p>
        </div>
    @endif
</x-body.body>
