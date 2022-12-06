<?php

namespace App\Http\Controllers\Api\Developer;

use App\Http\Controllers\Controller;
use App\Http\Resources\RandomDevelopersResource;
use App\Models\Developer;
use Illuminate\Http\JsonResponse;

class RandomDevsController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function getSixRandomDevelopers(): JsonResponse
    {
        // 6 développeurs random,
        // qui ont des reviews >= 3 OU qui n'ont pas de reviews mais pas de plaintes,
        // qui ont forcément au moins une techno de renseignée.
        $randomDevelopers = Developer::with('user', 'developerStacks', 'complaints', 'stacks')
            ->whereHas('stacks')
            ->withWhereHas('reviews', function($query) {
                return $query->where('rating', '>=', 3);
            })
            ->orWhereDoesntHave('complaints')
            ->inRandomOrder()
            ->take(6)
            ->get();

        // On retourne les développeurs sous forme de ressources,
        // pour pouvoir retourner les données exactement comme on le souhaite dans l'API.
        return response()->json(RandomDevelopersResource::collection($randomDevelopers), 200);
    }
}
