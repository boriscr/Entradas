<x-body.body>
    <x-nav.nav />
    @if(isset($edit))
        {{$edit->nombre}}
    @endif
    <div class="formularioBox">
        <x-form.formEvento
        :nombreDelEvento="$edit->nombre"
        :descripcion="$edit->descripcion"
        :precio="$edit->precio"
        :cantidad="$edit->cantidad"
        :lugar="$edit->lugar"
        :fechaInicio="$edit->fecha_de_inicio"
        :horaInicio="$edit->hora_de_inicio"
        :fechaFin="$edit->fecha_a_finalizar"
        :horaFin="$edit->hora_a_finalizar"
        />
    </div>
    <script src="/js/checksFormCreate.js"></script>

</x-body.body>