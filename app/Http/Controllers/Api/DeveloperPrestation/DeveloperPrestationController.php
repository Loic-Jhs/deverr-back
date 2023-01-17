
<?php

namespace App\Http\Controllers\Api\DeveloperPrestation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backoffice\DevPrestation\StoreRequestDevPrestation;
use App\Http\Requests\Backoffice\DevPrestation\UpdateRequestDevPrestation;
use App\Models\DeveloperPrestation;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class DeveloperPrestationController extends Controller
{
    public function storeDevPrestation(StoreRequestDevPrestation $request): JsonResponse
    {
        $developer = User::where('role', '=', '1')->get('role');

        if ($developer) {
            $devPrestation = DeveloperPrestation::create([
                'developer_id' => $request->developer_id,
                'prestation_type_id' => $request->prestation_type_id,
                'description' => $request->description,
                'price' => $request->price,
            ]);

            return response()->json([
                'message' => sprintf('La prestation du développeur ayant l\'id %s a bien été créée', $devPrestation->id),
            ], 201);
        }

        return response()->json([
            'message' => "Cette action n'est pas autorisée",
        ], 403);
    }

    public function editDevPrestation(UpdateRequestDevPrestation $request): JsonResponse
    {
        $developer = User::where('role', '=', '1')->get('role');

        if ($developer) {
            $devPrestation = DeveloperPrestation::where('id', $request->id)->first();

            if (! $devPrestation) {
                abort(404, 'La prestation du développeur est introuvable');
            }

            $devPrestation->update($request->validated());

            return response()->json([
                'message' => sprintf('La prestation du développeur ayant l\'id %s a bien été modifiée', $devPrestation->id),
            ], 200);
        } else {
            return response()->json([
                'message' => "Cette action n'est pas autorisée",
            ], 403);
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function deleteDevPrestation($id)
    {
        $developer = User::where('role', '=', '1')->get('role');

        if ($developer) {
            $devPrestation = DeveloperPrestation::find($id);

            if (! $devPrestation) {
                abort(404, 'Prestation du développeur introuvable');
            }

            $devPrestation->delete();

            return response()->json([
                'message' => 'Prestation du développeur supprimée avec succès',
            ], 200);
        } else {
            return response()->json([
                'message' => "Cette action n'est pas autorisée",
            ], 403);
        }
    }
}
