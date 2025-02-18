<x-body.body>
    <x-nav.nav/>

@if (session('good'))
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            Swal.fire(@json(session('good')))
        })
    </script>    
@endif

    <div class="formularioBox">
    <x-form.formEvento
    :ruta="route('AdminEvento.store')"
    :tipo="'Fiesta privada'"
    :publicoCheck="'checked'"
    :descripcion="old('descripcion')"
    :descripcionCorta="old('descripcion_corta')"
    :nombreDelEvento="old('nombre_del_evento')"
    :lugar="old('lugar')"

    :fechaInicio="old('fecha_de_inicio')"
    :horaInicio="old('hora_de_inicio')"
    :fechaFin="old('fecha_a_finalizar')"
    :horaFin="old('hora_a_finalizar')"
    :edadPublicoMin="old('edad_publico_min')"
    :edadPublicoMax="old('edad_publico_max')"
    :btnSubmitName="'Crear'"
    />
    </div>
</x-body.body>