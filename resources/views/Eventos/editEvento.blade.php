<x-body.body :title="'Edit Evento'">
    <x-nav.nav />
    <div class="formularioBox">
        <x-form.formEvento
        :ruta="route('AdminEvento.update',$evento->id)"
        :metodo=true
        :publicoCheck="$evento->apt_todo_publico==true?'checked':''"
        :portadaImg="$evento->portadaImg"
        :tipo="$evento->tipo_de_evento"
        :nombreDelEvento="$evento->nombre"
        :descripcionCorta="$evento->descripcion_corta"
        :descripcion="$evento->descripcion"
        :precio="$evento->precio"
        :cantidad="$evento->cantidad"
        :lugar="$evento->lugar"
        :fechaInicio="\Carbon\Carbon::parse($evento->fecha_de_inicio)->format('Y-m-d')"
        :horaInicio="$evento->hora_de_inicio"
        :fechaFin="\Carbon\Carbon::parse($evento->fecha_a_finalizar)->format('Y-m-d')"
        :horaFin="$evento->hora_a_finalizar"
        :edadPublicoMin="$evento->edad_publico_min"
        :edadPublicoMax="$evento->edad_publico_max"
        :btnSubmitName="'Actualizar'"
        />
    </div>
    <script src="/js/checksFormCreate.js"></script>
</x-body.body>
