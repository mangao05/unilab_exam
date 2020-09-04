<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;

use Auth;


use App\Product;
use App\Order;
use App\Cart;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json(Product::with('user')->paginate($request->limit));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        $request['user_id'] = Auth::user()->id;
        $product = Product::create($request->only(['name', 'price', 'user_id']));

        return response()->json('Successfully Created Product!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->all());

        return response()->json('Successfully Updated ' . $product->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::where('product_id', $id)->first();
        $cart = Cart::where('product_id', $id)->first();

        if($order != null || $cart != null){
            return "Cant delete product thats already been ordered or in cart of customer!";
        }

        $product = Product::find($id);
        $product->delete();

        return response()->json('Successfully Deleted Product!');
    }
}
