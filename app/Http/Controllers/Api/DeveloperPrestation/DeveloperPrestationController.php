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

    public function editDevPrestation(UpdateRequestDevPrestation $request, $id): JsonResponse
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
    public function deleteDevPrestation($id)
    {
    //    $devPrestation = DeveloperPrestation::find($id)->where('developer_id', auth()->user()->developer->id)->first();
    //
    //    if (! $devPrestation) {
    //        abort(404, 'Prestation introuvable');
    //    }
    //
    //    $devPrestation->delete();
    //
    //    return response()->json([
    //        'message' => 'Prestation supprimée avec succès',
    //    ], 200);

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
