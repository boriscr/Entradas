document.addEventListener('DOMContentLoaded', function () {
    function validateCheckboxes() {
        const publicoCheck = document.getElementById('publico_check');
        const publicoContainer = document.getElementById('box-publico-check');
        publicoContainer.style.display = publicoCheck.checked ? 'none' : 'flex';

        const descuento= document.getElementById('descuento_check');
        document.getElementById('box-descuento-check').style.display= descuento.checked?'flex':'none';
        const cupon=document.getElementById('descuento_cupon_check');
        document.getElementById('box-cupon-descuento').style.display=cupon.checked?'flex':'none';
        const cantidad=document.getElementById('descuento_por_cantidad_check');
        document.getElementById('box-cantidad-entradas').style.display=cantidad.checked?'flex':'none';
        const asiento=document.getElementById('asiento_check');
        document.getElementById('mensaje').style.display=asiento.checked?'flex':'none';
        const ubicacion=document.getElementById('ubicacion_check');
        document.getElementById('box-ubicacion').style.display=ubicacion.checked?'flex':'none';
        const asientoUbicacion=document.getElementById('asiento_ubicacion_check');
        document.getElementById('mensaje').style.display=asientoUbicacion.checked?'flex':'none';
        document.getElementById('box-asiento-ubicacion').style.display=asientoUbicacion.checked?'flex':'none';

    }

    // Validar checkboxes al cargar la página
    validateCheckboxes();
});