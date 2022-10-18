<?php

namespace App\Http\Controllers\Api\Developer;

use App\Http\Controllers\Controller;
use App\Http\Resources\DeveloperResource;
use App\Models\Developer;
use Illuminate\Http\JsonResponse;

class RandomDevsController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function getSixRandomUsers(): \Illuminate\Http\JsonResponse
    {
        // get 6 random developers, with their review ratings >=3 / if they have no ratings but have no complaints,
        $developers =
            Developer::select('id', 'avatar', 'user_id') // Dans la table `developers` on sélectionne l'id, l'avatar et l'user_id
            ->with('reviews', 'developerStacks', 'complaints', 'user') // On load les relations liées au devs (Eager Loading)
            ->distinct() // Récupère les développeurs de façon distincte
            ->get()      // Transforme en Collection
            ->filter(function ($developer) { // On va filtrer les développeurs et le filtre nous retournera ceux conformes aux critères
                return
                    $developer->complaints->count() === 0        // Nous voulons que le développeur n'ait aucune plainte
                    &&                                           // ET
                    (
                        $developer->reviews->avg('rating') >= 3  // (Qu'il ait SOIT une moyenne de note supérieure ou égale à 3)
                        || $developer->reviews->count() === 0       // (SOIT aucune note)
                        || $developer->reviews->avg('rating') === 0 // (SOIT une moyenne de note à 0)
                    )
                    &&                                             // ET
                    $developer->developerStacks->count() > 0;    // Qu'il ait au moins une Stack
            })
                ->shuffle()  // Mélange aléatoirement les développeurs conformes retournés par le filtre
                ->take(6);    // Nous en récupérons 6

        return response()->json(
            // On retourne les développeurs sous forme de ressources,
            // pour pouvoir retourner les données exactement comme on le souhaite dans l'API.
            DeveloperResource::collection($developers)
        , 200);
    }
}
