<x-body.body>
    <x-nav.nav />
    @if (session('eliminadoMensaje'))
        <div class="containerMensajeAlert">
            <div class="mensajeAlerta">
                {{ session('eliminadoMensaje') }}
            </div>
        </div>
    @elseif(session('eliminadoMensajeError'))
        <div class="containerMensajeAlert">
            <div class="mensajeAlertaError">
                {{ session('eliminadoMensajeError') }}
            </div>
        </div>
    @endif

    @if (isset($eventos))
            <?php
            $tipos = ['VIP', 'Preferencial', 'Primera fila', 'Platea baja', 'Platea alta', 'Anticipadas', 'Especial', 'Tribuna', 'Asiento y ubicacion', 'Ubicacion', 'Asiento', 'General', 'Otro'];
            ?>
            <div class="box-contenedor">
                @foreach ($tipos as $tipo)
                    @foreach ($eventos as $value)
                        @if ($value->tipo_de_entrada == $tipo)
                                <x-cardEventos.card-evento :value="$value" />
                        @endif
                    @endforeach
                @endforeach
            </div>
        </div>
    @else
        <div class="box-sin-eventos">
            <img src="https://68.media.tumblr.com/2bcd5f1584814fb90fb001cf5519a27f/tumblr_oqqshj6MUC1vjxr9zo1_500.gif"
                alt="">
            <p>¡Ups! No hay eventos disponibles en este momento.</p>
            <p>Por favor, vuelva más tarde. ¡Gracias por su paciencia!</p>
        </div>
    @endif
</x-body.body>
