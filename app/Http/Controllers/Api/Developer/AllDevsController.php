<?php

namespace App\Http\Controllers\Api\Developer;

use App\Http\Controllers\Controller;
use App\Http\Resources\AllDevsResource;
use App\Models\Developer;

class AllDevsController extends Controller
{
    public function getAllDevs()
    {
        // get all developers id, firstname, lastname, created_at,
        // with their ratings summed, their stack, their devPrestations
        $allDevs = Developer::with('user', 'developerStacks', 'developerPrestations', 'reviews')
            ->get()
            ->filter(function ($developer) {
                return $developer->developerStacks->count() > 0 &&
                    $developer->developerPrestations->count() > 0;
            })
            ->shuffle();


        return response()->json(
        // On retourne les développeurs sous forme de ressources,
        // pour pouvoir retourner les données exactement comme on le souhaite dans l'API.
            AllDevsResource::collection($allDevs)
            , 200);
    }
}
