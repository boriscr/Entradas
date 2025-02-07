function cantidadMinMax(minInp, minMens, maxInp, maxMens) {
    if (minInp.value > maxInp.value) {
        minMens.style.display = 'flex';
        minMens.textContent = 'El valor mínimo no puede superar al máximo.'
    } else {
        minMens.style.display = 'none';
        minMens.innerHTML = ''
    }
    if (maxInp.value < minInp.value) {
        minMens.style.display = 'flex';
        maxMens.textContent = 'El valor máximo no puede ser inferior al valor mínimo.'
    } else {
        minMens.style.display = 'none';
        maxMens.innerHTML = ''
    }
}

document.getElementById('publico_check').checked = true;
const publicoCheck = document.getElementById('publico_check');
const boxPublico = document.getElementById('box-publico-check');
publicoCheck.addEventListener('change', function () {
    if (publicoCheck.checked) {
        boxPublico.style.display = 'none';
    } else {
        boxPublico.style.display = 'flex';
        /*Input edades maximas y minimas */
        const edadMin = document.getElementById('edad_publico_min');
        const edadMinMensajeError = document.getElementById('edad-minima-mensaje-error');
        const edadMax = document.getElementById('edad_publico_max');
        const edadMaxMensajeError = document.getElementById('edad-maxima-mensaje-error');
        edadMin.addEventListener('input', function () {
            cantidadMinMax(edadMin, edadMinMensajeError, edadMax, edadMaxMensajeError)
        })
        edadMax.addEventListener('input', function () {
            cantidadMinMax(edadMin, edadMinMensajeError, edadMax, edadMaxMensajeError)
        })
    }
})
//2 Box descuentos----------------------------------------------------------------------------------

/*Descuento */
const precioInput = document.getElementById('precio');
const descuentoMensajeError = document.getElementById("porcentaje-de-descuento-mensaje-error");
const descuentoMensaje = document.getElementById("porcentaje-de-descuento-mensaje");
const descuentoFinalMensaje = document.getElementById("porcentaje-de-descuento-final-mensaje");
const porcentajedescuentoInput = document.getElementById('porcentaje_descuento');
//Box inputs descuento por cantidad
const cantidadMensaje = document.getElementById("cantidad-entradas-mensaje");

//Box inputs descuento por cupon
const box = document.getElementById('box-cupon-descuento');

