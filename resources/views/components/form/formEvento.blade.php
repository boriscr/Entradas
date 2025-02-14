<form action="{{ $ruta }}" method="post" enctype="multipart/form-data">
    @csrf
    @if (isset($metodo))
        @method('PUT')
    @endif

    <div class="boxContenidoForm">
        <h3>1/3</h3>
        <div class="contenidoForm">
            <h3>Crear nuevo evento</h3>
            <hr>
            <label for="tipo_de_entrada">Tipo de evento</label>
            <select name="tipo_de_entrada" id="tipo_de_entrada">
                <option value="Fiesta privada" {{ $tipo == 'Fiesta privada' ? 'selected' : '' }}>Fiesta privada</option>
                <option value="Fiesta temática" {{ $tipo == 'Fiesta temática' ? 'selected' : '' }}>Fiesta temática
                </option>
                <option value="Fiesta de club" {{ $tipo == 'Fiesta de club' ? 'selected' : '' }}>Fiesta de club</option>
                <option value="Concierto" {{ $tipo == 'Concierto' ? 'selected' : '' }}>Concierto</option>
                <option value="Festival cultural" {{ $tipo == 'Festival cultural' ? 'selected' : '' }}>Festival cultural
                </option>
                <option value="Evento de DJ" {{ $tipo == 'Evento de DJ' ? 'selected' : '' }}>Evento de DJ</option>
                <option value="Baile de gala" {{ $tipo == 'Baile de gala' ? 'selected' : '' }}>Baile de gala</option>
                <option value="Otro" {{ $tipo == 'Otro' ? 'selected' : '' }}>Otro</option>
                <option value="Sin tipo" {{ $tipo == 'Sin tipo' ? 'selected' : '' }}>Sin tipo</option>
            </select>
            @error('tipo_de_entrada')
                <p class="error">{{ $message }}</p>
            @enderror
            <label for="nombreentrada">Nombre del evento</label>
            <input type="text" name="nombre_del_evento" id="nombre_del_entrada" value="{{ $nombreDelEvento }}"
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
        <div class="contenidoForm">
            <h3>Imagen de portada</h3>
            <hr>
            @if (isset($portadaImg))
                <div class="contenedorImg">
                    <img src="{{ asset('storage/eventosImg/' . $portadaImg) }}" alt="">
                </div>
            @endif
            <!-- 2 Portada img-->
            <div class="file-input-wrapper">
                <input type="file" name="portada_image" id="portada_image" class="file-input" accept="image/*">
                <p style="font-size: 11px">La imagen de previsualización se recortará a un tamaño de 400px x 200px.</p>
                <p style="font-size: 11px">En la vista final se recortará a un tamaño de 500px x 400px.</p>
                @error('portada_image')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <hr>
        <div class="contenidoForm">
            <h3>Edad admitida</h3>
            <hr>
            <div class="row">
                <div class="col">
                    <input type="checkbox" name="publico_check" id="publico_check" value="1" {{ $publicoCheck }}>
                    <label for="publico_check">Apto para todo público</label>
                </div>
                <div class="box-publico-check" id="box-publico-check">
                    <label for="edad_publico_min">Edad minima aceptada</label>
                    <input type="number" name="edad_publico_min" id="edad_publico_min" placeholder="Ejemplo: 13"
                        value="{{ $edadPublicoMin }}">
                    @error('edad_publico_min')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    <p class="error visibilidadError" id="edad-minima-mensaje-error"></p>
                    <label for="edad_publico_max">Edad máxima aceptada</label>
                    <input type="number" name="edad_publico_max" id="edad_publico_max" placeholder="Ejemplo: 17"
                        value="{{ $edadPublicoMax }}">
                    <p class="error visibilidadError" id="edad-maxima-mensaje-error"></p>
                    @error('edad_publico_max')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <hr>
            <button type="submit">{{$btnSubmitName}}</button>
        </div>
    </div>

</form>
