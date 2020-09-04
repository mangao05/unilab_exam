<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Product;
use App\User;

class Order extends Model
{
    protected $fillable = ['product_id', 'user_id', 'quantity', 'price'];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
