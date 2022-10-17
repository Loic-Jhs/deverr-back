<?php

namespace App\Http\Controllers\Api\Developer;

use App\Http\Controllers\Controller;
use App\Models\Developer;
use App\Models\User;

class AllDevsController extends Controller
{
    public function getAllDevs()
    {
        // get all developers id, firstname, lastname, created_at,
        // with their ratings summed, their stack, their devPrestations
        $allDevs = Developer::with('user', 'developerStacks', 'developerPrestations', 'reviews')
            ->get()
            ->filter(function ($developer) {
                return $developer->developerStacks->count() > 0 && $developer->developerStacks->where('is_primary', 1)
                    && $developer->developerPrestations->count() > 0;
                    ;
            });
//        dd($allDevs);

//        $developers = User::select('id', 'firstname', 'lastname', 'created_at')
//            ->where([
//            'role_id' => 2,
//            'is_account_active' => 1
//            ])
//            ->with('developer', 'developerPrestations')
//            ->get();

//        $developers = Developer::select('id', 'avatar', 'description', 'created_at')
//            ->with('user', function ($query) {
//                return $query->select('id', 'firstname', 'lastname');
//            })
//
//            ->get();

        return response()->json($allDevs, 200);
    }
}
