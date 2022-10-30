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
     * @return JsonResponse
     */
    public function recapDeveloperPrestation($id): JsonResponse
    {
        $developerPrestation = DeveloperPrestation::where('id', $id)->first();
        $devFullName = $developerPrestation->developer->user->firstname . ' ' . $developerPrestation->developer->user->lastname;

        return new JsonResponse([
            'developerPrestationId'    => $developerPrestation->id,
            'developerPrestationName'  => $developerPrestation->prestationType->name,
            'developerFullName'        => $devFullName,
            'developerPrestationPrice' => $developerPrestation->price,
        ]);

        /*return view('recap', [
            'developerPrestation' => $developerPrestation,
        ]);*/
    }

    /**
     * @param $stripeSessionId
     * @param $developerPrestationId
     * @return JsonResponse
     */
    public function success($stripeSessionId, $developerPrestationId): JsonResponse
    {
        Order::where('developer_prestation_id', $developerPrestationId)->update([
            'is_payed' => true,
            'reference' => str_replace([' ', '-'], '', now()->format('Y-m-d') . '-' . uniqid()),
            'stripe_session_id' => $stripeSessionId
        ]);

        $orderStripeSessionId = Order::where('stripe_session_id', $stripeSessionId)->first();

        return new JsonResponse([
            'message' => 'Payment Success',
            'order'   => $orderStripeSessionId,
        ]);
    }

    /**
     * @param $stripeSessionId
     * @param $developerPrestationId
     * @return JsonResponse
     */
    public function canceled($stripeSessionId, $developerPrestationId): JsonResponse
    {
        Order::where('developer_prestation_id', $developerPrestationId)->update([
            'is_payed' => true,
            'reference' => str_replace([' ', '-'], '', now()->format('Y-m-d') . '-' . uniqid()),
            'stripe_session_id' => $stripeSessionId
        ]);

        $orderStripeSessionId = Order::where('stripe_session_id', $stripeSessionId)->first();

        return new JsonResponse([
            'message' => 'Payment canceled',
            'order'   => $orderStripeSessionId,
        ]);
    }
}
