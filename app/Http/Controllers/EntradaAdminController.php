<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewEntrada;
use App\Models\NewEvento;
use Barryvdh\DomPDF\Facade\Pdf; // Asegúrate de que esta línea esté presente
use App\Http\Requests\entradaNuevaStoreRequest;

class EntradaAdminController extends Controller
{
    public function index()
    {
        /*
        $entradas = new_entrada::all();
        foreach ($entradas as $value) {
            if ($value->activo == true) {
                return view('home', compact('entradas'));
            }
        }
        return view('home');
*/
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
        $evento=NewEvento::all();
        $publico_check=true;
        return view('Eventos.Entradas.createEntrada', compact('publico_check','evento'));
    }

    public function store(entradaNuevaStoreRequest $request)
    {
        $entrada = new NewEntrada();
        //Columna1: Nombre, Descripción, Precio, Cantidad
        $entrada->id_evento=$request->input('evento');
        $entrada->tipo_de_entrada = $request->input('tipo_de_entrada');
        $entrada->descripcion = $request->input('descripcion');
        $entrada->precio = $request->input('precio');
        $entrada->cantidad = $request->input('cantidad');
        //Columna2: Lugar

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
        $entradas = NewEntrada::all();
        return to_route('AdminEvento.show', compact('entradas'));
    }

    public function edit($id)
    {
        $edit = NewEntrada::find($id);
        return view('Eventos.Entradas.editEntrada', compact('edit'));
    }

    public function destroy($id)
    {
        $del = NewEntrada::find($id);
        if ($del) {
            $del->delete();
            return to_route('show')->with('eliminadoMensaje', 'entrada eliminado con éxito.');
        }
        return to_route('show')->with('eliminadoMensajeError', 'Error al eliminar éste entrada.');
    }


    public function indexentradas($id)
    {
        $entradas = NewEntrada::find($id);
        if (!$entradas) {
            abort(404);
        } else {
            return view('Eventos.Entradas.show', compact('entradas'));
        }
    }
}
