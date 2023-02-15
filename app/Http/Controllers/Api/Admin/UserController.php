<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BackOffice\StoreUserRequest;
use App\Http\Requests\BackOffice\UpdateUserRequest;
use App\Models\Complaint;
use App\Models\Order;
use App\Models\PrestationType;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $nb_clients = User::where('role_id', 1)->count();
        $nb_prestations = PrestationType::select('id')->count();
        $nb_developers = User::where('role_id', 2)->count();
        $nb_orders = Order::select('id')->count();
        $nb_users = $nb_developers + $nb_clients;
        $nb_complaints = Complaint::select('id')->count();

        return response()->json([
            'nb_clients' => $nb_clients,
            'nb_prestations' => $nb_prestations,
            'nb_developers' => $nb_developers,
            'nb_orders' => $nb_orders,
            'nb_users' => $nb_users,
            'nb_complaints' => $nb_complaints,
        ], 200);
    }

    /**
     * @param  int|null  $id
     * @return JsonResponse
     */
    public function users(int $id = null): JsonResponse
    {
        if (! $id) {
            $users = User::select('id', 'firstname', 'lastname', 'email', 'email_verified_at', 'is_account_active')->paginate();
        } else {
            $users = User::select('id', 'firstname', 'lastname', 'email', 'email_verified_at', 'is_account_active')->where('id', $id)->paginate();
        }

        return response()->json([
            'users' => $users,
        ], 200);
    }

    /**
     * @param  StoreUserRequest  $request
     * @return JsonResponse
     */
    public function storeUser(StoreUserRequest $request): JsonResponse
    {
        $user = User::create([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role_id' => 3,
        ]);

        return response()->json([
            'message' => 'Utilisateur '.$user->lastname.' '.$user->firstname.' créé avec succès',
        ], 201);
    }

    /**
     * @param  UpdateUserRequest  $request
     * @return JsonResponse
     */
    public function editUser(UpdateUserRequest $request): JsonResponse
    {
        $user = User::where('id', $request->id)->first();

        if (! $user) {
            abort(404, 'Utilisateur introuvable');
        }

        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');

        if ($user->role_id == 2) {
            $dev = $user->developer();
            $dev->description = $request->description;
            $dev->experience = $request->experience;
            $dev->update();
        }
        $user->update();

        return response()->json([
            'message' => sprintf("L'utilisateur %s à été modifié", $user->firstname.' '.$user->lastname),
        ], 200);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function deleteUser($id)
    {
        $user = User::find($id);

        if (! $user) {
            abort(404, 'Utilisateur introuvable');
        }

        $user->delete();

        return response()->json([
            'message' => 'Utilisateur supprimé avec succès',
        ], 200);
    }

    /**
     * @param $email
     * @return JsonResponse
     */
    public function deleteUserByEmail($email)
    {
        $user = User::where('email', $email)->first();

        if (! $user) {
            abort(404, 'Utilisateur introuvable');
        }

        $user->forceDelete();

        return response()->json([
            'message' => 'Utilisateur supprimé avec succès',
        ], 200);
    }
}
