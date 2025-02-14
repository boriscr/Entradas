<x-body.body>
    <style>
        @page {
            margin: 0cm;
        }

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: Verdana, Geneva, Tahoma, sans-serif
        }

        .box {
            width: 96%;
            height: 100vh;
            padding: 15px;
        }

        .contenidoBox {
            /*background: rgb(2, 33, 39));*/

            background-image: url('{{ public_path('images/golden.jpg') }}');
            /*
            background: radial-gradient(ellipse farthest-corner at right bottom, #FEDB37 0%, #FDB931 8%, #9f7928 30%, #8A6E2F 40%, transparent 80%),
            radial-gradient(ellipse farthest-corner at left top, #FFFFFF 0%, #FFFFAC 8%, #D1B464 25%, #5d4a1f 62.5%, #5d4a1f 100%);
            */
            background-size: cover;
            background-repeat: no-repeat;
            padding: 10px;
        }

        .nameTitle {
            display: flex;
            justify-content: center;
            align-items: center;
            height: auto;
            border: 2px solid rgb(201, 248, 234);
        }

        .nameTitle h1 {
            margin-top: 10px;
            margin-bottom: 10px;
            color: red;
            text-align: center;
        }

        /*background-image: url('{{ public_path('images/original.png') }}');*/
        .watterOriginal {
            width: 100%;
            height: auto;
            text-align: center;
            background: rgba(0, 0, 0, 0.541);
            padding: 0px
        }

        .watterOriginal p {
            margin-right: -8px;
            margin-left: -8px;
            margin-top: 3px;
            margin-bottom: 3px;
            display: inline-block;
            font-size: 4px;
            color: rgba(255, 255, 255, 0.534);
            transform: rotate(-50deg);

        }

        .detalles {
            color: #fff;
            font-size: 15px;
        }
        .codigoRandom{
            text-align: center;
            background: rgba(0, 0, 0, 0.432)
        }
        .codigoRandom .code {
            font-size: 25px;
            font-family: "Unica One", serif;
            font-weight: bold;
            font-style: normal;
        }
    </style>
    <div class="box" id="box">
        <div class="contenidoBox">
            <div class="nameTitle">
                <h1>Gran entrada Anual-Solidario</h1>
            </div>
            <?php
            $count = 90;
            ?>
            <div class="watterOriginal">
                @for ($i = 0; $i < $count; $i++)
                    <p>ORIGINAL</p>
                @endfor
            </div>
            <div class="detalles">
                <div class="propietario">
                    <h2>Propietario</h2>
                    <p><b>Nombre:</b></p>
                    <p><b>Apellido:</b></p>
                    <p><b>Documento:</b></p>
                </div>
                <div class="lugar">
                    <h2>Detalles</h2>
                    <p><b>Lugar:</b></p>
                    <p><b>Horario:</b></p>
                    <p><b>Horario:</b></p>
                </div>
                <div class="pago">
                    <h2>Abonado</h2>
                    <p><b>Valor:$</b></p>
                    <p><b>Medio de Pago:</b></p>
                    <p><b>Tipo de entrada:</b></p>
                </div>
                <div class="codigoRandom">
                    <p>Codigo Ticket</p>
                    <p class="code">{{ $randomNumber }}</p>
                </div>
            </div>
        </div>
    </div>

</x-body.body>
