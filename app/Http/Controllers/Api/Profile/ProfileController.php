<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\DevPrestation\StoreRequestDevPrestation;
use App\Http\Requests\DevPrestation\UpdateRequestDevPrestation;
use App\Http\Requests\UserProfile\AddStackRequest;
use App\Http\Requests\UserProfile\UpdatePasswordRequest;
use App\Http\Requests\UserProfile\UserProfileRequest;
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

    /**
     * Add a new stack to the developer
     * @param  AddStackRequest  $request
     * @return JsonResponse
     */
    public function addStack(AddStackRequest $request): JsonResponse
    {
        // check if the developer already added this stack
        $alreadyExists = DeveloperStack::where('developer_id', auth()->user()->developer->id)
            ->where('stack_id', $request->input('stack_id'))
            ->first();

        if ($alreadyExists) {
            return response()->json([
                'message' => 'Vous avez déjà ajouté cette compétence',
            ], 400);
        }

        $dev_stack = DeveloperStack::create([
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
     * Update the primary stack
     *
     * @param $id
     * @return JsonResponse
     */
    public function updatePrimaryStack($id)
    {
        // Retrieve the developer and the new stack to set as is_primary
        $developer = auth()->user()->developer;
        $stack = DeveloperStack::where('stack_id', $id)->where('developer_id', $developer->id)->first();

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
        }

        // update the stack to be primary
        DeveloperStack::query()->where('stack_id', $stack->stack_id)->update([
            'is_primary' => true,
        ]);

        return response()->json([
            'message' => 'Compétence principale mise à jour avec succès',
        ]);
    }

    /**
     * @param  StoreRequestDevPrestation  $request
     * @return JsonResponse
     */
    public function storeDeveloperPrestation(StoreRequestDevPrestation $request): JsonResponse
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
     * @param UpdateRequestDevPrestation $request
     * @param $id
     * @return JsonResponse
     */
    public function editDeveloperPrestation(UpdateRequestDevPrestation $request, $id): JsonResponse
    {
        if (auth()->user()->developer->id === DeveloperPrestation::find($id)->developer_id) {
            DeveloperPrestation::find($id)->update([
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
    public function deleteDeveloperPrestation($id)
    {
        // delete the developer prestation
        $devPrestation = DeveloperPrestation::find($id);

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
