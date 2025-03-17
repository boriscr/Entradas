<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Models\NewEntrada; // Asegúrate de importar el modelo NewEntrada

class MercadoPagoController extends Controller
{
    public function createPaymentPreference(Request $request)
    {
        Log::info('Creando preferencia de pago');
        $this->authenticate();
        Log::info('Autenticado con éxito');

        // Obtén el ID de la entrada desde la solicitud
        $entradaId = $request->input('product')[0]['id']; // ID de la entrada
        $entrada = NewEntrada::find($entradaId);

        // Verificar si hay entradas disponibles
        if ($entrada->cantidad <= 0) {
            $entrada->activo = false; // Desactiva la entrada si no hay disponibilidad
            $entrada->save();
            session()->flash('error', [
                'title' => 'Entradas agotadas',
                'text' => 'Lo sentimos, entradas agotadas.',
                'icon' => 'error',
            ]);
            return back();
        }

        // Obtén la cantidad de entradas que el usuario quiere comprar
        $cantidadInput = $request->input('product')[0]['quantity']; // Cantidad de entradas

        // Verificar que el usuario no compre más entradas de las disponibles
        if ($cantidadInput > $entrada->cantidad) {
            return response()->json(['error' => 'No puedes comprar más entradas de las disponibles.'], 400);
        }

        // Obtén los datos del formulario
        $product = $request->input('product'); // Asumiendo que envías un campo 'product' con los datos

        if (empty($product) || !is_array($product)) {
            return response()->json(['error' => 'Los datos del producto son requeridos.'], 400);
        }

        // Información del comprador
        $payer = [
            "name" => $request->input('name', 'John'), // Puedes obtener el nombre del request o usar un valor predeterminado
            "surname" => $request->input('surname', 'Doe'),
            "email" => $request->input('email', 'user@example.com'),
        ];

        // Crear la solicitud de preferencia
        $requestData = $this->createPreferenceRequest($product, $payer);

        // Crear la preferencia con el cliente de preferencia
        $client = new PreferenceClient();

        try {
            $preference = $client->create($requestData);

            return response()->json([
                'id' => $preference->id,
                'init_point' => $preference->init_point,
            ]);
        } catch (MPApiException $error) {
            Log::error('Error en la API de Mercado Pago:', ['error' => $error->getApiResponse()->getContent()]);
            return response()->json([
                'error' => $error->getApiResponse()->getContent(),
            ], 500);
        } catch (Exception $e) {
            Log::error('Error al crear la preferencia:', ['error' => $e->getMessage()]);
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // Autenticación con Mercado Pago
    protected function authenticate()
    {
        $mpAccessToken = config('services.mercadopago.access_token');
        if (!$mpAccessToken) {
            throw new Exception("El token de acceso de Mercado Pago no está configurado.");
        }
        MercadoPagoConfig::setAccessToken($mpAccessToken);
        MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);
    }

    // Función para crear la estructura de preferencia
    protected function createPreferenceRequest($items, $payer): array
    {
        $paymentMethods = [
            "excluded_payment_methods" => [],
            "installments" => 12,
            "default_installments" => 1
        ];

        // Definir las URLs de redirección
        $backUrls = [
            'success' => route('mercadopago.success', ['quantity' => $items[0]['quantity']]), // Pasa la cantidad comprada como parámetro
            'failure' => route('mercadopago.failed')
        ];

        $request = [
            "items" => $items,
            "payer" => $payer,
            "payment_methods" => $paymentMethods,
            "back_urls" => $backUrls,
            "statement_descriptor" => "TIENDA ONLINE",
            "external_reference" => $items[0]['id'], // Usa el ID del producto como referencia externa
            "expires" => false,
            "auto_return" => 'approved',
        ];
        return $request;
    }
}
