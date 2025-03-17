// Selecciona todos los elementos con la clase 'btn-comprar-no-loggin'
const botonesComprar = document.querySelectorAll('.no-loggin');

// Añade un evento 'click' a cada botón
botonesComprar.forEach(boton => {
    boton.addEventListener('click', function () {
        // Muestra el contenedor de pago
        document.getElementById('container-pago').style.display = 'flex';
    });
});

document.getElementById('btn-cancelar').addEventListener('click', function () {
    document.getElementById('container-pago').style.display = 'none';
})
//

document.getElementById('btn-comprar').addEventListener('click', function () {
    document.getElementById('container-pago').style.display = 'flex';
})

//Btn aumentar disminuir cantidad de entradas
const cantidadInput = document.getElementById('cantidad');
document.getElementById('btn-cantidad-menos').addEventListener('click', function () {
    const cantidadValue = parseInt(cantidadInput.value);
    if (cantidadValue >= 2) {
        cantidadInput.value = cantidadValue - 1;
    }
})
document.getElementById('btn-cantidad-mas').addEventListener('click', function () {
    const cantidadValue = parseInt(cantidadInput.value);
    if (cantidadValue >= 1) {
        cantidadInput.value = cantidadValue + 1;
    }
})
cantidadInput.addEventListener('input', function () {
    if (parseInt(cantidadInput.value) < 1) {
        cantidadInput.value = 1;
    }
})