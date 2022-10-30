<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AllDevelopersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'avatar' => $this->avatar,
            'firstname' => $this->user->firstname,
            'lastname' => $this->user->lastname,
            'description' => $this->description,
            'average_rating' => $this->reviews->count() > 0 ? number_format($this->reviews->avg('rating'), 1) : null,
            'reviews_number' => $this->reviews->count(),
            'stacks' => $this->stacks->count() > 0 ? $this->stacks->map(function ($stack) {
                    return [
                        'id' => $stack->id,
                        'name' => $stack->name,
                        'logo' => $stack->logo
                    ];
            }) : null,
            'prestations' => $this->developerPrestations->count() > 0 ? $this->developerPrestations->map(function ($developerPrestation) {
                return [
                    'id' => $developerPrestation->id,
                    'name' => $developerPrestation->prestationType->name,
                    'description' => $developerPrestation->description,
                    'price' => $developerPrestation->price,
                ];
            }) : null,
        ];
    }
}
