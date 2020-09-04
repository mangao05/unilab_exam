<?php

namespace App\Http\Services;

class OrderService {
    public function mapId($array){
        $ids = explode(',', $array);
            
        $ids = array_map(function($value) {
            return intval($value);
        }, $ids);

        return $ids;
    }
}