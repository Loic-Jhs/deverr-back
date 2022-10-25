<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserProfile\UserProfileRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * @param UserProfileRequest $request
     * @return JsonResponse|void
     */
    public function index(UserProfileRequest $request)
    {
        $user = User::find($request->id);

        if ($user->role_id === 1) { // client
            return response()->json([
                'user' => $user,
            ]);
        } else if ($user->role_id === 2) { // developer
            return response()->json([
                'developer' => $user->load('developer'),
            ]);
        }
    }
}
