<?php

namespace App\Http\Controllers\Api\Developer;

use App\Http\Controllers\Controller;
use App\Http\Resources\AllDevelopersResource;
use App\Models\Developer;
use Illuminate\Http\JsonResponse;

class AllDevelopersController extends Controller
{
    /**
     * Get all developers
     *
     * @return JsonResponse
     */
    public function getAllDevs(): JsonResponse
    {
        // get all developers id, firstname, lastname, created_at,
        // with their ratings summed, their stack, their devPrestations
        $allDevelopers = Developer::with('user', 'developerStacks', 'complaints', 'reviews', 'developerPrestations')
            ->get();


        return response()->json(
            // On retourne les développeurs sous forme de ressources,
            // pour pouvoir retourner les données exactement comme on le souhaite dans l'API.
            AllDevelopersResource::collection($allDevelopers),
            200);
    }
}
