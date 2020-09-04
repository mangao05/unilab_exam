<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cart;
use App\Order;
use App\User;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'user_id'];

    public function cart(){
        return $this->hasMany(Cart::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }
}
