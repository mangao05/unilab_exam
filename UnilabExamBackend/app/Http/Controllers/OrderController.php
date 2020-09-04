<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\Cart;
use Auth;

use App\Http\Services\OrderService;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Resources\OrderBasic as OrderBasicResource;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with(['product', 'user'])->get();
        return OrderBasicResource::collection($orders);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request, OrderService $orderService)
    {

        $cartIds = $orderService->mapId($request->cart_ids);

        $carts = [];

        foreach($cartIds as $cart_id){
            array_push($carts, Cart::where('id', $cart_id)->where('user_id', Auth::user()->id)->with('products')->first());
        }
        
        foreach($carts as $cart){
            Order::create([
                'product_id' => $cart->product_id,
                'user_id' => Auth::user()->id,
                'quantity' => $cart->quantity,
                'price' => $cart->products->price
            ]);

            $cart->delete();
        }

        return "Order placed successfully!";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
