<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\new_evento;
use Barryvdh\DomPDF\Facade\Pdf; // Asegúrate de que esta línea esté presente
use App\Http\Requests\EntradaNuevaStoreRequest;

class EventoAdminController extends Controller
{
    public function index()
    {
        $eventos = new_evento::all();
        foreach ($eventos as $value) {
            if ($value->activo == true) {
                return view('home', compact('eventos'));
            }
        }
        return view('home');

        /*
        //Pdf
        $randomNumber = random_int(9999, 99999999);
        // Carga la vista del PDF incluyendo el QR  
        $pdf = PDF::loadView('pdf', ['randomNumber' =>  $randomNumber]);

        // Cambiar la orientación a horizontal  
        $pdf->setPaper('A4');

        // Retorna el PDF como un documento para descarga  
        return $pdf->stream('documento.pdf');

        return view('pdf', compact('randomNumber'));
        */
    }
    public function create()
    {
        $publico_check=true;
        return view('crearTickets', compact('publico_check'));
    }

    public function store(EntradaNuevaStoreRequest $request)
    {
        $entrada = new new_evento();
        //Columna1: Nombre, Descripción, Precio, Cantidad
        $entrada->nombre = $request->input('nombre_del_evento');
        $entrada->tipo_de_entrada = $request->input('tipo_de_entrada');
        $entrada->descripcion_corta = $request->input('descripcion_corta');
        $entrada->descripcion = $request->input('descripcion');
        $entrada->precio = $request->input('precio');
        $entrada->cantidad = $request->input('cantidad');
        $entrada->lugar = $request->input('lugar');
        //Columna2: Lugar
        $entrada->fecha_de_inicio = $request->input('fecha_de_inicio');
        $entrada->hora_de_inicio = $request->input('hora_de_inicio');
        $entrada->fecha_a_finalizar = $request->input('fecha_a_finalizar');
        $entrada->hora_a_finalizar = $request->input('hora_a_finalizar');

        //Columna3: Finalizacion---------------------------------------------
        //6/1 Edad del publico objetivo
        if (!$request->has('publico_check')) {
            $request->validate([
                'edad_publico_min' => 'required|numeric|min:1',
                'edad_publico_max' => 'required|numeric|min:2',
            ]);
            $entrada->apt_todo_publico = false;
            $entrada->edad_minima = $request->input('edad_publico_min');
            $entrada->edad_maxima = $request->input('edad_publico_max');
        }
        //6/2 descuento porcentaje
        if ($request->has('descuento_check')) {
            $request->validate([
                'porcentaje_descuento' => 'required|numeric|min:1',
            ]);
            $entrada->porcentaje_de_descuento = $request->input('porcentaje_descuento');
            $entrada->precio_final=$request->input('precio')-(($request->input('precio')*$request->input('porcentaje_descuento'))/100);
        }
        //6/3 Cupones
        if ($request->has('descuento_cupon_check')) {
            $request->validate([
                'cupon_descuento' => 'required|string|min:3',
            ]);
            $entrada->cupon = $request->input('cupon_descuento');
        }
        //6/4 cantidad minima y maxima de entradas
        if ($request->has('descuento_por_cantidad_check')) {
            $request->validate([
                'cantidad_entradas_min' => 'required|numeric|min:2', // Validaciones para cantidad minima y maxima de entradas
                'cantidad_entradas_max' => 'required|numeric',
            ]);
            $entrada->cantidad_minima_de_entradas = $request->input('cantidad_entradas_min');
            $entrada->cantidad_maxima_de_entradas = $request->input('cantidad_entradas_max');
        }
        // 6/5 Asientos
        if ($request->has('asiento_check') || $request->has('asiento_ubicacion_check')) {
            $entrada->asientos = 0;
        }
        // 6/6 Ubicacion
        if ($request->has('ubicacion_check')) {
            $request->validate([
                'ubicacion_uno' => 'required|string|min:3|max:255', // Validaciones para ubicacion_uno  
            ]);
            $entrada->ubicacion = $request->input('ubicacion_uno');
        } elseif ($request->has('asiento_ubicacion_check')) {
            $request->validate([
                'ubicacion_dos' => 'required|string|min:3|max:255', // Validaciones para ubicacion_dos  
            ]);
            $entrada->ubicacion = $request->input('ubicacion_dos');
        }


        //Columna4: Vendidos, Recaudado, Activo
        $entrada->vendidos = 0;
        $entrada->recaudado = 0;
        $entrada->activo = true;
        $entrada->save();
        $eventos = new_evento::all();
        return to_route('evento.index', compact('eventos'));
    }

    public function edit($id)
    {
        $edit = new_evento::find($id);
        return view('editFormEntrada', compact('edit'));
    }

    public function destroy($id)
    {
        $del = new_evento::find($id);
        if ($del) {
            $del->delete();
            return to_route('home')->with('eliminadoMensaje', 'Evento eliminado con éxito.');
        }
        return to_route('home')->with('eliminadoMensajeError', 'Error al eliminar éste evento.');
    }


    public function indexEntradas($id)
    {
        $eventos = new_evento::find($id);
        if (!$eventos) {
            abort(404);
        } else {
            return view('consultaEntradas', compact('eventos'));
        }
    }
}
