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
}
