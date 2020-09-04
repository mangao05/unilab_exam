<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartBasic extends JsonResource
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
            'id' => $this->id,
            'product_name' => $this->products->name,
            'price' => $this->products->price,
            'quantity' => $this->quantity,
            'total_price' => $this->products->price * $this->quantity
        ];
    }
}
