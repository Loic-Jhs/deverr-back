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
            'rating' => $this->reviews->count() > 0 ? $this->reviews->avg('rating') : null,
            'stacks' => $this->stacks->count() > 0 ? $this->stacks->map(function ($stack) {
                    return [
                        'id' => $stack->id,
                        'name' => $stack->name,
                        'logo' => $stack->logo
                    ];
            }) : null,
            'prestations' => $this->developerPrestations->count() > 0 ? $this->developerPrestations->map(function ($prestation) {
                return [
                    'id' => $prestation->id,
                    'name' => $prestation->name,
                ];
            }) : null,
        ];
    }
}
