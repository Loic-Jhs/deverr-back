<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRegister\LoginUserRequest;
use App\Http\Requests\LoginRegister\StoreNewUserRequest;
use App\Models\Developer;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * @param StoreNewUserRequest $request
     * @return JsonResponse
     */
    public function register(StoreNewUserRequest $request): \Illuminate\Http\JsonResponse
    {
        switch ($request->type) {
            case 'client':
                if ($request->experience == null && $request->description == null) {
                    $user = User::create([
                        'firstname' => $request->firstname,
                        'lastname' => $request->lastname,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                        'role_id' => 1,
                    ]);
                } else {
                    return response()->json([
                        'error' => "L'expérience et la description ne doivent pas être renseignés.",
                    ], 400);
                }
                break;
            case 'developer':
                if ($request->experience != '' && $request->description != '') {
                    $user = User::create([
                        'firstname' => $request->firstname,
                        'lastname' => $request->lastname,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                        'role_id' => 2,
                    ]);

                    $developer = Developer::create([
                        'user_id' => $user->id,
                        'description' => $request->description,
                        'experience' => $request->experience,
                    ]);

                    // if the developer is not created, delete the user
                    if (!$developer->id) {
                        User::destroy($user->id);

                        return response()->json([
                            'error' => "Une erreur s'est produite veuillez essayer ultérieurement.",
                        ], 500);
                    }
                }
                break;
            default:
                return response()->json([
                    'error' => "Le type d'utilisateur est incorrect.",
                ], 400);
        }

        $token = explode('|', $user->createToken('auth_token')->plainTextToken);

        return response()->json([
            'access_token' => $token[1],
            'token_type' => 'Bearer',
        ], 201);
    }

    /**
     * @param LoginUserRequest $request
     * @return JsonResponse
     */
    public function login(LoginUserRequest $request): \Illuminate\Http\JsonResponse
    {
        if (! Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details',
            ], 401);
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

    /**
     * @param Request $request
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
