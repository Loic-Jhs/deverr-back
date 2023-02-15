<?php

namespace App\Http\Controllers\Api\Stripe;

use App\Http\Controllers\Controller;
use App\Models\DeveloperPrestation;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class StripeController extends Controller
{
    public function createSession($id): JsonResponse
    {
        $DOMAIN = config('app.front_url');
        $DOMAIN_API = env('APP_URL');

        Stripe::setApiKey(config('app.stripe_api_secret_key'));

        $order = Order::where('id', $id)->first();
        $user = auth()->user();

        $checkout_session = Session::create([
            'customer_email' => $user ?: $order->developerPrestation->developer->user->email,
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'eur',
                        'unit_amount' => (float) $order->developerPrestation->price * 100,
                        'product_data' => [
                            'name' => 'Paiement pour la prestation : '.$order->developerPrestation->prestationType->name,
                            'images' => [$DOMAIN_API.'/images/deverrLogo.png'],
                        ],
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => $DOMAIN.'/payment-success/{CHECKOUT_SESSION_ID}/'.$order['developer_prestation_id'],
            'cancel_url' => $DOMAIN.'/payment-canceled/{CHECKOUT_SESSION_ID}/'.$order['developer_prestation_id'],
        ]);

        return new JsonResponse([
            'id' => $checkout_session->id,
        ]);
    }
}
