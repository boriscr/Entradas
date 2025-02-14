/////////////////////////////////////////////////////////////////////////////////////////////////////////
const descripcionMensajeError = document.getElementById('descripcion-mensaje-error');
document.getElementById('descripcionCorta').addEventListener('input', function () {
    var input = document.getElementById('descripcionCorta').value;
    var contador = input.length;
    if (contador >= 83) {
        descripcionMensajeError.style.display = 'flex';
        descripcionMensajeError.textContent = 'El campo descripcion corta no debe ser mayor que 83 caracteres.';
    } else {
        descripcionMensajeError.style.display = 'none';
        descripcionMensajeError.innerHTML = '';
    }
});
/////////////////////////////////////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////////////////////////////////

/*Columna 2 */
const publicoCheck = document.getElementById('publico_check');
const boxPublico = document.getElementById('box-publico-check');
const edadMin = document.getElementById('edad_publico_min');
const edadMinMensajeError = document.getElementById('edad-minima-mensaje-error');
const edadMax = document.getElementById('edad_publico_max');

publicoCheck.addEventListener('change', function () {
    if (publicoCheck.checked) {
        boxPublico.style.display = 'none';
        edadMin.value = '';
        edadMax.value = '';
    } else {
        boxPublico.style.display = 'flex';
    }
})
/*Input edades maximas y minimas */
edadMin.addEventListener('input', function () {
    if (parseInt(this.value) > parseInt(edadMax.value)) {
        edadMinMensajeError.style.display = 'flex';
        edadMinMensajeError.textContent = 'El valor mínimo no puede superar al máximo.'
    } else {
        edadMaxMensajeError.style.display = 'none';
        edadMaxMensajeError.innerHTML = ''
        edadMinMensajeError.style.display = 'none';
        edadMinMensajeError.innerHTML = ''
    }
})
const edadMaxMensajeError = document.getElementById('edad-maxima-mensaje-error');
edadMax.addEventListener('input', function () {
    if (parseInt(this.value) < parseInt(edadMin.value)) {
        edadMaxMensajeError.style.display = 'flex';
        edadMaxMensajeError.textContent = 'El valor máximo no puede ser inferior al valor mínimo.'
    } else {
        edadMaxMensajeError.style.display = 'none';
        edadMaxMensajeError.innerHTML = ''
        edadMinMensajeError.style.display = 'none';
        edadMinMensajeError.innerHTML = ''
    }
})