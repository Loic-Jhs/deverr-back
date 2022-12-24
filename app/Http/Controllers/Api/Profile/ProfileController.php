<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\DevPrestation\StorePrestationRequest;
use App\Http\Requests\DevPrestation\UpdatePrestationRequest;
use App\Http\Requests\Profile\Developer\AddStackRequest;
use App\Http\Requests\Profile\Developer\EditStackExperienceRequest;
use App\Http\Requests\Profile\UpdatePasswordRequest;
use App\Http\Requests\Profile\UserProfileRequest;
use App\Http\Resources\Profile\DeveloperProfileResource;
use App\Http\Resources\Profile\UserProfileResource;
use App\Models\Developer;
use App\Models\DeveloperPrestation;
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
        $user = User::query()->find($id);

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

        $developer = Developer::query()->where('user_id', $user->id)->first();

        // update the user
        $user->update($request->only('firstname', 'lastname', 'email'));

        // update the developer if he is one
        if ($developer) {
            $developer->update($request->only('description', 'years_of_experience', 'avatar'));
        }

        // if the developer changed his email, update email_verified_at to null
        if ($oldEmail !== $request->input('email') && $request->input('email') !== null) {
            $user->update([
                'email_verified_at' => null,
            ]);
            $user->sendEmailVerificationNotification();

            return response()->json([
                'message' => 'Votre profil a été mis à jour avec succès, un email de vérification vous a été envoyé.',
            ]);
        }

        return response()->json([
            'message' => 'Votre profil a été mis à jour avec succès.',
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
            'password' => Hash::make($request->input('password')),
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

    /**
     * Add a new stack to the developer
     * @param  AddStackRequest  $request
     * @return JsonResponse
     */
    public function addStack(AddStackRequest $request): JsonResponse
    {
        // check if the developer already added this stack
        $alreadyExists = DeveloperStack::query()->where('developer_id', auth()->user()->developer->id)
            ->where('stack_id', $request->input('stack_id'))
            ->first();

        if ($alreadyExists) {
            return response()->json([
                'message' => 'Vous avez déjà ajouté cette compétence',
            ], 400);
        }
        // check if the developer adds a new stack as primary
        if ($request->input('is_primary')) {
            // set the old one to false
            DeveloperStack::query()->where('developer_id', auth()->user()->developer->id)
                ->where('is_primary', true)
                ->update([
                    'is_primary' => false,
                ]);
        }

        $dev_stack = DeveloperStack::query()->create([
            'developer_id' => auth()->user()->developer->id,
            'stack_id' => $request->input('stack_id'),
            'stack_experience' => $request->input('stack_experience'),
            'is_primary' => $request->input('is_primary'),
        ]);

        return response()->json([
            'message' => 'La Compétence '.$dev_stack->stack->name.' a bien été ajoutée',
        ]);
    }

    /**
     * @param EditStackExperienceRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function editStackExperience(EditStackExperienceRequest $request, $id): JsonResponse
    {
        $stack = DeveloperStack::query()
            ->where('stack_id', $id)
            ->where('developer_id', auth()->user()->developer->id)
            ->first();

        if (! $stack) {
            return response()->json([
                'message' => 'Compétence introuvable',
            ], 404);
        }

        $stack->update([
            'stack_experience' => $request->input('stack_experience'),
        ]);

        return response()->json([
            'message' => 'Compétence mise à jour avec succès',
        ]);
    }


    /**
     * Update the primary stack
     *
     * @param $id
     * @return JsonResponse
     */
    public function editPrimaryStack($id)
    {
        // Retrieve the developer and the new stack to set as is_primary
        $developer = auth()->user()->developer;
        $stack = DeveloperStack::query()->where('stack_id', $id)->where('developer_id', $developer->id)->first();

        if (! $stack) {
            return response()->json([
                'message' => "Compétence introuvable",
            ], 400);
        }

        // If the developer already has a primary stack, update it to false
        $oldPrimaryStack = $stack->where('is_primary', true)->first();
        if ($oldPrimaryStack) {
            $oldPrimaryStack::query()->update([
                'is_primary' => false,
            ]);
        }

        // update the stack to be primary
        DeveloperStack::query()->where('stack_id', $stack->stack_id)->update([
            'is_primary' => true,
        ]);

        return response()->json([
            'message' => 'Compétence principale mise à jour avec succès',
        ]);
    }

    public function deleteStack($id)
    {
        $stack = DeveloperStack::query()->where('stack_id', $id)->where('developer_id', auth()->user()->developer->id);

        if (! $stack) {
            return response()->json([
                'message' => 'Compétence introuvable',
            ], 404);
        }

        $stack->delete();

        return response()->json([
            'message' => 'Compétence supprimée avec succès',
        ]);
    }

    /**
     * @param  StorePrestationRequest  $request
     * @return JsonResponse
     */
    public function storePrestation(StorePrestationRequest $request): JsonResponse
    {
        DeveloperPrestation::query()->create([
            'developer_id' => auth()->user()->developer->id,
            'prestation_type_id' => $request->input('prestation_type_id'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
        ]);

        return response()->json([
            'message' => "Prestation enregistrée",
        ], 201);
    }

    /**
     * @param UpdatePrestationRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function editPrestation(UpdatePrestationRequest $request, $id): JsonResponse
    {
        if (auth()->user()->developer->id === DeveloperPrestation::query()->find($id)->developer_id) {
            DeveloperPrestation::query()->find($id)->update([
                'developer_id' => auth()->user()->developer->id,
                'prestation_type_id' => $request->input('prestation_type_id'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
            ]);

            return response()->json([
                'message' => "Prestation modifiée",
            ], 200);
        } else {
            return response()->json([
                'message' => "Vous n'avez pas le droit de modifier cette prestation",
            ], 403);
        }
    }
    /**
     * @param $id
     * @return JsonResponse
     */
    public function deletePrestation($id)
    {
        $devPrestation = DeveloperPrestation::query()->find($id);

        if (! $devPrestation) {
            return response()->json([
                'message' => "Cette prestation n'existe pas",
            ], 404);
        }

        if ($devPrestation->developer_id === auth()->user()->developer->id) {
            $devPrestation->delete();
            return response()->json([
                'message' => 'Prestation supprimée avec succès',
            ], 200);
        } else {
            return response()->json([
                'message' => "Vous n'avez pas le droit de supprimer cette prestation",
            ], 403);
        }
    }

}
