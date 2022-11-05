<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserProfile\UpdatePasswordRequest;
use App\Http\Requests\UserProfile\UserProfileRequest;
use App\Models\Developer;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * @param $id
     * @return JsonResponse
     */
    public function index($id = null): JsonResponse
    {
        if ($id == null) {
            $id = auth()->user()->id;
        }

        $user = User::where('id', $id)->first();
        if (! $user) {
            return response()->json([
                'message' => 'Utilisateur introuvable',
            ], 404);
        }
        if ($user->role == '1') {
            return response()->json(
                [
                    'id' => $user->id,
                    'firstname' => $user->firstname,
                    'lastname' => $user->lastname,
                    'email' => $user->email,
                    'registered_at' => date_format($user->created_at, 'd/m/Y'),
                    'avatar' => $user->developer->avatar,
                    'description' => $user->developer->description,
                    'years_of_experience' => $user->developer->years_of_experience,
                    'stacks' => $user->developer->stacks ? $user->developer->stacks
                        ->map(function ($stack) {
                            return [
                                'id' => $stack->id,
                                'name' => $stack->name,
                                'logo' => $stack->logo,
                            ];
                        }) : null,
                ]
            );
        } else {
            return response()->json(
                [
                    'id' => $user->id,
                    'firstname' => $user->firstname,
                    'lastname' => $user->lastname,
                    'email' => $user->email,
                    'registered_at' => date_format($user->created_at, 'd/m/Y'),
                    'orders' => $user->orders ? $user->orders->map(function ($order) {
                        return [
                            'created_at' => date_format($order->created_at, 'd/m/Y'),
                            'updated_at' => date_format($order->updated_at, 'd/m/Y'),
                            'developer' => $order->developer->user->lastname.' '.$order->developer->user->firstname,
                            'is_finished' => $order->is_finished,
                            'is_payed' => $order->is_payed,
                            'is_accepted_by_developer' => $order->is_accepted_by_developer,
                            'prestation_name' => $order->developerPrestation->prestationType->name,
                            'price' => $order->developerPrestation->price,
                            'instructions' => $order->instructions,
                        ];
                    }) : null,
                ]
            );
        }
    }

    /**
     * @param  UserProfileRequest  $request
     * @return JsonResponse
     */
    public function update(UserProfileRequest $request): JsonResponse
    {
        // current user
        $user = auth()->user();
        // his old email in case he changes it
        $oldEmail = $user->email;

        $developer = Developer::where('user_id', $user->id)->first();

        // update the user
        $user->update($request->all());

        // update the developer if he is one
        if ($developer) {
            $developer->update($request->only('description', 'years_of_experience', 'avatar'));
        }

        // if the developer changed his email, update email_verified_at to null
        if ($oldEmail !== $request->email && $request->email !== null) {
            $user->update([
                'email_verified_at' => null,
            ]);
            $user->sendEmailVerificationNotification();
        }

        return response()->json([
            'message' => 'Votre profil a été mis à jour avec succè, un email de vérification vous a été envoyé.',
        ]);
    }

    /**
     * @param  UpdatePasswordRequest  $request
     * @return JsonResponse
     */
    public function updatePassword(UpdatePasswordRequest $request): JsonResponse
    {
        $user = auth()->user();

        $user->update([
            'password' => Hash::make(request('password')),
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
