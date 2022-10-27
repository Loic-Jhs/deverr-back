<?php

namespace App\Http\Controllers\Api\Developer;

use App\Http\Controllers\Controller;
use App\Http\Resources\DeveloperDetailsResource;
use App\Models\Developer;
use App\Models\DeveloperPrestation;
use App\Models\DeveloperStack;
use Illuminate\Http\JsonResponse;

class DeveloperDetailsController extends Controller
{
    /**
     * @param $id
     * @return JsonResponse
     */
    public function developerDetails($id): JsonResponse
    {

        // get a developer's details, with his stacks, prestations, reviews
        $developer = Developer::with('user', 'stacks', 'developerPrestations', 'reviews')
            ->where('id', $id)
            ->get();

        if (! $developer) {
            return new JsonResponse([
                'error' => "Ce développeur n'existe pas",
            ], 404);
        }

        return new JsonResponse(
            DeveloperDetailsResource::collection($developer)
        , 200);
    }
}
