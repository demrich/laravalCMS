<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;


class CartController extends Controller
{
    public function myCart(){
        return view('mycart');
    }

    public function store(Request $request)
    {
        Cart::add($request->id, $request->name, 1 , $request->price)
        ->associate('App\Product');

        return redirect()->route('cart')->with('success_message', 'Item successfully added to cart!');
    }




}
