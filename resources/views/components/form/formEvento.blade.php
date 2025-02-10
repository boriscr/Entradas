
<form action="{{ route('evento.store') }}" method="post">
    @csrf
    <div class="boxContenidoForm">
        <h3>1/3</h3>
        <div class="contenidoForm">
            <h3>Crear nuevo evento</h3>
            <hr>
            <label for="tipo_de_entrada">Tipo de entrada</label>
            <select name="tipo_de_entrada" id="tipo_de_entrada">
                <option value="VIP">VIP</option>
                <option value="Preferencial">Preferencial</option>
                <option value="Primera fila">Primera Fila</option>
                <option value="Platea baja">Platea Baja</option>
                <option value="Platea alta">Platea Alta</option>
                <option value="Anticipadas">Anticipadas</option>
                <option value="Especial">Especial</option>
                <option value="Tribuna">Tribuna</option>
                <option value="Asiento y ubicacion">Con asiento y ubicación</option>
                <option value="Ubicacion">Con ubicación específica</option>
                <option value="Asiento">Con asignación de asiento</option>
                <option value="General">General</option>
                <option value="Otro">Otro</option>
            </select>
            @error('tipo_de_entrada')
                <p class="error">{{ $message }}</p>
            @enderror
            <label for="nombreEvento">Nombre del evento</label>
            <input type="text" name="nombre_del_evento" id="nombre_del_evento" value="{{ $nombreDelEvento }}"
                placeholder="Ejemplo: Concierto de Rock">
            @error('nombre_del_evento')
                <p class="error">{{ $message }}</p>
            @enderror
            <label for="descripcion_corta">Descripción corta</label>
            <textarea name="descripcion_corta" id="descripcionCorta" cols="30" rows="1">{{ $descripcionCorta }}</textarea>
            <p class="error visibilidadError" id="descripcion-mensaje-error"></p>
            @error('descripcion_corta')
                <p class="error">{{ $message }}</p>
            @enderror
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" cols="30" rows="3">{{ $descripcion }}</textarea>
            @error('descripcion')
                <p class="error">{{ $message }}</p>
            @enderror
            <label for="precio">Precio $$</label>
            <input type="number" name="precio" id="precio" value="{{ $precio }}" placeholder="Ejemplo: 2000"
                step="any">
            @error('precio')
                <p class="error">{{ $message }}</p>
            @enderror
            <label for="cantidad">Cantidad de entradas</label>
            <input type="number" name="cantidad" id="cantidad" value="{{ $cantidad }}"
                placeholder="Ejemplo: 100">
            @error('cantidad')
                <p class="error">{{ $message }}</p>
            @enderror
            <label for="lugar">Lugar/Dirección</label>
            <input type="text" name="lugar" id="lugar" value="{{ $lugar }}"
                placeholder="Ejemplo: Plaza central">
            @error('lugar')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="boxContenidoForm">
        <h3>2/3</h3>
        <!--
        <i class="bi bi-calendar2-plus-fill"></i>
        -->
        <div class="contenidoForm">
            <h3>Inicio del evento</h3>
            <hr>
            <label for="fecha_de_inicio">Fecha de inicio</label>
            <input type="date" name="fecha_de_inicio" id="fecha_de_inicio" value="{{ $fechaInicio }}">
            @error('fecha_de_inicio')
                <p class="error">{{ $message }}</p>
            @enderror
            <label for="hora_de_inicio">Hora de inicio</label>
            <input type="time" name="hora_de_inicio" id="hora_de_inicio" value="{{ $horaInicio }}">
            @error('hora_de_inicio')
                <p class="error">{{ $message }}</p>
            @enderror

        </div>
        <div class="contenidoForm">
            <h3>Finalización del evento</h3>
            <hr>
            <label for="fecha_a_finalizar">Fecha de finalizacion</label>
            <input type="date" name="fecha_a_finalizar" id="fecha_a_finalizar" value="{{ $fechaFin }}">
            @error('fecha_a_finalizar')
                <p class="error">{{ $message }}</p>
            @enderror
            <label for="hora_a_finalizar">Hora de finalizacion</label>
            <input type="time" name="hora_a_finalizar" id="hora_a_finalizar" value="{{ $horaFin }}">
            @error('hora_a_finalizar')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="boxContenidoForm">
        <h3>3/3</h3>
        <!--
        <i class="bi bi-calendar2-x"></i>
    -->
        <div class="contenidoForm">
            <h3>Opciones extras</h3>
            <hr>
            <!-- 1 Apto para todo publico-->
            <div class="row">
                <div class="col">
                    <input type="checkbox" name="publico_check" id="publico_check" value="1" {{ old('publico_check')? 'checked' : '' }}>
                    <label for="publico_check">¿Es apto para todo público?</label>
                </div>
                <div class="box-publico-check" id="box-publico-check">
                    <label for="edad_publico_min">Edad minima aceptada</label>
                    <input type="number" name="edad_publico_min" id="edad_publico_min" placeholder="Ejemplo: 13" value="{{$edadPublicoMin}}">
                    <p class="error visibilidadError" id="edad-minima-mensaje-error"></p>
                    <label for="edad_publico_max">Edad máxima aceptada</label>
                    <input type="number" name="edad_publico_max" id="edad_publico_max" placeholder="Ejemplo: 17" value="{{$edadPublicoMax}}">
                    <p class="error visibilidadError" id="edad-maxima-mensaje-error"></p>
                </div>
            </div>
            <hr>

            <!-- 2 Descuentos-->
            <div class="row">
                <div class="col">
                    <input type="checkbox" name="descuento_check" id="descuento_check" value="1" {{ old('descuento_check') ? 'checked' : '' }}>
                    <label for="descuento_check">Descuento</label>
                </div>
                <div class="box-descuento-check" id="box-descuento-check">
                    <!-- 2- 3/1 Descuentos PORCENTAJE-->
                    <label for="porcentaje_descuento">Porcentaje de descuento</label>
                    <input type="number" name="porcentaje_descuento" id="porcentaje_descuento"
                        placeholder="Ejemplo: 12%" step="any" value="{{ $porcentajeDescuento }}">
                    @error('porcentaje_descuento')
                        <p class="error">{{ $message }}</p>
                    @enderror
                    <p class="error visibilidadError" id="porcentaje-de-descuento-mensaje-error"></p>
                    <p class="mensaje" id="porcentaje-de-descuento-mensaje"></p>
                    <p class="mensaje" id="porcentaje-de-descuento-final-mensaje"></p>
                    <!-- 2- 3/2 Descuentos CON CUPON-->
                    <div class="col">
                        <input type="checkbox" name="descuento_cupon_check" id="descuento_cupon_check" value="1" {{ old('descuento_cupon_check') ? 'checked' : '' }}>
                        <label for="descuento_cupon_check">Descuento solo con cupón</label>
                    </div>
                    <div class="box-cupon-descuento" id="box-cupon-descuento">
                        <label for="cupon_descuento">Cupon</label>
                        <input type="text" name="cupon_descuento" id="cupon_descuento"
                            placeholder="Ejemplo: FIESTA10" value="{{ $cuponDescuento }}">
                        <p class="mensaje" id="cupon-descuento-mensaje"></p>
                    </div>
                    <!-- 2- 3/3 Descuentos POR CANTIDAD DE ENTRADAS-->
                    <div class="col">
                        <input type="checkbox" name="descuento_por_cantidad_check" id="descuento_por_cantidad_check" value="1" {{ old('descuento_por_cantidad_check') ? 'checked' : '' }}>
                        <label for="descuento_por_cantidad_check">Descuento por cantidad</label>
                    </div>
                    <div class="box-cantidad-entradas" id="box-cantidad-entradas">
                        <label for="cantidad_entradas_min">Cantidad minima de entradas</label>
                        <input type="number" name="cantidad_entradas_min" id="cantidad_entradas_min"
                            placeholder="Ejemplo: 3" value="{{ $cantidadEntradasMin}}">
                        <p class="error visibilidadError" id="cantidad-entradas-min-error"></p>
                        <label for="cantidad_entradas_max">Cantidad máxima de entradas</label>
                        <input type="number" name="cantidad_entradas_max" id="cantidad_entradas_max"
                            placeholder="Ejemplo: 15" value="{{ $cantidadEntradasMax}}">
                        <p class="error visibilidadError" id="cantidad-entradas-max-error"></p>
                        <p class="mensaje" id="cantidad-entradas-mensaje"></p>
                    </div>
                </div>
            </div>
            <hr>

            <!-- 3 ASIENTOS-LUGARES ASIGNADOS-->
            <div class="row">
                <!-- 3- 3/1 ASIENTO ASIGNADO-->
                <div class="col">
                    <input type="checkbox" name="asiento_check" id="asiento_check" value="1" {{ old('asiento_check') ? 'checked' : '' }}>
                    <label for="asiento_check">Asignación de asientos</label>
                </div>
                <p class="mensaje" class="mensaje-asiento-check" id="mensaje-asiento-check"></p>
            </div>
            <!-- 3- 3/2 UBICACION ASIGNADO-->
            <div class="row">
                <div class="col">
                    <input type="checkbox" name="ubicacion_check" id="ubicacion_check" value="1" {{ old('ubicacion_check') ? 'checked' : '' }}>
                    <label for="ubicacion_check">Ubicación específica</label>
                </div>
                <div class="box-ubicacion" id="box-ubicacion">
                    <label for="ubicacion_uno">Nombre de la ubicación</label>
                    <input type="text" name="ubicacion_uno" id="ubicacion_uno"
                        placeholder="Ejemplo: Pasillo derecho" value="{{ $ubicacionUno}}">
                </div>
            </div>

            <!-- 3- 3/3 ASIENTO Y UBICACION ASIGNADO-->
            <div class="row">
                <div class="col">
                    <input type="checkbox" name="asiento_ubicacion_check" id="asiento_ubicacion_check" value="1" {{ old('asiento_ubicacion_check') ? 'checked' : '' }}>
                    <label for="asiento_ubicacion_check">Con asiento y ubicación</label>
                </div>
                <div class="box-asiento-ubicacion" id="box-asiento-ubicacion">
                    <p class="mensaje" id="mensaje">Asientos asignados a cada entrada.</p>
                    <label for="ubicacion_dos">Nombre de la ubicación</label>
                    <input type="text" name="ubicacion_dos" id="ubicacion_dos"
                        placeholder="Ejemplo: Pasillo derecho" value="{{ $ubicacionDos}}">
                </div>
            </div>
            <br>
            <button type="submit">Crear</button>
        </div>
    </div>
</form>
