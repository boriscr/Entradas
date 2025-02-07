<x-body.body>
    <x-nav.nav />
    <div class="formularioBox">
        <x-form.formEvento
        :descripcion="old('descripcion')"
        :nombreDelEvento="old('nombre_del_evento')"
        :precio="old('precio')"
        :cantidad="old('cantidad')"
        :lugar="old('lugar')"
        :fechaInicio="old('fecha_de_inicio')"
        :horaInicio="old('hora_de_inicio')"
        :fechaFin="old('fecha_a_finalizar')"
        :horaFin="old('hora_a_finalizar')"
        />
    </div>
    <script src="/js/checksFormCreate.js"></script>
</x-body.body>
