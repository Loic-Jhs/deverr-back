<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BackOffice\Stack\UpdateStackRequest;
use App\Http\Requests\BackOffice\StoreStackRequest;
use App\Models\Stack;
use Illuminate\Http\JsonResponse;

class StackController extends Controller
{
    /**
     * @param int|null $id
     * @return JsonResponse
     */
    public function stacks(int $id = null): JsonResponse
    {
        if (! $id) {
            $stacks = Stack::select('id', 'name')->paginate();
        } else {
            $stacks = Stack::select('id', 'name')->where('id', $id)->paginate();
        }

        return response()->json([
            'stacks' => $stacks,
        ], 200);
    }

    /**
     * @param StoreStackRequest $request
     * @return JsonResponse
     */
    public function storeStack(StoreStackRequest $request): JsonResponse
    {
        $stack = Stack::create([
            'name' => ucfirst($request->name),
        ]);

        return response()->json([
            'message' => sprintf('La stack %s a bien été créée', $stack->name),
        ], 201);
    }

    public function editStack(UpdateStackRequest $request): JsonResponse
    {
        $stack = Stack::where('id', $request->id)->first();

        if (! $stack) {
            abort(404, 'Stack introuvable');
        }

        $oldStackName = $stack->name;
        $stack->name = $request->name;

        $stack->update();

        return response()->json([
            'message' => sprintf('La stack %s a bien été modifiée en %s', $oldStackName, $stack->name),
        ], 200);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function deleteStack($id)
    {
        $stack = Stack::find($id);

        if (! $stack) {
            abort(404, 'Stack introuvable');
        }

        $stack->delete();

        return response()->json([
            'message' => 'Stack supprimée avec succès',
        ], 200);
    }
}
