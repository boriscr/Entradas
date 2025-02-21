<x-body.body>
    <x-nav.nav />
    <div class="formularioBox">
        <x-form.formentrada
        :ruta="route('entrada.edit')"
        :publico_check="$publico_check"
        :nombreDelentrada="$edit->nombre"
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
        :cantidadentradasMin="$edit->cantidad_entradas_min"
        :cantidadentradasMax="$edit->cantidad_entradas_max"
        :ubicacionUno="$edit->ubicacion_uno"
        :ubicacionDos="$edit->ubicacion_dos"
        :btnSubmitName="'Actualizar'"
        />
    </div>
    <script src="/js/checksFormCreate.js"></script>

</x-body.body>