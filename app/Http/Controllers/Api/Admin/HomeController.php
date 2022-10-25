<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Order;
use App\Models\PrestationType;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $orders = Order::where('is_payed', 0)->count();
        $prestations = PrestationType::all()->count();
        $complaints = Complaint::where('status', 1)->count();
        $clients = User::where([
            'role_id' => 1,
            'is_account_active' => 1,
        ])->count();
        $developers = User::where([
            'role_id' => 2,
            'is_account_active' => 1,
        ])->count();
        $users = $clients + $developers;

        return response()->json([
            compact('users', 'developers', 'clients', 'orders', 'complaints', 'prestations'),
        ], 200);
    }
}
