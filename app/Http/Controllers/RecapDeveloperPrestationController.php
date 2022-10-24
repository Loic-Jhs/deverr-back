<?php

namespace App\Http\Controllers;

use App\Models\DeveloperPrestation;

class RecapDeveloperPrestationController extends Controller
{

    public function recapDeveloperPrestation($id)
    {
        $developerPrestation = DeveloperPrestation::where('id', $id)->first();

        return view('recap', [
            'developerPrestation' => $developerPrestation,
        ]);
    }
}