const descuentoCheck = document.getElementById('descuento_check');
descuentoCheck.addEventListener('change', function () {
    if (descuentoCheck.checked) {
        const descuentoCantidadCheck = document.getElementById('descuento_por_cantidad_check');
        document.getElementById('box-descuento-check').style.display = "flex";
        //Descuento por cantidad
        descuentoCantidadCheck.addEventListener('change', function () {
            if (descuentoCantidadCheck.checked) {
                document.getElementById('box-cantidad-entradas').style.display = "flex";
                const cantidad_entradas_min = document.getElementById('cantidad_entradas_min');
                const cantidadEntradasMinError = document.getElementById('cantidad-entradas-min-error');
                const cantidad_entradas_max = document.getElementById('cantidad_entradas_max');
                const cantidadEntradasMaxError = document.getElementById('cantidad-entradas-max-error');
                cantidad_entradas_min.addEventListener('input', function () {
                    cantidadMinMax(cantidad_entradas_min, cantidadEntradasMinError, cantidad_entradas_max, cantidadEntradasMaxError)
                    const descuentoPorcentaje = document.getElementById('porcentaje_descuento').value;
                    if (this.value > 1 && this.value < cantidad_entradas_max.value) {
                        cantidadMensaje.style.display = 'flex';
                        cantidadMensaje.textContent = 'Por la compra de ' + cantidad_entradas_min.value + ' entradas o más, se realizará el descuento del ' + descuentoPorcentaje + '%';
                    } else {
                        cantidadMensaje.style.display = 'none';
                        cantidadMensaje.textContent = '';
                    }
                })
        
                cantidad_entradas_max.addEventListener('input', function () {
                    cantidadMinMax(cantidad_entradas_min, cantidadEntradasMinError, cantidad_entradas_max, cantidadEntradasMaxError)
                    const descuentoPorcentaje = document.getElementById('porcentaje_descuento').value;
                    if (this.value > 1 && this.value > cantidad_entradas_min.value) {
                        cantidadMensaje.style.display = 'flex';
                        cantidadMensaje.textContent = 'Por la compra de ' + cantidad_entradas_min.value + ' entradas o más, se realizará el descuento del ' + descuentoPorcentaje + '%';
                    } else {
                        cantidadMensaje.style.display = 'none';
                        cantidadMensaje.textContent = '';
                    }
                })
            } else {
                document.getElementById('box-cantidad-entradas').style.display = "none";
            }
        })

        //Descuento por cupon option
        document.getElementById('descuento_cupon_check').addEventListener('change', function () {
            const cuponDescuentoMensaje = document.getElementById('cupon-descuento-mensaje');
            if (this.checked) {
                box.style.display = "flex";
                document.getElementById('cupon_descuento').addEventListener('input', function () {
                    if (this != '' && porcentajedescuentoInput.value >= 1) {
                        cuponDescuentoMensaje.style.display = 'flex';
                        cuponDescuentoMensaje.textContent = 'El descuento del ' + porcentajedescuentoInput.value + '% solo aplicará si se coloca el cupon "' + this.value + '" para el descuento.';
                    } else {
                        cuponDescuentoMensaje.style.display = 'none';
                        cuponDescuentoMensaje.innerHTML = '';
                    }
                })
            } else {
                box.style.display = "none";
            }
        })


    } else {
        document.getElementById('descuento_por_cantidad_check').checked = false;
        document.getElementById('box-cantidad-entradas').style.display = "none";
        document.getElementById('descuento_cupon_check').checked = false;
        box.style.display = 'none';
        document.getElementById('box-descuento-check').style.display = "none";
    }
})
function descuentoPorcentual() {
    const precio = Number(precioInput.value); // Obtener el valor actualizado  
    const porcentajeDescuento = Number(porcentajedescuentoInput.value);
    if (porcentajeDescuento < 0.1) {
        descuentoMensajeError.style.display = 'flex';
        descuentoMensajeError.textContent = 'El porcentaje debe ser mayor a 0.1';
    } else {
        descuentoMensajeError.style.display = 'none';
        descuentoMensajeError.innerHTML = '';
        if (porcentajeDescuento > 0 && precio > 0) {
            const calculo = ((precio * porcentajeDescuento) / 100);
            const precioFinal = precio - calculo;
            descuentoMensaje.style.display = 'flex';
            descuentoFinalMensaje.style.display = 'flex';
            descuentoMensaje.textContent = 'Descuento por cada entrada: $' + calculo.toFixed(2);
            descuentoFinalMensaje.textContent = 'Precio final: $' + precioFinal.toFixed(2);
        } else {
            descuentoFinalMensaje.style.display = 'none';
            descuentoMensaje.style.display = 'none';
            descuentoMensaje.innerHTML = '';
            descuentoFinalMensaje.textContent = '';
        }
    }
}
porcentajedescuentoInput.addEventListener('input', function () {
    descuentoPorcentual()
})
precioInput.addEventListener('input', function () {
    if (porcentajedescuentoInput.value >= 1) {
        descuentoPorcentual()
    }
})


const asiento = document.getElementById('asiento_check');
const asientoMensaje = document.getElementById('mensaje-asiento-check');

const ubicacion = document.getElementById('ubicacion_check');
const boxUbicacion = document.getElementById('box-ubicacion');

const asientoUbicacion = document.getElementById('asiento_ubicacion_check');
const boxAsientoUbicacion = document.getElementById('box-asiento-ubicacion');


asiento.addEventListener('change', function () {
    if (asiento.checked) {
        ubicacion.checked = false;
        asientoUbicacion.checked = false;
        asientoMensaje.style.display = 'flex';
        asientoMensaje.textContent = "Asientos asignados a cada entrada."
        boxAsientoUbicacion.style.display = 'none';//True
        boxUbicacion.style.display = 'none';
    } else {
        asientoMensaje.style.display = 'none';
        asientoMensaje.innerHTML = "";
    }
})
ubicacion.addEventListener('change', function () {
    if (ubicacion.checked) {
        asiento.checked = false;
        asientoMensaje.innerHTML = "";
        asientoUbicacion.checked = false;
        boxUbicacion.style.display = 'flex';
        boxAsientoUbicacion.style.display = 'none';
    } else {
        boxUbicacion.style.display = 'none';
    }
})

asientoUbicacion.addEventListener('change', function () {
    if (asientoUbicacion.checked) {
        asiento.checked = false;
        asientoMensaje.innerHTML = "";
        ubicacion.checked = false;
        document.getElementById('mensaje').style.display = 'flex';
        boxAsientoUbicacion.style.display = 'flex';
        boxUbicacion.style.display = 'none';
    } else {
        document.getElementById('mensaje').style.display = 'none';
        boxAsientoUbicacion.style.display = 'none';
    }
})