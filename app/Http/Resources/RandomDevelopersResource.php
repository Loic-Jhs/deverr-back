<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RandomDevelopersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'firstname' => $this->user->firstname,
            'lastname' => $this->user->lastname,
            'avatar' => $this->avatar,
            'average_rating' => $this->reviews->avg('rating'),
            'stack' => [
                'name' => $this->primaryStack->first()->name,
                'logo' => $this->primaryStack->first()->logo,
            ],
        ];
    }
}
