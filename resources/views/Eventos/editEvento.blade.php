<x-body.body :title="'Edit Evento'">
    <x-nav.nav />
@if(session('good'))
    <script>
        document.addEventListener('DOMContentLoaded',function(){
            Swal.fire(@json(session('good')))
        })
    </script>
@endif
    <div class="formularioBox">
        <x-form.formEvento
        :ruta="route('AdminEvento.update',$evento->id)"
        :metodo=true
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

        :publicoCheck="$evento->apt_todo_publico==true?'checked':''"
        :edadPublicoMin="$evento->edad_minima"
        :edadPublicoMax="$evento->edad_maxima"
        :btnSubmitName="'Actualizar'"
        />
    </div>
</x-body.body>
