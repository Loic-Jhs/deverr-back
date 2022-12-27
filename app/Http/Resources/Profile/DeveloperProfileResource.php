<?php

namespace App\Http\Resources\Profile;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeveloperProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'registered_at' => date_format($this->created_at, 'd/m/Y'),
            'avatar' => $this->developer->avatar,
            'description' => $this->developer->description,
            'years_of_experience' => $this->developer->years_of_experience,
            'stacks' => $this->developer->stacks ?
                $this->developer->stacks
                ->map(function ($stack) {
                    return [
                        'id' => $stack->id,
                        'name' => $stack->name,
                        'logo' => $stack->logo,
                    ];
                }) : null,
            'prestations' => $this->developer->developerPrestations ?
                $this->developer->developerPrestations
                ->map(function ($prestation) {
                    return [
                        'id' => $prestation->id,
                        'prestation_type_id' => $prestation->prestation_type_id,
                        'prestation_type_name' => $prestation->prestationType->name,
                        'description' => $prestation->description,
                        'price' => $prestation->price,
                    ];
                }) : null,
        ];
    }
}
