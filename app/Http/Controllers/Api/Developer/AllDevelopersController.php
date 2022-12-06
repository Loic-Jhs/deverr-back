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
    public function getAllDevelopers(): JsonResponse
    {
        // Récupérer tous les développeurs avec leurs plaintes, leurs technos, leurs prestations, leurs notes
        $allDevelopers = Developer::with( 'complaints', 'reviews')
            ->withWhereHas('stacks')
            ->withWhereHas('developerPrestations')
            ->withWhereHas('user', function ($query) {
                return $query->where('email_verified_at', '!=', null);
            })
            ->get();

        return response()->json(
            // On retourne les développeurs sous forme de ressources,
            // pour pouvoir retourner les données exactement comme on le souhaite dans l'API.
            AllDevelopersResource::collection($allDevelopers),
            200);
    }
}
