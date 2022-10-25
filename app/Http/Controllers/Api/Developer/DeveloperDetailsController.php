<?php

namespace App\Http\Controllers\Api\Developer;

use App\Http\Controllers\Controller;
use App\Models\Developer;
use App\Models\DeveloperPrestation;
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

        $developerPrestation = DeveloperPrestation::with('prestation')
            ->where('developer_id', $id)
            ->select('id', 'client_id', 'description', 'prestation_id')
            ->get();

        if (!$developer) {
            return new JsonResponse([
                'error' => 'Invalid data',
            ], 404);
        }

        return new JsonResponse([
            'dev_info'   => $developer,
            'prestation' => $developerPrestation,
        ], 200);
    }
}
