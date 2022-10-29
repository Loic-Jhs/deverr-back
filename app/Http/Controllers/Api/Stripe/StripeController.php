<?php

namespace App\Http\Controllers\Api\Stripe;

use App\Http\Controllers\Controller;
use App\Models\DeveloperPrestation;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class StripeController extends Controller
{
    public function createSession($id): JsonResponse
    {
        $DOMAIN = 'http://localhost';
        Stripe::setApiKey('sk_test_51LvRpVGm3pNtvPq2Cf4hl95LApSmGx9Zdz5oyrmsJzMIGOoiVzOX0w5lvn3O9WlmKU2mCvPh57oPDLF4CRUUrD60009lXMzhVb');

        $developerPrestation = DeveloperPrestation::where('id', $id)->first();
        $devPrestationIdInOrder = Order::where('developer_prestation_id', $id)->first();
        $user = auth()->user();

        $checkout_session = Session::create([
            'customer_email'       => $user ?: $developerPrestation->developer->user->email,
            'payment_method_types' => ['card'],
            'line_items'           => [
                [
                    'price_data' => [
                        'currency'     => 'eur',
                        'unit_amount'  => (float)$developerPrestation->price * 100,
                        'product_data' => [
                            'name'   => "Paiement pour la prestation : ".$developerPrestation->prestationType->name,
                            'images' => [$DOMAIN . '/public/images/deverr.jng'],
                        ],
                    ],
                    'quantity'   => 1,
                ],
            ],
            'mode'                 => 'payment',
            'success_url'          => $DOMAIN . '/payment-success/{CHECKOUT_SESSION_ID}/' . $devPrestationIdInOrder['developer_prestation_id'],
            'cancel_url'           => $DOMAIN . '/payment-canceled/{CHECKOUT_SESSION_ID}/'. $devPrestationIdInOrder['developer_prestation_id'],
        ]);

        return new JsonResponse([
            'id' => $checkout_session->id,
        ]);
    }
}
