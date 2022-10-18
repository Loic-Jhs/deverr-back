<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AllDevsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'avatar' => $this->avatar,
            'firstname' => $this->user->firstname,
            'lastname' => $this->user->lastname,
            'average_rating' => $this->reviews->count() > 0 ? number_format($this->reviews->avg('rating'), 1): null,
            'register_date' => $this->user->created_at->format('d/m/Y'),
            'stack' => $this->developerStacks->count() > 0 ? $this->developerStacks->where('is_primary', 1)->first()->stack->only('name', 'logo'): null,
            'prestations' => $this->developerPrestations->count() > 0 ? $this->developerPrestations->map(function ($prestation) {
                return [
                    'id' => $prestation->id,
                    'name' => $prestation->prestation->name,
                ];
            }) : null,
        ];
    }
}
