<?php

namespace App\Http\Controllers\Api\Developer;

use App\Http\Controllers\Controller;
use App\Http\Requests\BackOffice\Stack\StoreStackRequest;
use App\Http\Requests\BackOffice\Stack\UpdateStackRequest;
use App\Http\Resources\AllStacksResource;
use App\Models\Stack;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class StackController extends Controller
{
    /**
     * @param  StoreStackRequest  $request
     * @return JsonResponse
     */
    public function storeStack(StoreStackRequest $request): JsonResponse
    {
        $developer = User::all('role')->where('role', '=', '1');
        if ($developer) {
            $stack = Stack::create([
                'name' => ucfirst($request->name),
            ]);

            return response()->json([
                'message' => sprintf('La stack %s a bien été créée', $stack->name),
            ], 201);
        }

        return response()->json([
            'message' => "Cette action n'est pas autorisée"
        ]);
    }

    /**
     * @param  UpdateStackRequest  $request
     * @return JsonResponse
     */
    public function editStack(UpdateStackRequest $request): JsonResponse
    {
        $developer = User::all('role')->where('role', '=', '1');
        if ($developer) {
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

        return response()->json([
            'message' => "Cette action n'est pas autorisée"
        ]);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function deleteStack($id)
    {
        $developer = User::all('role')->where('role', '=', '1');
        if ($developer) {
            $stack = Stack::find($id);

            if (! $stack) {
                abort(404, 'Stack introuvable');
            }

            $stack->delete();

            return response()->json([
                'message' => 'Stack supprimée avec succès',
            ], 200);
        }

        return response()->json([
            'message' => "Cette action n'est pas autorisée"
        ]);
    }

    public function allStack()
    {
        $stacks = Stack::get()->sortBy('name');

        return response()->json(
            AllStacksResource::collection($stacks)
        ,200);
    }
}
