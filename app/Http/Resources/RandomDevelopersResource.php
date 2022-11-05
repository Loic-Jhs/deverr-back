<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class RandomDevelopersResource extends JsonResource
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
            'firstname' => $this->user->firstname,
            'lastname' => $this->user->lastname,
            'avatar' => $this->avatar,
            'average_rating' => $this->reviews->avg('rating'),
            'stack' => [
                'name' => $this->developerStacks->first() ? $this->developerStacks->firstWhere('is_primary', 1)->stack->name : null,
                'logo' => $this->developerStacks->first() ? $this->developerStacks->firstWhere('is_primary', 1)->stack->logo : null,
            ],
        ];
    }
}
