<?php

namespace App\Http\Resources\Profile;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
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
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'registered_at' => date_format($this->created_at, 'd/m/Y'),
            'orders' => $this->orders ? $this->orders->map(function ($order) {
                return [
                    'created_at' => date_format($order->created_at, 'd/m/Y'),
                    'updated_at' => date_format($order->updated_at, 'd/m/Y'),
                    'developer' => $order->developer->user->lastname.' '.$order->developer->user->firstname,
                    'is_finished' => $order->is_finished,
                    'is_paid' => $order->is_paid,
                    'is_accepted_by_developer' => $order->is_accepted_by_developer,
                    'prestation_name' => $order->developerPrestation->prestationType->name,
                    'price' => $order->developerPrestation->price,
                    'instructions' => $order->instructions,
                ];
            }) : null,
        ];
    }
}
