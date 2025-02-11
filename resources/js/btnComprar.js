document.getElementById('btn-comprar-ahora').addEventListener('click', function(){
    document.getElementById('container-pago').style.display='flex';
})

document.getElementById('btn-cancelar').addEventListener('click', function(){
    document.getElementById('container-pago').style.display='none';
})