<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrdersResource extends JsonResource
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
            'user_fullname' => $this->user->lastname.' '.$this->user->firstname,
            'created_at' => $this->created_at,
            'instructions' => $this->instructions,
            'is_payed' => $this->is_payed,
            'is_accepted_by_developer' => $this->is_accepted_by_developer,
            'is_finished' => $this->is_finished,
            'price' => $this->developerPrestation->price,
        ];
    }
}
