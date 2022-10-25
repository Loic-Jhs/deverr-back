<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backoffice\Prestation\StoreRequestPrestation;
use App\Http\Requests\Backoffice\Prestation\UpdateRequestPrestation;
use App\Models\PrestationType;
use Illuminate\Http\JsonResponse;

class PrestationController extends Controller
{
    /**
     * @param  int|null  $id
     * @return JsonResponse
     */
    public function prestations(int $id = null): JsonResponse
    {
        if (! $id) {
            $prestations = PrestationType::select('id', 'name')->paginate();
        } else {
            $prestations = PrestationType::select('id', 'name')->where('id', $id)->paginate();
        }

        return response()->json([
            'prestations' => $prestations,
        ], 200);
    }

    public function storePrestation(StoreRequestPrestation $request): JsonResponse
    {
        $prestation = PrestationType::create([
            'name' => ucfirst($request->name),
        ]);

        return response()->json([
            'message' => sprintf('La prestation %s a bien été créée', $prestation->name),
        ], 201);
    }

    public function editPrestation(UpdateRequestPrestation $request): JsonResponse
    {
        $prestation = PrestationType::where('id', $request->id)->first();

        if (! $prestation) {
            abort(404, 'Prestation introuvable');
        }

        $oldPrestationName = $prestation->name;
        $prestation->name = $request->name;

        $prestation->update();

        return response()->json([
            'message' => sprintf('La prestation %s a bien été modifiée en %s', $oldPrestationName, $prestation->name),
        ], 200);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function deletePrestation($id)
    {
        $prestation = PrestationType::find($id);

        if (! $prestation) {
            abort(404, 'Prestation introuvable');
        }

        $prestation->delete();

        return response()->json([
            'message' => 'Prestation supprimée avec succès',
        ], 200);
    }
}
