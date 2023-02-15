<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailsResource extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'           => $this->id,
            'reference'    => $this->reference,
            'prestation'   => $this->developerPrestation->prestationType->name,
            'fullname'     => $this->developer->user->lastname . ' ' . $this->developer->user->firstname,
            'developer_id' => $this->developer->id,
        ];
    }
}


