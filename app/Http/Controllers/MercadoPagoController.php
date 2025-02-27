<?php

namespace App\Http\Controllers;

use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\MercadoPagoConfig;
use Illuminate\Http\Request;

class MercadoPagoController extends Controller
{
    public function createPreference(Request $request)
    {
        // Obtén el Access Token desde la configuración
        $accessToken = config('mercado_pago.access_token');
    
        // Configura el access token de Mercado Pago
        MercadoPagoConfig::setAccessToken($accessToken);
    
        // Crea una instancia del cliente de pagos
        $client = new PaymentClient();
    
        // Obtén los datos del formulario
        $cantidad = $request->input('cantidad', 1); // Cantidad de entradas
        $precioUnitario = 2000; // Precio por entrada (ajusta según tu lógica)
    
        try {
            // Crea la preferencia de pago
            $payment = $client->create([
                "transaction_amount" => 100, // Monto total
                "description" => "Entrada para evento", // Descripción del pago
                "payment_method_id" => "pix", // Método de pago
                "payer" => [
                    "email" => "test_user_123456@testuser.com", // Email de prueba
                    "first_name" => "Test", // Nombre de prueba
                    "last_name" => "User", // Apellido de prueba
                ],
            ]);
    
            // Obtén la URL de pago desde la respuesta
            $paymentUrl = $payment->point_of_interaction->transaction_data->ticket_url;
    
            // Redirige al usuario a la URL de pago de Mercado Pago
            return redirect($paymentUrl);
        } catch (\MercadoPago\Exceptions\MPApiException $e) {
            // Captura el error y muestra los detalles
            return response()->json([
                'error' => $e->getMessage(),
                'response' => $e->getApiResponse(),
                'status' => $e->getStatusCode(),
            ], 500);
        }
    }
}