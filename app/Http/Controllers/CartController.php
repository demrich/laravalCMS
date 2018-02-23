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

    public function destroy($id)
    {
        Cart::remove($id);
        Cart::instance('shopping')->remove($id);

        return back()->with('success_message', 'Item has been removed!');


    }

    public function removeWish($id)
    {
        Cart::instance('wishList')->remove($id);
        return back()->with('success_message', 'Item has been removed from wishlist!');


    }

    /*
     *
     * Switch Item to Wishlist
     * 
     * 
     */
    
    public function wishList(Request $request, $id)
    {
        $heart = Cart:: get($id);
     
        Cart::remove($id);
        Cart::instance('shopping')->remove($id);

        Cart::instance('wishList')->add($heart->id, $heart->name, 1, $heart->price)
        ->associate('App\Product');
        
        return redirect()->route('cart')->with('success_message','Item added to wishlist!');
    }

    

}
