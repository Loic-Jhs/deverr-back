<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prestation;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Backoffice\Prestation\StoreRequestPrestation;
use Illuminate\Http\Request;

class PrestationController extends Controller
{
    /**
     * @param int|null $id
     * @return JsonResponse
     */
    public function prestations(int $id = null): JsonResponse
    {
        if (! $id) {
            $prestations = Prestation::select('id', 'name')->paginate();
        } else {
            $prestations = Prestation::select('id', 'name')->where('id', $id)->paginate();
        }

        return response()->json([
            'prestations' => $prestations,
        ], 200);
    }

    public function storePrestation(StoreRequestPrestation $request): JsonResponse
    {
        $prestation = Prestation::create([
            'name' => ucfirst($request->name),
        ]);

        return response()->json([
            'message' => sprintf('La prestation %s a bien été créée', $prestation->name),
        ], 201);
    }
}
