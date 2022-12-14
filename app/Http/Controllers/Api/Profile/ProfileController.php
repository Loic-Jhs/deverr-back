<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserProfile\AddStackRequest;
use App\Http\Requests\UserProfile\UpdatePasswordRequest;
use App\Http\Requests\UserProfile\UserProfileRequest;
use App\Http\Resources\Profile\DeveloperProfileResource;
use App\Http\Resources\Profile\UserProfileResource;
use App\Models\Developer;
use App\Models\DeveloperStack;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * @param $id
     * @return JsonResponse
     */
    public function index($id = null): JsonResponse
    {
        $user = User::find($id);
        if (! $user) {
            return response()->json([
                'message' => 'Utilisateur introuvable',
            ], 404);
        }

        if ($id == null) {
            $id = auth()->user()->id;
        }

        if ($user->role == '1') {
            return response()->json(DeveloperProfileResource::make($user), 200);
        } else {
            return response()->json(UserProfileResource::make($user), 200);
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
            'message' => 'Votre profil a été mis à jour avec succès, un email de vérification vous a été envoyé.',
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

    /*
     * @param  AddStackRequest  $request
     * @return JsonResponse
     */
    public function addStack(AddStackRequest $request): JsonResponse
    {
        // check if the developer already added this stack
        $alreadyExists = DeveloperStack::where('developer_id', auth()->user()->developer->id)
            ->where('stack_id', $request->stack_id)
            ->first();

        if ($alreadyExists) {
            return response()->json([
                'message' => 'Vous avez déjà ajouté cette compétence',
            ], 400);
        }

        $dev_stack = DeveloperStack::create([
            'developer_id' => auth()->user()->developer->id,
            'stack_id' => $request->stack_id,
            'stack_experience' => $request->stack_experience,
            'is_primary' => $request->is_primary,
        ]);

        return response()->json([
            'message' => 'La Compétence '.$dev_stack->stack->name.' a bien été ajoutée',
        ]);
//        // if the developer wants to update the is_primary stack of this stack
//        if ($request->is_primary) {
//            // check if the developer has already a primary stack
//            $alreadyPrimary = DeveloperStack::where('developer_id', auth()->user()->developer->id)
//                ->where('is_primary', true)
//                ->first();
//
//            // if he has, update it to false
//            if ($alreadyPrimary) {
//                $alreadyPrimary->update([
//                    'is_primary' => false,
//                ]);
//            }
//
//            // edit the stack to set it as primary
//            ->update([
//                'is_primary' => true,
//            ]);
//        }
    }

    // Update the is_primary stack for a developer
    public function updatePrimaryStack(Request $request)
    {
        // Retrieve the developer and the new stack to set as is_primary
        $developer = auth()->user()->developer;
        $stack = DeveloperStack::where('stack_id', $request->input('stack_id'))->where('developer_id', $developer->id)->first();

        if (! $stack) {
            return response()->json([
                'message' => "Vous n'avez pas cette compétence",
            ], 400);
        }

        // If the developer already has a primary stack, update it to false
        $oldPrimaryStack = $stack->where('is_primary', true)->first();
        if ($oldPrimaryStack) {
            $oldPrimaryStack::query()->update([
                'is_primary' => false,
            ]);

            $oldPrimaryStack->save();
        }

        // Set the new stack as is_primary for the developer
        $stack->is_primary = true;
        $stack->save();

        return response()->json([
            'message' => 'Successfully updated is_primary stack for developer.'
        ]);
    }


}
