<?php

namespace App\Http\Controllers\Api\Stripe;

use App\Http\Controllers\Controller;
use App\Models\DeveloperPrestation;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class PaymentController extends Controller
{

    /**
     * @param $id
     * @return View
     */
    public function recapDeveloperPrestation($id): View
    {
        $developerPrestation = DeveloperPrestation::where('id', $id)->first();
        $devFullName = $developerPrestation->developer->user->firstname . ' ' . $developerPrestation->developer->user->lastname;

        /*return new JsonResponse([
            'developerPrestationId'    => $developerPrestation->id,
            'developerPrestationName'  => $developerPrestation->prestation->name,
            'developerFullName'        => $devFullName,
            'developerPrestationPrice' => $developerPrestation->price,
        ]);*/

        return view('recap', [
            'developerPrestation' => $developerPrestation,
        ]);
    }

    /**
     * @param $stripeSessionId
     * @param $clientId
     * @param $developerPrestationId
     * @return JsonResponse
     */
    public function success($stripeSessionId, $clientId, $developerPrestationId): JsonResponse
    {
        $order = new Order();
        $order->is_payed = true;
        $order->client_id = $clientId;
        $order->dev_prestation_id = $developerPrestationId;
        $order->reference = str_replace([' ', '-'], '', now()->format('Y-m-d') . '-' . uniqid());
        $order->stripe_session_id = $stripeSessionId;
        $order->save();

        $orderStripeSessionId = Order::where('stripe_session_id', $stripeSessionId)->first();

        return new JsonResponse([
            'message' => 'Payment Success',
            'order'   => $orderStripeSessionId,
        ]);
    }

    /**
     * @param $stripeSessionId
     * @param $clientId
     * @param $developerPrestationId
     * @return JsonResponse
     */
    public function canceled($stripeSessionId, $clientId, $developerPrestationId): JsonResponse
    {
        $order = new Order();
        $order->is_payed = false;
        $order->client_id = $clientId;
        $order->dev_prestation_id = $developerPrestationId;
        $order->reference = null;
        $order->stripe_session_id = $stripeSessionId;
        $order->save();

        $orderStripeSessionId = Order::where('stripe_session_id', $stripeSessionId)->first();

        return new JsonResponse([
            'message' => 'Payment canceled',
            'order'   => $orderStripeSessionId,
        ]);
    }
}
