<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRegister\ForgotPasswordRequest;
use App\Http\Requests\LoginRegister\LoginUserRequest;
use App\Http\Requests\LoginRegister\ResetPasswordRequest;
use App\Http\Requests\LoginRegister\StoreNewUserRequest;
use App\Models\Developer;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * @param  StoreNewUserRequest  $request
     * @return JsonResponse
     */
    public function register(StoreNewUserRequest $request): JsonResponse
    {
        if ($request->has('years_of_experience') && $request->has('description')) {
            $user = User::create([
                'firstname' => $request->input('firstname'),
                'lastname' => $request->input('lastname'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'role' => '1',
            ]);

            Developer::create([
                'user_id' => $user->id,
                'years_of_experience' => $request->input('years_of_experience'),
                'description' => $request->input('description'),
            ]);
        } else {
            $user = User::create([
                'firstname' => $request->input('firstname'),
                'lastname' => $request->input('lastname'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'role' => '0',
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

        $user = User::where('email', $request->input('email'))->firstOrFail();

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

    /**
     * @param  ForgotPasswordRequest  $request
     * @return JsonResponse
     */
    public function forgotPassword(ForgotPasswordRequest $request): JsonResponse
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? response()->json('Un email de réinitialisation de mot de passe à été envoyé.', 200)
            : response()->json("Veuillez réessayer dans quelques instants s'il vous plaît.", 404);
    }

    /**
     * @param  ResetPasswordRequest  $request
     * @return JsonResponse
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));
                $user->save();
                $user->tokens()->delete();
                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return response()->json('Votre mot de passe a bien été réinitialisé.', 200);
        } else {
            return response()->json('Une erreur est survenue, veuillez réessayer.', 404);
        }
    }
}
