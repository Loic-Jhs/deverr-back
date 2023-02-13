<?php


namespace Tests\Feature;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Stripe\Stripe;
use Stripe\Checkout\Session;

uses(RefreshDatabase::class);

it('should return 200 when a customer clicks on the payment button to be redirected to the Stripe Page', function () {

    Stripe::setApiKey(env('SECRET_KEY_STRIPE'));

    $order = new Order;
    $order->id = 1411;
    $order->user_id = 3;
    $order->developer_id = 17;
    $order->developer_prestation_id = 1;

    $checkout_session = Session::create([
        'customer_email' => "ethan@example.com",
        'payment_method_types' => ['card'],
        'line_items' => [
            [
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => "1200",
                    'product_data' => [
                        'name' => 'Paiement TEST :',
                        'images' => ['deverr.jng'],
                    ],
                ],
                'quantity' => 1,
            ],
        ],
        'mode' => 'payment',
        'success_url' => 'https://test.com/payment-success/{CHECKOUT_SESSION_ID}',
        'cancel_url' => 'https://test.com/payment-canceled/{CHECKOUT_SESSION_ID}',
    ]);

    $url = $checkout_session['url'];
    $client = new \GuzzleHttp\Client();
    $response = $client->get($url);
    $this->assertEquals("200", $response->getStatusCode());
});

