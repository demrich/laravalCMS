<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
Use Illuminate\Support\Facades\Validator;

class WishlistController extends Controller
{

     /*
     *
     * Add item from wishlist to shopping cart
     * 
     * 
     */

    public function store(Request $request)
    {
      $duplicates = Cart::search(function ($cartItem, $rowId) use($request) {
            return $cartItem->id === $request->id;
        });

        if ($duplicates->isNotEmpty()) {
            return redirect()->route('cart')->with('success_message', 'Item is already in cart!');
        }

        Cart::add($request->id, $request->name, 1 , $request->price)
        ->associate('App\Product');
        
        Cart::instance('shopping')->add($request->id, $request->name, 1 , $request->price)
        ->associate('App\Product');

        return redirect()->route('cart')->with('success_message', 'Item successfully moved to cart!');
        
    }

/*
     *
     * Switch Item to Wishlist
     * 
     * 
     */
    
    public function wishList($id)
    {
        $heart = Cart:: get($id);
        Cart::remove($id);
        Cart::instance('shopping')->remove($id);

        $duplicates = Cart::instance('wishList')->search(function ($cartItem, $rowId) use($id) {
            return $rowId === $id;
        });

        if ($duplicates->isNotEmpty()) {
            return redirect()->route('cart')->with('success_message', 'Item is already in Wishlist!');
        }

        Cart::instance('wishList')->add($heart->id, $heart->name, 1, $heart->price)
        ->associate('App\Product');
        
        return redirect()->route('cart')->with('success_message','Item added to wishlist!');
        
    }

    /*
     *
     * Remove item from wishlist
     * 
     * 
     */

    public function removeWish($id)
    {
        Cart::instance('wishList')->remove($id);
        return back()->with('success_message', 'Item has been removed from wishlist!');


    }
}
