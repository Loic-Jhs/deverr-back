<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DeveloperDetailsResource extends JsonResource
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
            'firstname' => $this->user->firstname,
            'lastname' => $this->user->lastname,
            'avatar' => $this->avatar,
            'description' => $this->description,
            'stacks' => $this->stacks->map(function ($stack) {
                return [
                    'id' => $stack->id,
                    'name' => $stack->name,
                    'logo' => $stack->logo
                ];
            }),
            'prestations' => $this->developerPrestations->map(function ($prestation) {
                return [
                    'id' => $prestation->id,
                    'name' => $prestation->name,
                ];
            }),
            'reviews' => $this->reviews->map(function ($review) {
                return [
                    'id' => $review->id,
                    'rating' => $review->rating,
                    'comment' => $review->comment,
                ];
            }),
        ];
    }
}
