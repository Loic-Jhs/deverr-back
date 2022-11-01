<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreNewOderRequest;
use App\Http\Resources\OrdersResource;
use App\Mail\SendConfirmationOderMail;
use App\Mail\SendNewOrderMail;
use App\Models\DeveloperPrestation;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $developerPrestations = Order::where('developer_id',$request->developer_id)->orderBy('created_at')->get();

        return response()->json(OrdersResource::collection($developerPrestations), 200);
    }

    /**
     * @param StoreNewOderRequest $request
     * @return JsonResponse
     */
    public function store(StoreNewOderRequest $request): JsonResponse
    {
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'developer_id' => $request->developer_id,
            'developer_prestation_id' => $request->developer_prestation_id,
            'instructions' => $request->instructions,
        ]);

        $data = [
            "fullname" => auth()->user()->lastname . ' ' . auth()->user()->firstname,
            "prestationTypeName" => $order->developerPrestation->prestationType->name,
            'instructions' => $order->instructions,
            'order_id' => $order->id,
            'developer_fullname' => $order->developer->user->firstname . ' ' . $order->developer->user->lastname
        ];

        Mail::to($order->developer->user->email)->send(new SendNewOrderMail($data));

        return response()->json($order);
    }

    /**
     * @param Request $request
     * @return void
     */
    public function prestationAccepted(Request $request): void
    {
        Order::find($request->order_id)->update([
            "is_accepted_by_developer" => true
        ]);

        $order = Order::where('id', $request->order_id)->first();

        $dataDev = [
            "user_fullname" => $order->user->lastname.' '.$order->user->firstname,
            "developer_fullname" => $order->developer->user->lastname.' '.$order->developer->user->firstname,
            "prestationTypeName" => $order->developerPrestation->prestationType->name,
        ];

        Mail::to($order->user->email)->send(new SendConfirmationOderMail($dataDev));

        redirect()->to(env('FRONT_URL').'/login');
    }
}
