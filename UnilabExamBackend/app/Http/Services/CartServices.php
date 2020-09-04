<?php

namespace App\Http\Services;

class CartServices {
    
    public function computeQuantity($old_quantity, $add_quantity){
        return $old_quantity + $add_quantity;
    }

}