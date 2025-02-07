<x-body.body>
<style>
    @page {
        margin: 0.5cm;
    }
    *{
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }
/*Tickets*/
.box {
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    width: 95%;
    height: 50%;
    background-color: #efb810;
    /*background-image: linear-gradient(40deg, rgb(202, 87, 174), rgb(80, 7, 7));*/
    padding: 5px;
}

.contentTicket {
    border: 1px dotted rgb(250, 229, 114);
    background-image: linear-gradient(90deg, rgba(209, 107, 184, 0.671), rgba(255, 34, 207, 0.719), rgb(63, 1, 1));
    border-radius: 10px;
    width: 100%;
    height: 100%;

}

.marca-agua {
    width: 100%;
    height: 100%;
    background-image: url('/images/original.png');
    /* Reemplaza con la ruta de tu imagen */
    background-size: 25px 25px;
    /* Ajusta el tamaño según sea necesario */
    padding: 20px;
    text-align: center;
    background-repeat: repeat;
    /* Repite la imagen */
}
/*1 Columna N° ticket*/
.ticket {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    height: 100%;
    border: 2px dotted black;
    background-color: #00000018;
}

.ticket-header__date {
    color: #efb810;
    transform: rotate(-90deg);
    transform-origin: center; /* Ajusta el origen de transformación */  
}

/*2 COLUMNA TITULO Y DETALLES*/
.ticket-header {
    height: 30%;
    gap: 2px;
    color: #ffffffbd;
    display: flex;
    align-items: start;
    justify-content: center;
    flex-direction: column;
}

.ticket-header__title {
    padding: 5px;
    height: 50%;
    max-width: 300px;
    display: flex;
    justify-content: center;
    align-items: center;
    border: 5px solid rgb(255, 255, 255);
}

.detalles {
    font-family:cursive;
    gap: 1px;
    text-align: start;
}

/*3 Columna Qr*/
.ticket-body {
    color: #fff;
    height: 100%;
    display: flex;
    justify-content: end;
    align-items: center;
    flex-direction: column;
    padding-bottom: 20px;
}

.qrBox {
    border: 1px solid rgb(255, 255, 255);
    width: 100px;
    height: 100px;
    background-color: black;
}
.hrBox{
    height: 100%;
    border: 2px dotted #fff;

}

/*4 Columna Lite*/
.ticket-footer{
    color: #ffffffb9;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}

</style>
<div class="box" id="box">
    <div class="contentTicket">
        <div class="marca-agua">
            <div class="ticket">
                <div class="ticket-header__date">
                        <h2>28022001</h2>

                        <h3>Número de Boleto</h3>
                </div>
                <div class="ticket-header">
                    <div class="ticket-header__title">
                        <h2>GRAN FESTIVAL DEL HUANCAR</h2>
                    </div>
                    <div class="detalles">
                        <h5>Precio: $1500</h5>
                        <h5>Fecha:15-03-2025</h5>
                        <h5>Horario: 18:20</h5>
                    </div>
                </div>
                <div class="ticket-body">
                    <div class="ticket-body__content">
                        <p>Escanea el QR</p>
                    </div>
                    <div class="qrBox">
                    </div>
                </div>
                <div class="hrBox">
                </div>
                <div class="ticket-footer">
                    <div class="ticket-header__title">
                        <h2>Titulo DEL GRAN EVENTO</h2>
                    </div>
                    <div class="ticket-header__date_lite">
                        <h3>28022001</h3>

                        <h4>Número de Boleto</h4>
                    </div>
                    <div class="detalles">
                        <h5>Precio: $1500</h5>
                        <h5>Fecha:15-03-2025</h5>
                        <h5>Horario: 18:20</h5>
                    </div>
                    <div class="qrBox">
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-body.body>
