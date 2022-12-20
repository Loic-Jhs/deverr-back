<?php

namespace App\Http\Controllers\Api\DeveloperPrestation;

use App\Http\Controllers\Controller;
use App\Http\Requests\DevPrestation\UpdateRequestDevPrestation;
use App\Http\Requests\DevPrestation\StoreRequestDevPrestation;
use App\Models\DeveloperPrestation;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class DeveloperPrestationController extends Controller
{
    public function storeDevPrestation(StoreRequestDevPrestation $request): JsonResponse
    {
        DeveloperPrestation::query()->create([
            'developer_id' => auth()->user()->developer->id,
            'prestation_type_id' => $request->prestation_type_id,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return response()->json([
            'message' => "Prestation enregistrée",
        ], 201);
    }

    public function editDevPrestation(UpdateRequestDevPrestation $request): JsonResponse
    {
        $devPrestation = DeveloperPrestation::where('id', $request->id)->first();

        if (! $devPrestation) {
            abort(404, 'La prestation du développeur est introuvable');
        }

        $devPrestation->update($request->only('prestation_type_id', 'description', 'price'));

        return response()->json([
            'message' => "Prestation modifiée",
        ], 200);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function deleteDevPrestation($id)
    {
        $devPrestation = DeveloperPrestation::find($id)->where('developer_id', auth()->user()->developer->id)->first();

        if (! $devPrestation) {
            abort(404, 'Prestation introuvable');
        }

        $devPrestation->delete();

        return response()->json([
            'message' => 'Prestation supprimée avec succès',
        ], 200);
    }
}
