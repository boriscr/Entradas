<form action="{{ $ruta }}" method="post">
    @csrf
    <div class="boxContenidoForm">
        <h3>1/3</h3>
        <div class="contenidoForm">
            <h3>Crear nuevo entrada</h3>
            <hr>
            <label for="evento">Nombre del evento</label>
            <select name="evento" id="evento">
                
                @if ( $eventoNameInd!=null )
                    <option value="{{ $eventoNameInd->id }}">{{ $eventoNameInd->nombre }}</option>
                @else
                    @foreach ($eventoName as $evento)
                        @if ($evento->activo)
                            <option value="{{ $evento->id }}">{{ $evento->nombre }}</option>
                        @endif
                    @endforeach
                @endif
            </select>

            @error('evento')
                <p class="error">{{ $message }}</p>
            @enderror
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

        </div>
    </div>
    <div class="boxContenidoForm">
        <h3>2/3</h3>
        <div class="contenidoForm">
            <h3>Descuentos</h3>
            <hr>
            <!-- 2 Descuentos-->
            <div class="row">
                <div class="col">
                    <input type="checkbox" name="descuento_check" id="descuento_check" value="1"
                        {{ old('descuento_check') ? 'checked' : '' }}>
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
                        <input type="checkbox" name="descuento_cupon_check" id="descuento_cupon_check" value="1"
                            {{ old('descuento_cupon_check') ? 'checked' : '' }}>
                        <label for="descuento_cupon_check">Descuento solo con cupón</label>
                    </div>
                    <div class="box-cupon-descuento" id="box-cupon-descuento">
                        <label for="cupon_descuento">Cupon</label>
                        <input type="text" name="cupon_descuento" id="cupon_descuento"
                            placeholder="Ejemplo: FIESTA10" value="{{ $cuponDescuento }}">
                        <p class="mensaje" id="cupon-descuento-mensaje"></p>
                    </div>
                    <!-- 2- 3/3 Descuentos POR CANTIDAD DE entradaS-->
                    <div class="col">
                        <input type="checkbox" name="descuento_por_cantidad_check" id="descuento_por_cantidad_check"
                            value="1" {{ old('descuento_por_cantidad_check') ? 'checked' : '' }}>
                        <label for="descuento_por_cantidad_check">Descuento por cantidad</label>
                    </div>
                    <div class="box-cantidad-entradas" id="box-cantidad-entradas">
                        <label for="cantidad_entradas_min">Cantidad minima de entradas</label>
                        <input type="number" name="cantidad_entradas_min" id="cantidad_entradas_min"
                            placeholder="Ejemplo: 3" value="{{ $cantidadentradasMin }}">
                        <p class="error visibilidadError" id="cantidad-entradas-min-error"></p>
                        <label for="cantidad_entradas_max">Cantidad máxima de entradas</label>
                        <input type="number" name="cantidad_entradas_max" id="cantidad_entradas_max"
                            placeholder="Ejemplo: 15" value="{{ $cantidadentradasMax }}">
                        <p class="error visibilidadError" id="cantidad-entradas-max-error"></p>
                        <p class="mensaje" id="cantidad-entradas-mensaje"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="boxContenidoForm">
        <h3>3/3</h3>
        <div class="contenidoForm">
            <h3>Asignación de lugares</h3>
            <hr>
            <!-- 3 ASIENTOS-LUGARES ASIGNADOS-->
            <div class="row">
                <!-- 3- 3/1 ASIENTO ASIGNADO-->
                <div class="col">
                    <input type="checkbox" name="asiento_check" id="asiento_check" value="1"
                        {{ old('asiento_check') ? 'checked' : '' }}>
                    <label for="asiento_check">Asignación de asientos</label>
                </div>
                <p class="mensaje" class="mensaje-asiento-check" id="mensaje-asiento-check"></p>
            </div>
            <!-- 3- 3/2 UBICACION ASIGNADO-->
            <div class="row">
                <div class="col">
                    <input type="checkbox" name="ubicacion_check" id="ubicacion_check" value="1"
                        {{ old('ubicacion_check') ? 'checked' : '' }}>
                    <label for="ubicacion_check">Ubicación específica</label>
                </div>
                <div class="box-ubicacion" id="box-ubicacion">
                    <label for="ubicacion_uno">Nombre de la ubicación</label>
                    <input type="text" name="ubicacion_uno" id="ubicacion_uno"
                        placeholder="Ejemplo: Pasillo derecho" value="{{ $ubicacionUno }}">
                </div>
            </div>

            <!-- 3- 3/3 ASIENTO Y UBICACION ASIGNADO-->
            <div class="row">
                <div class="col">
                    <input type="checkbox" name="asiento_ubicacion_check" id="asiento_ubicacion_check"
                        value="1" {{ old('asiento_ubicacion_check') ? 'checked' : '' }}>
                    <label for="asiento_ubicacion_check">Con asiento y ubicación</label>
                </div>
                <div class="box-asiento-ubicacion" id="box-asiento-ubicacion">
                    <p class="mensaje" id="mensaje">Asientos asignados a cada entrada.</p>
                    <label for="ubicacion_dos">Nombre de la ubicación</label>
                    <input type="text" name="ubicacion_dos" id="ubicacion_dos"
                        placeholder="Ejemplo: Pasillo derecho" value="{{ $ubicacionDos }}">
                </div>
            </div>
            <br>
            <button type="submit">{{ $btnSubmitName }}</button>
        </div>
    </div>
</form>
