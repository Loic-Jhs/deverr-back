<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreNewOderRequest;
use App\Http\Resources\DeveloperPrestationsResource;
use App\Mail\SendConfirmationOderMail;
use App\Mail\SendNewOrderMail;
use App\Models\Developer;
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
        $developerPrestations = DeveloperPrestation::where('developer_id',$request->developer_id)->get();

        return response()->json(DeveloperPrestationsResource::collection($developerPrestations), 200);
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
        $developer = Developer::find($request->developer_id)->firstOrFail();

        $data = [
            "fullname" => auth()->user()->lastname . ' ' . auth()->user()->firstname,
            "prestationTypeName" => $order->developerPrestation->prestationType->name,
            'instructions' => $order->instructions,
            'order_id' => $order->id
        ];

        Mail::to($developer->user->email)->send(new SendNewOrderMail($data));

        return response()->json($order);
    }

    public function prestationAccepted(Request $request)
    {
        Order::find($request->order_id)->update([
            "is_accepted_by_developer" => true
        ]);

        $order = Order::find($request->order_id)->firstOrFail();

        $dataDev = [
            "developer" => true,
            "fullname" => $order->developer->user->lastname.' '.$order->developer->user->firstname,
            "prestationTypeName" => $order->developerPrestation->prestationType->name,
        ];

        $dataClient = [
            "developer" => false,
            "fullname" => $order->user->lastname.' '.$order->user->firstname,
            "prestationTypeName" => $order->developerPrestation->prestationType->name,
        ];

        Mail::to($order->developer->user->email)->send(new SendConfirmationOderMail($dataDev));
        Mail::to($order->user->email)->send(new SendConfirmationOderMail($dataClient));

        redirect()->to(env('FRONT_URL').'/login');
    }
}
