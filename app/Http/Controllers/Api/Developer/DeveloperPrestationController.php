<?php

namespace App\Http\Controllers\Api\Developer;

use App\Http\Controllers\Controller;
use App\Http\Requests\DevPrestation\StoreRequestDevPrestation;
use App\Http\Requests\DevPrestation\UpdateRequestDevPrestation;
use App\Models\DeveloperPrestation;
use Illuminate\Http\JsonResponse;

class DeveloperPrestationController extends Controller
{
    /**
     * @param  StoreRequestDevPrestation  $request
     * @return JsonResponse
     */
    public function storeDeveloperPrestation(StoreRequestDevPrestation $request): JsonResponse
    {
        DeveloperPrestation::query()->create([
            'developer_id' => auth()->user()->developer->id,
            'prestation_type_id' => $request->input('prestation_type_id'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
        ]);

        return response()->json([
            'message' => "Prestation enregistrée",
        ], 201);
    }

    /**
     * @param UpdateRequestDevPrestation $request
     * @param $id
     * @return JsonResponse
     */
    public function editDeveloperPrestation(UpdateRequestDevPrestation $request, $id): JsonResponse
    {
        if (auth()->user()->developer->id === DeveloperPrestation::find($id)->developer_id) {
            DeveloperPrestation::find($id)->update([
                'developer_id' => auth()->user()->developer->id,
                'prestation_type_id' => $request->input('prestation_type_id'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
            ]);

            return response()->json([
                'message' => "Prestation modifiée",
            ], 200);
        } else {
            return response()->json([
                'message' => "Vous n'avez pas le droit de modifier cette prestation",
            ], 403);
        }
    }
    /**
     * @param $id
     * @return JsonResponse
     */
    public function deleteDeveloperPrestation($id)
    {
        // delete the developer prestation
        $devPrestation = DeveloperPrestation::findOrFail($id);

        if ($devPrestation->developer_id === auth()->user()->developer->id) {
            $devPrestation->delete();
            return response()->json([
                'message' => 'Prestation supprimée avec succès',
            ], 200);
        } else {
            return response()->json([
                'message' => "Vous n'avez pas le droit de supprimer cette prestation",
            ], 403);
        }
    }
}
