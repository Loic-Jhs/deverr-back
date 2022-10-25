<?php

namespace App\Http\Controllers\Api\Developer;

use App\Http\Controllers\Controller;
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
        $developer = Developer::with('user')
            ->where('user_id', $id)
            ->select('*')
            ->get();

        $developerPrestations = DeveloperPrestation::with('prestation')
            ->where('developer_id', $id)
            ->select('id', 'client_id', 'description', 'prestation_id')
            ->get();

        $developerStacks = DeveloperStack::with('stack')
            ->where('developer_id', $id)
            ->select('id', 'stack_id', 'stack_experience', 'is_primary')
            ->get();

        if (!$developer) {
            return new JsonResponse([
                'error' => 'Invalid data',
            ], 404);
        }

        return new JsonResponse([
            'dev_info'   => $developer,
            'prestation' => $developerPrestations,
            'stack'      => $developerStacks,
        ], 200);
    }
}
