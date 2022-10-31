<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserProfile\UpdatePasswordRequest;
use App\Http\Requests\UserProfile\UserProfileRequest;
use App\Models\Developer;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * @param $id
     * @return JsonResponse
     */
    public function index($id): JsonResponse
    {
        $developer = Developer::with('user')->where('user_id', $id)->first();
        $user = User::find($id);

        if (! $user && ! $developer) {
            return response()->json([
                'message' => 'Utilisateur introuvable'
            ], 404);
        }

        return response()->json([
            'user' => $user,
            'developer' => $developer
        ]);
    }

    /**
     * @param UserProfileRequest $request
     * @return JsonResponse
     */
    public function update(UserProfileRequest $request): JsonResponse
    {
        // current user
        $user = auth()->user();
        // his old email in case he changes it
        $oldEmail = $user->email;

        $developer = Developer::where('user_id', $user->id)->first();;

        // update the user
        $user->update($request->all());

        // update the developer if he is one
        if ($developer) {
            $developer->update($request->only('description', 'years_of_experience', 'avatar'));
        }

        // if the developer changed his email, update email_verified_at to null
        if ($oldEmail !== $request->email && $request->email !== null) {
            $user->update([
                'email_verified_at' => null
            ]);
            $user->sendEmailVerificationNotification();
        }

        return response()->json([
            'message' => 'Votre profil a été mis à jour avec succè, un email de vérification vous a été envoyé.',
        ]);
    }

    /**
     * @param UpdatePasswordRequest $request
     * @return JsonResponse
     */
    public function updatePassword(UpdatePasswordRequest $request): JsonResponse
    {
        $user = auth()->user();

        $user->update([
            'password' => Hash::make(request('password'))
        ]);

        return response()->json([
            'message' => 'Mot de passe mis à jour avec succès',
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function delete(): JsonResponse
    {
        $user = auth()->user();

        $user->delete();

        return response()->json([
            'message' => 'Votre compte a été supprimé avec succès',
        ]);
    }
}
