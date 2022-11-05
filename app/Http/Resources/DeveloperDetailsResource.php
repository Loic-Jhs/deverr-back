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
            'registered_at' => date_format($this->user->created_at, 'd/m/Y'),
            'avatar' => $this->avatar,
            'description' => $this->description,
            'years_of_experience' => $this->years_of_experience,
            'stacks' => $this->stacks ? $this->stacks->map(function ($stack) {
                return [
                    'id' => $stack->id,
                    'name' => $stack->name,
                    'logo' => $stack->logo,
                ];
            }) : null,
            'prestations' => $this->developerPrestations ? $this->developerPrestations->map(function ($prestation) {
                return [
                    'id' => $prestation->id,
                    'name' => $prestation->prestationType->name,
                ];
            }) : null,
            'reviews' => $this->reviews ? $this->reviews->map(function ($review) {
                return [
                    'id' => $review->id,
                    'rating' => $review->rating,
                    'comment' => $review->comment,
                    'user_who_reviewed' => $review->order->user->firstname.' '.$review->order->user->lastname,
                    'created_at' => date_format($review->created_at, 'd/m/Y'),
                ];
            }) : null,
            'average_rating' => $this->reviews ? number_format($this->reviews->avg('rating'), 1) : null,
            'orders_count' => $this->orders->count() ?? 0,
            'last_order_date' => $this->orders->last() ? date_format($this->orders->last()->created_at, 'd/m/Y') : null,
        ];
    }
}
