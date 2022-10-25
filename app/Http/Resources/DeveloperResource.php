<?php

namespace App\Http\Resources;

use App\Models\Review;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class DeveloperResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'id' => $this->id,
            'avatar' => $this->avatar,
            // récupération de la note moyenne des reviews du développeur
            'average_rating' => $this->reviews->count() > 0 ? // vérification qu'il y ait au moins une review
                number_format($this->reviews->avg('rating'), 1) : // si oui, on retourne la moyenne arrondie à 1 chiffre après la virgule
                null, // sinon, on retourne null
            // Sa stack de prédilection (on fait un test pour vérifier qu'il en ait au moins une).
            'stack' => $this->developerStacks->count() > 0 ? // vérification qu'il y ait au moins une stack
                $this->developerStacks->where('is_primary', 1) // Retourne la stack de prédilection du dev
                     ->first() // Normalement en retourne uniquement une, mais au cas où on récupère quand même le premier élément
                     ->stack // Récupère la relation stack (accède au model Stack)
                     ->only('name', 'logo') : // Récupère uniquement les attributs name et logo de la stack
                null, // sinon, on retourne null
            'developer_firstname' => $this->user->firstname,
            'developer_lastname' => $this->user->lastname,
        ];
    }
}
