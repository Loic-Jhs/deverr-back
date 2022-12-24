<?php

namespace App\Http\Controllers\Api\Developer;

use App\Http\Controllers\Controller;
use App\Http\Resources\DeveloperDetailsResource;
use App\Models\Developer;
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
        $developer = Developer::with('user', 'stacks', 'developerPrestations', 'reviews', 'orders')
            ->where('id', $id)
            ->get();

        if (! $developer) {
            return new JsonResponse([
                'error' => "Ce développeur n'existe pas",
            ], 404);
        }

        return new JsonResponse(DeveloperDetailsResource::collection($developer), 200);
    }
}
