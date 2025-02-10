<x-body.body>
    <x-nav.nav />
    <div class="formularioBox">
        <x-form.formEvento
        :publico_check="$publico_check"
        :nombreDelEvento="$edit->nombre"
        :descripcionCorta="$edit->descripcion_corta"
        :descripcion="$edit->descripcion"
        :precio="$edit->precio"
        :cantidad="$edit->cantidad"
        :lugar="$edit->lugar"
        :fechaInicio="\Carbon\Carbon::parse($edit->fecha_de_inicio)->format('Y-m-d')"
        :horaInicio="$edit->hora_de_inicio"
        :fechaFin="\Carbon\Carbon::parse($edit->fecha_a_finalizar)->format('Y-m-d')"
        :horaFin="$edit->hora_a_finalizar"
        :edadPublicoMin="$edit->edadPublicoMin"
        :edadPublicoMax="$edit->edadPublicoMax"
        :porcentajeDescuento="$edit->porcentaje_descuento"
        :cuponDescuento="$edit->cupon_descuento"
        :cantidadEntradasMin="$edit->cantidad_entradas_min"
        :cantidadEntradasMax="$edit->cantidad_entradas_max"
        :ubicacionUno="$edit->ubicacion_uno"
        :ubicacionDos="$edit->ubicacion_dos"
        />
    </div>
    <script src="/js/checksFormCreate.js"></script>

</x-body.body>