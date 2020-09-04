<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderBasic extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->product->name,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'user' => $this->user->name,
            'total_price' => $this->quantity * $this->price
        ];
    }
}
