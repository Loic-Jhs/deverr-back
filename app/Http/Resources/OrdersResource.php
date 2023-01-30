<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

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
            'created_at' => Carbon::parse($this->created_at)->format('d/m/Y'),
            'instructions' => $this->instructions,
            'is_paid' => $this->is_paid,
            'is_accepted_by_developer' => $this->is_accepted_by_developer,
            'is_finished' => $this->is_finished,
            'price' => $this->developerPrestation->price,
        ];
    }
}
