<?php

namespace App\Http\Controllers\Api\Developer;

use App\Http\Controllers\Controller;
use App\Http\Resources\AllDevsResource;
use App\Models\Developer;
use Illuminate\Http\JsonResponse;

class AllDevsController extends Controller
{
    /**
     * Get all developers
     * @return JsonResponse
     */
    public function getAllDevs(): \Illuminate\Http\JsonResponse
    {
        // get all developers id, firstname, lastname, created_at,
        // with their ratings summed, their stack, their devPrestations
        $allDevs = Developer::with('user', 'developerStacks', 'developerPrestations', 'reviews')
            ->get()
            ->filter(function ($developer) {
                return
                    $developer->developerStacks->count() > 0 &&
                    $developer->developerPrestations->count() > 0 &&
                    $developer->user->is_account_active === 1;
            });

        return response()->json(
        // On retourne les développeurs sous forme de ressources,
        // pour pouvoir retourner les données exactement comme on le souhaite dans l'API.
            AllDevsResource::collection($allDevs)
            , 200);
    }
}
