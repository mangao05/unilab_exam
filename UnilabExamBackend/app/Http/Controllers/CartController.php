<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;

use Illuminate\Http\Request;
use App\Http\Requests\Cart\AddToCartRequest;
use App\Http\Services\CartServices;

use App\Http\Resources\CartBasic as CartBasicResource;


use Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartProducts = Cart::where('user_id', Auth::user()->id)->with('products')->get();
        return CartBasicResource::collection($cartProducts);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddToCartRequest $request, CartServices $cartService)
    {
        $product = Cart::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)->first();

        if(empty($product)){
            $product = Product::find($request->product_id);

            $product->cart()->create([
                'user_id' => Auth::user()->id,
                'quantity' => $request->quantity
            ]);
        }

        $quantity = $cartService->computeQuantity($product->quantity, $request->quantity);

        $product->update([
            'quantity' => $quantity
        ]);

        
        
        return response()->json('Added to Cart');
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = Cart::where('id', $id)->where('user_id', Auth::user()->id)->first();
        $cart->delete();
        return response()->json('Removed from cart');
    }

    public function cartCount(){
        $cartProducts = Cart::where('user_id', Auth::user()->id)->with('products')->get();
        return count($cartProducts);
    }
}
