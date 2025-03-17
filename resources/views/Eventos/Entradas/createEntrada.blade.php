<x-body.body>
    <x-nav.nav />

    @if (session('good'))  
    <script>  
        document.addEventListener('DOMContentLoaded', function () {  
            Swal.fire(@json(session('good')));  
        });  
    </script>  
@endif
<?php
$eventoUnico=isset($eventoUnico)?$eventoUnico:null;
$eventoAll=isset($evento)?$evento:null;
$id=$eventoUnico!=null?$eventoUnico:$eventoAll;
?>
    <div class="formularioBox">

        <x-form.formentrada
        :eventoNameInd="$eventoUnico"
        :eventoName="$eventoAll"
        :ruta="route('entrada.store',$id)"
        :descripcion="old('descripcion')"
        :precio="old('precio')"
        :cantidad="old('cantidad')"
        
        :porcentajeDescuento="old('porcentaje_descuento')"
        :cuponDescuento="old('cupon_descuento')"
        :cantidadentradasMin="old('cantidad_entradas_min')"
        :cantidadentradasMax="old('cantidad_entradas_max')"
        :ubicacionUno="old('ubicacion_uno')"
        :ubicacionDos="old('ubicacion_dos')"
        :btnSubmitName="'Crear'"
        />
    </div>
</x-body.body>
