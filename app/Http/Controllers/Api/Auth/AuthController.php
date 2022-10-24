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

                    // send email to user to verify his email address
                    event(new Registered($user));
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

                    event(new Registered($user));

                    // if the developer is not created, delete the user
                    if (! $developer->id) {
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

        // As a client
        if (auth()->user()->role_id == 1) {
            return response()->json([
                'access_token' => $token[1],
                'token_type' => 'Bearer',
                'role_id' => auth()->user()->role->name,
            ], 200);
        } // As a developer
        else if (auth()->user()->role_id == 2) {
            return response()->json([
                'access_token' => $token[1],
                'token_type' => 'Bearer',
                'role_id' => auth()->user()->role->name,
            ], 200);
        } else {
            return response()->json([
                'error' => "Une erreur s'est produite veuillez essayer ultérieurement.",
            ], 500);
        }
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
