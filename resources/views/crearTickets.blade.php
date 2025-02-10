<x-body.body>
    <x-nav.nav />
    <div class="formularioBox">
        <x-form.formEvento
        :publicoCheck="$publico_check"
        :descripcion="old('descripcion')"
        :descripcionCorta="old('descripcion_corta')"
        :nombreDelEvento="old('nombre_del_evento')"
        :precio="old('precio')"
        :cantidad="old('cantidad')"
        :lugar="old('lugar')"
        :fechaInicio="old('fecha_de_inicio')"
        :horaInicio="old('hora_de_inicio')"
        :fechaFin="old('fecha_a_finalizar')"
        :horaFin="old('hora_a_finalizar')"
        :edadPublicoMin="old('edad_publico_min')"
        :edadPublicoMax="old('edad_publico_max')"
        :porcentajeDescuento="old('porcentaje_descuento')"
        :cuponDescuento="old('cupon_descuento')"
        :cantidadEntradasMin="old('cantidad_entradas_min')"
        :cantidadEntradasMax="old('cantidad_entradas_max')"
        :ubicacionUno="old('ubicacion_uno')"
        :ubicacionDos="old('ubicacion_dos')"
        />
    </div>
    <script src="/js/checksFormCreate.js"></script>
</x-body.body>
