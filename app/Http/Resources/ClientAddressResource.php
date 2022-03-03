<?php

namespace App\Http\Resources;

use http\Client;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientAddressResource extends JsonResource
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
            'id'=> (string)$this->id,
            'title'=> $this->title,
            'client_id'=> $this->client_id,
//            'client'=> new ClientResource($this->client),
            'state'=> $this->state,
            'city'=> $this->city,
            'address'=> $this->address,
            'postal_code'=> $this->postal_code,
//            'orders'=> OrderResource::collection($this->orders),
//            'orders'=> $this->orders,

            "created_at" => date('Y-m-d', strtotime($this->created_at)),
            "updated_at" => date('Y-m-d', strtotime($this->updated_at)),

        ];
    }
}
