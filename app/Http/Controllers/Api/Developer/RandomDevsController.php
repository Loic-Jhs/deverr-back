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

        $randomDevelopers = Developer::with('reviews', 'user')
            ->withWhereHas('primaryStack')
            ->where(function ($query) {
                $query->whereHas('reviews', function ($query) {
                    $query->where('rating', '>=', 3);
                })
                ->orWhereDoesntHave('reviews')
                ->whereDoesntHave('complaints');
            })
            ->take(6)
            ->inRandomOrder()
            ->get();

        // On retourne les développeurs sous forme de ressources,
        // pour pouvoir retourner les données exactement comme on le souhaite dans l'API.
        return response()->json(RandomDevelopersResource::collection($randomDevelopers), 200);
    }
}
