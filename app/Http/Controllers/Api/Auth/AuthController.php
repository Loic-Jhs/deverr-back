<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRegister\LoginUserRequest;
use App\Http\Requests\LoginRegister\StoreNewUserRequest;
use App\Models\Developer;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * @param  StoreNewUserRequest  $request
     * @return JsonResponse
     */
    public function register(StoreNewUserRequest $request): JsonResponse
    {

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => "0",
        ]);

        if ($request->has('years_of_experience') && $request->has('description'))
        {
            Developer::create([
                'user_id' => $user->id,
                'years_of_experience' => $request->years_of_experience,
                'description' => $request->description,
            ]);
        }

        event(new Registered($user));

        return response()->json([
            'message' => 'Votre compte a bien été créé, merci de le vérifier grâce au lien envoyé dans votre boîte mail.',
        ], 201);
    }

    /**
     * @param  LoginUserRequest  $request
     * @return JsonResponse
     */
    public function login(LoginUserRequest $request): JsonResponse
    {
        if (! Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details',
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = explode('|', $user->createToken('auth_token')->plainTextToken);

        return response()->json([
            'access_token' => $token[1],
            'token_type' => 'Bearer',
            'user_info' => [
                'user_id' => $user->id,
                'developer_id' => $user->developer->id ?? null,
                'user_role' => $user->role,
            ],

        ], 200);
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'disconnected',
        ]);
    }
}
