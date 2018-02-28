<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
Use Illuminate\Support\Facades\Validator;


class CartController extends Controller
{
    public function myCart(){
        return view('mycart');
    }

     /*
     *
     * Add item to shopping cart
     * 
     * 
     */

    public function store(Request $request)
    {
      $duplicates = Cart::search(function ($cartItem, $rowId) use($request) {
            return $cartItem->id === $request->id;
        });

        if ($duplicates->isNotEmpty()) {
            return redirect()->route('merch')->with('success_message', 'Item is already in cart!');
        }

        Cart::add($request->id, $request->name, 1 , $request->price)
        ->associate('App\Product');
        
        Cart::instance('shopping')->add($request->id, $request->name, 1 , $request->price)
        ->associate('App\Product');

        return redirect()->route('cart')->with('success_message', 'Item successfully added to cart!');
    }

    public function update(Request $request, $id)
    {



    }

     /*
     *
     * Remove item from cart
     * 
     * 
     */

    public function destroy($id)
    {
        Cart::remove($id);
        Cart::instance('shopping')->remove($id);

        return back()->with('success_message', 'Item has been removed!');


    }

}
