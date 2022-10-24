<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backoffice\DevPrestation\StoreRequestOrder;
use App\Http\Requests\Backoffice\Prestation\UpdateRequestOrder;
use App\Models\DeveloperPrestation;
use Illuminate\Http\JsonResponse;

class DeveloperPrestationController extends Controller
{
    /**
     * @param int|null $id
     * @return JsonResponse
     */
    public function developerPrestations(int $id = null): JsonResponse
    {
        if (!$id) {
            $devPrestations = DeveloperPrestation::select('id', 'developer_id', 'prestation_id', 'price')->paginate();
        } else {
            $devPrestations = DeveloperPrestation::select('id', 'developer_id', 'prestation_id', 'price')->where('id', $id)->paginate();
        }

        return response()->json([
            'devPrestations' => $devPrestations,
        ], 200);
    }

    public function storeDevPrestation(StoreRequestOrder $request): JsonResponse
    {
        $devPrestation = DeveloperPrestation::create([
            'developer_id'  => $request->developer_id,
            'description'   => $request->description,
            'prestation_id' => $request->prestation_id,
            'price'         => $request->price,
        ]);

        return response()->json([
            'message' => sprintf('La prestation du développeur ayant l\'%s a bien été créée', $devPrestation->id),
        ], 201);
    }

    public function editDevPrestation(UpdateRequestOrder $request): JsonResponse
    {
        $devPrestation = DeveloperPrestation::where('id', $request->id)->first();

        if (!$devPrestation) {
            abort(404, 'La prestation du développeur est introuvable');
        }

        $devPrestation->developer_id = $request->developer_id;
        $devPrestation->description = $request->description;
        $devPrestation->prestation_id = $request->prestation_id;
        $devPrestation->price = $request->price;

        $devPrestation->update();

        return response()->json([
            'message' => sprintf('La prestation du développeur ayant l\'%s a bien été modifiée', $devPrestation->id),
        ], 200);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function deleteDevPrestation($id)
    {
        $devPrestation = DeveloperPrestation::find($id);

        if (!$devPrestation) {
            abort(404, 'Prestation du développeur introuvable');
        }

        $devPrestation->delete();

        return response()->json([
            'message' => 'Prestation du développeur supprimée avec succès',
        ], 200);
    }
}
