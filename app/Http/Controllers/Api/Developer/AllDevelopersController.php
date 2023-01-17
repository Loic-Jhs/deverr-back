<?php

namespace App\Http\Controllers\Api\Developer;

use App\Http\Controllers\Controller;
use App\Http\Resources\AllDevelopersResource;
use App\Http\Resources\AllDevelopersResourceCollection;
use App\Models\Developer;
use Illuminate\Http\JsonResponse;

class AllDevelopersController extends Controller
{
    /**
     * Get all developers
     *
     * @return AllDevelopersResourceCollection
     */
    public function getAllDevelopers(): AllDevelopersResourceCollection
    {
        if(isset(auth()->user()->developer)) {
            // Récupérer tous les développeurs avec leurs plaintes, leurs technos, leurs prestations, leurs notes
            $allDevelopers = Developer::query()->with('complaints', 'reviews')
                ->withWhereHas('stacks')
                ->withWhereHas('developerPrestations')
                ->withWhereHas('user', function ($query) {
                    return $query->where('email_verified_at', '!=', null)
                                 ->where('developers.id', '!=', auth()->user()->developer->id);
                })
                ->paginate(10);
        } else {
            // Récupérer tous les développeurs avec leurs plaintes, leurs technos, leurs prestations, leurs notes
            $allDevelopers = Developer::query()->with('complaints', 'reviews')
                ->withWhereHas('stacks')
                ->withWhereHas('developerPrestations')
                ->withWhereHas('user', function ($query) {
                    return $query->where('email_verified_at', '!=', null);
                })
                ->paginate(10);
        }


        // On retourne les développeurs sous forme de ressources,
        // pour pouvoir retourner les données exactement comme on le souhaite dans l'API.
        // (cette ressource est une collection pour pouvoir paginer les données, les autres ressources sont différentes)
        return new AllDevelopersResourceCollection($allDevelopers);
    }
}
