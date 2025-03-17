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
