<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\JsonResponse;

class PaymentSuccessController extends Controller
{
    public function success($stripeSessionId)
    {
        $dateNow = new \DateTime('now');

        $order = new Order();
        $order->is_payed = true;
        $order->client_id = 18;
        $order->dev_prestation_id = 5;
        $order->reference = str_replace(' ', '', $dateNow->format('Y-m-d') . '-' . uniqid());
        $order->stripe_session_id = $stripeSessionId;
        $order->save();

        $orderStripeSessionId = Order::where('stripe_session_id', $stripeSessionId)->first();

        return new JsonResponse([
            'message' => 'Payment Success',
            'order'   => $orderStripeSessionId,
        ]);
    }
}
