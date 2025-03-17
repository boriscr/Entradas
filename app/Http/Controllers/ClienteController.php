<?php

namespace App\Http\Controllers;

use App\Models\NewEntrada;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{

    public function index(Request $request)
    {
        $idEntrada= rand(99,999);
        $cliente=Cliente::findOrFail($idEntrada);
        if(!$cliente){
            $clienteNew= new Cliente();
            $clienteNew->nombre=$request->input('nombre');
        // Obtén el ID de la entrada desde la referencia externa (external_reference)
        $externalReference = $request->input('external_reference');
        $entrada = NewEntrada::find($externalReference);

        if ($entrada) {
            // Descontar la cantidad de entradas disponibles
            $cantidadComprada = $request->input('quantity', 1); // Cantidad comprada (puedes pasarla desde el frontend)
            $entrada->cantidad -= $cantidadComprada;
            $entrada->vendidos += $cantidadComprada;
            $entrada->recaudado += ($entrada->precio * $cantidadComprada);
            if ($entrada->cantidad <= 0) {
                $entrada->activo = false;
            }
            $entrada->save();
        }

        // Redirigir a una vista exclusiva
        return view('pago_exitoso', [
            'entrada' => $entrada,
            'quantity' => $cantidadComprada, // Pasa la cantidad comprada a la vista
        ]);
    }
    else{
        //
    }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
