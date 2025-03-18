<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\NewEvento;
use App\Models\NewEntrada;
use Barryvdh\DomPDF\Facade\Pdf; // Asegúrate de que esta línea esté presente
use App\Http\Requests\EventoNuevoStoreRequest;
//Storage para almacenar img en buket
use Illuminate\Support\Facades\Storage;
//Administrador de roles
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EventoAdminController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los eventos activos
        $eventos = NewEvento::where('activo', true)->get();
        if (!$eventos->isEmpty()) {
            // Pasar los eventos activos a la vista 'index'
            return view('index', compact('eventos'));
        }
        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $publico_check = true;
        return view('Eventos.createEvento', compact('publico_check'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventoNuevoStoreRequest $request)
    {
        $evento = new NewEvento();
        // Columna1: Nombre, Descripción, Precio, Cantidad
        $evento->nombre = $request->input('nombre_del_evento');
        $evento->tipo_de_evento = $request->input('tipo_de_evento');
        $evento->descripcion_corta = $request->input('descripcion_corta');
        $evento->descripcion = $request->input('descripcion');
        $evento->lugar = $request->input('lugar'); // Columna2: Lugar

        $evento->fecha_de_inicio = $request->input('fecha_de_inicio');
        $evento->hora_de_inicio = $request->input('hora_de_inicio');
        $evento->fecha_a_finalizar = $request->input('fecha_a_finalizar');
        $evento->hora_a_finalizar = $request->input('hora_a_finalizar');

        // Columna3: Finalizacion
        // Edad del publico objetivo
        // Apto para todo publico check
        if ($request->has('publico_check')) {
            $evento->apt_todo_publico = true;
        } else {
            $request->validate([
                'edad_publico_min' => 'required|numeric|min:1',
            ]);
            $evento->apt_todo_publico = false;
            $evento->edad_minima = $request->input('edad_publico_min');
            if (!$request->input('edad_publico_max') == null) {
                $request->validate([
                    'edad_publico_max' => 'numeric|min:2',
                ]);
                $evento->edad_maxima = $request->input('edad_publico_max');
            } else {
                $evento->edad_maxima = null;
            }
        }

        // 6/2 descuento porcentaje
        // Imagen de portada
        $evento->vendidos = 0;
        $evento->recaudado = 0;
        $evento->activo = true;
        $evento->portadaImg = '';

        // Procesar la imagen del input file
        // Procesar la imagen del input file
        if ($request->hasFile('portada_image')) {
            $image = $request->file('portada_image');

            // Obtener el ID del evento recién guardado
            $id_evento = $evento->id;

            // Generar un nombre único para la imagen
            $nombre_archivo = $id_evento . '.' . strtolower($image->getClientOriginalExtension());
            //Subir la imagen localmente
            //$ruta = storage_path("app/public/eventosImg/" . $nombre_archivo);
            // Subir la imagen al bucket
            $ruta = Storage::disk('s3')->putFileAs('eventosImg', $image, $nombre_archivo);

            // Guardar la ruta de la imagen en la base de datos
            $evento->portadaImg = $ruta;
            $evento->save();
        } else {
            session()->flash('error', [
                'title' => 'Error!',
                'text' => 'Error al subir la imagen.',
                'icon' => 'error',
            ]);
        }

        $evento->save();
        session()->flash('good', [
            'title' => 'Éxito!',
            'text' => 'Evento creado correctamente.',
            'icon' => 'success',
        ]);


        return back();
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $evento = NewEvento::findOrFail($id);
        // Obtén todas las entradas que tienen el mismo id_evento
        $entradasRelacionadas = NewEntrada::where('id_evento', $id)
            ->where('activo', true)
            ->get();
        return view('Eventos.showEvento', compact('evento', 'entradasRelacionadas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('admin-access');
        $evento = NewEvento::find($id);
        return view('Eventos.editEvento', compact('evento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $evento = NewEvento::findOrFail($id);
        $evento->nombre = $request->input('nombre_del_evento');
        $evento->tipo_de_evento = $request->input('tipo_de_evento');
        $evento->descripcion_corta = $request->input('descripcion_corta');
        $evento->descripcion = $request->input('descripcion');
        $evento->lugar = $request->input('lugar');
        $evento->fecha_de_inicio = $request->input('fecha_de_inicio');
        $evento->hora_de_inicio = $request->input('hora_de_inicio');
        $evento->fecha_a_finalizar = $request->input('fecha_a_finalizar');
        $evento->hora_a_finalizar = $request->input('hora_a_finalizar');

        // Actualizar los datos del evento
        $evento->fill($request->except('portada_image'));
        $evento->save();

        // Procesar la nueva imagen del input file
        if ($request->hasFile('portada_image')) {
            $portadaImg = $request->file('portada_image');

            // Generar un nombre único para la nueva imagen
            $nombreImg = $evento->id . '.' . strtolower($portadaImg->getClientOriginalExtension());

            // Eliminar la imagen anterior del bucket si existe
            if ($evento->portadaImg) {
                Storage::disk('s3')->delete($evento->portadaImg);
            }

            // Subir la nueva imagen al bucket
            $ruta = Storage::disk('s3')->putFileAs('eventosImg', $portadaImg, $nombreImg);

            // Actualizar la ruta de la imagen en la base de datos
            $evento->portadaImg = $ruta;
            $evento->save();
        }

        // Mostrar mensaje de éxito
        session()->flash('good', [
            'title' => 'Actualizado!',
            'text' => 'Los datos del evento han sido actualizados.',
            'icon' => 'success',
        ]);

        return back();
        /* Actualizar img en local
        if ($request->hasFile('portada_image')) {
            $portadaImg = $request->file('portada_image');
            $evento_id = $evento->id;
            $nombreImg = $evento_id . '.' . strtolower($portadaImg->getClientOriginalExtension());
            $ruta = storage_path('app/public/eventosImg/' . $nombreImg);
            if (file_exists($ruta)) {
                unlink($ruta);
            }
            $portadaImg->move(storage_path('app/public/eventosImg/'), $nombreImg);
            $evento->portadaImg = $nombreImg;
            $evento->save();
        }
        session()->flash('good', [
            'title' => 'Actualizado!',
            'text' => 'Los datos del evento han sido actualizados.',
            'icon' => 'success',
        ]);
        return back();
        */
    }

    public function destroy($id)
    {
        $evento = NewEvento::findOrFail($id);
        // Eliminar la imagen del bucket
        if ($evento->portadaImg) {
            Storage::disk('s3')->delete($evento->portadaImg);
        }

        // Eliminar el evento de la base de datos
        $evento->delete();

        session()->flash('good', [
            'title' => 'Éxito!',
            'text' => 'Evento eliminado correctamente.',
            'icon' => 'success',
        ]);
        return back();
        /* Eliminar img de portada local
        $rutaImgPortada = storage_path('app/public/eventosImg/') . $evento->portadaImg;
        if (file_exists($rutaImgPortada)) {
            unlink($rutaImgPortada);
        }
        $evento->delete();
        session()->flash('good', [
            'title' => 'Eliminado!',
            'text' => 'Evento eliminado correctamente.',
            'icon' => 'success',
        ]);
        return back();*/
    }

    public function finalizar($id)
    {
        $evento = NewEvento::findOrFail($id);
        $evento->activo = false;
        $evento->save();
        session()->flash('good', [
            'title' => 'Finalizado!',
            'text' => 'Evento finalizado correctamente.',
            'icon' => 'success',
        ]);
        return back();
    }
}
