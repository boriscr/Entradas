        <div class="box-elementos">
            <div class="box-img-portada">
                <div class="box-fecha">
                    <p>{{ strToUpper(\Carbon\Carbon::parse($eventos->fecha_de_inicio)->locale('es')->isoFormat('MMM')) }}
                    </p>
                    <p>{{ \Carbon\Carbon::parse($eventos->fecha_de_inicio)->format('d') }}</p>
                </div>
                <img src="{{ asset('storage/eventosImg/' . $eventos->portadaImg) }}" alt="portadaImg">
            </div>
            <div class="style-contenedor-general">
                <div class="nombre-de-entrada">
                    <H4>{{ Str::limit($eventos->nombre, 49) }}</H4>

                </div>
                <div class="tipo-de-evento">
                    <b>{{ $eventos->tipo_de_evento }}</b>
                </div>
                <div class="descripcion-card">
                    <p>{{ Str::limit($eventos->descripcion_corta, 83) }}</p>
                </div>
                <hr>
                <div class="inicio-card">
                    @if ($eventos->apt_todo_publico)
                        <p class="publicoY">Apto para todo público</p>
                    @else
                        <p class="publicoN">NO apto para todo público</p>
                    @endif
                    <p><i class="bi bi-alarm"></i>{{ $eventos->hora_de_inicio }}Hs</p>
                    <p><i class="bi bi-geo-alt-fill"></i>{{ Str::limit($eventos->lugar, 35) }}</p>
                </div>

                <div class="box-comprar">
                    <a class="link-comprar" href="{{ route('evento.show', $eventos->id) }}">COMPRAR AHORA</a>
                </div>
            </div>
            @role('Admin')
                <div class="box-btn-edit-del">
                    <a href="{{ route('evento.edit', $eventos->id) }}" class="btn-editar btn">
                        <i class="bi bi-pencil-fill"></i>
                    </a>
                    <form action="{{ route('evento.finalizar', $eventos->id) }}" method="post">
                        @csrf
                        <button class="btn-finalizar btn" type="submit"
                            onclick="return(confirm('¿Desea finalizar este evento? Esto implica: \n1. No será visible para los visitantes.\n2. Los visitantes no tendrán acceso ni podrán adquirirlo.\n3. Los administradores podrán ver los datos.\n4. Finalizar el entrada NO elimina los datos de la base de datos.\n5. Esta acción es reversible.'))">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </form>

                    <form action="{{ route('evento.destroy', $eventos->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn-destroy btn" type="submit"
                            onclick="return confirm('¿Desea eliminar este evento de la base de datos? Esto implica la pérdida total de toda la información relacionada.')"><i
                                class="bi bi-trash-fill"></i></button>
                    </form>
                </div>
            @endrole
        </div>
