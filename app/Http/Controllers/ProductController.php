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

    public function uploadProductPost(Request $request) 
    {
        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required', 
            'price' => 'required',           
        ]);

        $productImage = time().'.'.request()->image->getClientOriginalExtension();
        $productName = $request['name'];
        $productDescription = $request['description'];
        $productPrice = $request['price'];

        request()->image->move(public_path('storage/product_images'), $productImage);


        /* Assigns to Database */  
        $product = new Product();
        $product->name = $productName;
        $product->description = $productDescription;
        $product->price = $productPrice;
        $product->created_at = time();
        $product->updated_at = time();
        $product->imagePath = $productImage;
        $product->save();

        return back()
            ->with('success','You have successfully uploaded an image.')
            ->with('image',$productImage);



    }

}
