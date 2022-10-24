<?php

namespace App\Http\Controllers\Api\Stripe;

use App\Http\Controllers\Controller;
use App\Models\DeveloperPrestation;
use Illuminate\Http\JsonResponse;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class StripeController extends Controller
{
    public function createSession($id): JsonResponse
    {
        $DOMAIN = 'http://localhost';
        Stripe::setApiKey('sk_test_51LvRpVGm3pNtvPq2Cf4hl95LApSmGx9Zdz5oyrmsJzMIGOoiVzOX0w5lvn3O9WlmKU2mCvPh57oPDLF4CRUUrD60009lXMzhVb');

        $developerPrestation = DeveloperPrestation::where('id', $id)->first();

        $checkout_session = Session::create([
            'customer_email'       => 'ethan@test.fr',
            'payment_method_types' => ['card'],
            'line_items'           => [
                [
                    'price_data' => [
                        'currency'     => 'eur',
                        'unit_amount'  => (float)$developerPrestation->price * 100,
                        'product_data' => [
                            'name'   => "Site vitrine",
                            'images' => [$DOMAIN . '/public/images/defaultProfile.png'],
                        ],
                    ],
                    'quantity'   => 1,
                ],
            ],
            'mode'                 => 'payment',
            'success_url'          => $DOMAIN . '/payment-success/{CHECKOUT_SESSION_ID}',
            'cancel_url'           => $DOMAIN . '/payment-canceled/{CHECKOUT_SESSION_ID}',
        ]);

        return new JsonResponse([
            'id' => $checkout_session->id,
        ]);
    }
}
