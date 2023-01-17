<?php

namespace App\Http\Controllers\Api\Developer;

use App\Http\Controllers\Controller;
use App\Http\Resources\AllStacksResource;
use App\Models\Stack;
use Illuminate\Http\JsonResponse;

class StackController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $stacks = Stack::all()->sortBy('name');

        return response()->json(AllStacksResource::collection($stacks), 200);
    }
}
