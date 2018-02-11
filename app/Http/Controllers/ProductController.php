<?php

namespace App\Http\Controllers;

use View;
use App\Product; //remember for each model
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getMerch()
    {
        $products = Product::all();
        
        return View::make('merch')->with('products', $products);
    }

    public function uploadProduct() 
    {
        return view('uploadproduct');
    }

    public function uploadProductPost() 
    {
        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $productImage = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $productImage);

        return back()
            ->with('success','You have successfully upload image.')
            ->with('image',$productImage);


    }

}
