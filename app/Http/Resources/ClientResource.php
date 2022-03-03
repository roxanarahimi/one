<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $allOrders =[];
        foreach ($this->allOrders as $item){
            array_push($allOrders, new OrderResource($item));
        }
        $addresses =[];
        foreach ($this->addresses as $add){
            array_push($addresses, new ClientAddressResource($add));
        }


        switch ($this->gender) {
            case 'female':
            {
                $gender = 'خانم';
                break;
            }
            case 'male':
            {
                $gender = 'آقا';
                break;
            }
            default:
            {
                $gender = 'نامعلوم';
                break;
            }
        }


        return [
            "id" => (string)$this->id,
            "name" => $this->name,
            "email" => $this->email,
            "mobile" => $this->mobile,
            "gender" => $gender,
            "avatar" => $this->avatar,
            "cart" => new OrderResource($this->cart),
            "orders" => $this->orders,
            "allOrders" => $allOrders,
            "addresses"=> $addresses,
            "created_at" => date('Y-m-d', strtotime($this->created_at)),
            "updated_at" => date('Y-m-d', strtotime($this->updated_at)),
        ];
    }
}
