<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Product;

class Cart extends Model
{
    protected $fillable = ['product_id', 'user_id', 'quantity'];

    public function products(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
