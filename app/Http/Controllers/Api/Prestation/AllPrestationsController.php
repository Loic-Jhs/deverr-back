<?php

namespace App\Http\Controllers\Api\Prestation;

use App\Http\Controllers\Controller;
use App\Http\Resources\AllPrestationsResource;
use App\Models\PrestationType;

class AllPrestationsController extends Controller
{
    public function index()
    {
        $prestations = PrestationType::all();

        return response()->json(AllPrestationsResource::collection($prestations), 200);
    }
}
