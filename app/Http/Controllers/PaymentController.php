<?php

namespace App\Http\Controllers;

use App\Models\DeveloperPrestation;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class PaymentController extends Controller
{
    /**
     * @param $clientId
     * @param $developerPrestationId
     * @return void
     */
    public function preorder($clientId, $developerPrestationId): void
    {
        Order::create([
            'client_id'         => $clientId,
            'dev_prestation_id' => $developerPrestationId,
        ]);
    }

    /**
     * @param $id
     * @return View
     */
    public function recapDeveloperPrestation($id): View
    {
        $developerPrestation = DeveloperPrestation::where('id', $id)->first();

        return view('recap', [
            'developerPrestation' => $developerPrestation,
        ]);
    }

    /**
     * @param $stripeSessionId
     * @return JsonResponse
     */
    public function success($stripeSessionId, Order $order): JsonResponse
    {
        $order->is_payed = true;
        $order->reference = str_replace(' ', '', now()->format('Y-m-d') . '-' . uniqid());
        $order->stripe_session_id = $stripeSessionId;
        $order->update();

        $orderStripeSessionId = Order::where('stripe_session_id', $stripeSessionId)->first();

        return new JsonResponse([
            'message' => 'Payment Success',
            'order'   => $orderStripeSessionId,
        ]);
    }
}
