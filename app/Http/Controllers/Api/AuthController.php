<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRegister\LoginUserRequest;
use App\Http\Requests\LoginRegister\StoreNewUserRequest;
use App\Models\Developer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(StoreNewUserRequest $request): \Illuminate\Http\JsonResponse
    {
        if ($request->input('type') == 'client') {
            if ($request->input('experience') == '' || $request->input('description') == '') {
                $user = User::create([
                    'firstname' => $request->input('firstname'),
                    'lastname' => $request->input('lastname'),
                    'email' => $request->input('email'),
                    'password' => Hash::make($request->input('password')),
                    'role_id' => 1,
                ]);
            } else {
                return response()->json([
                    'error' => 'Invalid data.',
                ], 400);
            }
        } elseif ($request->input('type') == 'developer') {
            if ($request->input('experience') != '' || $request->input('description') != '') {
                $user = User::create([
                    'firstname' => $request->input('firstname'),
                    'lastname' => $request->input('lastname'),
                    'email' => $request->input('email'),
                    'password' => Hash::make($request->input('password')),
                    'role_id' => 2,
                ]);

                $developer = Developer::create([
                    'user_id' => $user->id,
                    'description' => $request->input('description'),
                    'experience' => $request->input('experience'),
                ]);

                if (! $developer->id) {
                    User::destroy($user->id);

                    return response()->json([
                        'error' => 'Invalid data.',
                    ], 400);
                }
            } else {
                return response()->json([
                    'error' => 'Invalid data.',
                ], 400);
            }
        } else {
            return response()->json([
                'error' => 'Invalid data.',
            ], 400);
        }

        $token = explode('|', $user->createToken('auth_token')->plainTextToken);

        return response()->json([
            'access_token' => $token[1],
            'token_type' => 'Bearer',
        ], 201);
    }

    public function login(LoginUserRequest $request): \Illuminate\Http\JsonResponse
    {
        if (! Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details',
            ], 401)->header('Accept', 'application/json');
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = explode('|', $user->createToken('auth_token')->plainTextToken);

        return response()->json([
            'user' => $user,
            'dev' => $user->developer,
            'access_token' => $token[1],
            'token_type' => 'Bearer',
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'disconnected',
        ]);
    }
}
